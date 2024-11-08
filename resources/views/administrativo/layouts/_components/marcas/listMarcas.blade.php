<div clas="container-fluid">
    <!-- /.card -->
    <div>

        <div class="">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listar Acessórios</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>nome</th>
                                    <th>Descrição</th>
                                    <th>Funções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($marcas as $marca)
                                    <tr>
                                        <td>{{ $marca->nome }}</td>
                                        <td>{{ $marca->descricao }}</td>
                                        <td>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <form action="{{ route('administrativo.marca.enviarForm') }}" method="post">
                                                       @csrf
                                                       <input name="id" value="{{ $marca->id }}" hidden>
                                                       
                                                       <button type="submit"
                                                            class="btn btn-sm btn-warning" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                            <i class="fas fa-comments"></i>Alterar
                                                        </button>
                                                    </form>
                                                </div>

                                                <div class="col-md-6">
                                                    <form
                                                        action="{{ route('administrativo.marca.excluir') }}"
                                                        method="post">
                                                        @csrf
                                                        <input name="id" value="{{ $marca->id }}"
                                                           hidden>
                                                        <button type="submit" class="btn btn-sm btn-danger mt-1" type="d">
                                                            <i class="fas fa-comments"></i>Excluir
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>nome</th>
                                    <th>Descrição</th>
                                    <th>Funções</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- iCheck -->

</div>
<!-- /.card -->
