<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-add-tag-label">{{__('admin_label.pages.tags.modal.modal_add_name')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-add-tag">
                <input type="hidden" id="tag-id" value=""/>
                @csrf
                <div class="form-group row">
                    <label for="input-tag-label"
                           class="col-sm-3 col-form-label">{{__('admin_label.pages.tags.modal.tag_label')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="input-tag-label" name="label">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{__('admin_label.common.modal.close')}}</button>
            <button type="button" class="btn btn-primary" id="add-tag">{{__('admin_label.common.modal.save')}}</button>
        </div>
    </div>
</div>
