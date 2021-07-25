<?php
namespace App\Enums;
use App\Enums\BaseEnum;

/**
 * DBConstant enum.
 */
class DBConstant extends BaseEnum
{
    // [categories]
    const NO_PARENT = 0;

    // [articles]
    const NO_CATEGORY = 0;

    // [articles status]
    const ARTICLE_PUBLISH = 1;
    const ARTICLE_DRAFT = 2;
    const ARTICLE_DELETED = 3;
    const ARTICLE_PENDING = 4;

    // [articles type]
    const ARTICLE = 1;
    const LEARN = 2;
    const TIP = 3;
    const COPY = 4;
}
