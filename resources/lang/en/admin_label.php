<?php

return [
    'common' => [
        'button' => [
            'search' => 'Search',
            'submit' => 'Submit'
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
            'empty_data' => 'Empty data!'
        ],
        'modal' => [
            'close' => 'Close',
            'save' => 'Save changes' //Save changes
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
                'link_references' => 'Link references'
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
            ]
        ]
    ],

];
