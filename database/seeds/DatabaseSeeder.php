<?php

use App\Domain\Models\Tables\Category;
use App\Domain\Models\Tables\Product;
use App\Domain\Models\Tables\Transaction;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    private const USER_QUANTITY = 100;
    private const CATEGORY_QUANTITY = 20;
    private const PRODUCT_QUANTITY = 100;
    private const TRANSACTION_QUANTITY = 50;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $this->truncateTables();
        $this->seedTables();
    }

    public function truncateTables(): void
    {
        DB::table('users')->truncate();
        DB::table('categories')->truncate();
        DB::table('products')->truncate();
        DB::table('transactions')->truncate();
        DB::table('category_product')->truncate();
    }

    private function seedTables(): void
    {
        factory(User::class, self::USER_QUANTITY)->create();
        factory(Category::class, self::CATEGORY_QUANTITY)->create();
        factory(Product::class, self::PRODUCT_QUANTITY)->create()->each(static function ($product) {
            $categories = Category::all()->random(random_int(1, 5))->pluck('id');
            $product->categories()->sync($categories);
        });
        factory(Transaction::class, self::TRANSACTION_QUANTITY)->create();
    }
}
