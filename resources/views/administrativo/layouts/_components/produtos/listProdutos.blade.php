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
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Valor</th>
                            <th>Material</th>
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
                                $estoque = $estoques->firstWhere('id', $produto->id);
                                $categoria = $produto->categoria->listarCategoria($produto->categoria_id);
                                $marca =
                                    $produto->marca_id != null
                                        ? $produto->marca->listarMarca($produto->marca_id)
                                        : null;
                            @endphp

                            <tr>
                                <td> <img src="{{ $produto->imagem_url }}" class="blur-up lazyload" alt=""
                                        style="width: 80px; height: auto;"></td>
                                <td>{{ $produto->nome }}</td>
                                <td>R$: {{ $produto->valor }}</td>
                                <td>{{ $produto->material }}</td>
                                <td>{{ $estoque['quantidade'] ?? 0 }}</td>
                                <td>{{ $categoria['nome'] ?? 'Sem Categoria' }}</td>
                                <td>{{ $marca['nome'] ?? 'Sem Marca' }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>

                                    <button class="btn btn-sm btn-warning mt-1" data-toggle="modal"
                                        data-target="#produtoModal"
                                        onclick='preencherModal(
        @json($produto->id), 
        @json($produto->nome), 
        @json($produto->valor), 
        @json($produto->material),  
        @json($estoque['quantidade'] ?? 0),
        @json($produto->categoria_id),
        @json($produto->marca_id),
        @json($produto->descricao),
        @json($estoque->quantidadeP ?? 0),
        @json($estoque->quantidadeM ?? 0),
        @json($estoque->quantidadeG ?? 0),
        @json($estoque->quantidadeGG ?? 0),
        @json($estoque->quantidade775 ?? 0),
        @json($estoque->quantidade8 ?? 0),
        @json($estoque->quantidade825 ?? 0),
        @json($estoque->quantidade85 ?? 0)
    )'>
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
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Valor</th>
                            <th>Material</th>
                            <th>Estoque</th>
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
                                <label for="categoriaProduto">Categoria</label>
                                <select class="form-control" id="categoriaProduto" name="categoria_id">
                                    @foreach ($categorias as $categorias)
                                        <option value="{{ $categorias->id }}">{{ $categorias->nome }}</option>
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marcaProduto">Marca</label>
                                <select class="form-control" id="marcaProduto" name="marca_id">
                                    <option value="">Sem Marca</option>
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="estoqueProd">
                            <div class="form-group">
                                <label for="quantidade">Quantidade</label>
                                <input type="number" class="form-control" id="quantidadeProduto"
                                    name="quantidadeProduto" placeholder="Digite a quantidade"
                                     style="width: 100px;">
                            </div>
                        </div>




                    </div>

                    <div class="form-group">
                        <label for="descricaoProduto">Descrição</label>
                        <textarea class="form-control" id="descricaoProduto" name="descricao" rows="3"></textarea>
                    </div>
                    <div class="card" id="estoqueCardSkt">
                        <div class="card-header">
                            <h3 class="card-title">Estoque</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tamanho 7.75</label>
                                        <input type="number" id="quanti775" class="form-control" name="quanti775">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidade8">Tamanho 8</label>
                                        <input type="number" class="form-control" id="quanti8"
                                            name="quantidade8">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidade825">Tamanho 8.25</label>
                                        <input type="number" class="form-control" id="quanti825"
                                            name="quantidade825">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidade85">Tamanho 8.5</label>
                                        <input type="number" class="form-control" id="quanti85"
                                            name="quantidade85">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="card" id="estoqueCard">
                        <div class="card-header">
                            <h3 class="card-title">Estoque</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeP">Tamanho P</label>
                                        <input type="number" id="quantidadePC" class="form-control"
                                            name="quantidadeP">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeM">Tamanho M</label>
                                        <input type="number" class="form-control" id="quantidadeMC"
                                            name="quantidadeM">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeG">Tamanho G</label>
                                        <input type="number" class="form-control" id="quantidadeGC"
                                            name="quantidadeG">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeGG">Tamanho GG</label>
                                        <input type="number" class="form-control" id="quantidadeGGC"
                                            name="quantidadeGG">
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
    function preencherModal(id, nome, valor, material, quantidadeTotal, categoriaId, marcaId, descricao,
        estoqueP, estoqueM, estoqueG, estoqueGG, quantidade775, quantidade8, quantidade825, quantidade85) {

        console.log('Valores recebidos na função:', {
            id: id,
            nome: nome,
            valor: valor,
            material: material,

            quantidadeTotal: quantidadeTotal,
            categoriaId: categoriaId,
            marcaId: marcaId,
            descricao: descricao,
            estoqueP: estoqueP,
            estoqueM: estoqueM,
            estoqueG: estoqueG,
            estoqueGG: estoqueGG,
            categoriaId: categoriaId,
            quantidade775: quantidade775,
            quantidade8: quantidade8,
            quantidade825: quantidade825,
            quantidade85: quantidade85

        });
        document.getElementById('quantidadeProduto').value = quantidadeTotal ?? 0;
        document.getElementById('quanti775').value = quantidade775 ?? 0;
        document.getElementById('quanti8').value = quantidade8 ?? 0;
        document.getElementById('quanti825').value = quantidade825 ?? 0;
        document.getElementById('quanti85').value = quantidade85 ?? 0;
        document.getElementById('produtoId').value = id;
        document.getElementById('nomeProduto').value = nome;
        document.getElementById('valorProduto').value = valor;
        document.getElementById('materialProduto').value = material;
        document.getElementById('descricaoProduto').value = descricao;
        document.getElementById('categoriaProduto').value = categoriaId;
        document.getElementById('marcaProduto').value = marcaId || '';
        document.getElementById('quantidadePC').value = estoqueP ?? 0;
        document.getElementById('quantidadeMC').value = estoqueM ?? 0;
        document.getElementById('quantidadeGC').value = estoqueG ?? 0;
        document.getElementById('quantidadeGGC').value = estoqueGG ?? 0;

        if (categoriaId == 2) {
            document.getElementById('estoqueCard').style.display = 'none';
            document.getElementById('estoqueCardSkt').style.display = 'block';
            document.getElementById('estoqueProd').style.display = 'none';
        } else if (categoriaId == 1) {
            document.getElementById('estoqueCard').style.display = 'block';
            document.getElementById('estoqueCardSkt').style.display = 'none';
            document.getElementById('estoqueProd').style.display = 'none';
        } else {
            document.getElementById('estoqueProd').style.display = 'block';
            document.getElementById('estoqueCard').style.display = 'none';
            document.getElementById('estoqueCardSkt').style.display = 'none';
        }
        // espera 100ms para garantir que o modal foi carregado
    }
</script>
