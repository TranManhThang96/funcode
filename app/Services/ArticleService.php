<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Article\ArticleRepositoryInterface;
use App\Services\BaseService;

class ArticleService extends BaseService
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        return $this->articleRepository->index();
    }

    public function search($params)
    {
        return $this->articleRepository->search($params);
    }

    public function getAll()
    {
        return $this->articleRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->articleRepository->create($attributes);
    }

    public function getCountSlugLikeName($slug, $id = null)
    {
        return $this->articleRepository->getCountSlugLikeName($slug, $id);
    }

    public function find($id)
    {
        return $this->articleRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->articleRepository->update($id, $attributes);
    }
}
