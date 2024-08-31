<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Carpeta extends Model
{
    use HasFactory;
    protected $table = 'carpetas';
    protected $fillable = [
        'nombre',
        'user_id'
    ];
    public function usuario(){
        return $this->belongsTo(User::class);
    }
    
}
