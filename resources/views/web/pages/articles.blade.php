@extends('web.layout.default')

@section('content')
    <div class="articles-content">
        {!! $articles->content !!}
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{asset('js/web/articles.js')}}"></script>
    <script>
        $(document).ready(function () {

            let articleViewLogId = null;

            function pingServer() {
                let url = articleViewLogId ? `/articles-view-log/${articleViewLogId}` : `/articles-view-log`;
                let method = articleViewLogId ? `PUT` : `POST`;
                $.ajax({
                    url: url,
                    type: method,
                    data: {
                        article_id: {{$articles->id}}
                    },
                    success: function (response) {
                        articleViewLogId = response.data.articleViewLogId;
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseJSON.errors);
                    }
                });
                setTimeout(() => {
                    pingServer();
                }, 15000);
            }

            pingServer();

            $(window).on("unload", function (e) {
                pingServer();
            });
        })

    </script>
@endsection
