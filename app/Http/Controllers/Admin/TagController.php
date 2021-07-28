<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TagService;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TagRequest;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{

    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = $this->tagService->index($request);
        return view('admin.pages.tags.index', compact('tags'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $tags = $this->tagService->index($request);
        $view = view('admin.pages.tags.list', compact('tags'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.tags.add')->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagRequest $request)
    {
        $params = $request->only('label');
        $params['name'] = ucwords(strtolower($params['label']));
        // auto create slug by name.
        $slug = Str::slug($params['label'], '-');
        // get the number of slugs that already exist.
        $countSlug = $this->tagService->getCountSlugLikeName($slug);
        $params['slug'] = $countSlug > 0 ? $slug . '-' . (int)($countSlug + 1) : $slug;
        $result = $this->tagService->store($params);
        if ($result) {
            return $this->apiSendSuccess($result, Response::HTTP_CREATED, '');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST);
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = $this->tagService->find($id);
        $view = view('admin.pages.tags.edit', compact('tag'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TagRequest $request, $id)
    {
        $params = $request->only('label');
        $params['name'] = ucwords(strtolower($params['label']));
        // auto create slug by name.
        $slug = Str::slug($params['label'], '-');
        // get the number of slugs that already exist.
        $countSlug = $this->tagService->getCountSlugLikeName($slug, $id);
        $params['slug'] = $countSlug > 0 ? $slug . '-' . date("YmdHis",time()) : $slug;
        $result = $this->tagService->update($id, $params);
        if ($result) {
            return $this->apiSendSuccess($result, Response::HTTP_CREATED, '');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     * https://www.restapitutorial.com/lessons/httpmethods.html.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->tagService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, 'kk');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST);
    }
}
