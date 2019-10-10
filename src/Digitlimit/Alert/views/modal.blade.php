@if ( Alert::has('modal') )
    <div class="modal fade" id="digitlimit-alert" tabindex="-1" role="dialog" aria-labelledby="digitlimit-alert" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        @if(Alert::icon()) <i class="{{Alert::icon()}}"></i> @endif
                            {{Alert::title()}}
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                   {{Alert::message()}}
                </div>
                <div class="modal-footer">

                    <a href="{{Alert::close_button_url() ? Alert::close_button_url() : 'javascript:void(0);'}}"
                       class="btn btn-secondary" data-dismiss="modal">
                        {{Alert::close_button_label() ? Alert::close_button_label() : 'Close'}}
                    </a>

                    <a href="{{Alert::action_button_url() ? Alert::action_button_url() : 'javascript:void(0);'}}"
                       class="btn btn-primary">
                        {{Alert::action_button_label() ? Alert::action_button_label() : 'Ok'}}
                    </a>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.onload = function()
        {
            $('#digitlimit-alert').modal('show');
        };
    </script>

@endif