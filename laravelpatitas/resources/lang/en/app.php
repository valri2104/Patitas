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
            'title'    => 'Patitas - Care and products for your pets',
            'subtitle' => 'Patitas',
            'footer'   => 'Patitas copy ©',
        ],
    ],

    'home' => [
        'title'            => 'Welcome to Patitas',
        'welcome_message'  => 'The best products and services for your pets in one place.',
        'explore_products' => 'Explore products',
    ],

    'products' => [
        'list' => [
            'title'              => 'Product Catalog',
            'subtitle'           => 'Find the best products for your pet',
            'no_products'        => 'No products available at the moment.',
            'filter_by_category' => 'Filter by category',
            'all_categories'     => 'All categories',
            'showing_category'   => 'Showing products in: :category',
            'products_found'     => ':count product found|:count products found',
            'top3'               => 'Top 3 most popular products',
            'more_affordable'    => 'Most affordable products',
        ],
        'show' => [
            'title'           => 'Product Details',
            'price'           => 'Price',
            'stock'           => 'Available stock',
            'category'        => 'Category',
            'description'     => 'Description',
            'customizable'    => 'Customizable',
            'in_stock'        => 'In stock',
            'out_of_stock'    => 'Out of stock',
            'units_available' => ':count unit available|:count units available',
            'back_to_catalog' => 'Back to catalog',
            'additional_info' => 'Additional Information',
            'product_details' => 'Product Details',
            'purchase_info'   => 'Purchase Information',
            'units'           => 'units',
            'availability'    => 'Availability',
            'shipping'        => 'Shipping',
            'free_shipping'   => 'Free shipping',
            'reviews_count'   => ':count review|:count reviews',
        ],
        'categories' => [
            'Alimento'   => 'Food',
            'Juguetes'   => 'Toys',
            'Medicina'   => 'Medicine',
            'Accesorios' => 'Accessories',
        ],
        'actions' => [
            'add_to_cart'     => 'Add to cart',
            'add_review'      => 'Add review',
            'delete_review'   => 'Delete review',
            'confirm_delete'  => 'Are you sure you want to delete this review?',
            'login_to_review' => 'Sign in to leave a review',
            'first_review'    => 'Be the first to review this product',
        ],
        'reviews' => [
            'title'             => 'Reviews',
            'average_rating'    => 'Average rating',
            'count'             => '(:count review)|(:count reviews)',
            'total_reviews'     => 'Total reviews: :count',
            'no_reviews'        => 'There are no reviews for this product yet.',
            'your_review'       => 'Your review',
            'write_review'      => 'Write a review',
            'write_title'       => 'Write your review',
            'rating_label'      => 'Rating',
            'description_label' => 'Comment',
            'submit'            => 'Submit review',
            'login_message'     => 'Sign in to leave a review.',
            'messages'          => [
                'created'           => 'Thank you for your review!',
                'deleted'           => 'Review deleted successfully.',
                'already_reviewed'  => 'You have already reviewed this product.',
                'purchase_required' => 'You must purchase the product before reviewing it.',
                'validation_error'  => 'Please correct the form errors.',
            ],
        ],
    ],

    'navigation' => [
        'home'         => 'Home',
        'products'     => 'Products',
        'about'        => 'About',
        'contact'      => 'Contact',
        'login'        => 'Sign In',
        'register'     => 'Register',
        'logout'       => 'Log Out',
        'cart'         => 'Cart',
        'order'        => 'My orders',
        'orders'       => 'My orders',
        'appointments' => 'Veterinary appointments',
        'balance'      => 'Balance',
        'language'     => 'Language',
        'language_es'  => 'Spanish',
        'language_en'  => 'English',
    ],

    'common' => [
        'yes'           => 'Yes',
        'no'            => 'No',
        'search'        => 'Search',
        'filter'        => 'Filter',
        'clear_filters' => 'Clear filters',
        'loading'       => 'Loading...',
        'error'         => 'Error',
        'success'       => 'Success',
        'currency'      => 'COP',
        'of'            => 'of',
        'select'        => 'Select',
    ],

    'partners' => [
        'title'    => 'Partner Products',
        'subtitle' => 'Supplements from our partner team',
        'fields'   => [
            'identifier' => 'Product ID: :id',
        ],
        'messages' => [
            'unavailable' => 'Partner products are not available right now.',
            'timeout'     => 'Partner products could not be loaded due to a timeout.',
            'error'       => 'An unexpected error occurred while loading partner products.',
            'empty'       => 'No partner products were found.',
        ],
    ],

];
