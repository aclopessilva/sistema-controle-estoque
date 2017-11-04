<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    
    use SoftDeletes;
    
    protected $fillable = ['nome', 'endereco', 'cnpj'];
    protected $dates = ['deleted_at'];
    
    public function produtos()
    {
        return $this->hasMany('App\Produto');
    }
    
}
