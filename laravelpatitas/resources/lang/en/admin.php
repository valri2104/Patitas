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
            'title'           => 'Product Management',
            'subtitle'        => 'Manage the full product catalog',
            'create_new'      => 'Create New Product',
            'total_products'  => 'Total products: :count',
            'no_products'     => 'No products registered.',
            'search_products' => 'Search products...',
        ],
        'create' => [
            'title'      => 'Create New Product',
            'subtitle'   => 'Add a new product to the catalog',
            'form_title' => 'Product Information',
        ],
        'edit' => [
            'title'      => 'Edit Product: :name',
            'subtitle'   => 'Update the product information',
            'form_title' => 'Update Information',
        ],
        'show' => [
            'title'               => 'Product Details: :name',
            'product_information' => 'Product Information',
            'created_at'          => 'Created on',
            'updated_at'          => 'Last updated',
        ],
        'form' => [
            'name'                    => 'Product Name',
            'name_placeholder'        => 'Enter the product name',
            'description'             => 'Description',
            'description_placeholder' => 'Describe the product features',
            'price'                   => 'Price (COP)',
            'price_placeholder'       => '0.00',
            'stock'                   => 'Stock',
            'stock_placeholder'       => 'Available quantity',
            'category'                => 'Category',
            'category_placeholder'    => 'Select a category',
            'customizable'            => 'Customizable Product',
            'customizable_help'       => 'Check if this product can be customized',
            'image_url'               => 'Image URL',
            'image_url_placeholder'   => 'https://example.com/image.jpg',
            'image_url_help'          => 'Product image URL (optional)',
        ],
        'actions' => [
            'create'         => 'Create Product',
            'update'         => 'Update Product',
            'delete'         => 'Delete',
            'edit'           => 'Edit',
            'view'           => 'View Details',
            'back_to_list'   => 'Back to List',
            'confirm_delete' => 'Are you sure you want to delete this product?',
        ],
        'table' => [
            'name'         => 'Name',
            'category'     => 'Category',
            'price'        => 'Price',
            'stock'        => 'Stock',
            'status'       => 'Status',
            'actions'      => 'Actions',
            'in_stock'     => 'In Stock',
            'out_of_stock' => 'Out of Stock',
            'customizable' => 'Customizable',
        ],
        'messages' => [
            'created'          => 'Product created successfully.',
            'updated'          => 'Product updated successfully.',
            'deleted'          => 'Product ":name" deleted successfully.',
            'not_found'        => 'Product not found.',
            'validation_error' => 'Please correct the errors in the form.',
            'delete_error'     => 'The product could not be deleted. Try again.',
        ],
        'categories' => [
            'Alimento'   => 'Food',
            'Juguetes'   => 'Toys',
            'Medicina'   => 'Medicine',
            'Accesorios' => 'Accessories',
        ],
    ],

    'orders' => [
        'index' => [
            'title'            => 'Order Management',
            'subtitle'         => 'Manage every order registered in the system',
            'filter_status'    => 'Filter by status',
            'all_statuses'     => 'All statuses',
            'order_id'         => 'Order',
            'customer'         => 'Customer',
            'date'             => 'Date',
            'status'           => 'Status',
            'total'            => 'Total',
            'actions'          => 'Actions',
            'no_orders'        => 'No orders registered.',
            'unknown_customer' => 'Customer unavailable',
        ],
        'show' => [
            'title'               => 'Order #:id',
            'subtitle'            => 'Full details of the selected order',
            'order_details'       => 'Order details',
            'customer'            => 'Customer',
            'email'               => 'Email',
            'email_unavailable'   => 'Email unavailable',
            'status'              => 'Status',
            'placed_on'           => 'Placed on :date',
            'delivery'            => 'Delivery address',
            'notes'               => 'Order notes',
            'items'               => 'Order items',
            'product'             => 'Product',
            'product_unavailable' => 'Product unavailable',
            'quantity'            => 'Quantity',
            'unit_price'          => 'Unit price',
            'subtotal'            => 'Subtotal',
            'total'               => 'Order total',
            'print'               => 'Print invoice',
            'back'                => 'Back to list',
        ],
        'statuses' => [
            'pending'   => 'Pending',
            'confirmed' => 'Confirmed',
            'shipped'   => 'Shipped',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
        ],
        'messages' => [
            'status_updated' => 'The order status was updated successfully.',
        ],
        'actions' => [
            'view'          => 'View Details',
            'update_status' => 'Update status',
        ],
        'filters' => [
            'apply' => 'Apply filter',
            'clear' => 'Clear filter',
        ],
    ],

    'reviews' => [
        'index' => [
            'title'    => 'Review Moderation',
            'subtitle' => 'Manage and moderate product reviews',
            'info'     => 'Monitor user-generated content to keep the catalog quality high.',
            'empty'    => 'No reviews match the selected filters.',
        ],
        'filters' => [
            'rating'       => 'Rating',
            'product'      => 'Product',
            'user'         => 'User',
            'apply'        => 'Apply filters',
            'clear'        => 'Clear filters',
            'placeholder'  => 'Search by name or email',
            'all_ratings'  => 'All ratings',
            'all_products' => 'All products',
            'all'          => 'All',
            'stars'        => ':rating★',
        ],
        'table' => [
            'author'      => 'User',
            'product'     => 'Product',
            'rating'      => 'Rating',
            'description' => 'Description',
            'date'        => 'Date',
            'actions'     => 'Actions',
        ],
        'messages' => [
            'deleted' => 'Review deleted successfully.',
        ],
        'actions' => [
            'delete'         => 'Delete review',
            'confirm_delete' => 'Are you sure you want to delete this review?',
        ],
    ],

    'navigation' => [
        'dashboard'    => 'Dashboard',
        'products'     => 'Products',
        'users'        => 'Users',
        'orders'       => 'Orders',
        'appointments' => 'Veterinary Appointments',
        'reviews'      => 'Reviews',
        'reports'      => 'Reports',
        'settings'     => 'Settings',
        'logout'       => 'Log Out',
    ],

    'common' => [
        'yes'      => 'Yes',
        'no'       => 'No',
        'save'     => 'Save',
        'cancel'   => 'Cancel',
        'delete'   => 'Delete',
        'edit'     => 'Edit',
        'view'     => 'View',
        'create'   => 'Create',
        'update'   => 'Update',
        'search'   => 'Search',
        'filter'   => 'Filter',
        'clear'    => 'Clear',
        'loading'  => 'Loading...',
        'error'    => 'Error',
        'success'  => 'Success',
        'warning'  => 'Warning',
        'info'     => 'Information',
        'confirm'  => 'Confirm',
        'required' => 'Required',
        'optional' => 'Optional',
        'currency' => 'COP',
        'actions'  => 'Actions',
        'status'   => 'Status',
        'active'   => 'Active',
        'inactive' => 'Inactive',
        'date'     => 'Date',
        'time'     => 'Time',
    ],

    'validation' => [
        'required' => 'This field is required.',
        'string'   => 'This field must be text.',
        'numeric'  => 'This field must be numeric.',
        'integer'  => 'This field must be an integer.',
        'min'      => 'The minimum value is :min.',
        'max'      => 'The maximum value is :max.',
        'unique'   => 'This value is already in use.',
        'in'       => 'The selected value is not valid.',
    ],
    /**
     *|--------------------------------------------------
     *| Users translate
     *|-------------------------------------------------
     */
    'users' => [
        'index' => [
            'title'        => 'User Management',
            'subtitle'     => 'Manage every user in the system',
            'create_new'   => 'Create New User',
            'total_users'  => 'Total users: :count',
            'no_users'     => 'No users registered.',
            'search_users' => 'Search users...',
        ],
        'create' => [
            'title'      => 'Create New User',
            'subtitle'   => 'Add a new user to the system',
            'form_title' => 'User Information',
        ],
        'edit' => [
            'title'      => 'Edit User: :name',
            'subtitle'   => 'Update the user information',
            'form_title' => 'Update Information',
        ],
        'show' => [
            'title'            => 'User Details: :name',
            'user_information' => 'User Information',
            'created_at'       => 'Created on',
            'updated_at'       => 'Last updated',
        ],
        'form' => [
            'name'                         => 'Full Name',
            'name_placeholder'             => 'Enter the full name',
            'email'                        => 'Email Address',
            'email_placeholder'            => 'user@example.com',
            'role'                         => 'Role',
            'role_placeholder'             => 'Select a role',
            'phone'                        => 'Phone number',
            'phone_placeholder'            => 'Enter the phone number',
            'address'                      => 'Home address',
            'address_placeholder'          => 'Enter the complete address',
            'password'                     => 'Password',
            'password_placeholder'         => 'Enter a secure password',
            'password_confirm'             => 'Confirm Password',
            'password_confirm_placeholder' => 'Repeat the password',
        ],
        'actions' => [
            'create'         => 'Create User',
            'update'         => 'Update User',
            'delete'         => 'Delete',
            'edit'           => 'Edit',
            'view'           => 'View Details',
            'back_to_list'   => 'Back to List',
            'confirm_delete' => 'Are you sure you want to delete this user?',
        ],
        'table' => [
            'name'     => 'Name',
            'email'    => 'Email Address',
            'phone'    => 'Phone',
            'address'  => 'Address',
            'password' => 'Password',
            'role'     => 'Role',
        ],
        'messages' => [
            'created'          => 'User created successfully.',
            'updated'          => 'User updated successfully.',
            'deleted'          => 'User ":name" deleted successfully.',
            'not_found'        => 'User not found.',
            'validation_error' => 'Please correct the errors in the form.',
            'delete_error'     => 'The user could not be deleted. Try again.',
        ],
        'roles' => [
            'Admin'        => 'Administrator',
            'Buyer'        => 'Buyer',
            'Veterinarian' => 'Veterinarian',
        ],
    ],

    /**
     *|--------------------------------------------------
     *| Admin translate
     *|-------------------------------------------------
     */
    'admin' => [
        'index' => [
            'title'           => 'Administration Panel',
            'welcome_message' => 'Welcome to the application',
        ],
    ],

    'layouts' => [
        'title'    => 'Admin - Patitas',
        'subtitle' => 'Patitas Admin',
        'footer'   => 'Patitas Admin Panel copy ©',
    ],

];
