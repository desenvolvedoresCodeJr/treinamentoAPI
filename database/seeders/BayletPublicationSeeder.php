<?php

namespace Database\Seeders;

use App\Models\BayletCategory;
use App\Models\BayletPublication;
use App\Models\BayletUser;
use Illuminate\Database\Seeder;

class BayletPublicationSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = BayletCategory::query()->pluck('id')->all();
        $userIds = BayletUser::query()->pluck('id')->all();

        if (empty($categoryIds) || empty($userIds)) {
            return;
        }

        BayletPublication::factory()
            ->count(20)
            ->make()
            ->each(function (BayletPublication $publication) use ($categoryIds, $userIds) {
                $publication->category_id = fake()->randomElement($categoryIds);
                $publication->created_by = fake()->randomElement($userIds);
                $publication->save();
            });
    }
}
