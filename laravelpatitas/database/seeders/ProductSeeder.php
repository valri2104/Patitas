<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing products and related data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::query()->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('Creating products...');

        // Create Food products (15 total: 12 with stock, 3 without stock)
        $this->command->info('Creating Food products...');
        \Faker\Factory::create()->unique(true); // Reset unique generator
        Product::factory()->food()->count(12)->create();
        Product::factory()->food()->outOfStock()->count(3)->create();
        $this->command->info('✓ Created 15 Food products (12 with stock, 3 out of stock)');

        // Create Toy products (12 total: 10 with stock, 2 without stock)
        $this->command->info('Creating Toy products...');
        \Faker\Factory::create()->unique(true); // Reset unique generator
        Product::factory()->toys()->count(10)->create();
        Product::factory()->toys()->outOfStock()->count(2)->create();
        $this->command->info('✓ Created 12 Toy products (10 with stock, 2 out of stock)');

        // Create Medicine products (10 total: 9 with stock, 1 without stock)
        $this->command->info('Creating Medicine products...');
        \Faker\Factory::create()->unique(true); // Reset unique generator
        Product::factory()->medicine()->count(9)->create();
        Product::factory()->medicine()->outOfStock()->count(1)->create();
        $this->command->info('✓ Created 10 Medicine products (9 with stock, 1 out of stock)');

        // Create Accessory products (13 total: 11 with stock, 2 without stock)
        $this->command->info('Creating Accessory products...');
        \Faker\Factory::create()->unique(true); // Reset unique generator
        Product::factory()->accessories()->count(11)->create();
        Product::factory()->accessories()->outOfStock()->count(2)->create();
        $this->command->info('✓ Created 13 Accessory products (11 with stock, 2 out of stock)');

        $totalProducts = Product::count();
        $this->command->info("🎉 ProductSeeder completed! Total products created: {$totalProducts}");

        // Show summary by category
        $foodCount      = Product::where('category', 'Alimento')->count();
        $toyCount       = Product::where('category', 'Juguetes')->count();
        $medicineCount  = Product::where('category', 'Medicina')->count();
        $accessoryCount = Product::where('category', 'Accesorios')->count();

        $this->command->info('📊 Summary:');
        $this->command->info("   - Food (Alimento): {$foodCount} products");
        $this->command->info("   - Toys (Juguetes): {$toyCount} products");
        $this->command->info("   - Medicine (Medicina): {$medicineCount} products");
        $this->command->info("   - Accessories (Accesorios): {$accessoryCount} products");

        $outOfStockCount = Product::where('stock', 0)->count();
        $inStockCount    = Product::where('stock', '>', 0)->count();
        $this->command->info("   - Products in stock: {$inStockCount}");
        $this->command->info("   - Products out of stock: {$outOfStockCount}");
    }
}
