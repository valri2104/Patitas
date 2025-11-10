
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

    'layouts' => [
        'app' => [
            'title'    => 'Patitas - Cuidado y productos para tus mascotas',
            'subtitle' => 'Patitas',
            'footer'   => 'Patitas copy ©',
        ],
    ],

    'home' => [
        'title'            => 'Bienvenido a Patitas',
        'welcome_message'  => 'Los mejores productos y servicios para tus mascotas en un solo lugar.',
        'explore_products' => 'Explorar productos',
    ],

    'products' => [
        'list' => [
            'title'              => 'Catálogo de Productos',
            'subtitle'           => 'Encuentra los mejores productos para tu mascota',
            'no_products'        => 'No hay productos disponibles en este momento.',
            'filter_by_category' => 'Filtrar por categoría',
            'all_categories'     => 'Todas las categorías',
            'showing_category'   => 'Mostrando productos de: :category',
            'products_found'     => ':count producto encontrado|:count productos encontrados',
            'top3'               => 'Top 3 productos más populares',
            'more_affordable'    => 'Productos más económicos',
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
            'additional_info' => 'Información Adicional',
            'product_details' => 'Detalles del Producto',
            'purchase_info'   => 'Información de Compra',
            'units'           => 'unidades',
            'availability'    => 'Disponibilidad',
            'shipping'        => 'Envío',
            'free_shipping'   => 'Envío gratuito',
            'reviews_count'   => ':count reseña|:count reseñas',
        ],
        'categories' => [
            'Alimento'   => 'Alimento',
            'Juguetes'   => 'Juguetes',
            'Medicina'   => 'Medicina',
            'Accesorios' => 'Accesorios',
        ],
        'actions' => [
            'add_to_cart'     => 'Agregar al carrito',
            'add_review'      => 'Agregar reseña',
            'delete_review'   => 'Eliminar reseña',
            'confirm_delete'  => '¿Estás seguro de que deseas eliminar esta reseña?',
            'login_to_review' => 'Inicia sesión para dejar una reseña',
            'first_review'    => 'Sé el primero en opinar sobre este producto',
        ],
        'reviews' => [
            'title'             => 'Reseñas',
            'average_rating'    => 'Calificación promedio',
            'count'             => '(:count reseña)|(:count reseñas)',
            'total_reviews'     => 'Total de reseñas: :count',
            'no_reviews'        => 'Aún no hay reseñas para este producto.',
            'your_review'       => 'Tu reseña',
            'write_review'      => 'Escribe una reseña',
            'write_title'       => 'Escribe tu reseña',
            'rating_label'      => 'Calificación',
            'description_label' => 'Comentario',
            'submit'            => 'Enviar reseña',
            'login_message'     => 'Inicia sesión para dejar una reseña.',
            'messages'          => [
                'created'           => '¡Gracias por tu reseña!',
                'deleted'           => 'Reseña eliminada correctamente.',
                'already_reviewed'  => 'Ya has reseñado este producto.',
                'purchase_required' => 'Necesitas comprar el producto antes de poder reseñarlo.',
                'validation_error'  => 'Por favor corrige los errores del formulario.',
            ],
        ],
    ],

    'navigation' => [
        'home'         => 'Inicio',
        'products'     => 'Productos',
        'about'        => 'Acerca de',
        'contact'      => 'Contacto',
        'login'        => 'Iniciar Sesión',
        'register'     => 'Registrarse',
        'logout'       => 'Cerrar Sesión',
        'cart'         => 'Carrito',
        'order'        => 'Mis pedidos',
        'orders'       => 'Mis pedidos',
        'appointments' => 'Citas veterinarias',
        'balance'      => 'Saldo',
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
        'of'            => 'de',
        'select'        => 'Seleccione',
    ],

];
