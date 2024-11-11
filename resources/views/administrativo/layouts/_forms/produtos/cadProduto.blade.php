<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-secondary">Cadastrar Produtos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Início</a></li>
                    <li class="breadcrumb-item active">Cadastrar Produtos</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<style>
    .size-option {
        width: 50px;
        height: 50px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 5px;
        font-size: 16px;
        font-weight: bold;
        border: 2px solid #333;
        cursor: pointer;
        border-radius: 4px;
        user-select: none;
        transition: background-color 0.3s;
    }

    .size-option.selected {
        background-color: #4CAF50;
        color: white;
        border-color: #4CAF50;
    }

    .size-checkbox {
        display: none;
    }
</style>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Cadastrar Produtos / Função Administrativa</h3>
                    </div>

                    <div class="card-body">
                        <h4 class="mb-4 text-secondary">Cadastrar Produtos</h4>
                        <form action="{{ route('administrativo.produto.salvar') }}" method="POST" enctype="multipart/form-data" onsubmit="return enviarCores()">
                            @csrf
                            @isset($permissao)
                                <input type="hidden" name="idEditar" value="{{ $id = $permissao->role_id }}">
                            @endisset

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label for="tamanhoAcesso" class="form-label">Nome <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="nome" value="{{ old('nome') }}" id="tamanhoAcesso" placeholder="Digite o nome do produto">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="valor" class="form-label">Valor do Produto<span style="color: red">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" id="valor" oninput="formatCurrency(this)" value="{{ old('valor') }}" class="form-control" name="valor" placeholder="R$ 0,00">
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="quantidade" class="form-label">Quantidade em Estoque <span style="color: red">*</span></label>
                                    <input type="number" class="form-control" name="quantidade" value="{{ old('quantidade') }}" placeholder="Digite a quantidade" min="0">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3 mb-3">
                                    <label for="categoria" class="form-label">Categoria do Produto <span style="color: red">*</span></label>
                                    <select class="form-control mb-3" name="categoria_id" value='{{ old('categoria_id') }}' id="categoria">
                                        <option selected>Escolha uma Categoria</option>
                                        @foreach ($produtosCategorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="marca" class="form-label">Marca</label>
                                    <select class="form-control mb-3" name="marca_id" id="marca">
                                        <option selected>Escolha uma marca</option>
                                        @foreach ($produtosMarca as $marca)
                                            <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="material" class="form-label">Material</label>
                                    <input type="text" class="form-control" name="material" id="material" placeholder="Digite o tipo de material">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <div class="mb-2"><b>Selecione os tamanhos</b></div>
                                    <label class="size-option" data-size="P">P</label>
                                    <label class="size-option" data-size="M">M</label>
                                    <label class="size-option" data-size="G">G</label>
                                    <label class="size-option" data-size="GG">GG</label>

                                    <!-- Checkboxes invisíveis para armazenar valores selecionados -->
                                    <input type="checkbox" class="size-checkbox" name="tamanho[]" value="P">
                                    <input type="checkbox" class="size-checkbox" name="tamanho[]" value="M">
                                    <input type="checkbox" class="size-checkbox" name="tamanho[]" value="G">
                                    <input type="checkbox" class="size-checkbox" name="tamanho[]" value="GG">
                                </div>
                            </div>

                            <!-- Campo escondido para armazenar as cores -->
                            <input type="hidden" id="coresInput" name="cores">

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="inputGroupFile02" class="form-label">Imagens do Produto <span style="color: red">*</span></label>
                                    <input type="file" class="form-control" id="inputGroupFile02" name="url_imagem[]" multiple onchange="verificarLimiteFotos()">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="colorInput" class="form-label">Cor do Produto</label>
                                    <input type="color" class="form-control form-control-color" id="colorInput" name="cor" value="{{ $permissao->cor ?? '#000000' }}">
                                </div>
                                <div class="col-md-3 d-flex align-items-end mb-3">
                                    <button type="button" class="btn btn-success me-2" onclick="salvarCor()">Salvar Cor</button>
                                    <button type="button" class="btn btn-danger ml-4" onclick="removerUltimaCor()">Remover Cor</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div id="coresContainer" class="d-flex flex-wrap gap-2 mb-3"></div>
                                </div>
                                <div class="col-md-12">
                                    <p id="mensagemErro" class="text-danger" style="display: none;">Máximo de 5 cores alcançado!</p>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.querySelectorAll('.size-option').forEach(option => {
        option.addEventListener('click', function() {
            this.classList.toggle('selected'); // Adiciona ou remove a seleção visual

            const checkbox = document.querySelector(`.size-checkbox[value="${this.dataset.size}"]`);
            checkbox.checked = !checkbox.checked;
        });
    });

    function formatCurrency(input) {
        let value = input.value.replace(/\D/g, '');
        value = (value / 100).toFixed(2);
        value = value.replace(".", ",");
        input.value = "R$ " + value;
    }

    let coresSalvas = [];
    function salvarCor() {
        const colorInput = document.getElementById("colorInput").value;
        const mensagemErro = document.getElementById("mensagemErro");

        if (coresSalvas.length >= 5) {
            mensagemErro.style.display = "block";
            return;
        }

        mensagemErro.style.display = "none";
        coresSalvas.push(colorInput);
        document.getElementById("coresInput").value = JSON.stringify(coresSalvas);
        atualizarExibicaoCores();
    }

    function removerUltimaCor() {
        const mensagemErro = document.getElementById("mensagemErro");

        if (coresSalvas.length > 0) {
            coresSalvas.pop();
            document.getElementById("coresInput").value = JSON.stringify(coresSalvas);

            if (coresSalvas.length < 5) {
                mensagemErro.style.display = "none";
            }
        }

        atualizarExibicaoCores();
    }

    function atualizarExibicaoCores() {
        const coresContainer = document.getElementById("coresContainer");
        coresContainer.innerHTML = "";

        coresSalvas.forEach(cor => {
            const divCor = document.createElement("div");
            divCor.style.backgroundColor = cor;
            divCor.style.width = "40px";
            divCor.style.height = "40px";
            divCor.style.borderRadius = "5px";
            divCor.style.border = "1px solid #ddd";
            coresContainer.appendChild(divCor);
        });
    }

    function enviarCores() {
        if (coresSalvas.length === 0) {
            alert("Nenhuma cor foi salva!");
            return false;
        }
        return true;
    }


    
    function verificarLimiteFotos() {
        const inputFile = document.getElementById("inputGroupFile02");
        if (inputFile.files.length > 5) {
            alert("Você pode enviar no máximo 5 fotos.");
            inputFile.value = ""; // Limpa a seleção de arquivos
        }
    }

</script>
