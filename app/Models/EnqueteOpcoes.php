<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnqueteOpcoes extends Model
{
    use HasFactory;

    protected $table = 'enquete_opcoes';
    protected $fillable = [ 'enquete_id', 'opcao', 'votos' ];

}
