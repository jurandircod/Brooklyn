document.addEventListener("DOMContentLoaded", function () {
    // Cria a tabela e guarda referência global para uso em attachModalEvents
    window.produtosTable = new DataTable("#produtosTable", {
        processing: true,
        serverSide: true,
        ajax: function (data, callback, settings) {
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

            const searchValue = $('#produtosTable').DataTable().search();
            if (searchValue) {
                params.append("search", searchValue);
            }

            console.log(params.toString());

            fetch("/administrativo/produtos/api?" + params.toString())
                .then(res => res.json())
                .then(json => callback(json));
        },
        columns: [{
            data: "imagem_url",
            render: function (data) {
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
            render: function (data, type, row) {
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
        drawCallback: function () {
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
    window.refreshTable = function () {
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
            btn.addEventListener('click', function (e) {
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
                const tamanho = row.estoque ?? "";
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
            btn.addEventListener('click', function (e) {
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
                        case '38':
                            document.getElementById('38').value = item.quantidade ?? 0;
                            break;
                        case '39':
                            document.getElementById('39').value = item.quantidade ?? 0;
                            break;
                        case '40':
                            document.getElementById('40').value = item.quantidade ?? 0;
                            break;
                        case '41':
                            document.getElementById('41').value = item.quantidade ?? 0;
                            break;
                        case '42':
                            document.getElementById('42').value = item.quantidade ?? 0;
                            break;
                        default:
                            document.getElementById('quantidadeProduto').value = item.quantidade ?? 0;
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
        document.getElementById('estoqueCardTenis').style.display = 'none';
    } else if (categoriaId == 1) { // Camisetas
        document.getElementById('estoqueCard').style.display = 'block';
        document.getElementById('estoqueCardSkt').style.display = 'none';
        document.getElementById('estoqueProd').style.display = 'none';
        document.getElementById('estoqueCardTenis').style.display = 'none';
    } else if (categoriaId == 3) { // Outros sem tamanho
        document.getElementById('estoqueCard').style.display = 'none';
        document.getElementById('estoqueCardSkt').style.display = 'none';
        document.getElementById('estoqueProd').style.display = 'none';
        document.getElementById('estoqueCardTenis').style.display = 'block';
    } else { // Outras categorias
        document.getElementById('estoqueProd').style.display = 'block';
        document.getElementById('estoqueCard').style.display = 'none';
        document.getElementById('estoqueCardSkt').style.display = 'none';
        document.getElementById('estoqueCardTenis').style.display = 'none';
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
    const defaultImage = window.defaultImage;

    console.log(defaultImage);
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

        reader.onload = function (e) {
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
    }).done(function (response) {
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
