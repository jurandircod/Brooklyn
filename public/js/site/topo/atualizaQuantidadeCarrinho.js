document.addEventListener("DOMContentLoaded", function () {
    $(document).ready(function () {
        function atualizarContadorCarrinho() {
            $.ajax({
                url: "{{ route('site.carrinho.quantidadeItensCarrinho') }}",
                method: 'GET',
                success: function (response) {
                    console.log("Quantidade de itens:", response.quantidade);
                    $('#contador').text(response.quantidade);
                },
                error: function (xhr, status, error) {
                    console.error("Erro no AJAX:", error);
                    console.log("Resposta completa:", xhr.responseText);
                }
            });
        }

        // Atualiza imediatamente ao carregar a página
        atualizarContadorCarrinho();

        // Atualiza a cada 5 segundos (5000 milissegundos)
        setInterval(atualizarContadorCarrinho, 1000);
    });
});