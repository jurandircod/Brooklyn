@foreach ($avaliacoes as $avaliacao)
    <div class="customer-section">
        <div class="customer-profile">
            <img src="{{ asset('images/inner-page/review-image/1.jpg') }}"
                class="img-fluid blur-up lazyload" alt="">
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

@if($avaliacoes->hasPages())
    <div class="mt-3" id="pagination">
        {{ $avaliacoes->links() }}
    </div>
@endif


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Configuração das estrelas (seu código existente)
    $('#rating li').on('click', function() {
        // Seu código para selecionar estrelas
    });

    // Paginação via AJAX
    $(document).on('click', '#pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                $('#avaliacoes-container').html(data);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Erro ao carregar mais avaliações.');
            }
        });
    });

    // Formulário de avaliação via AJAX
    $('form').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Recarrega as avaliações após enviar
                $.ajax({
                    url: window.location.pathname,
                    type: 'GET',
                    success: function(data) {
                        $('#avaliacoes-container').html($(data).find('#avaliacoes-container').html());
                        // Limpa o formulário
                        $('textarea#comments').val('');
                        $('#rating li i').removeClass('active');
                        $('#avaliacaoInput').val('0');
                    }
                });
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message || 'Erro ao enviar avaliação.');
            }
        });
    });
});
</script>
