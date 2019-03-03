<?php

namespace Digitlimit\Alert;

use Illuminate\Session\Store;

class Alert
{
    protected $alert;
    protected $type;
    protected $title;
    protected $message;
    protected $status = 'success'; //default
    protected $icon;
    protected $closable = true; //default
    protected $un_closable = false; //default
    protected $un_closable_strict = false; //default
    protected $self_destroy = false; //default

    protected $persist = false; //default

    protected $sticky_title; //type of alert but cannot be overridden
    protected $sticky_message; //type of alert but cannot be overridden

    protected $modal_size = '';
    protected $modal_view = '';

    protected $action_button_label; //default
    protected $action_button_url; //default

    protected $close_button_label; //default
    protected $close_button_url; //default
    protected $close_button_attributes; //default

    protected $tag; //default

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    protected function flash($type = 'flash')
    {
        $this->alert = [
            $this->type                 => true,
            'type'                      => $this->type,
            'title'                     => $this->title,
            'message'                   => $this->message,
            'status'                    => $this->status,
            'icon'                      => $this->icon,

            'closable'                  => $this->closable,
            'un_closable'               => $this->un_closable,
            'un_closable_strict'        => $this->un_closable_strict,
            'self_destroy'              => $this->self_destroy,
            'persist'                   => $this->persist,

            'sticky_title'              => $this->sticky_title,
            'sticky_message'            => $this->sticky_message,

            'modal_size'                => $this->modal_size,
            'modal_view'                => $this->modal_view,

            'action_button_label'       => $this->action_button_label,
            'action_button_url'         => $this->action_button_url,
            'close_button_label'        => $this->close_button_label,
            'close_button_url'          => $this->close_button_url,
            'close_button_attributes'   => $this->close_button_attributes,

            'tag'                       => $this->tag,
        ];

        $this->session->$type('alert_message', $this->alert);

        return $this;
    }

    protected function alert()
    {
        return $this->session->get('alert_message');
    }

    public function __call($method, $param)
    {
        $alert = $this->alert();
        if (is_array($alert) && property_exists($this, $method) && isset($alert[$method])) {
            return $alert[$method];
        }
    }

    //Actions
    public function persist()
    {
        return $this->flash($type = 'put');
    }

    public function destroy()
    {
        return $this->flash($type = 'pull'); //retrieve an item and forget it
    }

    public function unClosable()
    {
        $this->closable = false;
        $this->un_closable = true;

        return $this->flash();
    }

    public function unClosableStrict()
    {
        $this->closable = false;
        $this->un_closable = true;
        $this->un_closable_strict = true;

        return $this->flash();
    }

    public function selfDestroy()
    {
        $this->self_destroy = true;

        return $this->flash();
    }

    public function setIcon($icon = '')
    {
        $this->icon = $icon;

        return $this->flash();
    }

    public function setActionButton($label = '', $url = '')
    {
        $this->action_button_label = $label;
        $this->action_button_url = $url;

        return $this->flash();
    }

    public function setCloseButton($label = '', $url = '', $attributes = [])
    {
        $this->close_button_label = $label;
        $this->close_button_url = $url;
        $this->close_button_attributes = $attributes;

        return $this->flash();
    }

    public function large()
    {
        $this->modal_size = 'modal-lg';

        return $this->flash();
    }

    public function small()
    {
        $this->modal_size = 'modal-sm';

        return $this->flash();
    }

    //Alert status
    public function success($class_name = 'success')
    {
        $this->status = $class_name;
        $this->icon = 'fa fa-check-circle';

        return $this->flash();
    }

    public function info($class_name = 'info')
    {
        $this->status = $class_name;
        $this->icon = 'fa fa-info';

        return $this->flash();
    }

    public function warning($class_name = 'warning')
    {
        $this->status = $class_name;
        $this->icon = 'fa fa-warning';

        return $this->flash();
    }

    public function error($class_name = 'danger')
    {
        $this->status = $class_name;
        $this->icon = 'fa fa-times-circle';

        return $this->flash();
    }

    public function royal($class_name = 'royal')
    {
        $this->status = $class_name;
        $this->icon = 'fa fa-bullhorn';

        return $this->flash();
    }

    public function primary($class_name = 'primary')
    {
        $this->status = $class_name;
        $this->icon = 'fa fa-comments-o';

        return $this->flash();
    }

    //Alert Types
    public function modal($message, $title = '', $view = '')
    {
        $this->type = 'alert_modal_message';
        $this->title = $title;
        $this->message = $message;
        $this->modal_view = $view;

        return $this->flash();
    }

    public function form($message, $title = '')
    {
        $this->type = 'alert_form_message';
        $this->title = $title;
        $this->message = $message;

        return $this->flash();
    }

    public function notify($message, $title = '')
    {
        $this->type = 'alert_notify_message';
        $this->title = $title;
        $this->message = $message;

        return $this->flash();
    }

    public function sticky($message, $title = '')
    {
        $this->type = 'alert_sticky_message';
        $this->sticky_title = $title;
        $this->sticky_message = $message;

        return $this->flash();
    }

    //Helpers
    public function has($alert_type)
    {
        $alert = $this->alert();

        $alert_type = "alert_{$alert_type}_message";

        return is_array($alert) ? isset($alert[$alert_type]) : false;
    }

    public function tag($name)
    {
        $this->tag = $name;

        return $this->flash();
    }

    /**
     * Tag an alert
     * 
     * @param $name
     * @return bool
     */
    public function tagged($name)
    {
        $alert = $this->alert();

        return  $alert['tag'] == $name;
    }
}
