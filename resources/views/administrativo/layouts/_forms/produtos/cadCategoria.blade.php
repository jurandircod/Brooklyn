<!-- Content Wrapper. Contains page content -->


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cadastrar Acessórios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Início</a></li>
                    <li class="breadcrumb-item active">Cadastrar Características do Acessório</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Cadastrar Características do Acessório / Função Administrativa</h3>
                    </div>

                    <!-- form start -->
                    <form
                        action="{{ isset($categoriaAlter) ? route('administrativo.produto.categoria.alterar') : route('administrativo.produto.categoria.salvar') }}"
                        method="POST" onsubmit="return enviarCores()">
                        @csrf
                        <input type="text" name="rotaCategoria" value="0" hidden>
                        @isset($categoriaAlter)
                            <input type="hidden" name="categoria_id" value="{{ $categoriaAlter->id }}">
                        @endisset

                        <div class="card-body row">
                            <div class="form-group col-md-5">
                                <label for="categoria">Categoria</label>
                                <input type="text"
                                    value="{{ isset($categoriaAlter) ? $categoriaAlter->nome : old('nome') }}"
                                    class="form-control" name="nome" placeholder="Digite o Categoria do usuário">
                                @if ($errors->has('nome'))
                                    <span style="color: red">{{ $errors->first('nome') }}</span>
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        {{ $errors->first('nome') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">Descrição</label>
                                <input type="text"
                                    value="{{ isset($categoriaAlter) ? $categoriaAlter->descricao : old('descricao') }}"
                                    class="form-control" name="descricao" placeholder="Digite a descrição do usuário">
                                @if ($errors->has('descricao'))
                                    <span style="color: red">{{ $errors->first('descricao') }}</span>
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        {{ $errors->first('descricao') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>