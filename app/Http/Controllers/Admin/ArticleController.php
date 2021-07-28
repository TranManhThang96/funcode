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
        $articles = $this->articleService->index($request);
        return view('admin.pages.articles.index', compact('articles'));
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
        $allCategories = $this->categoryService->index();
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
        // get the number of slugs that already exist.
        $countSlug = $this->articleService->getCountSlugLikeName($slug);
        $params['slug'] = $countSlug > 0 ? $slug . '-' . (int)($countSlug + 1) : $slug;
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
        $allCategories = $this->categoryService->index();
        showCategories($allCategories, $categories);
        $tags = $this->tagService->all();
        $series = $this->seriesService->all();
        $article = $this->articleService->find($id);
        return view('admin.pages.articles.edit', compact('categories', 'tags', 'series', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
