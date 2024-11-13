<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-secondary">Listar Produtos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Início</a></li>
                    <li class="breadcrumb-item active">Listar Produtos</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div clas="container-fluid">
    <!-- /.card -->
    <div>

        <div class="">
            <div class="col-12">
                <!-- /.card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listar Produtos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>nome</th>
                                    <th>valor</th>
                                    <th>material</th>
                                    <th>Estoque</th>
                                    <th>quantidade Total</th>
                                    <th>categoria</th>
                                    <th>marca</th>
                                    <th>descricao</th>
                                    <th>Função</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $produto)
                                    @php
                                        $estoque = $listarEstoque->listarEstoque($produto->id);
                                        $categoria = $listarCategoria->listarCategoria($produto->categoria_id);
                                        
                                        if ($produto->marca_id != null) {
                                            $marca = $listarMarca->listarMarca($produto->marca_id);
                                        }else{
                                            $marca = null;
                                        }
                                    @endphp

                                    <tr>
                                        <td>{{ $produto->nome }}</td>
                                        <td>R$: {{ $produto->valor }}</td>
                                        <td>{{ $produto->material }}</td>
                                        @if ($estoque != null)
                                            <td>P: <b>{{ $estoque->quantidadeP }}</b>| M:
                                                <b>{{ $estoque->quantidadeM }}</b>| G:
                                                <b>{{ $estoque->quantidadeG }}</b>| GG:
                                                <b>{{ $estoque->quantidadeGG }}</b></td>
                                            <td>Total: {{ $estoque['quantidade'] }}</td>
                                        @else
                                            <td>P: <b>0</b>| M: <b>0</b>| G: <b>0</b>| GG: <b>0</b></td>
                                            <td>Total: 0</td>
                                        @endif
                                        @if ($categoria != null)
                                            <td>{{ $categoria['nome'] }}</td>
                                        @else
                                            <td>Sem Categoria</td>
                                        @endif
                                        @if ($marca != null)
                                            <td>{{ $marca['nome'] }}</td>
                                        @else
                                            <td>Sem Marca</td>
                                        @endif
                                        <td>{{ $produto->descricao }}</td>

                                        <td>
                                            <div class="row">
                                                <form action="{{ route('administrativo.produto.enviaFormAlterar') }}"
                                                    method="post">
                                                    @csrf

                                                    <div class="col">
                                                        <input type="" name="produto_id"
                                                            value="{{ $produto->id }}" hidden>
                                                        <button type="submit" class="btn btn-sm btn-warning mt-1"
                                                            type="d">
                                                            Alterar
                                                        </button>
                                                    </div>
                                                </form>



                                                <form action="{{ route('administrativo.produto.excluir') }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="col">
                                                        <input type="" name="produto_id"
                                                            value="{{ $produto->id }}" hidden>
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
                                    <th>nome</th>
                                    <th>valor</th>
                                    <th>material</th>
                                    <th>tamanho</th>
                                    <th>quantidade</th>
                                    <th>categoria</th>
                                    <th>marca</th>
                                    <th>descricao</th>
                                    <th>Função</th>
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
