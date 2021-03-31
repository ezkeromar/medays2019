<div class="modal fade" id="confirmSave" role="dialog" aria-labelledby="confirmSaveLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{!! trans('modals.edit_user__modal_text_confirm_title') !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{!! trans('modals.confirm_modal_title_text') !!}</p>
            </div>
            <div class="modal-footer">
                {!! Form::button('<i class="fa fa-fw '.trans('modals.confirm_modal_button_cancel_icon').'" aria-hidden="true"></i> ' . trans('modals.confirm_modal_button_cancel_text'), array('class' => 'btn btn-outline pull-left btn-flat', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
                {!! Form::button('<i class="fa fa-fw '.trans('modals.confirm_modal_button_save_icon').'" aria-hidden="true"></i> ' . trans('modals.confirm_modal_button_save_text'), array('class' => 'btn btn-success pull-right btn-flat', 'type' => 'button', 'id' => 'confirm' )) !!}
            </div>
        </div>
    </div>
</div>
