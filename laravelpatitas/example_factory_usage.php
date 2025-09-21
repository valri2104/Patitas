<?php

/**
 * Example usage of ProductFactory
 * This file demonstrates how to use the ProductFactory to generate test data
 * Remove this file after reviewing the examples
 */

// Basic usage - creates random products
// Product::factory()->count(10)->create();

// Create specific category products
// Product::factory()->food()->count(5)->create();
// Product::factory()->toys()->count(3)->create();
// Product::factory()->medicine()->count(4)->create();
// Product::factory()->accessories()->count(6)->create();

// Create out of stock products
// Product::factory()->outOfStock()->count(2)->create();

// Combine methods - create food products that are out of stock
// Product::factory()->food()->outOfStock()->count(3)->create();

// Create customizable toys
// Product::factory()->toys()->state(['customizable' => true])->count(2)->create();

// Create products with specific prices
// Product::factory()->medicine()->state(['price' => 50000])->count(1)->create();

// Mix different categories
// Product::factory()->count(20)->create(); // Random mix
// Product::factory()->food()->count(8)->create(); // Food products
// Product::factory()->toys()->count(6)->create(); // Toy products
// Product::factory()->medicine()->count(4)->create(); // Medicine products
// Product::factory()->accessories()->count(2)->create(); // Accessory products
