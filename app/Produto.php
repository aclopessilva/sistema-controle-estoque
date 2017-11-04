<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'custo', 'quantidade'];
    
    public function fornecedor()
    {
        return $this->belongsTo('App\Fornecedor');
    }
    
}
