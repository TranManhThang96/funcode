<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Services\ArticleViewLogService;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;

class ArticleViewLogController extends Controller
{
    protected $articleViewLogService;
    protected $agent;

    public function __construct(
        ArticleViewLogService $articleViewLogService
    )
    {
        $this->articleViewLogService = $articleViewLogService;
        $this->agent = new Agent();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->agent->setUserAgent($request->userAgent());
        $data = [
            'article_id' => $request->article_id,
            'ip_address' => $request->getClientIp(),
            'user_agent' => $request->userAgent(),
            'platform' => $this->agent->platform(),
            'browser' => $this->agent->browser(),
            'isPhone' => $this->agent->isPhone(),
            'device' => $this->agent->device(),
        ];
        $articleViewLog = $this->articleViewLogService->store($data);
        if ($articleViewLog) {
            return $this->apiSendSuccess(['articleViewLogId' => $articleViewLog->id], Response::HTTP_CREATED, '');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, '');
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
        //
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
        $isUpdated = $this->articleViewLogService->update($id, []);
        if ($isUpdated) {
            return $this->apiSendSuccess(['articleViewLogId' => $id], Response::HTTP_OK, '');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
