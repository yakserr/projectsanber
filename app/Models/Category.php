<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $guarded = [];

    /**
     * Get the questions for the category.
     */

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * get the owns of Category
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
