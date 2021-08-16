<div class="columns">
    <ul>
        <li class="form-check pl-0 my-3 pr-3">
            <input class="form-check-input" type="checkbox" id="articles-all-columns" value="articles-all-columns">
            <label class="form-check-label" for="articles-all-columns">{{__('admin_label.common.table.all')}}</label>
        </li>

        <div class="body">
            @foreach(array_values($articlesColumns) as $column)
                <li class="form-check pl-0 mb-3 pr-3">
                    <input class="form-check-input" type="checkbox" id="{{$column['class']}}" value="{{$column['class']}}">
                    <label class="form-check-label" for="{{$column['class']}}">{{$column['label']}}</label>
                </li>
            @endforeach
        </div>
    </ul>
    <div class="footer">
        <button class="btn btn-success btn-block" id="btn-check-columns">{{__('admin_label.common.button.apply')}}</button>
    </div>
</div>
