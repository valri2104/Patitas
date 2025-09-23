
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Language Lines - Public Interface
    |--------------------------------------------------------------------------
    |
    | The following language lines are used throughout the public interface
    | of the Patitas application. These are texts that regular users will see
    | when browsing the product catalog and viewing individual products.
    |
    */

    'products' => [
        'list' => [
            'title'              => 'Catálogo de Productos',
            'subtitle'           => 'Encuentra los mejores productos para tu mascota',
            'no_products'        => 'No hay productos disponibles en este momento.',
            'filter_by_category' => 'Filtrar por categoría',
            'all_categories'     => 'Todas las categorías',
            'showing_category'   => 'Mostrando productos de: :category',
            'products_found'     => ':count producto encontrado|:count productos encontrados',
        ],
        'show' => [
            'title'           => 'Detalles del Producto',
            'price'           => 'Precio',
            'stock'           => 'Stock disponible',
            'category'        => 'Categoría',
            'description'     => 'Descripción',
            'customizable'    => 'Personalizable',
            'in_stock'        => 'En stock',
            'out_of_stock'    => 'Agotado',
            'units_available' => ':count unidad disponible|:count unidades disponibles',
            'back_to_catalog' => 'Volver al catálogo',
        ],
        'categories' => [
            'Alimento'   => 'Alimento',
            'Juguetes'   => 'Juguetes',
            'Medicina'   => 'Medicina',
            'Accesorios' => 'Accesorios',
        ],
        'actions' => [
            'add_to_cart' => 'Agregar al carrito',
        ],
    ],

    'navigation' => [
        'home'     => 'Inicio',
        'products' => 'Productos',
        'about'    => 'Acerca de',
        'contact'  => 'Contacto',
        'login'    => 'Iniciar Sesión',
        'register' => 'Registrarse',
        'logout'   => 'Cerrar Sesión',
        'cart'     => 'Carrito',
    ],

    'common' => [
        'yes'           => 'Sí',
        'no'            => 'No',
        'search'        => 'Buscar',
        'filter'        => 'Filtrar',
        'clear_filters' => 'Limpiar filtros',
        'loading'       => 'Cargando...',
        'error'         => 'Error',
        'success'       => 'Éxito',
        'currency'      => 'COP',
    ],

];
