<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SeriesService;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SeriesRequest;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class SeriesController extends Controller
{

    protected $seriesService;

    public function __construct(SeriesService $seriesService)
    {
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
        $series = $this->seriesService->index($request);
        return view('admin.pages.series.index', compact('series'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $series = $this->seriesService->index($request);
        $view = view('admin.pages.series.list', compact('series'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = view('admin.pages.series.add')->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SeriesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SeriesRequest $request)
    {
        $params = $request->only('name');
        $params['name'] = ucwords(strtolower($params['name']));
        // auto create slug by name.
        $slug = Str::slug($params['name'], '-');
        // get the number of slugs that already exist.
        $countSlug = $this->seriesService->getCountSlugLikeName($slug);
        $params['slug'] = $countSlug > 0 ? $slug . '-' . Str::random(9) : $slug;
        $series = $this->seriesService->store($params);
        if ($series) {
            $isArticlesPage = isset($request->page) && ($request->page === 'articles');
            if ($isArticlesPage) {
                $allSeries = $this->seriesService->all();
                $seriesSelected = $series['id'];
                $view = view('admin.pages.series.components.options', compact('allSeries', 'seriesSelected'))->render();
                return $this->apiSendSuccess(['series' => $series, 'view' => $view], Response::HTTP_CREATED, __('admin_label.pages.series.messages.add_series_successful'));
            }
            return $this->apiSendSuccess($series, Response::HTTP_CREATED, __('admin_label.pages.series.messages.add_series_successful'));
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, __('admin_label.pages.series.messages.add_series_failure'));
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
        $series = $this->seriesService->find($id);
        $view = view('admin.pages.series.edit', compact('series'))->render();
        return $this->apiSendSuccess($view, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SeriesRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SeriesRequest $request, $id)
    {
        $params = $request->only('name');
        $params['name'] = ucwords(strtolower($params['name']));
        // auto create slug by name.
        $slug = Str::slug($params['name'], '-');
        // get the number of slugs that already exist.
        $countSlug = $this->seriesService->getCountSlugLikeName($slug, $id);
        $params['slug'] = $countSlug > 0 ? $slug . '-' . Str::random(9) : $slug;
        $result = $this->seriesService->update($id, $params);
        if ($result) {
            return $this->apiSendSuccess($result, Response::HTTP_OK, __('admin_label.pages.series.messages.update_series_successful'));
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, __('admin_label.pages.series.messages.update_series_failure'));
    }

    /**
     * Remove the specified resource from storage.
     * https://www.restapitutorial.com/lessons/httpmethods.html.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = $this->seriesService->delete($id);
        if ($isDeleted) {
            return $this->apiSendSuccess($isDeleted, Response::HTTP_OK, __('admin_label.pages.series.messages.delete_series_successful'));
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, __('admin_label.pages.series.messages.delete_series_failure'));
    }
}
