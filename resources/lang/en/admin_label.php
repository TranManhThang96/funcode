<?php

return [
    'common' => [
        'button' => [
            'search' => 'Search',
            'submit' => 'Submit',
            'apply' => 'Apply'
        ],
        'entries' => [
            'show' => 'Show',
            'entries' => 'entries',
            'showing' => 'Showing',
            'to' => 'to',
            'from' => 'from',
            'of' => 'of'
        ],
        'label' => [
            'placeholder_search' => 'Keyword ...'
        ],
        'table' => [
            'created_at' => 'Created at',
            'updated_at' => 'Updated at',
            'action' => 'Action',
            'edit' => 'Edit',
            'delete' => 'Delete',
            'empty_data' => 'Empty data!',
            'please_select' => 'Please choose...',
            'time' => 'Time',
            'all' => 'All',
        ],
        'modal' => [
            'close' => 'Close',
            'save' => 'Save changes' //Save changes
        ],
        'confirm_modal' => [
            'title' => 'Confirm',
            'body' => 'Are you sure?',
            'ok_button' => 'OK',
            'cancel_button' => 'Cancel'
        ]
    ],
    'pages' => [
        'home' => [
            'title' => 'Home',
        ],
        'dashboard' => [

        ],
        'categories' => [
            'title' => 'Categories',
            'index' => [
                'btn_add' => 'Add category',
            ],
            'modal' => [
                'modal_add_name' => 'Add category',
                'modal_edit_name' => 'Edit category',
                'category_name' => 'Category Name',
                'category_parent' => 'Category Parent',
                'no_parent' => 'No parent'
            ],
            'table' => [
                'name' => 'Category name',
                'slug' => 'Slug',
                'full_path' => 'Full path',
                'articles_count' => 'Articles count',
            ],
            'messages' => [
                'add_category_successful' => 'Add category successful.',
                'add_category_failure' => 'Add category failure.',
                'update_category_successful' => 'Update category successful.',
                'update_category_failure' => 'Update category failure.',
                'delete_category_successful' => 'Delete category successful.',
                'delete_category_failure' => 'Delete category failure.',
                'delete_category_has_articles' => 'Can not delete, category has articles.',
                'delete_category_has_subcategories' => 'Can not delete, category has subcategories.',
            ]
        ],
        'articles' => [
            'title' => 'Articles',
            'index' => [
                'btn_add' => 'Add articles',
            ],
            'create_articles' => [
                'title' => 'Add articles',
                'create_breadcrumb' => 'New',
            ],
            'edit_articles' => [
                'title' => 'Edit articles',
                'edit_breadcrumb' => 'Edit',
            ],
            'table' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'category' => 'Category',
                'series' => 'Series',
                'tag' => 'Tag',
                'status' => 'Status',
                'type' => 'Type',
                'excerpt' => 'Excerpt',
                'image' => 'Image',
                'no_category' => 'No category',
                'link_references' => 'Link references',
                'please_select' => 'Please select...',
                'time' => 'Time'
            ],
            'messages' => [
                'add_articles_successful' => 'Add articles successful.',
                'add_articles_failure' => 'Add articles failure.',
                'update_articles_successful' => 'Update articles successful.',
                'update_articles_failure' => 'Update articles failure.',
                'delete_articles_successful' => 'Delete articles successful.',
                'delete_articles_failure' => 'Delete articles failure.',
            ]
        ],
        'series' => [
            'title' => 'Series',
            'index' => [
                'btn_add' => 'Add series',
            ],
            'modal' => [
                'modal_add_name' => 'Add series',
                'modal_edit_name' => 'Edit series',
                'tag_label' => 'Series',
            ],
            'table' => [
                'label' => 'Series',
                'slug' => 'Slug',
                'articles_count' => 'Articles count',
            ],
            'messages' => [
                'add_series_successful' => 'Add series successful.',
                'add_series_failure' => 'Add series failure.',
                'update_series_successful' => 'Update series successful.',
                'update_series_failure' => 'Update series failure.',
                'delete_series_successful' => 'Delete series successful.',
                'delete_series_failure' => 'Delete series failure.',
            ]
        ],
        'tags' => [
            'title' => 'Tags',
            'index' => [
                'btn_add' => 'Add tag',
            ],
            'modal' => [
                'modal_add_name' => 'Add tag',
                'modal_edit_name' => 'Edit tag',
                'tag_label' => 'Tag',
            ],
            'table' => [
                'label' => 'Tag',
                'slug' => 'Slug',
                'articles_count' => 'Articles count',
            ],
            'messages' => [
                'add_tag_successful' => 'Add tag successful.',
                'add_tag_failure' => 'Add tag failure.',
                'update_tag_successful' => 'Update tag successful.',
                'update_tag_failure' => 'Update tag failure.',
                'delete_tag_successful' => 'Delete tag successful.',
                'delete_tag_failure' => 'Delete tag failure.',
            ]
        ]
    ],

];
