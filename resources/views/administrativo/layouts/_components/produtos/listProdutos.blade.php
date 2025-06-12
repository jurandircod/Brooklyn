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

<div class="container-fluid">
    <!-- /.card -->
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
                            <th>Nome</th>
                            <th>Valor</th>
                            <th>Material</th>
                            <th>Estoque</th>
                            <th>Largura</th>
                            <th>Quantidade Total</th>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Descrição</th>
                            <th>Alterar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            @php
                                $estoque = $listarEstoque->listarEstoque($produto->id);
                                $categoria = $listarCategoria->listarCategoria($produto->categoria_id);
                                $marca =
                                    $produto->marca_id != null ? $listarMarca->listarMarca($produto->marca_id) : null;
                            @endphp

                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>R$: {{ $produto->valor }}</td>
                                <td>{{ $produto->material }}</td>
                                <td>
                                    @if ($estoque != null)
                                        P: <b>{{ $estoque->quantidadeP }}</b> | M:
                                        <b>{{ $estoque->quantidadeM }}</b> | G:
                                        <b>{{ $estoque->quantidadeG }}</b> | GG:
                                        <b>{{ $estoque->quantidadeGG }}</b>
                                    @else
                                        P: <b>0</b> | M: <b>0</b> | G: <b>0</b> | GG: <b>0</b>
                                    @endif
                                </td>
                                <td>{{ $produto->largura }}</td>
                                <td>{{ $estoque['quantidade'] ?? 0 }}</td>
                                <td>{{ $categoria['nome'] ?? 'Sem Categoria' }}</td>
                                <td>{{ $marca['nome'] ?? 'Sem Marca' }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>

                                    <button class="btn btn-sm btn-warning mt-1"
                                        onclick="preencherModal(
        '{{ $produto->id }}', 
        '{{ $produto->nome }}', 
        '{{ $produto->valor }}', 
        '{{ $produto->material }}', 
        '{{ $produto->largura }}', 
        '{{ $estoque['quantidade'] ?? 0 }}',
        '{{ $produto->categoria_id }}',
        '{{ $produto->marca_id }}',
        '{{ $produto->descricao }}',
        '{{ $estoque->quantidadeP ?? 0 }}',
        '{{ $estoque->quantidadeM ?? 0 }}',
        '{{ $estoque->quantidadeG ?? 0 }}',
        '{{ $estoque->quantidadeGG ?? 0 }}'
    )"
                                        data-toggle="modal" data-target="#produtoModal">
                                        Alterar
                                    </button>

                                </td>

                                <td>
                                    <form action="{{ route('administrativo.produto.excluir') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="produto_id" value="{{ $produto->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger mt-1">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>Valor</th>
                            <th>Material</th>
                            <th>Estoque</th>
                            <th>Largura</th>
                            <th>Quantidade Total</th>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Descrição</th>
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

<!-- Modal para Editar Produto -->
<div class="modal fade" id="produtoModal" tabindex="-1" role="dialog" aria-labelledby="produtoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produtoModalLabel">Editar Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditarProduto" action="{{ route('administrativo.produto.atualizar') }}" method="POST">
                @csrf
               
                <input type="hidden" name="id" id="produtoId">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomeProduto">Nome do Produto</label>
                                <input type="text" class="form-control" id="nomeProduto" name="nome" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="valorProduto">Valor (R$)</label>
                                <input type="number" step="0.01" class="form-control" id="valorProduto"
                                    name="valor" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="materialProduto">Material</label>
                                <input type="text" class="form-control" id="materialProduto" name="material">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="larguraProduto">Largura</label>
                                <input type="text" class="form-control" id="larguraProduto" name="largura">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoriaProduto">Categoria</label>
                                <select class="form-control" id="categoriaProduto" name="categoria_id" required>
                                    @foreach ($produtosCategorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marcaProduto">Marca</label>
                                <select class="form-control" id="marcaProduto" name="marca_id">
                                    <option value="">Sem Marca</option>
                                    @foreach ($produtosMarca as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descricaoProduto">Descrição</label>
                        <textarea class="form-control" id="descricaoProduto" name="descricao" rows="3"></textarea>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Estoque</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeP">Tamanho P</label>
                                        <input type="number" class="form-control" id="quantidadeP"
                                            name="quantidadeP" min="0">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeM">Tamanho M</label>
                                        <input type="number" class="form-control" id="quantidadeM"
                                            name="quantidadeM" min="0">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeG">Tamanho G</label>
                                        <input type="number" class="form-control" id="quantidadeG"
                                            name="quantidadeG" min="0">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeGG">Tamanho GG</label>
                                        <input type="number" class="form-control" id="quantidadeGG"
                                            name="quantidadeGG" min="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript para Preencher Modal -->
<script>
    function preencherModal(id, nome, valor, material, largura, quantidadeTotal, categoriaId, marcaId, descricao,
        estoqueP, estoqueM, estoqueG, estoqueGG) {
        document.getElementById('produtoId').value = id;
        document.getElementById('nomeProduto').value = nome;
        document.getElementById('valorProduto').value = valor;
        document.getElementById('materialProduto').value = material;
        document.getElementById('larguraProduto').value = largura;
        document.getElementById('descricaoProduto').value = descricao;
        document.getElementById('categoriaProduto').value = categoriaId;
        document.getElementById('marcaProduto').value = marcaId || '';
        document.getElementById('quantidadeP').value = estoqueP || 0;
        document.getElementById('quantidadeM').value = estoqueM || 0;
        document.getElementById('quantidadeG').value = estoqueG || 0;
        document.getElementById('quantidadeGG').value = estoqueGG || 0;
    }
</script>
