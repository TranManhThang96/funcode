<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\BaseService;

class CategoryService extends BaseService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return $this->categoryRepository->index();
    }

    public function search($params)
    {
        return $this->categoryRepository->search($params);
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->categoryRepository->create($attributes);
    }

    public function getCountSlug($slug, $id = null)
    {
        return $this->categoryRepository->getCountSlug($slug, $id);
    }

    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->categoryRepository->update($id, $attributes);
    }
}
