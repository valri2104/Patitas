<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Review extends Model
{
    /**
     * REVIEW
     * $this->attributes['id'] - int - contains the review ID
     * $this->attributes['qualification'] - int - contains the review qualification
     * $this->attributes['description'] - string - contains the review description
     */

     protected $fillable = ['qualification', 'descrption'];
}
