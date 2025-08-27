document.addEventListener("DOMContentLoaded", function () {
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
        columns: [
            {
                data: "imagem_url",
                render: function (data) {
                    if (!data) return "";
                    return `<img src="${data}" width="50" height="50" 
                        style="object-fit:cover;border-radius:4px;" />`;
                }
            },
            { data: "nome" },
            { data: "valor" },
            { data: "material" },
            { data: "quantidade_total" },
            { data: "categoria" },
            { data: "marca" },
            { data: "descricao" },
            {
                data: "id",
                render: function (data, type, row) {
                    const payload = encodeURIComponent(JSON.stringify(row));
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
        ]
    });

    // ✅ Delegação de eventos (não precisa redraw)
    document.querySelector("#produtosTable tbody").addEventListener("click", function (e) {
        const editBtn = e.target.closest(".btn-edit");
        const deleteBtn = e.target.closest(".btn-delete");

        if (editBtn) {
            const encoded = editBtn.getAttribute("data-row");
            if (!encoded) return;
            let row;
            try {
                row = JSON.parse(decodeURIComponent(encoded));
            } catch (err) {
                console.error("Erro ao parsear data-row", err);
                return;
            }

            // chama preencherModal
            if (typeof preencherModal === "function") {
                preencherModal(
                    row.id ?? null,
                    row.nome ?? "",
                    row.valor ?? "",
                    row.material ?? "",
                    row.categoria_id ?? null,
                    row.marca_id ?? null,
                    row.descricao ?? "",
                    row.imagem_url ?? "",
                    row.imagem_url2 ?? "",
                    row.imagem_url3 ?? "",
                    row.imagem_url4 ?? "",
                    row.imagem_url5 ?? "",
                    row.estoque ?? ""
                );
            }

            // abre modal
            const modalEl = document.getElementById("produtoModal");
            if (modalEl && typeof bootstrap !== "undefined" && bootstrap.Modal) {
                new bootstrap.Modal(modalEl).show();
            }
        }

        if (deleteBtn) {
            const id = deleteBtn.getAttribute("data-id");
            if (!id) return;
            if (!confirm("Deseja realmente excluir este produto?")) return;

            const tokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrf = tokenMeta ? tokenMeta.getAttribute("content") : null;

            fetch(`/administrativo/produto/excluir/${id}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    ...(csrf ? { "X-CSRF-TOKEN": csrf } : {})
                }
            }).then(r => {
                if (r.ok) {
                    window.produtosTable.ajax.reload(null, false);
                } else {
                    alert("Falha ao excluir produto.");
                }
            });
        }
    });
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

function carregarImagensExistentes(...imgs) {
    const defaultImage = window.defaultImage;
    // Limpa previews só se não tiver imagem
    for (let i = 1; i <= 5; i++) {
        const preview = document.getElementById(`preview-${i}`);
        const del = document.getElementById(`deleteImage-${i}`);
        preview.src = defaultImage;
        del.checked = false;
    }

    imgs.forEach((url, idx) => {
        if (url) {
            const numero = getPureFileName(url) || (idx + 1);
            const preview = document.getElementById(`preview-${numero}`);
            if (preview) {
                preview.loading = "lazy";
                preview.decoding = "async";
                preview.src = url;
            }
        }
    });
}


function previewImagem(input, numeroImagem) {
    if (input.files?.[0]) {
        const preview = document.getElementById(`preview-${numeroImagem}`);
        const reader = new FileReader();
        reader.onload = e => requestAnimationFrame(() => {
            preview.src = e.target.result;
        });
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
