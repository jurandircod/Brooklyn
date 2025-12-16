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

                        <div class="row mb-3">
                            <div class="input-group col-md-3 mb-3">
                                <select class="form-control" name="" id="preSelect">
                                    <option value="">Pré-Preencher</option>
                                    <option value="camisas">Camisas</option>
                                    <option value="skates">Skates</option>
                                    <option value="tenis">Tênis</option>
                                    <option value="calcas">Calças</option>
                                </select>
                            </div>
                        </div>
                        <form id="formProduto" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Nome do produto -->
                            <div class="row mb-3">
                                <div class="col-md-3 mb-3">
                                    <label for="nome" class="form-label">Nome <span
                                            style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="nome"
                                        value="{{ old('nome') }}" id="nome"
                                        placeholder="Digite o nome do produto">
                                    @error('nome')
                                        <span class="invalid-feedback d-block" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label for="valor" class="form-label">Valor da compra<span
                                            style="color: red">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" id="valor_compra" oninput="formatCurrency(this)"
                                            value="{{ old('valor_compra') }}" id="valor_compra" class="form-control" name="valor_compra"
                                            placeholder="R$ 0,00">
                                    </div>
                                    @error('valor_compra')
                                        <span class="invalid-feedback d-block" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="valor" class="form-label">Valor de venda<span
                                            style="color: red">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">R$</span>
                                        <input type="text" id="valor" oninput="formatCurrency(this)"
                                            value="{{ old('valor') }}" class="form-control" name="valor"
                                            placeholder="R$ 0,00">
                                    </div>
                                    @error('valor')
                                        <span class="invalid-feedback d-block" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-3 mb-3">
                                    <label for="categoria" class="form-label">Categoria do Produto <span
                                            style="color: red">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="categoria_id" id="categoria">
                                            <option value="" {{ old('categoria_id') === null ? 'selected' : '' }}>
                                                Escolha uma Categoria</option>
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}"
                                                    {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                                    {{ $categoria->nome }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalNovaCategoria">+</button>
                                    </div>
                                    @error('categoria_id')
                                        <span class="invalid-feedback d-block"
                                            style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Marca, Material, Largura -->
                            <div class="row mb-3">
                                <div class="col-md-5 mb-3">
                                    <label for="marca" class="form-label">Marca <span
                                            style="color: red">*</span></label>
                                    <div class="input-group">
                                        <select class="form-control" name="marca_id" id="marca">
                                            <option value="" {{ old('marca_id') === null ? 'selected' : '' }}>
                                                Escolha uma Marca</option>
                                            @foreach ($marcas as $marca)
                                                <option value="{{ $marca->id }}"
                                                    {{ old('marca_id') == $marca->id ? 'selected' : '' }}>
                                                    {{ $marca->nome }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalNovaMarca">+</button>
                                    </div>
                                    @error('marca_id')
                                        <span class="invalid-feedback d-block"
                                            style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label for="material" class="form-label">Material</label>
                                    <input type="text" name="material" id="material" class="form-control"
                                        placeholder="Digite o tipo de material" value="{{ old('material') }}">
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label for="inputGroupFile02" class="form-label">Imagens do Produto <span
                                            style="color: red">*</span></label>
                                    <input type="file" class="form-control" id="inputGroupFile02"
                                        name="url_imagem[]" multiple accept="image/png,image/jpeg,image/jpg"
                                        onchange="verificarLimiteFotos()">
                                    @error('url_imagem')
                                        <span class="invalid-feedback d-block"
                                            style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 mb-3" id="quantidadeSection" style="display: block">
                                    <label for="quantidade" class="form-label">Quantidade em Estoque <span
                                            style="color: red">*</span></label>
                                    <input type="number" name="quantidade" id="quantidade" class="form-control"
                                        placeholder="Digite a quantidade" value="{{ old('quantidade') }}"
                                        min="0">
                                    @error('quantidade')
                                        <span class="invalid-feedback d-block"
                                            style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <!-- Tamanhos camisas-->
                            <div class="row mb-3" id="camisaSection" style="display: none;">
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        @foreach (['p', 'm', 'g', 'gg'] as $size)
                                            <div class="col-md-3">
                                                <label for="quantidade{{ $size }}"
                                                    class="form-label">Quantidade em Estoque Tamanho
                                                    {{ $size }}</label>
                                                <input type="number" class="form-control"
                                                    id="quantidade{{ $size }}" name="{{ $size }}"
                                                    value="{{ old($size) }}" placeholder="Digite a quantidade"
                                                    min="0">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Tamanhos calcas-->
                            <!-- Tamanhos skates-->
                            <div class="row mb-3" id="skateSection" style="display: none;">
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        @foreach (['775', '8', '825', '85'] as $size)
                                            <div class="col-md-3">
                                                <label for="quantidade{{ $size }}"
                                                    class="form-label">Quantidade em Estoque Tamanho
                                                    {{ $size }}</label>
                                                <input type="number" class="form-control"
                                                    id="quantidade{{ $size }}" name="{{ $size }}"
                                                    value="{{ old($size) }}" placeholder="Digite a quantidade"
                                                    min="0">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="mb-2"><b>Selecione os tamanhos</b></div>
                                    @foreach (['775', '8', '825', '85'] as $size)
                                        <label class="size-option"
                                            data-size="{{ $size }}">{{ $size }}</label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row mb-3" id="tenisSection" style="display: none;">
                                <div class="col-md-12 mb-3">
                                    <div class="row">
                                        @foreach (['38', '39', '40', '41', '42'] as $size)
                                            <div class="col-md-3">
                                                <label for="quantidade{{ $size }}"
                                                    class="form-label">Quantidade em Estoque Tamanho
                                                    {{ $size }}</label>
                                                <input type="number" class="form-control"
                                                    id="quantidade{{ $size }}" name="{{ $size }}"
                                                    value="{{ old($size) }}" placeholder="Digite a quantidade"
                                                    min="0">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="mb-2"><b>Selecione os tamanhos</b></div>
                                    @foreach (['38', '39', '40', '41', '42'] as $size)
                                        <label class="size-option"
                                            data-size="{{ $size }}">{{ $size }}</label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Pré-visualização das Imagens -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h5>Pré-visualização das Imagens</h5>
                                    <div id="imagePreviewContainer" class="d-flex flex-wrap gap-3"></div>
                                </div>
                            </div>

                            <!-- Descrição -->
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Descrição</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="descricao" rows="4"
                                    placeholder="Digite a descrição do produto">{{ old('descricao') }}</textarea>
                            </div>

                            <!-- Botão -->
                            <div class="text-center mt-4">
                                <button type="button" onclick="alterarAction('rotaProduto')"
                                    class="btn btn-primary">Enviar</button>
                            </div>
                            <!-- Modal nova categoria -->
                            <div class="modal fade" id="modalNovaCategoria" tabindex="-999"
                                aria-labelledby="modalNovaCategoriaLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <input type="text" name="rotaCategoria" value="1" hidden>
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalNovaCategoriaLabel">Nova Categoria</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Fechar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="novaCategoria" class="form-label">Nome da
                                                    Categoria</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Digite o nome da categoria" name="nomeCategoria"
                                                    id="novaCategoria" required>
                                            </div>
                                            <div>
                                                <label for="descricao" class="form-label">Descrição</label>
                                                <input type="text" name="descricaoCategoria" class="form-control"
                                                    placeholder="Digite a descrição da categoria">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" onclick="alterarAction('rotaCategoria')"
                                                class="btn btn-primary">Salvar
                                                Categoria</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal Nova Marca -->
                            <div class="modal fade" id="modalNovaMarca" tabindex="-1"
                                aria-labelledby="modalNovaMarcaLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <input type="text" name="rotaProduto" hidden>
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalNovaMarcaLabel">Nova Marca</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Fechar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="novaMarca" class="form-label">Nome da Marca</label>
                                                <input type="text" class="form-control" name="nomeMarca"
                                                    id="novaMarca" required>
                                            </div>
                                            <div>
                                                <label for="descricao" class="form-label">Descrição</label>
                                                <input type="text" name="descricaoMarca" class="form-control"
                                                    placeholder="Digite a descrição da categoria">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" onclick="alterarAction('rotaMarca')"
                                                class="btn btn-primary">Salvar
                                                Marca</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Modal -->


<script>
    function alterarAction(rota) {
        const form = document.getElementById('formProduto');
        const routes = {
            'rotaProduto': '{{ route('administrativo.produto.salvar') }}',
            'rotaMarca': '{{ route('administrativo.marca.salvar') }}',
            'rotaCategoria': '{{ route('administrativo.produto.categoria.salvar') }}'
        };

        if (routes[rota]) {
            form.action = routes[rota];
            form.submit();
        } else {
            console.error('Rota não definida:', rota);
            alert('Erro: Configuração inválida!');
        }
    }
</script>


<script>
    const categoria = document.getElementById('categoria');
    const camisaSection = document.getElementById('camisaSection');
    const tenisSection = document.getElementById('tenisSection');
    const skateSection = document.getElementById('skateSection');
    const quantidadeSection = document.getElementById('quantidadeSection');
    const preSelect = document.getElementById('preSelect');

    console.log(preSelect);
    if(preSelect){
        preSelect.addEventListener('change', () => {
            quantidadeSection.style.display = 'none';
            camisaSection.style.display = 'none';
            skateSection.style.display = 'none';
            tenisSection.style.display = 'none';
            const selectedText = preSelect.options[preSelect.selectedIndex]?.text || '';
            if(selectedText === 'Camisas'){
            document.getElementById('nome').value = 'Camisa';
            document.getElementById('valor').value = '69,90';
            document.getElementById('valor_compra').value = '50';
            camisaSection.style.display = 'block';
            categoria.value = 1;
            document.getElementById('marca').value = 1;
            document.getElementById('material').value = 'algodão';
            }

            if (selectedText === 'Skates'){
                document.getElementById('nome').value = 'Skate';
                document.getElementById('valor').value = '179,90';
                document.getElementById('valor_compra').value = '100';
                skateSection.style.display = 'block';
                categoria.value = 2;
                document.getElementById('marca').value = 1;
                document.getElementById('material').value = 'Marfil';
            }

            if (selectedText === 'Tênis'){
                document.getElementById('nome').value = 'Tênis';
                document.getElementById('valor').value = '119,90';
                document.getElementById('valor_compra').value = '80';
                tenisSection.style.display = 'block';
                categoria.value = 3;
                document.getElementById('marca').value = 1;
                document.getElementById('material').value = 'fibra';
            }

            if(selectedText === 'Calças'){
                document.getElementById('nome').value = 'Calça';
                document.getElementById('valor').value = '69,90';
                document.getElementById('valor_compra').value = '45';
                camisaSection.style.display = 'block';
                categoria.value = 4;
                document.getElementById('marca').value = 1;
                document.getElementById('material').value = 'Algodão';
            }
 
            if (selectedText === 'Pré-Preencher'){            
                document.getElementById('nome').value = '';
                document.getElementById('valor').value = '';
                document.getElementById('valor_compra').value = '';
                quantidadeSection.style.display = 'block';
                categoria.value = "";
                document.getElementById('marca').value = 1;
                document.getElementById('material').value = '';
            }
        })
    }

    if (categoria) {
        categoria.addEventListener('change', () => {
            const selectedText = categoria.options[categoria.selectedIndex]?.text || '';
            camisaSection.style.display = 'none';
            skateSection.style.display = 'none';
            tenisSection.style.display = 'none';
            quantidadeSection.style.display = 'none';
            if (selectedText === 'Camisas') {
                camisaSection.style.display = 'block';
            } else if (selectedText === 'Skates') {
                skateSection.style.display = 'block';
            } else if (selectedText === 'Tênis') {
                tenisSection.style.display = 'block';
            } else if (selectedText === 'Calças') {
                camisaSection.style.display = 'block';
            } else {
                quantidadeSection.style.display = 'block';
            }
        });
    }


    document.querySelectorAll('.size-option').forEach(option => {
        option.addEventListener('click', function() {
            this.classList.toggle('selected'); // Marca o botão como selecionado

            const size = this.dataset.size;
            const inputQuantidade = document.getElementById(`quantidade${size}`);

            if (inputQuantidade) {
                inputQuantidade.disabled = !inputQuantidade.disabled;
            }
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
