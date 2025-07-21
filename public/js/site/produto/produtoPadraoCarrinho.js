document.addEventListener("DOMContentLoaded", function () {
    const botoes = document.querySelectorAll(".addtocart-btn");

    botoes.forEach(botao => {
        botao.addEventListener("click", function () {
            const produtoId = this.getAttribute("data-id");
            const produtoElement = this.closest('.product-box');
            const produtoNome = produtoElement.querySelector('h5').textContent;
            const produtoPreco = produtoElement.querySelector('.theme-color').textContent;
            const produtoImagem = produtoElement.querySelector('img').src;
            const tamanho = "quantidade";

            // Mostrar toast de carregamento
            const loadingToast = Toastify({
                text: "Adicionando ao carrinho...",
                duration: -1,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#4CAF50",
                stopOnFocus: true
            }).showToast();

            fetch("{{ route('site.carrinho.itemCarrinho.adicionar') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    produto_id: produtoId,
                    quantidade: 1,
                    tamanho: tamanho
                })
            })
                .then(async (res) => {
                    const contentType = res.headers.get("content-type");
                    if (contentType && contentType.includes("application/json")) {
                        return res.json();
                    } else {
                        const text = await res.text();
                        throw new Error(text);
                    }
                })
                .then(data => {

                    if (data.status === 'sucess' || data.status === 'success') {
                        loadingToast.hideToast();

                        // Mostrar SweetAlert para confirmação
                        Swal.fire({
                            title: 'Adicionado ao carrinho!',
                            html: `
                                <div style="display: flex; align-items: center; gap: 15px; margin: 10px 0;">
                                    <img src="${produtoImagem}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                    <div>
                                        <h6 style="margin: 0 0 5px 0;">${produtoNome}</h6>
                                        <p style="margin: 0; color: #4CAF50; font-weight: bold;">${produtoPreco}</p>
                                    </div>
                                </div>
                            `,
                            icon: 'success',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            timer: 3000,
                            timerProgressBar: true
                        });

                        // Mostrar toast de confirmação
                        Toastify({
                            text: `${data.message} adicionado ao carrinho!`,
                            duration: 3000,
                            gravity: "bottom",
                            position: "right",
                            backgroundColor: "#4CAF50",
                            stopOnFocus: true
                        }).showToast();
                    } else {
                        loadingToast.hideToast();
                        Toastify({
                            text: "Erro ao adicionar ao carrinho",
                            duration: 3000,
                            gravity: "bottom",
                            position: "right",
                            backgroundColor: "#f44336",
                            stopOnFocus: true
                        }).showToast();
                    }
                })
                .catch(err => {
                    loadingToast.hideToast();
                    Toastify({
                        text: "estoque insuficiente",
                        duration: 3000,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: "#f44336",
                        stopOnFocus: true
                    }).showToast();
                    console.error("Erro na requisição:", err);
                });
        });
    });
});