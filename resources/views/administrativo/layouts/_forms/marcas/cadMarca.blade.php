<!-- Content Wrapper. Contains page content -->


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cadastrar Marcas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Início</a></li>
                    <li class="breadcrumb-item active">Cadastrar Marcas</li>
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
                        <h3 class="card-title">Cadastrar marcas / Função Administrativa</h3>
                    </div>

                    <!-- form start -->
                    <form
                        action="{{ isset($marcaAlter) ? route('administrativo.marca.alterar') : route('administrativo.marca.salvar') }}"
                        method="POST" onsubmit="return enviarCores()">
                        @csrf

                        @isset($marcaAlter)
                            <input type="hidden" name="marca_id" value="{{ $marcaAlter->id }}">
                        @endisset

                        <div class="card-body row">
                            <div class="form-group col-md-5">
                                <label for="marca">Nome</label>
                                <input type="text" value="{{ isset($marcaAlter) ? $marcaAlter->nome : old('nome') }}"
                                    class="form-control" name="nome" placeholder="Digite o nome da marca">
                                @if ($errors->has('nome'))
                                    <span style="color: red">{{ $errors->first('nome') }}</span>
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        {{ $errors->first('nome') }}
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-5">
                                <label for="marca">Descricao</label>
                                <input type="text"
                                    value="{{ isset($marcaAlter) ? $marcaAlter->descricao : old('descricao') }}"
                                    class="form-control" name="descricao" placeholder="Digite o descricao da marca">
                                @if ($errors->has('descricao'))
                                    <span style="color: red">{{ $errors->first('descricao') }}</span>
                                    <span class="invalid-feedback" style="color: red" role="alert">
                                        {{ $errors->first('descricao') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class=" card-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

