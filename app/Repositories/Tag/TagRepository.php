<?php

declare(strict_types=1);

namespace App\Repositories\Tag;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;
use Carbon\Carbon;
use App\Enums\DBConstant;

class TagRepository extends RepositoryAbstract implements TagRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Tag::class;
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
        $orderBy = $params->order_by ?? 'DESC';
        $perPage = $params->per_page ?? Constant::DEFAULT_PER_PAGE;
        return $this->model
            ->withCount('articles')
            ->when($q, function ($query, $q) {
                return $query->where('label', 'like', "%$q%");
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function all()
    {
        return $this->model::orderBy('id', Constant::SORT_BY_DESC)->get();
    }

    public function getTagBySlug($slug, $id = null)
    {
        return $this->model::where('slug', $slug)
            ->when($id, function ($query, $id) {
                return $query->where('id', '<>', $id);
            })->first();
    }

}
