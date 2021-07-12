<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Series\SeriesRepositoryInterface;
use App\Services\BaseService;

class SeriesService extends BaseService
{
    protected $seriesRepository;

    public function __construct(SeriesRepositoryInterface $seriesRepository)
    {
        $this->seriesRepository = $seriesRepository;
    }

    public function index($params)
    {
        return $this->seriesRepository->index($params);
    }

    public function store($attributes)
    {
        return $this->seriesRepository->create($attributes);
    }

    public function getCountSlug($slug, $id = null)
    {
        return $this->seriesRepository->getCountSlug($slug, $id);
    }

    public function find($id)
    {
        return $this->seriesRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->seriesRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->seriesRepository->delete($id);
    }
}
