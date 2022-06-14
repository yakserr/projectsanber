<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public $guarded = [];


    /**
     * Get the user that owns the question.
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    /**
     * Get the category that owns the question.
     */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
