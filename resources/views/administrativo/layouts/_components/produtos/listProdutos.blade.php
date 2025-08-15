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
                <h3 class="card-title text-white">Listar Produtos</h3>
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
                                $tamanhoMap = [];
                                $estoque = $produto->estoque->where('produto_id', $produto->id);
                                $tamanhoMap[] = $estoque;
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
        @json($produto->categoria_id),
        @json($produto->marca_id),
        @json($produto->descricao),
        @json($produto->imagem_url ?? ''),
        @json($produto->imagem_url2 ?? ''),
        @json($produto->imagem_url3 ?? ''),
        @json($produto->imagem_url4 ?? ''),
        @json($produto->imagem_url5 ?? ''),
        @json($tamanhoMap)
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
    <div class="modal-dialog modal-lg" role="document" style="background-color: #f8f9fa;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="produtoModalLabel">Editar Produto</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
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
                                            name="quantidade775">
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
                            <h3 class="card-title text-white">Estoque</h3>
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

<style>
    .imagem-container {
        position: relative;
        margin-bottom: 15px;
    }

    .imagem-preview {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border: 2px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        background-color: #f8f9fa;
    }

    .imagem-preview:hover {
        border-color: #007bff;
        opacity: 0.8;
    }

    .input-file-hidden {
        display: none;
    }

    .btn-trocar-imagem {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        border-radius: 3px;
        padding: 3px 6px;
        font-size: 11px;
        cursor: pointer;
    }

    .btn-trocar-imagem:hover {
        background: rgba(0, 0, 0, 0.9);
    }

    .imagem-label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
        font-size: 12px;
    }
</style>


<!-- JavaScript para Preencher Modal -->
<script>
    function preencherModal(id, nome, valor, material, categoriaId, marcaId, descricao,
        imagemUrl1, imagemUrl2, imagemUrl3, imagemUrl4, imagemUrl5, tamanho) {

        document.getElementById('produtoId').value = id;
        document.getElementById('nomeProduto').value = nome;
        document.getElementById('valorProduto').value = valor;
        document.getElementById('materialProduto').value = material;
        document.getElementById('descricaoProduto').value = descricao;
        document.getElementById('categoriaProduto').value = categoriaId;
        document.getElementById('marcaProduto').value = marcaId || '';

        console.log(tamanho);

        // Verifica se é um array vazio simples []
        function isEmptyArray(arr) {
            return Array.isArray(arr) && arr.length === 0;
        }

        // Verifica se é um array contendo um array vazio [[]]
        function isArrayWithEmptyArray(arr) {
            return Array.isArray(arr) && arr.length === 1 &&
                Array.isArray(arr[0]) && arr[0].length === 0;
        }

        // Verifica se é um array vazio ou contendo array vazio
        function isEmptyOrContainsEmpty(arr) {
            return isEmptyArray(arr) || isArrayWithEmptyArray(arr);
        }

        
        if (isEmptyOrContainsEmpty(tamanho)) {
            document.getElementById('quanti775').value = 0;
            document.getElementById('quanti8').value = 0;
            document.getElementById('quanti825').value = 0;
            document.getElementById('quanti85').value = 0;
            document.getElementById('quantidadePC').value = 0;
            document.getElementById('quantidadeMC').value = 0;
            document.getElementById('quantidadeGC').value = 0;
            document.getElementById('quantidadeGGC').value = 0;
        } else {
            tamanho.forEach((grupo, grupoIndex) => {
                grupo.forEach(item => {
                    if (item.produto_id == id) {
                        switch (item.tamanho) {
                            case 'p':
                                document.getElementById('quantidadePC').value = item.quantidade ?? 0;
                                break;
                            case 'm':
                                document.getElementById('quantidadeMC').value = item.quantidade ?? 0;
                                break;
                            case 'g':
                                document.getElementById('quantidadeGC').value = item.quantidade ?? 0;
                                break;
                            case 'gg':
                                document.getElementById('quantidadeGGC').value = item.quantidade ?? 0;
                                break;
                            case '775':
                                document.getElementById('quanti775').value = item.quantidade ?? 0;
                                break;
                            case '8':
                                document.getElementById('quanti8').value = item.quantidade ?? 0;
                                break;
                            case '825':
                                document.getElementById('quanti825').value = item.quantidade ?? 0;
                                break;
                            case '85':
                                document.getElementById('quanti85').value = item.quantidade ?? 0;
                                break;
                        }
                    }
                });
            })
        };
        // Carregar imagens existentes

        carregarImagensExistentes(imagemUrl1, imagemUrl2, imagemUrl3, imagemUrl4, imagemUrl5);

        if (categoriaId == 2) { // Tênis
            document.getElementById('estoqueCard').style.display = 'none';
            document.getElementById('estoqueCardSkt').style.display = 'block';
        } else if (categoriaId == 1) { // Camisetas
            document.getElementById('estoqueCard').style.display = 'block';
            document.getElementById('estoqueCardSkt').style.display = 'none';
        } else if (categoriaId == 3) { // Tênis
            document.getElementById('estoqueCard').style.display = 'none';
            document.getElementById('estoqueCardSkt').style.display = 'none';
            document.getElementById('estoqueProd').style.display = 'none';
        } else { // Outras categorias
            document.getElementById('estoqueProd').style.display = 'block';
            document.getElementById('estoqueCard').style.display = 'none';
            document.getElementById('estoqueCardSkt').style.display = 'none';
        }
    }

    function getPureFileName(filePath) {
        if (!filePath || typeof filePath !== 'string') return null;

        const fileName = filePath.split('/').pop();
        const match = fileName.match(/(\d+)\./);
        return match ? parseInt(match[1]) : null;
    }



    function carregarImagensExistentes(img1, img2, img3, img4, img5) {
        const imagens = [img1, img2, img3, img4, img5];
        const defaultImage = "{{ asset('uploads/produtos/padrao/1.gif') }}";

        // Limpar todas as prévias primeiro
        for (let i = 1; i <= 5; i++) {
            document.getElementById(`preview-${i}`).src = defaultImage;
            document.getElementById(`deleteImage-${i}`).checked = false;
        }

        // Carregar imagens existentes
        imagens.forEach((url, index) => {
            if (url && url !== '') {
                const numero = getPureFileName(url);
                if (numero && numero >= 1 && numero <= 5) {
                    document.getElementById(`preview-${numero}`).src = url;
                    document.getElementById(`deleteImage-${numero}`).checked = false;
                }
            }
        });
    }


    //
    function previewImagem(input, numeroImagem) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById(`preview-${numeroImagem}`).src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
