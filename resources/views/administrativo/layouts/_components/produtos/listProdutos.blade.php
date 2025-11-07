<!-- Adicione no head -->

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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-white">Listar Produtos</h3>

                <!-- Filtros -->
                <div class="card-tools">
                    <div class="row">
                        <div class="col-md-3">
                            <select id="filtroCategoria" class="form-control form-control-sm">
                                <option value="">Todas as Categorias</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="filtroMarca" class="form-control form-control-sm">
                                <option value="">Todas as Marcas</option>
                                @foreach ($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="btnLimparFiltros" class="btn btn-sm btn-secondary">
                                <i class="fas fa-eraser"></i> Limpar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table id="produtosTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Valor</th>
                            <th>Material</th>
                            <th>Estoque</th>
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Descrição</th>
                            <th width="80px">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- Dados carregados via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal permanece o mesmo -->
<div class="modal fade" id="produtoModal" tabindex="-1" role="dialog" aria-labelledby="produtoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="background-color: #f8f9fa;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produtoModalLabel">Editar Produto</h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEditarProduto" action="{{ route('administrativo.produto.atualizar') }}" method="POST"
                enctype="multipart/form-data">
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
                                    name="quantidadeProduto" placeholder="Digite a quantidade" style="width: 100px;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descricaoProduto">Descrição</label>
                        <textarea class="form-control" id="descricaoProduto" name="descricao" rows="3"></textarea>
                    </div>

                    <!-- Seção de Imagens -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title text-white">Imagens do Produto</h3>
                        </div>
                        <div class="card-body">
                            <div class="row" id="imagensProduto">
                                <div class="col-md-2">
                                    <div class="imagem-container">
                                        <label class="imagem-label">Imagem 1</label>
                                        <img id="preview-1" src="" alt="Imagem 1" class="imagem-preview"
                                            onclick="document.getElementById('file-input-1').click()">
                                        <button type="button" class="btn-trocar-imagem"
                                            onclick="document.getElementById('file-input-1').click()">Alterar</button>
                                        <input type="file" id="file-input-1" name="imagem_1"
                                            class="input-file-hidden" accept="image/*"
                                            onchange="previewImagem(this, 1)">
                                    </div>

                                    <div>
                                        <input type="checkbox" id="deleteImage-1" name="deleteImage[1]">
                                        <label for="imagem1">Excluir</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="imagem-container">
                                        <label class="imagem-label">Imagem 2</label>
                                        <img id="preview-2" src="" alt="Imagem 2" class="imagem-preview"
                                            onclick="document.getElementById('file-input-2').click()">
                                        <button type="button" class="btn-trocar-imagem"
                                            onclick="document.getElementById('file-input-2').click()">Alterar</button>
                                        <input type="file" id="file-input-2" name="imagem_2"
                                            class="input-file-hidden" accept="image/*"
                                            onchange="previewImagem(this, 2)">
                                    </div>
                                    <div>
                                        <input type="checkbox" id="deleteImage-2" name="deleteImage[2]">
                                        <label for="imagem1">Excluir</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="imagem-container">
                                        <label class="imagem-label">Imagem 3</label>
                                        <img id="preview-3" src="" alt="Imagem 3" class="imagem-preview"
                                            onclick="document.getElementById('file-input-3').click()">
                                        <button type="button" class="btn-trocar-imagem"
                                            onclick="document.getElementById('file-input-3').click()">Alterar</button>
                                        <input type="file" id="file-input-3" name="imagem_3"
                                            class="input-file-hidden" accept="image/*"
                                            onchange="previewImagem(this, 3)">
                                    </div>

                                    <div>
                                        <input type="checkbox" id="deleteImage-3" name="deleteImage[3]">
                                        <label for="imagem1">Excluir</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="imagem-container">
                                        <label class="imagem-label">Imagem 4</label>
                                        <img id="preview-4" src="" alt="Imagem 4" class="imagem-preview"
                                            onclick="document.getElementById('file-input-4').click()">
                                        <button type="button" class="btn-trocar-imagem"
                                            onclick="document.getElementById('file-input-4').click()">Alterar</button>
                                        <input type="file" id="file-input-4" name="imagem_4"
                                            class="input-file-hidden" accept="image/*"
                                            onchange="previewImagem(this, 4)">
                                    </div>
                                    <div>
                                        <input type="checkbox" id="deleteImage-4" name="deleteImage[4]">
                                        <label for="imagem1">Excluir</label>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="imagem-container">
                                        <label class="imagem-label">Imagem 5</label>
                                        <img id="preview-5" src="" alt="Imagem 5" class="imagem-preview"
                                            onclick="document.getElementById('file-input-5').click()">
                                        <button type="button" class="btn-trocar-imagem"
                                            onclick="document.getElementById('file-input-5').click()">Alterar</button>
                                        <input type="file" id="file-input-5" name="imagem_5"
                                            class="input-file-hidden" accept="image/*"
                                            onchange="previewImagem(this, 5)">
                                    </div>
                                    <div>
                                        <input type="checkbox" id="deleteImage-5" name="deleteImage[5]">
                                        <label for="imagem1">Excluir</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="estoqueCardSkt">
                        <div class="card-header">
                            <h3 class="card-title text-white">Estoque</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tamanho 7.75</label>
                                        <input type="number" id="quanti775" class="form-control"
                                            name="775">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidade8">Tamanho 8</label>
                                        <input type="number" class="form-control" id="quanti8"
                                            name="8">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidade825">Tamanho 8.25</label>
                                        <input type="number" class="form-control" id="quanti825"
                                            name="825">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidade85">Tamanho 8.5</label>
                                        <input type="number" class="form-control" id="quanti85"
                                            name="85">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card" id="estoqueCardTenis">
                        <div class="card-header">
                            <h3 class="card-title text-white">Estoque</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tamanho 38</label>
                                        <input type="number" id="38" class="form-control" name="38">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidade8">Tamanho 39</label>
                                        <input type="number" class="form-control" id="39" name="39">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidade40">Tamanho 40</label>
                                        <input type="number" class="form-control" id="40" name="40">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidade41">Tamanho 41</label>
                                        <input type="number" class="form-control" id="41" name="41">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidade42">Tamanho 42</label>
                                        <input type="number" class="form-control" id="42" name="42">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card" id="estoqueCard">
                        <div class="card-header">
                            <h3 class="card-title text-white">Estoque</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeP">Tamanho P</label>
                                        <input type="number" id="quantidadePC" class="form-control"
                                            name="p">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeM">Tamanho M</label>
                                        <input type="number" class="form-control" id="quantidadeMC"
                                            name="m">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeG">Tamanho G</label>
                                        <input type="number" class="form-control" id="quantidadeGC"
                                            name="g">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantidadeGG">Tamanho GG</label>
                                        <input type="number" class="form-control" id="quantidadeGGC"
                                            name="gg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="{{ asset('js/administrativo/produto/listProdutos.js') }}"></script>

<!-- ... seu modal atual ... -->
<!-- CSS (padrão) -->


