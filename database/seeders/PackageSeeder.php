<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run()
    {
        Package::create([
            'name' => 'Gói Cơ Bản',
            'price' => 50000,
            'duration' => 1,
            'max_borrows' => 2,
            'borrow_duration' => 7,
            'extension_limit' => 1,
            'can_reserve' => false,
            'priority_support' => false,
            'delivery' => false,
            'color' => '#4F46E5',
            'recommended' => false
        ]);

        Package::create([
            'name' => 'Gói Premium',
            'price' => 100000,
            'duration' => 1,
            'max_borrows' => 5,
            'borrow_duration' => 14,
            'extension_limit' => 2,
            'can_reserve' => true,
            'priority_support' => true,
            'delivery' => true,
            'color' => '#9333EA',
            'recommended' => true
        ]);
    }
} 