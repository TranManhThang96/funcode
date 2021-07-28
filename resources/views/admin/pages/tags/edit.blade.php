<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-edit-tag-label">Edit tag</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-edit-tag">
                <input type="hidden" id="tag-id" name="id" value="{{$tag->id}}"/>
                @csrf
                <div class="form-group row">
                    <label for="input-tag-label" class="col-sm-3 col-form-label">Tag Label</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="input-tag-label" name="label"
                               value="{{$tag->label}}">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="edit-tag">Save changes</button>
        </div>
    </div>
</div>
