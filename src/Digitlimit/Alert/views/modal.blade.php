@if ( Alert::has('modal') )

    <?php
        $icon = Alert::icon();
        $status = Alert::status();
        $title = Alert::title();
        $message = Alert::message();
        $action_button = Alert::action_button_label();
        $action_button_url = Alert::action_button_url();
        $close_button = Alert::close_button_label();
        $close_button_url = Alert::close_button_url();
    ?>

    <script type="text/javascript">
        window.onload = function()
        {
            swal("{{$title}}", "{{$message}}", "{{$status}}");
        };
    </script>
@endif