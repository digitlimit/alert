<?php namespace Digitlimit\Alert;

use Illuminate\Session\Store;

class Alert {

    protected $alert_message_type;
    protected $alert_message_title;
    protected $alert_message;
    protected $alert_message_status = 'success'; //default
    protected $alert_message_closable  = false; //default
    protected $alert_message_self_destroy  = false; //default



    public function __construct(Store $session){
        $this->session = $session;
    }

    protected function flash(){
        $this->session->flash($this->alert_message_type, true);
        $this->session->flash('alert_message_title', $this->alert_message_title);
        $this->session->flash('alert_message', $this->alert_message);
        $this->session->flash('alert_message_status', $this->alert_message_status);
        $this->session->flash('alert_message_closable', $this->alert_message_closable);
        $this->session->flash('alert_message_self_destroy', $this->alert_message_self_destroy);

        return $this;
    }


    //Actions
    public function closable(){
        $this->alert_message_closable = true;
        return $this->flash();
    }

    public function selfDestroy(){
        $this->alert_message_self_destroy = true;
        return $this->flash();
    }



    //Alert status
    public function success(){
        $this->alert_message_status = 'success';
        return $this->flash();
    }

    public function info(){
        $this->alert_message_status = 'info';
        return $this->flash();
    }

    public function warning(){
        $this->alert_message_status = 'warning';
        return $this->flash();
    }

    public function error(){
        $this->alert_message_status = 'danger';
        return $this->flash();
    }

    public function royal(){
        $this->alert_message_status = 'royal';
        return $this->flash();
    }

    public function primary(){
        $this->alert_message_status = 'primary';
        return $this->flash();
    }




    //Alert Types
    public function modal($message, $title=''){
        $this->alert_message_type    = 'alert_modal_message';
        $this->alert_message_title   = $title;
        $this->alert_message         = $message;

        return $this->flash();
    }

    public function form($message, $title=''){

        $this->alert_message_type    = 'alert_form_message';
        $this->alert_message_title   = $title;
        $this->alert_message = $message;

        return $this->flash();
    }

    public function notify($message, $title=''){

        $this->alert_message_type    = 'alert_notify_message';
        $this->alert_message_title   = $title;
        $this->alert_message = $message;

        return $this->flash();
    }
}
