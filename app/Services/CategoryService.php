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

    public function index($request)
    {
        return $this->categoryRepository->index($request);
    }

    public function all($request = null)
    {
        return $this->categoryRepository->all($request);
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function store($attributes)
    {
        return $this->categoryRepository->create($attributes);
    }

    public function getCountSlugLikeName($slug, $id = null)
    {
        return $this->categoryRepository->getCountSlugLikeName($slug, $id);
    }

    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function update($id, $attributes)
    {
        return $this->categoryRepository->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
