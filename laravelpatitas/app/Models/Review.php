<?php
/**
 * Developed by: Valeria Cardona
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Review extends Model
{
    /**
     * REVIEW
     * $this->attributes['id'] - int - contains the review ID
     * $this->attributes['user_id'] - int - contains the foreign key (user_id) from users table
     * $this->attributes['qualification'] - int - contains the review qualification
     * $this->attributes['description'] - string - contains the review description
     * $this->attributes['created_at'] - Carbon - contains the date when review was created
     * $this->attributes['updated_at'] - Carbon - contains the date when the review was updated
     */

     use HasFactory;

     protected $table = 'reviews';
     protected $fillable = ['qualification', 'descrption'];
     public $timestamps = true;

     public function setId(int $id): void
     {
        $this->attributes['id'] = $id;
     }

     public function getId(): int
     {
        return $this->attributes['id'];
     }

     public function getUserId(): int
     {
        return $this->attributes['user_id'];
     }

     public function setQualification(int $qualification): void
     {
        $this->attributes['qualification'] = $qualification;
     }

     public function getQualification(): int
     {
        return $this->attributes['qualification'];
     }

     public function getCreatedAt(): Carbon
     {
      return $this->attributes['created_at'];
     }

     public function getUpdatedAt(): Carbon
     {
        return $this->attributes['updated_at'];
     }

     public function user(): BelongsTo
     {
        return $this->belongsTo(User::class);
     }
}
