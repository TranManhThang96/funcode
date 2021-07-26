<?php

declare(strict_types=1);

namespace App\Repositories\Series;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;
use Carbon\Carbon;
use App\Enums\DBConstant;

class SeriesRepository extends RepositoryAbstract implements SeriesRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Series::class;
    }

    public function getCountSlugLikeName($slug, $id)
    {
        return $this->model::where('slug', 'LIKE', $slug . '%')
            ->when($id, function ($query, $id) {
                return $query->where('id', '<>', $id);
            })->count();
    }

    public function index($params)
    {
        $q = $params->q ?? '';
        $sortBy = $params->sort_by ?? 'id';
        $orderBy = $params->order_by ?? 'ASC';
        $perPage = $params->per_page ?? Constant::DEFAULT_PER_PAGE;
        return $this->model
            ->when($q, function ($query, $q) {
                return $query->where('name', 'like', "%$q%");
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function all()
    {
        return $this->model::orderBy('id', Constant::SORT_BY_DESC)->get();
    }

}
