<?php

return [
    'common' => [
        'button' => [
            'search' => 'Tìm kiếm',
            'submit' => 'Lưu',
            'apply' => 'Áp dụng'
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
            'view' => 'Xem',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
            'empty_data' => 'Không có dữ liệu!',
            'please_select' => 'Vui lòng chọn...',
            'time' => 'Thời gian',
            'all' => 'Tất cả'
        ],
        'modal' => [
            'close' => 'Đóng',
            'save' => 'Lưu' //Save changes
        ],
        'confirm_modal' => [
            'title' => 'Thông báo',
            'body' => 'Bạn có chắc chắn điều này?',
            'ok_button' => 'Đồng ý',
            'cancel_button' => 'Không'
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
            ],
            'messages' => [
                'add_category_successful' => 'Thêm danh mục thành công.',
                'add_category_failure' => 'Thêm danh mục thất bại.',
                'update_category_successful' => 'Sửa danh mục thành công.',
                'update_category_failure' => 'Sửa danh mục thất bại.',
                'delete_category_successful' => 'Danh mục đã được xóa.',
                'delete_category_failure' => 'Xóa danh mục lỗi.',
                'delete_category_has_articles' => 'Không thể xóa danh mục có bài viết.',
                'delete_category_has_subcategories' => 'Không thể xóa danh mục có danh mục con.',
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
            ],
            'messages' => [
                'add_articles_successful' => 'Thêm bài viết thành công.',
                'add_articles_failure' => 'Thêm bài viết thất bại.',
                'update_articles_successful' => 'Sửa bài viết thành công.',
                'update_articles_failure' => 'Sửa bài viết thất bại.',
                'delete_articles_successful' => 'Bài viết đã được xóa.',
                'delete_articles_failure' => 'Xóa bài viết bị lỗi.',
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
            ],
            'messages' => [
                'add_series_successful' => 'Thêm series thành công.',
                'add_series_failure' => 'Thêm series thất bại.',
                'update_series_successful' => 'Sửa series thành công.',
                'update_series_failure' => 'Sửa series thất bại.',
                'delete_series_successful' => 'Series đã được xóa.',
                'delete_series_failure' => 'Xóa series bị lỗi.',
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
            ],
            'messages' => [
                'add_tag_successful' => 'Thêm tag thành công.',
                'add_tag_failure' => 'Thêm tag thất bại.',
                'update_tag_successful' => 'Sửa tag thành công.',
                'update_tag_failure' => 'Sửa tag thất bại.',
                'delete_tag_successful' => 'Tag đã được xóa.',
                'delete_tag_failure' => 'Xóa tag bị lỗi.',
            ]
        ]
    ],

];
