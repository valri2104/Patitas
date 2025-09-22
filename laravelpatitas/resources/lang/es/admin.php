<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Language Lines - Administrative Interface
    |--------------------------------------------------------------------------
    |
    | The following language lines are used throughout the administrative
    | interface of the Patitas application. These are texts that administrators
    | will see when managing products, users, and other system resources.
    |
    */

    'products' => [
        'index' => [
            'title'           => 'Gestión de Productos',
            'subtitle'        => 'Administra el catálogo completo de productos',
            'create_new'      => 'Crear Nuevo Producto',
            'total_products'  => 'Total de productos: :count',
            'no_products'     => 'No hay productos registrados.',
            'search_products' => 'Buscar productos...',
        ],
        'create' => [
            'title'      => 'Crear Nuevo Producto',
            'subtitle'   => 'Añade un nuevo producto al catálogo',
            'form_title' => 'Información del Producto',
        ],
        'edit' => [
            'title'      => 'Editar Producto: :name',
            'subtitle'   => 'Modifica la información del producto',
            'form_title' => 'Actualizar Información',
        ],
        'show' => [
            'title'               => 'Detalles del Producto: :name',
            'product_information' => 'Información del Producto',
            'created_at'          => 'Creado el',
            'updated_at'          => 'Última actualización',
        ],
        'form' => [
            'name'                    => 'Nombre del Producto',
            'name_placeholder'        => 'Ingresa el nombre del producto',
            'description'             => 'Descripción',
            'description_placeholder' => 'Describe las características del producto',
            'price'                   => 'Precio (COP)',
            'price_placeholder'       => '0.00',
            'stock'                   => 'Stock',
            'stock_placeholder'       => 'Cantidad disponible',
            'category'                => 'Categoría',
            'category_placeholder'    => 'Selecciona una categoría',
            'customizable'            => 'Producto Personalizable',
            'customizable_help'       => 'Marca si este producto puede ser personalizado',
            'image_url'               => 'URL de la Imagen',
            'image_url_placeholder'   => 'https://ejemplo.com/imagen.jpg',
            'image_url_help'          => 'URL de la imagen del producto (opcional)',
        ],
        'actions' => [
            'create'         => 'Crear Producto',
            'update'         => 'Actualizar Producto',
            'delete'         => 'Eliminar',
            'edit'           => 'Editar',
            'view'           => 'Ver Detalles',
            'back_to_list'   => 'Volver a la Lista',
            'confirm_delete' => '¿Estás seguro de que deseas eliminar este producto?',
        ],
        'table' => [
            'name'         => 'Nombre',
            'category'     => 'Categoría',
            'price'        => 'Precio',
            'stock'        => 'Stock',
            'status'       => 'Estado',
            'actions'      => 'Acciones',
            'in_stock'     => 'En Stock',
            'out_of_stock' => 'Agotado',
            'customizable' => 'Personalizable',
        ],
        'messages' => [
            'created'          => 'Producto creado exitosamente.',
            'updated'          => 'Producto actualizado exitosamente.',
            'deleted'          => 'Producto ":name" eliminado exitosamente.',
            'not_found'        => 'Producto no encontrado.',
            'validation_error' => 'Por favor corrige los errores en el formulario.',
            'delete_error'     => 'No se pudo eliminar el producto. Inténtalo de nuevo.',
        ],
        'categories' => [
            'Alimento'   => 'Alimento',
            'Juguetes'   => 'Juguetes',
            'Medicina'   => 'Medicina',
            'Accesorios' => 'Accesorios',
        ],
    ],

    'navigation' => [
        'dashboard' => 'Panel de Control',
        'products'  => 'Productos',
        'users'     => 'Usuarios',
        'orders'    => 'Pedidos',
        'reports'   => 'Reportes',
        'settings'  => 'Configuración',
        'logout'    => 'Cerrar Sesión',
    ],

    'common' => [
        'yes'      => 'Sí',
        'no'       => 'No',
        'save'     => 'Guardar',
        'cancel'   => 'Cancelar',
        'delete'   => 'Eliminar',
        'edit'     => 'Editar',
        'view'     => 'Ver',
        'create'   => 'Crear',
        'update'   => 'Actualizar',
        'search'   => 'Buscar',
        'filter'   => 'Filtrar',
        'clear'    => 'Limpiar',
        'loading'  => 'Cargando...',
        'error'    => 'Error',
        'success'  => 'Éxito',
        'warning'  => 'Advertencia',
        'info'     => 'Información',
        'confirm'  => 'Confirmar',
        'required' => 'Requerido',
        'optional' => 'Opcional',
        'currency' => 'COP',
        'actions'  => 'Acciones',
        'status'   => 'Estado',
        'active'   => 'Activo',
        'inactive' => 'Inactivo',
        'date'     => 'Fecha',
        'time'     => 'Hora',
    ],

    'validation' => [
        'required' => 'Este campo es requerido.',
        'string'   => 'Este campo debe ser texto.',
        'numeric'  => 'Este campo debe ser numérico.',
        'integer'  => 'Este campo debe ser un número entero.',
        'min'      => 'El valor mínimo es :min.',
        'max'      => 'El valor máximo es :max.',
        'unique'   => 'Este valor ya está en uso.',
        'in'       => 'El valor seleccionado no es válido.',
    ],

];
