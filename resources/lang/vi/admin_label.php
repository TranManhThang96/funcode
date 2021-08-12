<?php

return [
    'common' => [
        'button' => [
            'search' => 'Tìm kiếm',
            'submit' => 'Lưu'
        ],
        'entries' => [
            'show' => 'Hiển thị',
            'entries' => 'bản ghi',
            'showing' => 'Hiển thị',
            'to' => 'đến',
            'from' => 'từ',
            'of' => 'của'
        ],
        'label' => [
            'placeholder_search' => 'Từ khóa ...'
        ],
        'table' => [
            'created_at' => 'Thời gian tạo',
            'updated_at' => 'Thời gian cập nhật',
            'action' => 'Thao tác',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
            'empty_data' => 'Không có dữ liệu!',
            'please_select' => 'Vui lòng chọn...',
        ],
        'modal' => [
            'close' => 'Đóng',
            'save' => 'Lưu' //Save changes
        ]
    ],
    'pages' => [
        'home' => [
            'title' => 'Trang chủ',
        ],
        'dashboard' => [

        ],
        'categories' => [
            'title' => 'Danh mục bài viết',
            'index' => [
                'btn_add' => 'Thêm danh mục',
            ],
            'modal' => [
                'modal_add_name' => 'Thêm danh mục',
                'modal_edit_name' => 'Sửa danh mục',
                'category_name' => 'Danh mục',
                'category_parent' => 'Danh mục cha',
                'no_parent' => 'Không có danh mục cha'
            ],
            'table' => [
                'name' => 'Tên danh mục',
                'slug' => 'Slug',
                'full_path' => 'Đường dẫn',
                'articles_count' => 'Số lượng bài viết',
            ]
        ],
        'articles' => [
            'title' => 'Danh sách bài viết',
            'index' => [
                'btn_add' => 'Thêm bài viết',
            ],
            'create_articles' => [
                'title' => 'Thêm bài viết',
                'create_breadcrumb' => 'Tạo mới',
            ],
            'edit_articles' => [
                'title' => 'Sửa bài viết',
                'create_breadcrumb' => 'Sửa bài viết',
            ],
            'table' => [
                'title' => 'Tên bài viết',
                'slug' => 'Slug',
                'category' => 'Danh mục',
                'series' => 'Series',
                'tag' => 'Tag',
                'status' => 'Trạng thái',
                'type' => 'Loại',
                'excerpt' => 'Mô tả',
                'image' => 'Hình ảnh',
                'no_category' => 'Không có danh mục',
                'link_references' => 'Bài viết tham khảo',
            ]
        ],
        'series' => [
            'title' => 'Danh sách series',
            'index' => [
                'btn_add' => 'Thêm series',
            ],
            'modal' => [
                'modal_add_name' => 'Thêm series',
                'modal_edit_name' => 'Sửa series',
                'tag_label' => 'Tên series',
            ],
            'table' => [
                'label' => 'Tên series',
                'slug' => 'Slug',
                'articles_count' => 'Số lượng bài viết',
            ]
        ],
        'tags' => [
            'title' => 'Danh sách tags',
            'index' => [
                'btn_add' => 'Thêm tag',
            ],
            'modal' => [
                'modal_add_name' => 'Thêm tag',
                'modal_edit_name' => 'Sửa tag',
                'tag_label' => 'Tên tag',
            ],
            'table' => [
                'label' => 'Tên tag',
                'slug' => 'Slug',
                'articles_count' => 'Số lượng bài viết',
            ]
        ]
    ],

];
