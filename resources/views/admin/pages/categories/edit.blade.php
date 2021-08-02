<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"
                id="modal-edit-category-label">{{__('admin_label.pages.categories.modal.modal_edit_name')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-edit-category">
                <input type="hidden" id="category-id" name="id" value="{{$category->id}}"/>
                @csrf
                <div class="form-group row">
                    <label for="input-category-name"
                           class="col-sm-3 col-form-label">{{__('admin_label.pages.categories.modal.category_name')}}</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="input-category-name" name="name"
                               value="{{$category->name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="select-category-parent"
                           class="col-sm-3 col-form-label text-nowrap">{{__('admin_label.pages.categories.modal.category_parent')}}</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select-2 mr-sm-2 select-category-parent" name="parent_id">
                            <option selected
                                    value="{{\App\Enums\DBConstant::NO_PARENT}}">{{__('admin_label.pages.categories.modal.no_parent')}}</option>
                            @if(isset($categories))
                                @foreach($categories as $cate)
                                    <option
                                        value="{{$cate['id']}}" {{$category->parent_id === $cate['id'] ? 'selected' : ''}}>{{$cate['label']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{__('admin_label.common.modal.close')}}</button>
            <button type="button" class="btn btn-primary"
                    id="edit-category">{{__('admin_label.common.modal.save')}}</button>
        </div>
    </div>
</div>
