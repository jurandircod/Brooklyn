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
                                        <a href="{{ route('site.perfil.exibirEndereco') }}" target="_blank"
                                            class="btn btn-solid-default btn-sm fw-bold ms-auto"
                                            data-bs-target="#addAddress"><i class="fas fa-plus"></i>
                                            Adicionar novo endereço</a>
                                    </div>
                                @else
                                    @foreach ($enderecos as $endereco)
                                        <div class="col-xl-4 col-md-6">
                                            <div class="save-details">
                                                <div class="save-name">
                                                    <h5>{{ $endereco->cidade }}</h5>

                                                </div>

                                                <div class="save-address">
                                                    <p class="font-light"><b>Endereço: </b>{{ $endereco->bairro }}</p>
                                                    <p class="font-light"><b>Número da casa:
                                                        </b>{{ $endereco->numero }} </p>
                                                    <p class="font-light"><b>Estado: </b>{{ $endereco->estado }} </p>
                                                    <p class="font-light"><b>CEP: </b>{{ $endereco->cep }} </p>
                                                </div>

                                                <div class="mobile">
                                                    <p class="font-light mobile"><b>Telefone:
                                                        </b>{{ $endereco->telefone }} </p>
                                                </div>

                                                <div class="button">
                                                    <div class="icheck-primary">
                                                        <input type="checkbox" id="checkbox1" name="endereco"
                                                            value="{{ $endereco->id }}" checked>
                                                        <label for="checkbox1">Selecione este endereço</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endisset
                        </div>


                    </div>

                    <div id="shippingAddress" class="row g-4 mt-5">
                        <h3 class="mb-3 theme-color">Shipping address</h3>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="s_name" name="s_name"
                                placeholder="Enter Full Name">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="s_phone" name="s_phone"
                                placeholder="Enter Phone Number">
                        </div>
                        <div class="col-md-6">
                            <label for="locality" class="form-label">Locality</label>
                            <input type="text" class="form-control" id="s_locality" name="s_locality"
                                placeholder="Locality">
                        </div>
                        <div class="col-md-6">
                            <label for="landmark" class="form-label">Landmark</label>
                            <input type="text" class="form-control" id="s_landmark" name="s_landmark"
                                placeholder="Landmark">
                        </div>

                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="s_address" name="s_address"></textarea>

                        </div>

                        <div class="col-md-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="s_city" name="s_city" placeholder="City">

                        </div>

                        <div class="col-md-3">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select custome-form-select" id="s_country" name="s_country">
                                <option>India</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select custome-form-select" id="s_state" name="s_state">
                                <option selected="" disabled="" value="">Choose...</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="s_zip" name="s_zip"
                                placeholder="123456">
                        </div>
                    </div>

                    <div class="form-check ps-0 mt-3 custome-form-check">
                        <input class="checkbox_animated check-it" type="checkbox" name="saveAddress"
                            id="saveAddress">
                        <label class="form-check-label checkout-label" for="saveAddress">Save this information for
                            next time</label>
                    </div>

                    <hr class="my-lg-5 my-4">

                    <h3 class="mb-3">Payment</h3>

                    <div class="d-block my-3">
                        <div class="form-check custome-radio-box">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" checked=""
                                id="cod">
                            <label class="form-check-label" for="cod">COD</label>
                        </div>
                        <div class="form-check custome-radio-box">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="debit">
                            <label class="form-check-label" for="debit">Debit card</label>
                        </div>

                        <div class="form-check custome-radio-box">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="paypal">
                            <label class="form-check-label" for="paypal">PayPal</label>
                        </div>
                    </div>
                    <div class="row g-4" style="display: none;">
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
                    <button class="btn btn-solid-default mt-4" type="submit">Place Order</button>
                </form>
            </div>

            <div class="col-lg-4">
                <div class="your-cart-box">
                    <h3 class="mb-3 d-flex text-capitalize">Your cart<span
                            class="badge bg-theme new-badge rounded-pill ms-auto bg-dark">0</span>
                    </h3>
                    <ul class="list-group mb-3">



                        <li class="list-group-item d-flex justify-content-between lh-condensed active">
                            <div class="text-dark">
                                <h6 class="my-0">Tax</h6>
                                <small></small>
                            </div>
                            <span>$0.00</span>
                        </li>
                        <li class="list-group-item d-flex lh-condensed justify-content-between">
                            <span class="fw-bold">{{ $itens->sum('preco_total') }}</span>
                            <strong></strong>
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
