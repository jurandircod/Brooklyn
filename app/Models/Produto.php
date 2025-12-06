<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $fillable = ['nome', 'valor', 'material', 'categoria_id', 'marca_id', 'descricao', 'largura', 'user_id', 'estado', 'valor_compra', 'quantidade'];
    protected $appends = ['imagem_url'];
    // Define o relacionamento "uma categoria tem muitos produtos"
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function fotos()
    {
        return $this->hasMany(Fotos::class, 'produto_id');
        //                     Modelo filho ↑   ↑ Coluna real no banco
    }

    public function avaliacao()
    {
        return $this->hasMany(Avaliacao::class, 'produto_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function ItemCarrinho()
    {
        return $this->hasMany(ItemCarrinho::class);
    }

    public function estoque()
    {
        return $this->hasMany(Estoque::class, 'produto_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calcularMediaEstrelas($produtoId)
    {
        $media = Avaliacao::where('produto_id', $produtoId)
            ->avg('estrela');

        return round($media); // Arredonda para inteiro (1-5)
    }
    // metodo acessor de helper
    public function getPastaAttribute()
    {
        return \App\Helpers\ImagemHelper::pastaImagensProduto($this->id);
    }

    public function getImagemUrlAttribute()
    {
        return \App\Helpers\ImagemHelper::imagemDoProduto($this->id, 0);
    }

    public function getImagemUrl2Attribute()
    {
        return \App\Helpers\ImagemHelper::imagemDoProduto($this->id, 1);
    }

    public function getImagemUrl3Attribute()
    {
        return \App\Helpers\ImagemHelper::imagemDoProduto($this->id, 2);
    }

    public function getImagemUrl4Attribute()
    {
        return \App\Helpers\ImagemHelper::imagemDoProduto($this->id, 3);
    }

    public function getImagemUrl5Attribute()
    {
        return \App\Helpers\ImagemHelper::imagemDoProduto($this->id, 4);
    }

    public function getImagemPastaAttribute()
    {
        return \App\Helpers\ImagemHelper::pastaImagensProduto($this->id);
    }

}
