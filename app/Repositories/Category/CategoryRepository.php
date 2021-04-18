<?php

declare(strict_types=1);

namespace App\Repositories\Category;

use App\Enums\Constant;
use App\Repositories\RepostioryAbstract;
use Carbon\Carbon;
use App\Enums\DBConstant;

class CategoryRepository extends RepostioryAbstract implements CategoryRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Category::class;
    }

    public function getCountSlug($slug, $id)
    {
        return $this->model::where('slug', $slug)
            ->when($id, function ($query, $id) {
                return $query->where('id', '<>', $id);
            })->count();
    }

    public function index()
    {
        return $this->model::orderBy('id', Constant::SORT_BY_DESC)->get();
    }

    public function search($params)
    {
        $q = $params->q ?? '';
        $sort_by = $params->sort_by ?? 'id';
        $order_by = $params->order_by ?? 'ASC';
        return $this->model
            ->when($q, function ($query, $q) {
                return $query->where('name', 'like', "%$q%");
            })->orderBy($sort_by, $order_by)->get();
    }

}
