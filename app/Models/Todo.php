<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'category_id', 'title', 'description', 'status', 'due_date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }
}
