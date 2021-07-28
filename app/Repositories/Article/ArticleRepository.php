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
                return $query->where('title', 'like', "%$q%");
            })->orderBy($sortBy, $orderBy)
            ->paginate($perPage);
    }

    public function findById($id)
    {
        return $this->model
            ->with('tags')
            ->find($id);
    }

    public function create(array $attributes)
    {
        $articleCreated = $this->model->create($attributes);
        if (!empty($articleCreated->id) && $attributes['tags']) {
            $articleCreated->tags()->sync($attributes['tags']);
        }
        return $articleCreated;
    }

    public function update($id, $attributes)
    {
        $article = $this->model->find($id);
        if ($article) {
            $isUpdated = $article->update($attributes);
            if ($attributes['tags']) {
                $article->tags()->sync($attributes['tags']);
            }
            return $isUpdated;
        }
        return false;
    }
}
