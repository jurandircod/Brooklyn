>
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
                    <h3>Contate-nos</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.htm">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Contate-nos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section> <!-- Contact Section Start -->
    <section class="contact-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="materialContainer">
                        <div class="material-details">
                            <div class="title title1 title-effect mb-1 title-left">
                                <h2>Contate-nos</h2>
                                <p class="ms-0 w-100">Seu email sera utilizado para envio de novas publicações e
                                    informações de contato.</p>
                            </div>
                        </div>
                        <form action="{{route('site.contato.salvar')}}" method="post">
                            <div class="row g-4 mt-md-1 mt-2">
                            @csrf
                                <div class="col-md-6">
                                    <label for="first" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="nome" value="{{old('nome')}}" id="first"
                                        placeholder="Insira seu nome" >
                                        @if($errors->has('nome')) 
                                        {{$errors->first('nome')}}
                                            <span class="invalid-feedback" role="alert">
                                                <p class="font-light">{{ $errors->first('nome') }}</p>
                                            </span>
                                        @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="last" class="form-label">Sobrenome</label>
                                    <input type="text" class="form-control" value="{{old('sobrenome')}}" name="sobrenome" id="last"
                                        placeholder="Insira seu sobrenome" >
                                        @if($errors->has('sobrenome')) 
                                        {{$errors->first('sobrenome')}}
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('sobrenome') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" value="{{old('email')}}" name="email" id="email"
                                        placeholder="Insira seu email" required="">
                                        @if($errors->has('email'))  
                                        {{$errors->first('email')}}
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="email2" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" value="{{old('telefone')}}" name="telefone" id="email2"
                                        placeholder="Insira seu telefone" required="">
                                        @if($errors->has('telefone')) 
                                        {{$errors->first('telefone')}}
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('telefone') }}</strong>
                                            </span> 
                                        @endif
                                </div>

                                <div class="col-12">
                                    <label for="comment" class="form-label">Mensagem</label>
                                    <textarea class="form-control" id="comment" value="{{old('mensagem')}}" name="mensagem" rows="5" required=""></textarea>

                                        @if($errors->has('mensagem')) 
                                        {{$errors->first('mensagem')}}
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <a>{{ $errors->first('mensagem') }}</a>
                                            </span> 
                                        @endif
                                </div>

                                <div class="col-auto">
                                    <button class="btn btn-solid-default" type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="contact-details">
                        <div>
                            <h2>Let's get in touch</h2>
                            <h5 class="font-light">Estamos abertos para qualquer sugestão ou apenas para conversar</h5>
                            <div class="contact-box">
                                <div class="contact-icon">
                                    <i data-feather="map-pin"></i>
                                </div>
                                <div class="contact-title">
                                    <h4>Address :</h4>
                                    <p>NIT, Faridabad, Haryana, India</p>
                                </div>
                            </div>

                            <div class="contact-box">
                                <div class="contact-icon">
                                    <i data-feather="phone"></i>
                                </div>
                                <div class="contact-title">
                                    <h4>Phone Number :</h4>
                                    <p>+1 0000000000</p>
                                </div>
                            </div>

                            <div class="contact-box">
                                <div class="contact-icon">
                                    <i data-feather="mail"></i>
                                </div>
                                <div class="contact-title">
                                    <h4>Email Address :</h4>
                                    <p>contact@surfsidemedia.in</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->



    <div class="bg-overlay"></div>

