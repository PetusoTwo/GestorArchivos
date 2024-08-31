<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;
    protected $table = 'archivos';

    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria_id',
        'ruta',
        'fecha'
    ];
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function sharedFile(){
        return $this->hasMany(Share::class);
    }

    public function getNombreArchivoAttribute()
    {
        return basename($this->ruta); // Devuelve solo el nombre del archivo
    }
}
