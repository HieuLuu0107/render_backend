<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Fiction',
                'description' => 'Tiểu thuyết và truyện hư cấu'
            ],
            [
                'name' => 'Science Fiction',
                'description' => 'Khoa học viễn tưởng'
            ],
            [
                'name' => 'Self Help',
                'description' => 'Sách phát triển bản thân'
            ],
            [
                'name' => 'Programming',
                'description' => 'Sách lập trình và công nghệ'
            ],
            [
                'name' => 'Business',
                'description' => 'Sách kinh doanh và quản lý'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
} 