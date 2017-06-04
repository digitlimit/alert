@if ( Alert::has('modal') )
    <div class="modal fade" id="alert-modal-message" tabindex="-1" role="dialog" aria-labelledby="alert-modal-message" @if(Alert::un_closable_strict()) data-backdrop="static" data-keyboard="false" @endif aria-hidden="true">
        <div class="modal-dialog {{Alert::modal_size()}}">
            <div class="modal-content">
                <div class="modal-header">
                    @if(Alert::closable())
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    @endif

                    @if(Alert::title())
                        <h4 class="modal-title  @if(Alert::status())modal-{{Alert::status()}}@endif" id="alert-modal-message-title">
                            @if(Alert::icon())<i class="{{Alert::icon()}}"></i>@endif
                            {{Alert::title()}}
                        </h4>
                    @endif
                </div>

                <div class="modal-body">
                    @if(Alert::modal_view())
                        @include(Alert::modal_view())
                    @else
                        {!!Alert::message()!!}
                    @endif
                </div>

                <div class="modal-footer">

                    @if(Alert::close_button_label())
                        @if(Alert::close_button_url())
                            <a href="{{Alert::close_button_url()}}" type="button" class="btn btn-ar btn-default" data-dismiss="modal" @if(is_array(Alert::close_button_attributes())) {{implode(" ",Alert::close_button_attributes())}} @endif >
                                {{Alert::close_button_label()}}
                            </a>
                        @else
                            <button type="button" class="btn btn-ar btn-default" data-dismiss="modal">
                                {{Alert::close_button_label()}}
                            </button>
                        @endif
                    @endif



                    @if(Alert::action_button_label())
                        @if(Alert::action_button_url())
                            <a href="{{Alert::action_button_url()}}" type="button" class="btn btn-ar btn-primary">
                                {{Alert::action_button_label()}}
                            </a>
                        @else
                            <button type="button" class="btn btn-ar btn-primary">{{Alert::action_button_label()}}</button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.onload = function(){
            $('#alert-modal-message').modal('show');
        };
    </script>
@endif
