<?php

return [
    'title'          => 'Reviews',
    'no_reviews'     => 'There are no reviews for this product yet.',
    'average_rating' => 'Average rating',
    'your_review'    => 'Your review',
    'form'           => [
        'title'         => 'Write your review',
        'qualification' => 'Rating',
        'description'   => 'Comment',
        'placeholder'   => 'Tell us how it worked for your pet...',
        'submit'        => 'Submit review',
    ],
    'messages' => [
        'created'           => 'Thank you for your review!',
        'deleted'           => 'Review deleted successfully.',
        'already_reviewed'  => 'You have already reviewed this product.',
        'purchase_required' => 'You must purchase the product before reviewing it.',
        'not_authorized'    => 'You are not authorized to delete this review.',
        'validation_error'  => 'Please correct the form errors.',
    ],
    'validation' => [
        'purchase_required' => 'You must have purchased this product to leave a review.',
        'already_reviewed'  => 'You can only leave one review per product.',
    ],
];
