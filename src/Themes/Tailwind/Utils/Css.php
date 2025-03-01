<?php

namespace Digitlimit\Alert\Themes\Tailwind\Utils;

use Illuminate\Support\Facades\Cache;

/**
 * Class Css
 */
class Css
{
    protected array $classes;

    protected string $cacheKey = 'alert_unique_tailwind_classes';

    public function __construct(array $classes = [])
    {
        $this->classes = $classes;
    }

    /**
     * Set the classes
     *
     * @param array $classes
     * @return Css
     */
    public function setClasses(array $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    /**
     * Flush the cache
     */
    public function flushCache(): void
    {
        Cache::forget($this->cacheKey);
    }


    /**
     * Retrieve unique Tailwind classes with caching
     *
     * @return array
     */
    public function uniqueClasses(): array
    {
        return Cache::rememberForever($this->cacheKey, function () {
            return $this->extractUniqueClasses($this->classes);
        });
    }

    /**
     * Recursively extract unique Tailwind classes from the provided array
     *
     * @param array $array
     * @return array
     */
    protected function extractUniqueClasses(array $array): array
    {
        $allClasses = [];

        array_walk_recursive($array, function ($value) use (&$allClasses) {
            if (is_string($value)) {
                $allClasses = array_merge($allClasses, explode(' ', $value));
            }
        });

        return array_values(array_unique($allClasses));
    }
}
