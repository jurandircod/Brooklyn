<div clas="container-fluid">
    <!-- /.card -->
    <div>

        <div class="">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listar permissoes</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Descricao</th>
                                    <th>Alterar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $categoria)
                                    <tr>
                                        <td>{{ $categoria->nome }}</td>
                                        <td>{{ $categoria->descricao }}</td>

                                        <td>
                                            <div class="row">
                                                <form action="{{ route('administrativo.produto.categoria.enviaFormAlterar') }}"
                                                    method="post">
                                                    @csrf

                                                    <div class="col">
                                                        <input type="" name="categoria_id" value="{{$categoria->id}}" hidden>
                                                        <button type="submit" class="btn btn-sm btn-warning mt-1"
                                                            type="d">
                                                            Alterar
                                                        </button>
                                                    </div>
                                                </form>



                                                <form action="{{ route('administrativo.produto.categoria.excluir') }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="col">
                                                        <input type="" name="categoria_id" value="{{$categoria->id}}" hidden>
                                                        <button type="submit" class="btn btn-sm btn-danger mt-1"
                                                            type="d">
                                                            Excluir
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Descricão</th>
                                    <th>Alterar</th>
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
</section>
