<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'nombre',
        'color'
    ];
    
    public function fotos(): HasMany{
        return $this->hasMany(Foto::class);
    } 

    public static function arrayCategory():array{
        $categorias=Category::orderBy('nombre')->pluck('nombre', 'id')->toArray();
        $categorias[-1]="______ Selecciona una categoría ______";
        ksort($categorias);
        return $categorias;
    }
}
