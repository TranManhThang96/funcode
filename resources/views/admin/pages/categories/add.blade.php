<div class="modal fade" id="modal-add-category" tabindex="-1" aria-labelledby="modal-add-category" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-add-category-label">Add category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-category">
                    <input type="hidden" id="category-id" value="" />
                    @csrf
                    <div class="form-group row">
                        <label for="input-category-name" class="col-sm-2 col-form-label">Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-category-name" name="category_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-category-parent" class="col-sm-2 col-form-label">Parent</label>
                        <div class="col-sm-10">
                            <select class="custom-select mr-sm-2" id="input-category-parent" name="category_parent">
                                <option selected value="{{\App\Enums\DBConstant::NO_PARENT}}">No parent</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-category">Save changes</button>
            </div>
        </div>
    </div>
</div>
