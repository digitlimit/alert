<?php

use Digitlimit\Alert\Foundation\AlertInterface;
use Digitlimit\Alert\Helpers\SessionKey;
use Illuminate\Support\Facades\Session;
use Digitlimit\Alert\Foundation\AbstractAlert;

beforeEach(function () {
    Session::flush(); // Ensure clean session state before each test
});

it('can auto-set and retrieve ID', function () {
    $alert = new class extends AbstractAlert {
        public string $message = 'Test Alert';
        public function key(): string
        {
            return 'test_alert';
        }

        public static function fill(array $alert): AlertInterface
        {
            $instance = new self();
            $instance->id($alert['id'] ?? 'default-id');
            $instance->message = $alert['message'] ?? 'Default message';
            return $instance;
        }
    };

    expect($alert->getId())->not()->toBeEmpty()
        ->and($alert->getIdTag())->toContain('test_alert');
})->group('alert', 'abstract-alert', 'auto-set-id');

it('can manually set ID', function () {
    $alert = new class extends AbstractAlert {
        public string $message = 'Test Alert';
        public function key(): string
        {
            return 'manual_alert';
        }

        public static function fill(array $alert): AlertInterface
        {
            $instance = new self();
            $instance->id($alert['id'] ?? 'default-id');
            $instance->message = $alert['message'] ?? 'Default message';
            return $instance;
        }
    };

    $alert->id('custom-id');

    expect($alert->getId())->toBe('custom-id')
        ->and($alert->getIdTag())->toBe('manual_alert.custom-id');
})->group('alert', 'abstract-alert', 'manual-set-id');

it('flashes alert to session if id and message are set', function () {
    $alert = new class extends AbstractAlert {
        public string $message = 'Hello session';
        public function key(): string
        {
            return 'session_alert';
        }

        public static function fill(array $alert): AlertInterface
        {
            $instance = new self();
            $instance->id($alert['id'] ?? 'default-id');
            $instance->message = $alert['message'] ?? 'Default message';
            return $instance;
        }
    };

    $alert->id('flash-id');
    $sessionKey = SessionKey::key('session_alert', 'session_alert.flash-id');

    expect(Session::get($sessionKey))->toBe($alert);
})->group('alert', 'abstract-alert', 'flash-session');

it('does not flash if message is empty', function () {
    $alert = new class extends AbstractAlert {
        public function key(): string
        {
            return 'session_alert';
        }

        public static function fill(array $alert): AlertInterface
        {
            $instance = new self();
            $instance->id($alert['id'] ?? 'default-id');
            $instance->message = $alert['message'] ?? 'Default message';
            return $instance;
        }
    };

    $alert->id('no-message-id');
    $sessionKey = SessionKey::key('session_alert', 'session_alert.no-message-id');

    expect(Session::has($sessionKey))->toBeFalse();
})->group('alert', 'abstract-alert', 'no-flash-empty-message');

it('can forget session key', function () {
    $alert = new class extends AbstractAlert {
        public string $message = 'Forget me';
        public function key(): string
        {
            return 'forget_alert';
        }

        public static function fill(array $alert): AlertInterface
        {
            $instance = new self();
            $instance->id($alert['id'] ?? 'default-id');
            $instance->message = $alert['message'] ?? 'Default message';
            return $instance;
        }
    };

    $alert->id('forget-id');
    $sessionKey = SessionKey::key('forget_alert', 'forget_alert.forget-id');

    expect(Session::get($sessionKey))->toBe($alert);

    $alert->forget();

    expect(Session::has($sessionKey))->toBeFalse();
})->group('alert', 'abstract-alert', 'forget-session');

it('can convert to array and json', function () {
    $alert = new class extends AbstractAlert {
        public string $message = 'Format test';
        public function key(): string
        {
            return 'json_alert';
        }

        public static function fill(array $alert): AlertInterface
        {
            $instance = new self();
            $instance->id($alert['id'] ?? 'default-id');
            $instance->message = $alert['message'] ?? 'Default message';
            return $instance;
        }
    };

    $id = $alert->getId();

    expect($alert->toArray())->toBe(['id' => $id])
        ->and($alert->toJson())->toBe(json_encode(['id' => $id]));
})->group('alert', 'abstract-alert', 'to-array-json');
