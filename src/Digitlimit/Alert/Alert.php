<?php namespace Digitlimit\Alert;

use Illuminate\Session\Store;

class Alert {

    protected $alert_message_type;
    protected $alert_message_title;
    protected $alert_message;
    protected $alert_message_status = 'success'; //default
    protected $alert_message_icon;
    protected $alert_message_closable  = false; //default
    protected $alert_message_self_destroy  = false; //default

    protected $alert_message_modal_size  = '';
    protected $alert_message_modal_view  = '';

    protected $alert_message_action_button_label; //default
    protected $alert_message_action_button_url; //default

    protected $alert_message_close_button_label; //default
    protected $alert_message_close_button_url; //default



    public function __construct(Store $session){
        $this->session = $session;
    }

    protected function flash(){
        $this->session->flash($this->alert_message_type, true);
        $this->session->flash('alert_message_title', $this->alert_message_title);
        $this->session->flash('alert_message', $this->alert_message);
        $this->session->flash('alert_message_status', $this->alert_message_status);
        $this->session->flash('alert_message_icon', $this->alert_message_icon);
        $this->session->flash('alert_message_closable', $this->alert_message_closable);
        $this->session->flash('alert_message_self_destroy', $this->alert_message_self_destroy);
        $this->session->flash('alert_message_modal_size', $this->alert_message_modal_size);
        $this->session->flash('alert_message_modal_view', $this->alert_message_modal_view);

        $this->session->flash('alert_message_action_button_label', $this->alert_message_action_button_label);
        $this->session->flash('alert_message_action_button_url', $this->alert_message_action_button_url);

        $this->session->flash('alert_message_close_button_label', $this->alert_message_close_button_label);
        $this->session->flash('alert_message_close_button_url', $this->alert_message_close_button_url);


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

    public function icon($icon=''){
        $this->alert_message_icon = $icon;
        return $this->flash();
    }

    public function actionButton($label='',$url=''){
        $this->alert_message_action_button_label = $label;
        $this->alert_message_action_button_url = $url;
        return $this->flash();
    }

    public function closeButton($label='',$url=''){
        $this->alert_message_close_button_label = $label;
        $this->alert_message_close_button_url = $url;
        return $this->flash();
    }


    public function large(){
        $this->alert_message_modal_size = 'modal-lg';
        return $this->flash();
    }

    public function small(){
        $this->alert_message_modal_size = 'modal-sm';
        return $this->flash();
    }



    //Alert status
    public function success(){
        $this->alert_message_status = 'success';
        $this->alert_message_icon = 'fa fa-check-circle';
        return $this->flash();
    }

    public function info(){
        $this->alert_message_status = 'info';
        $this->alert_message_icon = 'fa fa-info';
        return $this->flash();
    }

    public function warning(){
        $this->alert_message_status = 'warning';
        $this->alert_message_icon = 'fa fa-warning';
        return $this->flash();
    }

    public function error(){
        $this->alert_message_status = 'danger';
        $this->alert_message_icon = 'fa fa-times-circle';
        return $this->flash();
    }

    public function royal(){
        $this->alert_message_status = 'royal';
        $this->alert_message_icon = 'fa fa-bullhorn';
        return $this->flash();
    }

    public function primary(){
        $this->alert_message_status = 'primary';
        $this->alert_message_icon = 'fa fa-comments-o';
        return $this->flash();
    }




    //Alert Types
    public function modal($message, $title='',$view=''){
        $this->alert_message_type       = 'alert_modal_message';
        $this->alert_message_title      = $title;
        $this->alert_message            = $message;
        $this->alert_message_modal_view = $view;

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


    //Helpers
    public function has($alert_message_type){
        switch($alert_message_type){
            case 'modal':
                return $this->session->has('alert_modal_message');
                break;

            case 'form':
                return $this->session->has('alert_form_message');
                break;

            case 'notify':
                return $this->session->has('alert_form_message');
                break;

        }
    }


}