@foreach ($avaliacoes as $avaliacao)
    <div class="customer-section">
        <div class="customer-profile">
            <img src="{{ asset('images/inner-page/review-image/1.jpg') }}" class="img-fluid blur-up lazyload"
                alt="">
        </div>

        <div class="customer-details">
            <h5>{{ $avaliacao->user->name }}</h5>
            <ul class="rating my-2 d-inline-block">
                @for ($i = 1; $i <= $avaliacao->estrela; $i++)
                    <li>
                        <i class="fas fa-star theme-color"></i>
                    </li>
                @endfor
            </ul>
            <p class="font-light">{{ $avaliacao->comentario }}</p>
            <p class="date-custo font-light">{{ $avaliacao->created_at->format('d/m/Y') }}</p>
        </div>
    </div>
@endforeach

@if ($avaliacoes->hasPages())
    <div class="mt-3" id="pagination">
        {{ $avaliacoes->links() }}
    </div>
@endif


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Configuração das estrelas (seu código existente)
        const stars = document.querySelectorAll('#rating li');
        const avaliacaoInput = document.getElementById('avaliacaoInput');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = parseInt(this.getAttribute('data-value'));
                avaliacaoInput.value = value;

                // Atualiza a aparência visual das estrelas
                stars.forEach((s, index) => {
                    if (index < value) {
                        s.querySelector('i').classList.add(
                            'theme-color'
                        ); // Adicione uma classe 'active' para estrelas selecionadas
                    } else {
                        s.querySelector('i').classList.remove(
                            'theme-color'
                        ); // Remove a classe 'active' das estrelas não selecionadas
                    }
                });
            });
        });
        // Paginação via AJAX
        document.addEventListener("click", function(e) {
            if (e.target.closest("#pagination a")) {
                e.preventDefault();
                const url = e.target.closest("#pagination a").getAttribute("href");

                fetch(url, {
                        method: "GET"
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.querySelector("#avaliacoes-container").innerHTML = data;
                    })
                    .catch(error => {
                        console.error(error);
                        alert("Erro ao carregar mais avaliações.");
                    });
            }
        });

        // Formulário de avaliação via AJAX
        document.querySelectorAll("form").forEach(function(form) {
            form.addEventListener("submit", function(e) {
                e.preventDefault();

                const url = form.getAttribute("action");
                const formData = new FormData(form);

                fetch(url, {
                        method: "POST",
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) throw response;
                        return response.json();
                    })
                    .then(() => {
                        // Recarrega as avaliações após enviar
                        fetch(window.location.pathname, {
                                method: "GET"
                            })
                            .then(response => response.text())
                            .then(data => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(data, "text/html");
                                document.querySelector("#avaliacoes-container")
                                    .innerHTML =
                                    doc.querySelector("#avaliacoes-container")
                                    .innerHTML;

                                // Limpa o formulário
                                document.querySelector("textarea#comments").value = "";
                                document.querySelectorAll("#rating li i").forEach(i => i
                                    .classList.remove("active"));
                                document.querySelector("#avaliacaoInput").value = "0";
                            });
                        swal.fire({
                            title: 'Sucesso!',
                            text: 'Avaliação enviada com sucesso!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                        stars.forEach((s, index) => {
                            s.querySelector('i').classList.remove(
                                'theme-color'
                            ); // Remove a classe 'active' das estrelas não selecionadas
                        });
                    })
                    .catch(async (error) => {
                        try {
                            const err = await error.json();
                            alert(err.message || "Erro ao enviar avaliação.");
                        } catch {
                            alert("Erro ao enviar avaliação.");
                        }
                    });
            });
        });
    });
</script>
