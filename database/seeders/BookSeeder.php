<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        $books = [
            [
                'title' => 'Đắc Nhân Tâm',
                'author' => 'Dale Carnegie',
                'description' => 'Một trong những cuốn sách nổi tiếng nhất về phát triển bản thân, đã giúp hàng triệu người thành công trong cuộc sống.',
                'image' => 'dac-nhan-tam.jpg',
                'quantity' => 10,
                'category_id' => 3, // Self Help
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'description' => 'Cuốn sách kinh điển về nghệ thuật viết code sạch trong lập trình.',
                'image' => 'clean-code.jpg',
                'quantity' => 5,
                'category_id' => 4, // Programming
            ],
            [
                'title' => 'Nhà Giả Kim',
                'author' => 'Paulo Coelho',
                'description' => 'Câu chuyện về hành trình theo đuổi vận mệnh của một người chăn cừu trẻ.',
                'image' => 'nha-gia-kim.jpg',
                'quantity' => 8,
                'category_id' => 1, // Fiction
            ],
            [
                'title' => 'Dune',
                'author' => 'Frank Herbert',
                'description' => 'Tiểu thuyết khoa học viễn tưởng về một hành tinh sa mạc.',
                'image' => 'dune.jpg',
                'quantity' => 6,
                'category_id' => 2, // Science Fiction
            ],
            [
                'title' => 'Rich Dad Poor Dad',
                'author' => 'Robert Kiyosaki',
                'description' => 'Sách về tài chính cá nhân và đầu tư.',
                'image' => 'rich-dad-poor-dad.jpg',
                'quantity' => 7,
                'category_id' => 5, // Business
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
} 