<section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Checkout</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Cart Section Start -->
<section class="section-b-space">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <form class="needs-validation" method="POST" action="place-order">
                    <input type="hidden" name="_token" value="CVH6XgdFhoUV6OBdiTIlT2bviIidpb0qD6U1Vf68">
                    <div class="save-details-box">
                        <h3 class="mb-3 theme-color text-center">Escolha um endereço para receber seu pedido</h3>
                        <div class="row g-3">
                            @isset($enderecos)
                                @if ($enderecos->isEmpty())
                                    <div class="col-12">
                                        <h6 class="font-light">Você ainda não salvou nenhum endereço. Clique no botão abaixo
                                            para adicionar um novo endereço.</h6>
                                    </div>
                                @else
                                    @foreach ($enderecos as $endereco)
                                        <div class="col-xl-4 col-md-6">
                                            <div class="save-details">
                                                <div class="save-name">
                                                    <h5>{{ $endereco->cidade }}</h5>

                                                </div>

                                                <div class="save-address">
                                                    <p class=""><b>Bairro: </b>{{ $endereco->bairro }}</p>
                                                    <p class=""><b>Número da casa:</b>{{ $endereco->numero }} </p>
                                                    <p class=""><b>Cidade: </b>{{ $endereco->cidade }} </p>
                                                    <p class=""><b>Estado: </b>{{ $endereco->estado }} </p>
                                                    <p class=""><b>CEP: </b>{{ $endereco->cep }} </p>
                                                </div>

                                                <div class="mobile">
                                                    <p class="font-light mobile"><b>Telefone:
                                                        </b>{{ $endereco->telefone }} </p>
                                                </div>

                                                <div class="button">
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" id="checkbox{{$endereco->id}}" name="endereco_id[]"
                                                            value="{{ $endereco->id }}">
                                                        <label for="checkbox1">Selecione este endereço</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endisset

                            <a href="{{ route('site.perfil.exibirEndereco') }}" target="_blank"
                                class="btn btn-solid-default btn-sm fw-bold ms-auto" data-bs-target="#addAddress"><i
                                    class="fas fa-plus"></i>
                                Adicionar novo endereço</a>
                        </div>


                    </div>

                    <hr class="my-lg-5 my-4">

                    <h3 class="mb-3">Tipo de pagamento</h3>

                    <div class="d-block my-3">
                        <div class="form-check custome-radio-box">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" checked=""
                                id="cod">
                            <label class="form-check-label" for="cod">Pix</label>
                        </div>
                        <div class="form-check custome-radio-box">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="debit">
                            <label class="form-check-label" for="debit">Cartão de Crédito</label>
                        </div>

                        <div class="form-check custome-radio-box">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="paypal">
                            <label class="form-check-label" for="paypal">Cartão de Débito</label>
                        </div>
                    </div>
                    <div class="row g-4" style="display: block;">
                        <div class="col-md-6">
                            <label for="cc-name" class="form-label">Name on card</label>
                            <input type="text" class="form-control" id="cc-name">
                            <div id="emailHelp" class="form-text">Full name as displayed on card</div>
                        </div>
                        <div class="col-md-6">
                            <label for="cc-number" class="form-label">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number">
                            <div class="invalid-feedback">Credit card number is required</div>
                        </div>
                        <div class="col-md-3">
                            <label for="expiration" class="form-label">Expiration</label>
                            <input type="text" class="form-control" id="expiration">
                        </div>
                        <div class="col-md-3">
                            <label for="cc-cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv">
                        </div>
                    </div>
                    <button class="btn btn-solid-default mt-4" type="submit">Processar pagamento</button>
                </form>
            </div>

            <div class="col-lg-4">
                <div class="your-cart-box">
                    <h3 class="mb-3 d-flex text-capitalize">Seu carrinho<span
                            class="badge bg-theme new-badge rounded-pill ms-auto bg-dark">{{ $contador }}</span>
                    </h3>
                    <ul class="list-group mb-3">

                        <li class="list-group-item d-flex justify-content-between lh-condensed active">
                            <div class="text-dark">
                                <h6 class="my-0">Tax</h6>
                                <small></small>
                            </div>
                            <span>$0.00</span>
                        </li>
                        <span>
                            <li class="list-group-item d-flex lh-condensed justify-content-between">
                                @foreach ($itens as $item)
                            <li class="list-group-item d-flex lh-condensed justify-content-between">
                                <div class="text-dark">
                                    <h6 class="my-0">{{ $item->produto_nome }}</h6>
                                    <small class="text-muted">
                                        Quantidade: {{ $item->quantidade }} |
                                        Preço unitário: R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}
                                    </small>
                                </div>
                                <span class="text-dark">R$ {{ number_format($item->preco_total, 2, ',', '.') }}</span>
                            </li>
                            @endforeach
                        </span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between lh-condensed active">
                            <div class="text-dark">
                                <h6 class="my-0">Preço total</h6>
                                <small></small>
                            </div>
                            <span class="text-dark">R$ {{ number_format($preco_total, 2, ',', '.') }}</span>
                        </li>
                    </ul>

                    <form class="card border-0">
                        <div class="input-group custome-imput-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-solid-default rounded-0">Redeem</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(document).ready(function() {
        // Inicializa os checkboxes estilizados
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue',
            increaseArea: '20%' // aumenta a área clicável
        });

        // Evento para feedback visual
        $('input[type="checkbox"]').on('ifChanged', function(event) {
            if ($(this).is(':checked')) {
                $(this).closest('.icheck-primary').addClass('checked');
            } else {
                $(this).closest('.icheck-primary').removeClass('checked');
            }
        });
    });
</script>

<style>
    .icheck-primary {
        margin-bottom: 15px;
        padding: 8px 10px;
        border-radius: 4px;
        background-color: #f8f9fa;
        transition: all 0.3s;
    }

    .icheck-primary.checked {
        background-color: #e3f2fd;
        border-left: 3px solid #3c8dbc;
    }

    .icheck-primary label {
        margin-left: 10px;
        font-weight: normal;
        cursor: pointer;
        user-select: none;
    }
</style>
