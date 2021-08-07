<select class="custom-select custom-select-2 mr-sm-2 select-category-option" name="category_id">
    <option
        value="{{\App\Enums\DBConstant::NO_CATEGORY}}">{{__('admin_label.pages.articles.table.no_category')}}</option>
    @if(isset($categories))
        @foreach($categories as $category)
            <option
                value="{{$category['id']}}" {{$categorySelected == $category['id'] ? 'selected' : ''}}>{{$category['label']}}</option>
        @endforeach
    @endif
</select>
