<?php

declare(strict_types=1);

namespace App\Repositories\Article;

use App\Enums\Constant;
use App\Repositories\RepositoryAbstract;
use Carbon\Carbon;
use App\Enums\DBConstant;

class ArticleRepository extends RepositoryAbstract implements ArticleRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Article::class;
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
            ->with('category:id,name')
            ->with('series:id,name')
            ->with('tags')
            ->when($q, function ($query, $q) {
                return $query->where('name', 'like', "%$q%");
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
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

    public function create(array $attributes)
    {
        $articleCreated = $this->model->create($attributes);
        if (!empty($articleCreated->id) && $attributes['tags']) {
            $articleCreated->tags()->sync($attributes['tags']);
        }
        return $articleCreated;
    }

    public function find($id)
    {
        return $this->model
            ->with('tags')
            ->find($id);
    }

}
