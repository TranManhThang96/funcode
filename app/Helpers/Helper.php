<?php

use Illuminate\Support\Str;

if (!function_exists('showCategories')) {
    function showCategories($categories, &$result = [], $parent_id = \App\Enums\DBConstant::NO_PARENT, $char = '')
    {
        foreach ($categories as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item->parent_id == $parent_id) {
                $countSymbol = count(explode('/', $char));
                $result[] = array_merge(
                    $item->toArray(),
                    [
                        'full_path' => $char . Str::slug($item->name),
                        'label' => str_pad($item->name, strlen($item->name) + ($countSymbol - 1) * 4, "--- ", STR_PAD_LEFT),
                        'level' => $countSymbol,
                    ]
                );

                // Xóa chuyên mục đã lặp
                unset($categories[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $result, $item['id'], $char . Str::slug($item->name) . ' / ');
            }
        }
    }
}

if (!function_exists('getParent')) {
    function getParent($str = '', $id, $symbol = '')
    {
        $model = new Category();
        $currentCate = $model->find($id);
        $str = $currentCate->name . $symbol;
        if ($currentCate->parent_id == 0) {
            return $str;
        } else {
            $str = getParent($str, $currentCate->parent_id, '-->') . $str;
        }
        return $str;
    }
}

if (!function_exists('renderBreadcrumb')) {
    function renderBreadcrumb($pageTitle = '', $breadcrumb = [])
    {
        $countBreadcrumb = count($breadcrumb);
        if ($pageTitle && $countBreadcrumb === 0) {
            return;
        }
        echo '<div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">';
        if ($pageTitle) {
            echo '<h4 class="page-title">' . $pageTitle . '</h4>';
        }
        if ($countBreadcrumb) {
            echo '<div class="ml-auto text-right"><nav aria-label="breadcrumb"><ol class="breadcrumb">';
            foreach ($breadcrumb as $key => $brc) {
                echo '<li class="breadcrumb-item"><a href="' . $brc['link'] . '">' . $brc['name'] . '</a></li>';
            }
            echo '<li class="breadcrumb-item active" aria-current="page">' . $pageTitle . '</li></ol></nav></div>';
        }
        echo '</div></div></div>';
    }
}

if (!function_exists('renderCategoryName')) {
    function renderCategoryName($name, $level = \App\Enums\Constant::LEVEL_FIRST)
    {
        $distance = (int)($level - 1) * 30;
        echo '<div class="px-1 py-1 text-white float-right" style="background-color: ' . \App\Enums\Constant::LEVEL_COLORS[$level] . '; width: calc(100% - ' . $distance . 'px)">' . $name . '</div>';
    }
}
