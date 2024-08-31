<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    protected $table = 'shares';
    protected $fillable = [
        'user_id',
        'file_id',
        'folder_id',
        'fecha'
    ];
    public function archivo(){
        return $this->belongsTo(Archivo::class);
    }
}
