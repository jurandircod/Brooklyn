<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculaFreteController extends Controller
{


    public function calcularFrete($cepDestino)
{
    $cepOrigem = '87400000';
    $pesoTotal = 1.5; // kg
    $dimensoes = ['largura' => 30, 'altura' => 20, 'comprimento' => 20]; // cm
    
    // Tabela de fretes por região (exemplo simplificado)
    $tabelaFrete = [
        'SP' => ['base' => 10.00, 'adicional' => 0.50],
        'RJ' => ['base' => 15.00, 'adicional' => 0.80],
        'MG' => ['base' => 12.00, 'adicional' => 0.60],
        'default' => ['base' => 20.00, 'adicional' => 1.00]
    ];
    
    // Obter região do CEP (simplificado - na prática usar API)
    $regiao = $this->getRegiaoByCep($cepDestino);
    
    // Calcular frete
    $frete = $tabelaFrete[$regiao]['base'] + 
             ($pesoTotal * $tabelaFrete[$regiao]['adicional']);
    
    return [
        'valor' => number_format($frete, 2),
        'prazo' => $this->getPrazoEntrega($regiao),
        'regiao' => $regiao
    ];
}

private function getRegiaoByCep($cep)
{
    // Lógica simplificada - na prática usar ViaCEP ou similar
    $prefixo = substr($cep, 0, 2);
    if ($prefixo >= '01' && $prefixo <= '19') return 'SP';
    if ($prefixo >= '20' && $prefixo <= '28') return 'RJ';
    if ($prefixo >= '30' && $prefixo <= '39') return 'MG';
    return 'default';
}

private function getPrazoEntrega($regiao)
{
    $prazos = [
        'SP' => '1-2 dias úteis',
        'RJ' => '2-3 dias úteis',
        'MG' => '3-4 dias úteis',
        'default' => '5-7 dias úteis'
    ];
    return $prazos[$regiao];
}
}
