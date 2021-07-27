<?php

namespace App\Enums;

use App\Enums\BaseEnum;

/**
 * Constant enum.
 */
class Constant extends BaseEnum
{
    // page
    const START_PAGE = 1;

    const DEFAULT_PER_PAGE = 10;

    // result
    const SUCCESS = 1;

    const FAILURE = 0;

    // log level

    const DEBUG = 1;

    const INFO = 2;

    const WARNING = 3;

    const ERROR = 4;

    // category level
    const LEVEL_FIRST = 1;
    const LEVEL_SECOND = 2;
    const LEVEL_THIRD = 3;
    const LEVEL_FOURTH = 4;
    const LEVEL_FIFTH = 5;
    const LEVEL_SIXTH = 6;
    const LEVEL_SEVENTH = 7;

    // category color
    const LEVEL_FIRST_COLOR = '#28b779';
    const LEVEL_SECOND_COLOR = '#da542e';
    const LEVEL_THIRD_COLOR = '#7460ee';
    const LEVEL_FOURTH_COLOR = '#ffb848';
    const LEVEL_FIFTH_COLOR = '#f74d4d';
    const LEVEL_SIXTH_COLOR = '#2255a4';
    const LEVEL_SEVENTH_COLOR = '#6c757d';

    const LEVEL_COLORS = [null, '#28b779', '#da542e', '#7460ee', '#ffb848', '#f74d4d', '#2255a4', '#6c757d'];

    const SORT_BY_ASC = 'ASC';
    const SORT_BY_DESC = 'DESC';

    // [articles status]
    const ARTICLE_PUBLISH_LABEL = 'Publish';
    const ARTICLE_DRAFT_LABEL = 'Draft';
    const ARTICLE_DELETED_LABEL = 'Deleted';
    const ARTICLE_PENDING_LABEL = 'Pending';
    const ARTICLE_STATUS_LABEL_DATA = ['', 'Publish', 'Draft', 'Deleted', 'Pending'];

    // [articles type]
    const ARTICLE_LABEL = 'Article';
    const LEARN_LABEL = 'Learn';
    const TIP_LABEL = 'Tip';
    const COPY_LABEL = 'Copy';
    const ARTICLE_TYPE_LABEL_DATA = ['', 'Article', 'Learn', 'Tip', 'Copy'];

}
