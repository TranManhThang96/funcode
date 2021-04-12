<?php

declare(strict_types=1);

namespace App\Repositories\Category;

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

    public function index()
    {
        return \App\Models\Category::all();
    }

}
