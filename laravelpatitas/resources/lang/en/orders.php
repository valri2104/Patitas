<?php

return [
    'index' => [
        'title'    => 'My Orders',
        'subtitle' => 'Check the history of your recent orders.',
        'empty'    => 'You do not have orders yet.',
        'order_id' => 'Order',
        'date'     => 'Date',
        'status'   => 'Status',
        'total'    => 'Total',
        'view'     => 'View details',
    ],
    'show' => [
        'title'            => 'Order #:id',
        'order_number'     => 'Order number',
        'order_date'       => 'Order date',
        'total'            => 'Total',
        'shipping_address' => 'Delivery address',
        'delivery_address' => 'Delivery address',
        'status'           => 'Status',
        'notes'            => 'Order notes',
        'items'            => 'Order items',
        'product'          => 'Product',
        'quantity'         => 'Quantity',
        'unit_price'       => 'Unit price',
        'subtotal'         => 'Subtotal',
        'back'             => 'Back to history',
        'placed_on'        => 'Placed on :date',
    ],
    'status' => [
        'pending'   => 'Pending',
        'confirmed' => 'Confirmed',
        'shipped'   => 'Shipped',
        'delivered' => 'Delivered',
        'cancelled' => 'Cancelled',
    ],
    'fields' => [
        'order_number'     => 'Order number',
        'order_date'       => 'Order date',
        'total'            => 'Order total',
        'shipping_address' => 'Delivery address',
        'status'           => 'Order status',
    ],
    'actions' => [
        'view_details'   => 'View details',
        'back_to_orders' => 'Back to my orders',
    ],
];
