<?php


declare(strict_types=1);

namespace App\Repositories\ArticleViewLog;

use App\Repositories\RepositoryAbstract;

class ArticleViewLogRepository extends RepositoryAbstract implements ArticleViewLogRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ArticlesViewLog::class;
    }

    public function update($id, $attributes)
    {
        $articleViewLog = $this->model->find($id);
        if ($articleViewLog) {
            // Force update updated_at column using Eloquent Touch method
            // refer: http://www.expertphp.in/article/force-update-updated-at-column-using-eloquent-touch-method
            $isUpdated = $articleViewLog->touch();
            return $isUpdated;
        }
        return false;
    }
}
