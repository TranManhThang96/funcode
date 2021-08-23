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

    public function index($params)
    {
        return $this->articleRepository->index($params);
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
        return $this->articleRepository->findById($id);
    }

    public function update($id, $attributes)
    {
        return $this->articleRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->articleRepository->delete($id);
    }

    public function findBySlug($slug)
    {
        return $this->articleRepository->findBySlug($slug);
    }
}
