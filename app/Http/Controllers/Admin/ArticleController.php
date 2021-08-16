<?php

namespace App\Http\Controllers\Admin;

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
     * @return \Illuminate\Http\Response
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
        return view('admin.pages.articles.index', compact('articles', 'categories', 'tags', 'series', 'articlesColumns'));
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = [];
        $allCategories = $this->categoryService->all();
        showCategories($allCategories, $categories);
        $tags = $this->tagService->all();
        $series = $this->seriesService->all();
        return view('admin.pages.articles.add', compact('categories', 'tags', 'series'));
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
        $params['slug'] = $slug . '-'. date("YmdHis",time());
        // SLUG END

        // TAG START
        $tags = $this->tagService->syncTag($request->tags);
        $params['tags'] = $tags;
        // TAG END

        $this->articleService->store($params);
        return redirect()->route('admin.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = [];
        $allCategories = $this->categoryService->all();
        showCategories($allCategories, $categories);
        $tags = $this->tagService->all();
        $series = $this->seriesService->all();
        $article = $this->articleService->find($id);
        return view('admin.pages.articles.edit', compact('categories', 'tags', 'series', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $params = $request->all();
        $params['title'] = ucwords(strtolower($params['title']));

        // SLUG START
        // auto create slug by name.
        $slug = Str::slug($params['title'], '-');
        $params['slug'] = $slug . '-'. date("YmdHis",time());
        // SLUG END

        // TAG START
        $tags = $this->tagService->syncTag($request->tags);
        $params['tags'] = $tags;
        // TAG END

        $this->articleService->update($id, $params);
        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->articleService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'kk');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST);
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
}
