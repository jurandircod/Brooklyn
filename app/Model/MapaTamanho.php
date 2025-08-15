<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MapaTamanho extends Model
{
    protected $tamanhoTenis = [
        '38' => '38',
        '39' => '39',
        '40' => '40',
        '41' => '41',
        '42' => '42',
    ];

    protected $tamanhoCamisetas = [
        'p' => 'p',
        'm' => 'm',
        'g' => 'g',
        'gg' => 'gg',
    ];

    protected $tamanhoSkates = [
        '775' => '775',
        '8' => '8',
        '825' => '825',
        '85' => '85',
    ];

public function getTamanhoDisponiveis($categoriaId, $tamanho)
{
    if ($categoriaId == 1) {
        return $this->tamanhoCamisetas[$tamanho] ?? null;
    } elseif ($categoriaId == 2) {
        return $this->tamanhoSkates[$tamanho] ?? null;
    } elseif ($categoriaId == 3) {
        return $this->tamanhoTenis[$tamanho] ?? null;
    }
    return null;
}

}
