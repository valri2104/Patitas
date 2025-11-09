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
    |----------------------------------------------------
    | Products translate
    |----------------------------------------------------
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

    'orders' => [
        'index' => [
            'title'         => 'Gestión de Pedidos',
            'subtitle'      => 'Administra todos los pedidos registrados en el sistema',
            'filter_status' => 'Filtrar por estado',
            'all_statuses'  => 'Todos los estados',
            'order_id'      => 'Pedido',
            'customer'      => 'Cliente',
            'date'          => 'Fecha',
            'status'        => 'Estado',
            'total'         => 'Total',
            'actions'       => 'Acciones',
            'no_orders'     => 'No hay pedidos registrados.',
        ],
        'show' => [
            'title'         => 'Pedido #:id',
            'subtitle'      => 'Detalle completo del pedido seleccionado',
            'order_details' => 'Detalles del pedido',
            'customer'      => 'Cliente',
            'email'         => 'Correo electrónico',
            'status'        => 'Estado',
            'placed_on'     => 'Realizado el :date',
            'delivery'      => 'Dirección de entrega',
            'notes'         => 'Notas del pedido',
            'items'         => 'Productos del pedido',
            'product'       => 'Producto',
            'quantity'      => 'Cantidad',
            'unit_price'    => 'Precio unitario',
            'subtotal'      => 'Subtotal',
            'total'         => 'Total del pedido',
        ],
        'statuses' => [
            'pending'   => 'Pendiente',
            'confirmed' => 'Confirmado',
            'shipped'   => 'Enviado',
            'delivered' => 'Entregado',
            'cancelled' => 'Cancelado',
        ],
        'messages' => [
            'status_updated' => 'El estado del pedido se actualizó correctamente.',
        ],
        'actions' => [
            'view'          => 'Ver Detalles',
            'update_status' => 'Actualizar estado',
        ],
        'filters' => [
            'apply' => 'Aplicar filtro',
            'clear' => 'Limpiar filtro',
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
    /**
     *|--------------------------------------------------
     *| Users translate
     *|-------------------------------------------------
     */
    'users' => [
        'index' => [
            'title'        => 'Gestión de Usuarios',
            'subtitle'     => 'Administra todos los usuarios del sistema',
            'create_new'   => 'Crear Nuevo Usuario',
            'total_users'  => 'Total de usuarios: :count',
            'no_users'     => 'No hay usuarios registrados.',
            'search_users' => 'Buscar usuarios...',
        ],
        'create' => [
            'title'      => 'Crear Nuevo Usuario',
            'subtitle'   => 'Añade un nuevo usuario al sistema',
            'form_title' => 'Información del Usuario',
        ],
        'edit' => [
            'title'      => 'Editar Usuario: :name',
            'subtitle'   => 'Modifica la información del usuario',
            'form_title' => 'Actualizar Información',
        ],
        'show' => [
            'title'            => 'Detalles del Usuario: :name',
            'user_information' => 'Información del Usuario',
            'created_at'       => 'Creado el',
            'updated_at'       => 'Última actualización',
        ],
        'form' => [
            'name'                         => 'Nombre Completo',
            'name_placeholder'             => 'Ingresa el nombre completo',
            'email'                        => 'Correo Electrónico',
            'email_placeholder'            => 'usuario@ejemplo.com',
            'role'                         => 'Rol',
            'role_placeholder'             => 'Selecciona un rol',
            'phone'                        => 'Número de teléfono',
            'phone_placeholder'            => 'Ingresa el número de teléfono',
            'address'                      => 'Dirección de residencia',
            'address_placeholder'          => 'Ingrese su dirección completa',
            'password'                     => 'Contraseña',
            'password_placeholder'         => 'Ingresa una contraseña segura',
            'password_confirm'             => 'Confirmar Contraseña',
            'password_confirm_placeholder' => 'Repite la contraseña',
        ],
        'actions' => [
            'create'         => 'Crear Usuario',
            'update'         => 'Actualizar Usuario',
            'delete'         => 'Eliminar',
            'edit'           => 'Editar',
            'view'           => 'Ver Detalles',
            'back_to_list'   => 'Volver a la Lista',
            'confirm_delete' => '¿Estás seguro de que deseas eliminar este usuario?',
        ],
        'table' => [
            'name'     => 'Nombre',
            'email'    => 'Correo Electrónico',
            'phone'    => 'Teléfono',
            'address'  => 'Dirección',
            'password' => 'Contraseña',
            'role'     => 'Rol',
        ],
        'messages' => [
            'created'          => 'Usuario creado exitosamente.',
            'updated'          => 'Usuario actualizado exitosamente.',
            'deleted'          => 'Usuario ":name" eliminado exitosamente.',
            'not_found'        => 'Usuario no encontrado.',
            'validation_error' => 'Por favor corrige los errores en el formulario.',
            'delete_error'     => 'No se pudo eliminar el usuario. Inténtalo de nuevo.',
        ],
        'roles' => [
            'admin'        => 'Administrador',
            'buyer'        => 'Comprador',
            'veterinarian' => 'Veterinario',
        ],
    ],

    /**
     *|--------------------------------------------------
     *| Admin translate
     *|-------------------------------------------------
     */
    'admin' => [
        'index' => [
            'title'           => 'Panel de administración',
            'welcome_message' => 'Welcome to the application',
        ],
    ],

    'layouts' => [
        'title'    => 'Admin - Patitas',
        'subtitle' => 'Patitas Admin',
        'footer'   => 'Patitas Admin Panel copy ©',
    ],

];
