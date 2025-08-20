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
<!-- ... seu modal atual ... -->
<!-- CSS (padrão) -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Cria a tabela e guarda referência global para uso em attachModalEvents
        window.produtosTable = new DataTable("#produtosTable", {
            processing: true,
            serverSide: true,
            ajax: function(data, callback, settings) {
                const params = new URLSearchParams();
                params.append("draw", data.draw);
                params.append("start", data.start);
                params.append("length", data.length);
                if (document.querySelector("#filtroCategoria")) {
                    params.append("filtroCategoria", document.querySelector("#filtroCategoria")
                        .value);
                }
                if (document.querySelector("#filtroMarca")) {
                    params.append("filtroMarca", document.querySelector("#filtroMarca").value);
                }

                fetch("/administrativo/produtos/api?" + params.toString())
                    .then(res => res.json())
                    .then(json => callback(json));
            },
            columns: [{
                    data: "imagem_url",
                    render: function(data) {
                        if (!data) return "";
                        const src = data.replace(/(https?:\/\/[^\/]+\/uploads\/produtos\/)+/,
                            "$1");
                        return `<img src="${src}" width="50" />`;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: "nome"
                },
                {
                    data: "valor"
                },
                {
                    data: "material"
                },
                {
                    data: "quantidade_total"
                }, // Estoque
                {
                    data: "categoria"
                },
                {
                    data: "marca"
                },
                {
                    data: "descricao"
                },
                {
                    data: "id",
                    render: function(data, type, row) {
                        // codifica o objeto row para um atributo data-row (seguro)
                        const payload = encodeURIComponent(JSON.stringify(row));
                        // botões: Alterar (warning) e Excluir (danger)
                        return `
                        <button type="button" class="btn btn-sm btn-warning mt-1 btn-edit" data-row="${payload}">
                            Alterar
                        </button>
                        <button type="button" class="btn btn-sm btn-danger mt-1 btn-delete" data-id="${data}">
                            Excluir
                        </button>
                    `;
                    },
                    orderable: false,
                    searchable: false
                }
            ],
            drawCallback: function() {
                attachModalEvents(); // reaplica listeners
            }
        });

        // Filtros
        document.querySelectorAll("#filtroCategoria, #filtroMarca").forEach(el => {
            el.addEventListener("change", () => {
                // tenta usar API do DataTable; fallback para reload da página
                if (window.produtosTable && typeof window.produtosTable.draw === "function") {
                    window.produtosTable.draw();
                } else {
                    location.reload();
                }
            });
        });

        document.querySelector("#btnLimparFiltros").addEventListener("click", () => {
            if (document.querySelector("#filtroCategoria")) document.querySelector("#filtroCategoria")
                .value = "";
            if (document.querySelector("#filtroMarca")) document.querySelector("#filtroMarca").value =
                "";
            if (window.produtosTable && typeof window.produtosTable.draw === "function") {
                window.produtosTable.draw();
            } else {
                location.reload();
            }
        });

        // refresh manual
        window.refreshTable = function() {
            if (window.produtosTable && window.produtosTable.ajax && typeof window.produtosTable.ajax
                .reload === "function") {
                window.produtosTable.ajax.reload(null, false);
            } else if (window.produtosTable && typeof window.produtosTable.draw === "function") {
                window.produtosTable.draw();
            } else {
                location.reload();
            }
            atualizarEstatisticas();
        };

        // Implementação de attachModalEvents
        function attachModalEvents() {
            // remover listeners antigos para evitar duplicação
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.replaceWith(btn.cloneNode(true));
            });
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.replaceWith(btn.cloneNode(true));
            });

            // re-seleciona após clone
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const encoded = this.getAttribute('data-row');
                    if (!encoded) return;
                    let row;
                    try {
                        row = JSON.parse(decodeURIComponent(encoded));
                    } catch (err) {
                        console.error('Erro ao parsear data-row', err);
                        return;
                    }

                    // tenta obter campos com nomes alternativos (para compatibilidade)
                    const id = row.id ?? row.produto_id ?? null;
                    const nome = row.nome ?? row.title ?? '';
                    const valor = row.valor ?? row.price ?? '';
                    const material = row.material ?? '';
                    const categoriaId = row.categoria_id ?? row.categoriaId ?? row.categoria ??
                        null;
                    const marcaId = row.marca_id ?? row.marcaId ?? row.marca ?? null;
                    const descricao = row.descricao ?? row.description ?? '';
                    const imagemUrl = row.imagem_url ?? row.imagemUrl ?? row.imagem ?? '';
                    const imagemUrl2 = row.imagem_url2 ?? row.imagemUrl2 ?? '';
                    const imagemUrl3 = row.imagem_url3 ?? row.imagemUrl3 ?? '';
                    const imagemUrl4 = row.imagem_url4 ?? row.imagemUrl4 ?? '';
                    const imagemUrl5 = row.imagem_url5 ?? row.imagemUrl5 ?? '';
                    // possíveis nomes para tamanhos
                    const tamanho = row.tamanho ?? row.tamanhos ?? row.tamanhoMap ?? row
                        .tamanho_map ?? [];

                    // chama a função que preenche o modal (preservando assinatura)
                    // preencherModal(id, nome, valor, material, categoriaId, marcaId, descricao, imagemUrl1, imagemUrl2, ...)
                    if (typeof preencherModal === "function") {
                        preencherModal(
                            id,
                            nome,
                            valor,
                            material,
                            categoriaId,
                            marcaId,
                            descricao,
                            imagemUrl,
                            imagemUrl2,
                            imagemUrl3,
                            imagemUrl4,
                            imagemUrl5,
                            tamanho
                        );
                    } else {
                        console.warn("preencherModal não encontrado.");
                    }

                    // Abrir modal usando API do Bootstrap 5 (sem jQuery). Se não existir, tenta fallback BS4/jQuery.
                    const modalEl = document.getElementById('produtoModal');
                    if (!modalEl) {
                        console.warn("Modal #produtoModal não encontrado no DOM.");
                        return;
                    }

                    if (typeof bootstrap !== "undefined" && bootstrap.Modal) {
                        try {
                            const modal = new bootstrap.Modal(modalEl);
                            modal.show();
                        } catch (err) {
                            console.error('Erro ao abrir modal via bootstrap.Modal', err);
                        }
                    } else if (window.$ && typeof window.$(modalEl).modal === "function") {
                        // fallback para Bootstrap 4 com jQuery disponível
                        window.$(modalEl).modal('show');
                    } else {
                        // fallback simples (apenas visibilidade) - talvez não tenha animações/ backdrop
                        modalEl.classList.add('show');
                        modalEl.style.display = 'block';
                        modalEl.removeAttribute('aria-hidden');
                    }
                });
            });

            // delete
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const id = this.getAttribute('data-id');
                    if (!id) return;

                    if (!confirm(
                            'Deseja realmente excluir este produto? Essa ação não pode ser desfeita.'
                            )) {
                        return;
                    }

                    // procura token CSRF em meta (Laravel padrão)
                    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                    const csrf = tokenMeta ? tokenMeta.getAttribute('content') : null;

                    fetch(`/administrativo/produtos/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            ...(csrf ? {
                                'X-CSRF-TOKEN': csrf
                            } : {})
                        }
                    }).then(response => {
                        if (response.ok) {
                            // sucesso -> recarrega tabela
                            if (window.produtosTable && window.produtosTable.ajax &&
                                typeof window.produtosTable.ajax.reload === "function"
                                ) {
                                window.produtosTable.ajax.reload(null, false);
                            } else if (window.produtosTable && typeof window
                                .produtosTable.draw === "function") {
                                window.produtosTable.draw();
                            } else {
                                location.reload();
                            }
                        } else {
                            response.json().then(j => {
                                alert(j.message ||
                                    'Falha ao excluir o produto.');
                            }).catch(() => {
                                alert('Falha ao excluir o produto.');
                            });
                        }
                    }).catch(err => {
                        console.error(err);
                        alert('Erro na requisição de exclusão.');
                    });
                });
            });
        }

        // chama a primeira vez (já será chamada nas drawCallbacks também)
        attachModalEvents();

        // Atualizar estatísticas sem jQuery
        function atualizarEstatisticas() {
            const params = new URLSearchParams({
                length: -1,
                draw: 1
            });
            fetch("{{ route('administrativo.produtos.api') }}?" + params.toString())
                .then(res => res.json())
                .then(response => {
                    const totalProdutos = response.recordsTotal ?? 0;
                    const produtosSemEstoque = Array.isArray(response.data) ? response.data.filter(item => (
                        item.quantidade_total == 0)).length : 0;

                    const elTotal = document.getElementById('totalProdutos');
                    const elSem = document.getElementById('produtosSemEstoque');
                    const elCom = document.getElementById('produtosComEstoque');

                    if (elTotal) elTotal.textContent = totalProdutos;
                    if (elSem) elSem.textContent = produtosSemEstoque;
                    if (elCom) elCom.textContent = (totalProdutos - produtosSemEstoque);
                })
                .catch(err => console.error('Erro atualizarEstatisticas:', err));
        }

        // atualizar periodicamente
        setInterval(atualizarEstatisticas, 300000);
    });


    // Suas funções existentes permanecem as mesmas
    function preencherModal(id, nome, valor, material, categoriaId, marcaId, descricao,
        imagemUrl1, imagemUrl2, imagemUrl3, imagemUrl4, imagemUrl5, tamanho) {

        document.getElementById('produtoId').value = id;
        document.getElementById('nomeProduto').value = nome;
        document.getElementById('valorProduto').value = valor;
        document.getElementById('materialProduto').value = material;
        document.getElementById('descricaoProduto').value = descricao;
        document.getElementById('categoriaProduto').value = categoriaId;
        document.getElementById('marcaProduto').value = marcaId || '';

        // Verificação se é um array vazio simples []
        function isEmptyArray(arr) {
            return Array.isArray(arr) && arr.length === 0;
        }

        // Verificação se é um array contendo um array vazio [[]]
        function isArrayWithEmptyArray(arr) {
            return Array.isArray(arr) && arr.length === 1 &&
                Array.isArray(arr[0]) && arr[0].length === 0;
        }

        // Verificação se é um array vazio ou contendo array vazio
        function isEmptyOrContainsEmpty(arr) {
            return isEmptyArray(arr) || isArrayWithEmptyArray(arr);
        }

        if (isEmptyOrContainsEmpty(tamanho)) {
            // Zerar todos os campos
            document.getElementById('quanti775').value = 0;
            document.getElementById('quanti8').value = 0;
            document.getElementById('quanti825').value = 0;
            document.getElementById('quanti85').value = 0;
            document.getElementById('quantidadePC').value = 0;
            document.getElementById('quantidadeMC').value = 0;
            document.getElementById('quantidadeGC').value = 0;
            document.getElementById('quantidadeGGC').value = 0;
        } else {
            // Processar estoques
            if (Array.isArray(tamanho)) {
                tamanho.forEach(item => {
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
            }
        }

        // Carregar imagens existentes
        carregarImagensExistentes(imagemUrl1, imagemUrl2, imagemUrl3, imagemUrl4, imagemUrl5);

        // Controlar exibição dos cards de estoque baseado na categoria
        if (categoriaId == 2) { // Tênis
            document.getElementById('estoqueCard').style.display = 'none';
            document.getElementById('estoqueCardSkt').style.display = 'block';
            document.getElementById('estoqueProd').style.display = 'none';
        } else if (categoriaId == 1) { // Camisetas
            document.getElementById('estoqueCard').style.display = 'block';
            document.getElementById('estoqueCardSkt').style.display = 'none';
            document.getElementById('estoqueProd').style.display = 'none';
        } else if (categoriaId == 3) { // Outros sem tamanho
            document.getElementById('estoqueCard').style.display = 'none';
            document.getElementById('estoqueCardSkt').style.display = 'none';
            document.getElementById('estoqueProd').style.display = 'block';
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

    function previewImagem(input, numeroImagem) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById(`preview-${numeroImagem}`).src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Função para atualizar estatísticas em tempo real
    function atualizarEstatisticas() {
        $.get("{{ route('administrativo.produtos.api') }}", {
            length: -1, // Todos os registros
            draw: 1
        }).done(function(response) {
            const totalProdutos = response.recordsTotal;
            const produtosSemEstoque = response.data.filter(item => item.quantidade_total == 0).length;

            // Atualizar badges/cards de estatísticas se existirem
            $('#totalProdutos').text(totalProdutos);
            $('#produtosSemEstoque').text(produtosSemEstoque);
            $('#produtosComEstoque').text(totalProdutos - produtosSemEstoque);
        });
    }

    // Atualizar estatísticas a cada 5 minutos
    setInterval(atualizarEstatisticas, 300000);

    // Função para refresh manual da tabela
    function refreshTable() {
        $('#tabelaProdutos').DataTable().ajax.reload(null, false);
        atualizarEstatisticas();
    }
</script>

<!-- CSS customizado -->
<style>
    .btn-group-sm>.btn,
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        border-radius: 0.25rem;
    }

    .img-thumbnail {
        border-radius: 0.375rem;
    }

    .badge {
        font-size: 0.75em;
    }

    .card-tools .row {
        margin-right: -5px;
        margin-left: -5px;
    }

    .card-tools .col-md-3 {
        padding-right: 5px;
        padding-left: 5px;
    }

    /* Loading overlay para DataTables */
    .dataTables_processing {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        width: auto !important;
        margin: 0 !important;
        padding: 1rem 2rem !important;
        background: rgba(255, 255, 255, 0.95) !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 0.375rem !important;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    /* Responsividade da tabela */
    @media (max-width: 768px) {
        .btn-group-sm>.btn {
            padding: 0.125rem 0.25rem;
            font-size: 0.675rem;
        }

        .card-tools .row {
            flex-direction: column;
        }

        .card-tools .col-md-3 {
            width: 100%;
            margin-bottom: 0.5rem;
        }
    }

    /* Melhorias visuais */
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #e3e6f0;
    }

    .table thead th {
        background-color: #f8f9fc;
        border-bottom: 2px solid #e3e6f0;
        font-weight: 600;
        color: #5a5c69;
    }

    .badge-success {
        background-color: #1cc88a;
    }

    .badge-warning {
        background-color: #f6c23e;
    }

    .badge-danger {
        background-color: #e74a3b;
    }
</style>
