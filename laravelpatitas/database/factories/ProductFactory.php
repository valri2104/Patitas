<?php

/**
 * Developed by Camilo Arbelaez.
 */

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Alimento', 'Juguetes', 'Medicina', 'Accesorios'];
        $category   = $this->faker->randomElement($categories);

        return [
            'name'         => $this->generateNameByCategory($category),
            'description'  => $this->generateDescriptionByCategory($category),
            'price'        => $this->faker->randomFloat(2, 5000, 200000),
            'stock'        => $this->faker->numberBetween(0, 100),
            'category'     => $category,
            'customizable' => $this->faker->boolean(20), // 20% chance of being customizable
            'imageUrl'     => $this->generateImageUrlByCategory($category),
        ];
    }

    /**
     * Generate realistic product names by category
     */
    private function generateNameByCategory(string $category): string
    {
        $names = [
            'Alimento' => [
                'Purina Pro Plan Adult',
                'Royal Canin Puppy',
                'Hills Science Diet',
                'Eukanuba Senior',
                'Pedigree Adulto',
                'Whiskas Gatitos',
                'Nutro Natural Choice',
                'Blue Buffalo Wilderness',
                'Premios Dentastix',
                'Suplemento Omega 3',
                'Concentrado Premium',
                'Snacks Naturales',
                'Alimento Húmedo',
                'Treats de Pollo',
                'Vitaminas Caninas',
                'Dog Chow Adulto',
                'Felix Adulto',
                'Acana Heritage',
                'Orijen Original',
                'Taste of the Wild',
                'Canidae Pure',
                'Wellness Core',
                'Merrick Classic',
                'Fromm Family',
                'Ziwi Peak',
            ],
            'Juguetes' => [
                'Pelota de Tennis',
                'Hueso de Goma',
                'Cuerda de Algodón',
                'Frisbee Resistente',
                'Juguete Interactivo',
                'Pelota con Sonido',
                'Mordedor Dental',
                'Ratón de Peluche',
                'Kong Classic',
                'Juguete Dispensador',
                'Pelota Rebotadora',
                'Hueso Masticable',
                'Cuerda Nudos',
                'Juguete Flotante',
                'Peluche Chirriante',
                'Disco Volador',
                'Pelota Luminosa',
                'Juguete Puzzle',
                'Mordedor Congelable',
                'Túnel de Juego',
            ],
            'Medicina' => [
                'Bravecto Antipulgas',
                'Shampoo Antipulgas',
                'Vitaminas Multiples',
                'Desparasitante Interno',
                'Antibiótico Veterinario',
                'Colirio Oftálmico',
                'Spray Cicatrizante',
                'Suplemento Articular',
                'Shampoo Medicado',
                'Antihistamínico',
                'Probióticos Digestivos',
                'Gel Dental',
                'Loción Dermatológica',
                'Jarabe Expectorante',
                'Ungüento Antiséptico',
                'Nexgard Garrapatas',
                'Frontline Plus',
                'Revolution Spot On',
                'Advocate Pipeta',
                'Simparica Chewable',
            ],
            'Accesorios' => [
                'Collar de Cuero',
                'Correa Retráctil',
                'Cama Ortopédica',
                'Transportadora Rígida',
                'Comedero Acero Inoxidable',
                'Bebedero Automático',
                'Arnés Acolchado',
                'Manta Térmica',
                'Casa para Perro',
                'Rascador para Gatos',
                'Collar Isabelino',
                'Bandana Decorativa',
                'Juego de Platos',
                'Cepillo de Aseo',
                'Cortaúñas Profesional',
                'Collar GPS',
                'Correa Extensible',
                'Cama Elevada',
                'Transportadora Flexible',
                'Comedero Elevado',
                'Fuente de Agua',
                'Arnés Reflectante',
                'Cojín Térmico',
            ],
        ];

        $baseName = $this->faker->randomElement($names[$category]);
        $suffix   = $this->faker->unique()->numberBetween(1, 9999);

        return $baseName . ' #' . $suffix;
    }

    /**
     * Generate realistic descriptions by category
     */
    private function generateDescriptionByCategory(string $category): string
    {
        $descriptions = [
            'Alimento' => [
                'Alimento premium balanceado con ingredientes naturales para una nutrición completa.',
                'Fórmula especial rica en proteínas y vitaminas esenciales para el crecimiento.',
                'Concentrado super premium con antioxidantes naturales y omega 3.',
                'Alimento hipoalergénico ideal para mascotas con sensibilidades alimentarias.',
                'Snacks naturales sin conservantes artificiales, perfectos para entrenamientos.',
                'Suplemento nutricional que fortalece el sistema inmunológico de tu mascota.',
            ],
            'Juguetes' => [
                'Juguete resistente y duradero, perfecto para horas de diversión y ejercicio.',
                'Diseñado para estimular la mente y mantener entretenida a tu mascota.',
                'Material no tóxico y seguro, ideal para mascotas de todas las edades.',
                'Juguete interactivo que ayuda a reducir el estrés y la ansiedad.',
                'Perfecto para el juego activo y el fortalecimiento de la mandíbula.',
                'Juguete educativo que estimula los instintos naturales de caza.',
            ],
            'Medicina' => [
                'Tratamiento efectivo y seguro recomendado por veterinarios profesionales.',
                'Fórmula avanzada que proporciona alivio rápido y duradero.',
                'Medicamento de uso veterinario con ingredientes activos de alta calidad.',
                'Suplemento natural que mejora la salud y bienestar general.',
                'Producto dermatológico especialmente formulado para pieles sensibles.',
                'Preventivo mensual que protege contra parásitos externos e internos.',
            ],
            'Accesorios' => [
                'Accesorio de alta calidad, cómodo y resistente para uso diario.',
                'Diseño ergonómico que garantiza la comodidad y seguridad de tu mascota.',
                'Material premium duradero y fácil de limpiar para mayor higiene.',
                'Accesorio funcional y estético que combina practicidad con estilo.',
                'Producto resistente al agua y a los rayos UV para uso exterior.',
                'Diseño innovador que facilita el cuidado y manejo de tu mascota.',
            ],
        ];

        return $this->faker->randomElement($descriptions[$category]);
    }

    /**
     * Generate realistic image URLs by category
     */
    private function generateImageUrlByCategory(string $category): string
    {
        $baseUrl = 'https://via.placeholder.com/400x400/';
        $colors  = [
            'Alimento'   => '8B4513/FFFFFF', // Brown
            'Juguetes'   => 'FF6B6B/FFFFFF', // Red
            'Medicina'   => '4ECDC4/FFFFFF', // Teal
            'Accesorios' => '45B7D1/FFFFFF', // Blue
        ];

        $categoryLabels = [
            'Alimento'   => 'Food',
            'Juguetes'   => 'Toys',
            'Medicina'   => 'Medicine',
            'Accesorios' => 'Accessories',
        ];

        return $baseUrl . $colors[$category] . '?text=' . $categoryLabels[$category];
    }

    /**
     * Create food products
     */
    public function food(): static
    {
        return $this->state(fn (array $attributes) => [
            'category'    => 'Alimento',
            'name'        => $this->generateNameByCategory('Alimento'),
            'description' => $this->generateDescriptionByCategory('Alimento'),
            'imageUrl'    => $this->generateImageUrlByCategory('Alimento'),
            'price'       => $this->faker->randomFloat(2, 15000, 150000),
        ]);
    }

    /**
     * Create toy products
     */
    public function toys(): static
    {
        return $this->state(fn (array $attributes) => [
            'category'    => 'Juguetes',
            'name'        => $this->generateNameByCategory('Juguetes'),
            'description' => $this->generateDescriptionByCategory('Juguetes'),
            'imageUrl'    => $this->generateImageUrlByCategory('Juguetes'),
            'price'       => $this->faker->randomFloat(2, 5000, 50000),
        ]);
    }

    /**
     * Create medicine products
     */
    public function medicine(): static
    {
        return $this->state(fn (array $attributes) => [
            'category'    => 'Medicina',
            'name'        => $this->generateNameByCategory('Medicina'),
            'description' => $this->generateDescriptionByCategory('Medicina'),
            'imageUrl'    => $this->generateImageUrlByCategory('Medicina'),
            'price'       => $this->faker->randomFloat(2, 25000, 200000),
        ]);
    }

    /**
     * Create accessory products
     */
    public function accessories(): static
    {
        return $this->state(fn (array $attributes) => [
            'category'    => 'Accesorios',
            'name'        => $this->generateNameByCategory('Accesorios'),
            'description' => $this->generateDescriptionByCategory('Accesorios'),
            'imageUrl'    => $this->generateImageUrlByCategory('Accesorios'),
            'price'       => $this->faker->randomFloat(2, 10000, 120000),
        ]);
    }

    /**
     * Create out of stock products
     */
    public function outOfStock(): static
    {
        return $this->state(fn (array $attributes) => [
            'stock' => 0,
        ]);
    }
}
