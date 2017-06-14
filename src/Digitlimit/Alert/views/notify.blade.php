@if(Alert::has('notify'))
    <?php
        $icon = Alert::icon();
        $status = Alert::status();
        $title = Alert::title();
        $message = Alert::message();
    ?>

    <div class="alert {{$status}}">
        <input type="checkbox" id="alert1"/>
        <div class="close" title="close" for="alert1">
            <i class="icon-remove"></i>
        </div>
        <p class="inner">
            @if($icon)<i class="{{$icon}}"></i>@endif
            @if(isset($title))<strong>{{$title}}</strong>@endif {{$message}}
        </p>
    </div>
@endif