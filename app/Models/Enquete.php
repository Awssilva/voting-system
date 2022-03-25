<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquete extends Model
{
    use HasFactory;

    protected $table = 'enquetes';
    protected $fillable = [ 'titulo', 'data_inicio', 'data_fim' ];

    public function opcoes()
    {
        return $this->hasMany(EnqueteOpcoes::class, 'enquete_id');
    }
}
