<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'parent_id'
    ];


    public function parent(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
}
