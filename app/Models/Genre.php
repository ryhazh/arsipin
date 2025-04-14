<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $fillable = [
        'name'
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_genres');
    }
}
