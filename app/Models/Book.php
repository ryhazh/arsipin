<?php

namespace App\Models;

use App\Models\Genre;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'image',
        'title',
        'author',
        'description',
        'publisher',
        'publication_date',
        'category_id',
        'total_copies',
        'available_copies'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'book_genres');
    }

    public function records(): HasMany
    {
        return $this->hasMany(Record::class);
    }

    public function getAvailableCopiesAttribute()
    {
        $borrowedCount = $this->records()
            ->whereNull('returned_at')
            ->count();
            
        return $this->total_copies - $borrowedCount;
    }
}
