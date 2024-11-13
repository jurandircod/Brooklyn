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
                        <form action="{{ route('administrativo.produto.salvar') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-4 mb-3">
                                    <label for="nome" class="form-label">Nome <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="nome"
                                        value="{{ old('nome') }}" id="nome"
                                        placeholder="Digite o nome do produto">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="valor" class="form-label">Valor do Produto<span
                                            style="color: red">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" id="valor" oninput="formatCurrency(this)"
                                            value="{{ old('valor') }}" class="form-control" name="valor"
                                            placeholder="R$ 0,00">
                                    </div>
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label for="categoria" class="form-label">Categoria do Produto <span
                                            style="color: red">*</span></label>
                                    <select class="form-control mb-3" name="categoria_id" id="categoria">
                                        <option selected>Escolha uma Categoria</option>
                                        @foreach ($produtosCategorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>

                            <div class="row mb-3">
                                <div class="col-md-5 mb-3">
                                    <label for="categoria" class="form-label">Marca <span
                                            style="color: red">*</span></label>
                                    <select class="form-control mb-3" name="marca_id" id="categoria">
                                        <option selected>Escolha uma Marca</option>
                                        @foreach ($produtosMarca as $marca)
                                            <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="" class="form-label">Material</label>
                                    <input type="text" name="material" id="material" class="form-control"
                                        placeholder="Digite o tipo de material">
                                </div>

                                <div class="col-md-5 mb-3" id="skateSection" style="display: none;">
                                    <label for="Largura" class="form-label">largura do Shape
                                    </label>
                                    <input type="text" id="largura"
                                        oninput="formatCurrencyLarguraComprimento(this)" class="form-control"
                                        name="largura" value="{{ old('largura') }}"
                                        placeholder="A largura e comprimento do skate (ex: 8,5 x 32)">

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="inputGroupFile02" class="form-label">Imagens do Produto <span
                                            style="color: red">*</span></label>
                                    <input type="file" class="form-control" id="inputGroupFile02" name="url_imagem[]"
                                        multiple onchange="verificarLimiteFotos()">
                                </div>

                                <div class="col-md-6 mb-3" id="quantidadeSection" style="display: block">
                                    <label for="" class="form-label">Quantidade em Estoque <span
                                            style="color: red">*</span></label>
                                    <input type="number" name="quantidade" id="quantidade" class="form-control"
                                        placeholder="Digite a quantidade" min="0">
                                </div>


                            </div>

                            <!-- Seção de tamanhos, inicialmente oculta -->
                            <div class="row mb-3" id="sizeSection" style="display: none;">
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="quantidade1" class="form-label">Quantidade em Estoque Tamanho
                                                P</label>
                                            <input type="number" class="form-control" id="quantidade1"
                                                name="quantidadeP" value="{{ old('quantidadeP') }}"
                                                placeholder="Digite a quantidade" min="0" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="quantidade2" class="form-label">Quantidade em Estoque Tamanho
                                                M</label>
                                            <input type="number" class="form-control" id="quantidade2"
                                                name="quantidadeM" value="{{ old('quantidadeM') }}"
                                                placeholder="Digite a quantidade" min="0" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="quantidade3" class="form-label">Quantidade em Estoque Tamanho
                                                G</label>
                                            <input type="number" class="form-control" id="quantidade3"
                                                name="quantidadeG" value="{{ old('quantidadeG') }}"
                                                placeholder="Digite a quantidade" min="0" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="quantidade4" class="form-label">Quantidade em Estoque Tamanho
                                                GG</label>
                                            <input type="number" class="form-control" id="quantidade4"
                                                name="quantidadeGG" value="{{ old('quantidadeGG') }}"
                                                placeholder="Digite a quantidade" min="0" disabled>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botões para selecionar tamanhos -->
                                <div class="col-md-12 mb-3">
                                    <div class="mb-2"><b>Selecione os tamanhos</b></div>
                                    <label class="size-option" data-size="P">P</label>
                                    <label class="size-option" data-size="M">M</label>
                                    <label class="size-option" data-size="G">G</label>
                                    <label class="size-option" data-size="GG">GG</label>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h5>Pré-visualização das Imagens</h5>
                                    <div id="imagePreviewContainer" class="d-flex flex-wrap gap-3"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="descricao"
                                    placeholder="Digite a descrição do produto" rows="4"></textarea>
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
    document.getElementById('categoria').addEventListener('change', function() {
        const sizeSection = document.getElementById('sizeSection');
        const skateSection = document.getElementById('skateSection');
        const quantidadeSection = document.getElementById('quantidadeSection');
        sizeSection.style.display = (this.options[this.selectedIndex].text === 'Camisas') ? 'block' : 'none';
        skateSection.style.display = (this.options[this.selectedIndex].text === 'Skates') ? 'block' : 'none';
        quantidadeSection.style.display = (this.options[this.selectedIndex].text === 'Camisas') ? 'none' :
            'block';
    });

    document.querySelectorAll('.size-option').forEach(option => {
        option.addEventListener('click', function() {
            this.classList.toggle('selected'); // Marca o tamanho como selecionado

            const size = this.dataset.size;
            const inputQuantidade = document.getElementById(
                `quantidade${size === 'P' ? '1' : size === 'M' ? '2' : size === 'G' ? '3' : '4'}`);

            inputQuantidade.disabled = !inputQuantidade
                .disabled; // Habilita ou desabilita o campo correspondente
        });
    });

    function formatCurrency(input) {
        let value = input.value.replace(/\D/g, '');
        value = (value / 100).toFixed(2);
        value = value.replace(".", ",");
        input.value = "R$ " + value;
    }

    function formatCurrencyLarguraComprimento(input) {
        // Limpa espaços e caracteres não numéricos, exceto vírgula, ponto e "x"
        let value = input.value.replace(/[^\d,.\sxX]/g, '').replace(/\s/g, '');

        // Divide a entrada em largura e comprimento usando "x" ou "X" como delimitador
        let dimensions = value.split(/[xX]/);

        if (dimensions.length === 2) {
            // Tenta converter os valores de largura e comprimento para números com uma casa decimal
            let largura = parseFloat(dimensions[0].replace(',', '.')).toFixed(1);
            let comprimento = parseFloat(dimensions[1].replace(',', '.')).toFixed(1);

            // Checa se os valores são válidos
            if (!isNaN(largura) && !isNaN(comprimento)) {
                // Atualiza o valor do campo com o formato desejado
                input.value = `${largura.replace('.', ',')} cm x ${comprimento.replace('.', ',')} cm`;
            } else {
                console.log("Valores inválidos para largura ou comprimento.");
            }
        } else {
            console.log("Formato inválido. Por favor, insira no formato largura x comprimento.");
        }
    }
</script>

<script>
    function verificarLimiteFotos() {
        const inputFile = document.getElementById("inputGroupFile02");
        const previewContainer = document.getElementById("imagePreviewContainer");

        // Limpa a pré-visualização de imagens anteriores
        previewContainer.innerHTML = "";

        if (inputFile.files.length > 5) {
            alert("Você pode enviar no máximo 5 fotos.");
            inputFile.value = ""; // Limpa a seleção de arquivos
            return;
        }

        // Exibe a pré-visualização das imagens selecionadas
        Array.from(inputFile.files).forEach(file => {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgElement = document.createElement("img");
                    imgElement.src = e.target.result;
                    imgElement.style.width = "100px";
                    imgElement.style.height = "100px";
                    imgElement.style.objectFit = "cover";
                    imgElement.style.borderRadius = "5px";
                    imgElement.style.border = "1px solid #ddd";
                    imgElement.style.margin = "5px";
                    previewContainer.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
