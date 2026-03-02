<?php

namespace Database\Seeders;

use App\Models\TrainingCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrainingCategorySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Internal Training',
            'Webinar',
            'External Training',
        ];

        foreach ($items as $item) {
            TrainingCategory::firstOrCreate(
                ['slug' => Str::slug($item)],
                [
                    'name' => $item,
                    'is_active' => true,
                ]
            );
        }
    }
}