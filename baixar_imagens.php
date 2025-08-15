<?php
// CONFIGURAÇÕES
$apiKey = "4CXhWamanmb0QA1xHGytPVMuwieLALd5zV8XdNXA450hpzIVQBrzjgtZ"; // Trocar pela sua chave
$pastaDestino = "C:\Users\User\Documents\skate"; // Caminho da pasta de destino
$termos = ["skate", "shoes", "tenis"]; // Termos de busca
$quantidadePorTermo = 10; // Quantidade de imagens por termo

// Criar pasta caso não exista
if (!is_dir($pastaDestino)) {
    mkdir($pastaDestino, 0777, true);
}

foreach ($termos as $termo) {
    echo "🔍 Buscando imagens de: {$termo}...\n";

    $url = "https://api.pexels.com/v1/search?query=" . urlencode($termo) . "&per_page={$quantidadePorTermo}";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: {$apiKey}"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resultado = curl_exec($ch);
    curl_close($ch);

    $dados = json_decode($resultado, true);

    if (!isset($dados['photos'])) {
        echo "❌ Nenhuma foto encontrada para {$termo}\n";
        continue;
    }

    foreach ($dados['photos'] as $foto) {
        $urlImagem = $foto['src']['large'];
        $nomeArquivo = basename(parse_url($urlImagem, PHP_URL_PATH));
        $caminhoFinal = "{$pastaDestino}/{$termo}_{$nomeArquivo}";

        file_put_contents($caminhoFinal, file_get_contents($urlImagem));
        echo "✅ Baixado: {$caminhoFinal}\n";
    }
}

echo "🎯 Todas as imagens foram baixadas para: {$pastaDestino}\n";
