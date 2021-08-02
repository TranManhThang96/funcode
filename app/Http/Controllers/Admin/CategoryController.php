<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Exception;
use App\Traits\CollectionPagination;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $categories = collect([]);
        $allCategories = $this->categoryService->all();
        showCategories($allCategories, $categories);
        $categories = (new CollectionPagination($categories))->paginate(Constant::DEFAULT_PER_PAGE);
        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function search(Request $request)
    {
        $categories = collect([]);
        $q = $request->q ?? '';
        if (!empty($q)) {
            //show normal
            $categories = $this->categoryService->index($request);
            $view = view('admin.pages.categories.list', compact('categories'))->render();
        } else {
            //show full path
            $allCategories = $this->categoryService->all($request);
            showCategories($allCategories, $categories);
            if ($q) {
                $categories = $categories->filter(function ($item) use ($q) {
                    $q = strtolower($q);
                    return preg_match("/$q/", strtolower($item['name']));
                });
            }
            $categories = (new CollectionPagination($categories))->paginate((int)$request->per_page ?? Constant::DEFAULT_PER_PAGE);
            $view = view('admin.pages.categories.list', compact('categories'))->render();
        }
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $categories = [];
        $allCategories = $this->categoryService->all();
        showCategories($allCategories, $categories);
        $view = view('admin.pages.categories.add', compact('categories'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $params = $request->only('name', 'parent_id');
        $params['name'] = ucwords(strtolower($params['name']));
        // auto create slug by name.
        $slug = Str::slug($params['name'], '-');
        // get the number of slugs that already exist.
        $countSlug = $this->categoryService->getCountSlugLikeName($slug);
        $params['slug'] = $countSlug > 0 ? $slug . '-' . ($countSlug + 1) : $slug;
        $result = $this->categoryService->store($params);
        if ($result) {
            return $this->apiSendSuccess($result, Response::HTTP_CREATED, '');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $categories = [];
        $allCategories = $this->categoryService->all();
        showCategories($allCategories, $categories);
        $category = $this->categoryService->find($id);
        $view = view('admin.pages.categories.edit', compact('categories', 'category'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $params = $request->only('id', 'name', 'parent_id');
        $params['name'] = ucwords(strtolower($params['name']));
        // auto create slug by name.
        $slug = Str::slug($params['name'], '-');
        // get the number of slugs that already exist.
        $countSlug = $this->categoryService->getCountSlugLikeName($slug, $id);
        $params['slug'] = $countSlug > 0 ? $slug . '-' . ($countSlug + 1) : $slug;
        $result = $this->categoryService->update($id, $params);
        if ($result) {
            return $this->apiSendSuccess($result, Response::HTTP_CREATED, '');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryService->find($id);
        if ($category->articles_count > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa. Có bài viết');
        } else if ($category->categories_count > 0) {
            return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Không thể xóa. Có thể loại con');
        }
        $isDeleted = $this->categoryService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'Xóa thành công');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Xóa thất bại');
    }
}
