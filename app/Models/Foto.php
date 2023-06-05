<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Foto extends Model
{
    use HasFactory;
    protected $fillable=['titulo', 'descripcion', 'imagen', 'publicada', 'category_id', 'user_id'];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
