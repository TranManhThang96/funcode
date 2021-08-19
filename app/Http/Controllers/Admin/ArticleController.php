<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Constant;
use App\Enums\DBConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\SeriesService;
use App\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{

    protected $articleService;
    protected $categoryService;
    protected $tagService;
    protected $seriesService;

    public function __construct(
        ArticleService $articleService,
        CategoryService $categoryService,
        TagService $tagService,
        SeriesService $seriesService
    )
    {
        $this->articleService = $articleService;
        $this->categoryService = $categoryService;
        $this->tagService = $tagService;
        $this->seriesService = $seriesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $categories = [];
        $allCategories = $this->categoryService->all();
        showCategories($allCategories, $categories);
        $tags = $this->tagService->all();
        $series = $this->seriesService->all();
        $articles = $this->articleService->index($request);
        $articlesColumns = $this->articlesColumns();
        $articlesStatus = array_values($this->articlesStatus());
        $articlesType = array_values($this->articlesType());
        return view('admin.pages.articles.index', compact(
                'articles',
                'categories',
                'tags',
                'series',
                'articlesColumns',
                'articlesStatus',
                'articlesType')
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $articles = $this->articleService->index($request);
        $view = view('admin.pages.articles.list', compact('articles'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = [];
        $allCategories = $this->categoryService->all();
        showCategories($allCategories, $categories);
        $tags = $this->tagService->all();
        $series = $this->seriesService->all();
        $articlesStatus = array_values($this->articlesStatus());
        $articlesType = array_values($this->articlesType());
        return view('admin.pages.articles.add', compact(
                'categories',
                'tags',
                'series',
                'articlesStatus',
                'articlesType')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $params = $request->all();
        $params['title'] = ucwords(strtolower($params['title']));
        // SLUG START
        // auto create slug by name.
        $slug = Str::slug($params['title'], '-');
        $params['slug'] = $slug . '-' . date("YmdHis", time());
        // SLUG END

        // TAG START
        $tags = $this->tagService->syncTag($request->tags);
        $params['tags'] = $tags;
        // TAG END

        $articles = $this->articleService->store($params);
        if ($articles) {
            toastr()->success(__('admin_label.pages.articles.messages.add_articles_successful'), '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.articles.index');
        }
        toastr()->error(__('admin_label.pages.articles.messages.add_articles_failure'), '', [
            'positionClass' => 'toast-top-center',
        ]);
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $categories = [];
        $allCategories = $this->categoryService->all();
        showCategories($allCategories, $categories);
        $tags = $this->tagService->all();
        $series = $this->seriesService->all();
        $article = $this->articleService->find($id);
        $articlesStatus = array_values($this->articlesStatus());
        $articlesType = array_values($this->articlesType());
        return view('admin.pages.articles.edit', compact(
                'categories',
                'tags',
                'series',
                'article',
                'articlesStatus',
                'articlesType')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $params = $request->all();
        $params['title'] = ucwords(strtolower($params['title']));

        // SLUG START
        // auto create slug by name.
        $slug = Str::slug($params['title'], '-');
        $params['slug'] = $slug . '-' . date("YmdHis", time());
        // SLUG END

        // TAG START
        $tags = $this->tagService->syncTag($request->tags);
        $params['tags'] = $tags;
        // TAG END

        $result = $this->articleService->update($id, $params);
        if ($result) {
            toastr()->success(__('admin_label.pages.articles.messages.update_articles_successful'), '', [
                'positionClass' => 'toast-top-center',
            ]);
            return redirect()->route('admin.articles.index');
        }
        toastr()->error(__('admin_label.pages.articles.messages.update_articles_failure'), '', [
            'positionClass' => 'toast-top-center',
        ]);
        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->articleService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, __('admin_label.pages.articles.messages.delete_articles_successful'));
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, __('admin_label.pages.articles.messages.delete_articles_failure'));
    }

    /**
     * @return array[]
     */
    private function articlesColumns(): array
    {
        return [
            'title' => [
                'label' => __('admin_label.pages.articles.table.title'),
                'class' => 'articles-title-column'
            ],
            'slug' => [
                'label' => __('admin_label.pages.articles.table.slug'),
                'class' => 'articles-slug-column'
            ],
            'image' => [
                'label' => __('admin_label.pages.articles.table.image'),
                'class' => 'articles-image-column'
            ],
            'category' => [
                'label' => __('admin_label.pages.articles.table.category'),
                'class' => 'articles-category-column'
            ],
            'series' => [
                'label' => __('admin_label.pages.articles.table.series'),
                'class' => 'articles-series-column'
            ],
            'status' => [
                'label' => __('admin_label.pages.articles.table.status'),
                'class' => 'articles-status-column'
            ],
            'type' => [
                'label' => __('admin_label.pages.articles.table.type'),
                'class' => 'articles-type-column'
            ],
            'tag' => [
                'label' => __('admin_label.pages.articles.table.tag'),
                'class' => 'articles-tag-column'
            ],
            'created_at' => [
                'label' => __('admin_label.common.table.created_at'),
                'class' => 'articles-created-at-column'
            ],
            'updated_at' => [
                'label' => __('admin_label.common.table.updated_at'),
                'class' => 'articles-updated-at-column'
            ],
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateArticlesColumns(Request $request)
    {
        $request->session()->put('articles_columns', $request->articles_columns);
        $articlesColumns = $request->session()->get('articles_columns', []);
        return $this->apiSendSuccess(['articles_columns' => $articlesColumns], Response::HTTP_OK);
    }

    /**
     * get status contanst of articles.
     *
     * @return array[]
     */
    private function articlesStatus(): array
    {
        return [
            'publish' => [
                'value' => DBConstant::ARTICLE_PUBLISH,
                'label' => Constant::ARTICLE_PUBLISH_LABEL
            ],
            'draft' => [
                'value' => DBConstant::ARTICLE_DRAFT,
                'label' => Constant::ARTICLE_DRAFT_LABEL
            ],
            'pending' => [
                'value' => DBConstant::ARTICLE_PENDING,
                'label' => Constant::ARTICLE_PENDING_LABEL
            ],
        ];
    }

    /**
     * get type contanst of articles.
     *
     * @return array[]
     */
    private function articlesType(): array
    {
        return [
            'article' => [
                'value' => DBConstant::ARTICLE,
                'label' => Constant::ARTICLE_LABEL
            ],
            'learn' => [
                'value' => DBConstant::LEARN,
                'label' => Constant::LEARN_LABEL
            ],
            'tip' => [
                'value' => DBConstant::TIP,
                'label' => Constant::TIP_LABEL
            ],
            'copy' => [
                'value' => DBConstant::COPY,
                'label' => Constant::COPY_LABEL
            ]
        ];
    }

}
