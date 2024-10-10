<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cadastrar as permissões de um usuário</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">inicio</a></li>
                    <li class="breadcrumb-item active">General Form</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Cadastrar Permissões / Função administrativa</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('administrativo.salvarPermissao') }}" method="post">
                      @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de usuario</label>
                                <input type="text" name="tipo_acesso" value="{{old('tipo_acesso')}}" class="form-control" id="exampleInputEmail1"
                                    placeholder="Digite o tipo de usuário ex: administrador do sistema">
                                    @if($errors->has('tipo_acesso'))
                                        <span style="color: red">{{ $errors->first('tipo_acesso') }}</span>
                                        <span class="invalid-feedback" style="color: red" role="alert">
                                            {{ $errors->first('tipo_acesso') }}
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Descrição das funções</label>
                                <input type="text" class="form-control" value="{{old('descricao')}}" name="descricao" id="exampleInputPassword1"
                                    placeholder="Digite a descrição das funções a serem executadas pelo usuário">
                                    @if($errors->has('descricao'))
                                        <span style="color: red">{{ $errors->first('descricao') }}</span>
                                        <span class="invalid-feedback" style="color: red" role="alert">
                                            {{ $errors->first('descricao') }}
                                        </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="">Nível de permissão</label>
                                <input name="role" type="number" value="{{old('role')}}" min="0" max="10" 
                                    placeholder="Digite em um intervalo de 1 a 10 qual a quantidade de permissões o usuário terá"
                                    class="form-control" id="">
                                    @if($errors->has('role'))
                                        <span style="color: red">{{ $errors->first('role') }}</span>
                                        <span class="invalid-feedback" style="color: red" role="alert">
                                            {{ $errors->first('role') }}
                                        </span>
                                    @endif
                            </div>      
                        </div>

                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>

                    <!-- /.card -->

                </div>
                <!--/.col (left) -->
                <!-- right column -->

                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.content-wrapper -->
