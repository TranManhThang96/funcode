<?php


declare(strict_types=1);

namespace App\Services;

use App\Repositories\ArticleViewLog\ArticleViewLogRepositoryInterface;
use App\Services\BaseService;

class ArticleViewLogService extends BaseService
{
    protected $articleViewLogRepository;

    public function __construct(ArticleViewLogRepositoryInterface $articleViewLogRepository)
    {
        $this->articleViewLogRepository = $articleViewLogRepository;
    }


    public function store($attributes)
    {
        return $this->articleViewLogRepository->create($attributes);
    }

    public function update($id, $attributes)
    {
        return $this->articleViewLogRepository->update($id, $attributes);
    }

}
