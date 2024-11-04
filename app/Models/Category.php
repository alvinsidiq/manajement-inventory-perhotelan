<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public static function boot()
    {
        parent::boot();

        // Event 'deleting' untuk menghapus items terkait
        static::deleting(function ($category) {
            $category->items()->delete();
        });
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
