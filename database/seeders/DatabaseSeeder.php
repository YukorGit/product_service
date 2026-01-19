<?php

namespace Database\Seeders;

use App\Infrastructure\Persistence\Eloquent\Models\ProductModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        $categories = ['Electronics', 'Books', 'Clothing', 'Toys', 'Flowers'];
        $catIds = [];

        foreach ($categories as $cat) {
            $catIds[] = DB::table('categories')->insertGetId([
                'name' => $cat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach ($catIds as $catId) {
            ProductModel::factory()
                ->count(60) // По 60 на категорию, 300 всего
                ->create(['category_id' => $catId]);
        }
    }
}
