<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Category\CategoryRepositoryInterface;

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

}
