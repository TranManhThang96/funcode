<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"
                id="modal-add-series-label">{{__('admin_label.pages.series.modal.modal_add_name')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-add-series">
                <input type="hidden" id="series-id" value=""/>
                @csrf
                <div class="form-group row">
                    <label for="input-series-name"
                           class="col-sm-3 col-form-label">{{__('admin_label.pages.series.modal.tag_label')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="input-series-name" name="name">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{__('admin_label.common.modal.close')}}</button>
            <button type="button" class="btn btn-primary"
                    id="add-series">{{__('admin_label.common.modal.save')}}</button>
        </div>
    </div>
</div>
