@extends('admin.layout.default')

@section('title', 'Articles - new')

@section('breadcrumb')
    {{renderBreadcrumb('Create', [['name' => 'Home', 'link' => '/'], ['name' => 'Articles', 'link' => route('admin.articles.index')]])}}
@endsection

@section('content')
    <form>
        <div class="row">
            <div class="col-3 bg-white py-2">
                <div class="form-group">
                    <label for="article-name">Name</label>
                    <input type="text" class="form-control" id="article-name" placeholder="Enter article name">
                </div>

                <div class="form-group">
                    <label for="article-category">Category</label>
                    <select class="custom-select custom-select-2 mr-sm-2 select-category-parent" name="category_id">
                        <option selected value="{{\App\Enums\DBConstant::NO_CATEGORY}}">No Category</option>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{$category['id']}}">{{$category['label']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="excerpt-content">Excerpt</label>
                    <textarea class="form-control" id="excerpt-content" rows="3"></textarea>
                </div>
            </div>

            <div class="col-9 bg-white py-2">
                <div class="card">
                    <div class="card-body">
                        <textarea id="article-content"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('script')
    <script>
        $(document).ready(function (){
	        tinymce.init({
		        selector: 'textarea#article-content',
				        plugins: [
					        "image imagetool",
				        ],
				        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image",
	        file_picker_callback: function (callback, value, meta) {
		        let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
		        let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

		        let type = 'image' === meta.filetype ? 'Images' : 'Files',
			        url  = '/laravel-filemanager?editor=tinymce5&type=' + type;

		        tinymce.activeEditor.windowManager.openUrl({
			        url : url,
			        title : 'Filemanager',
			        width : x * 0.8,
			        height : y * 0.8,
			        onMessage: (api, message) => {
				        callback(message.content);
			        }
		        });
	        }
	        });
        })
    </script>
@endsection

@section('css')

@endsection
