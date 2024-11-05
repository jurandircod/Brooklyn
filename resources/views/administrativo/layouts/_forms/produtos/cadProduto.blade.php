<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cadastrar Acessórios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Início</a></li>
                    <li class="breadcrumb-item active">Cadastrar Características do Acessório</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Cadastrar Características do Acessório / Função Administrativa</h3>
                    </div>
                    
                    <!-- form start -->
                    <form action="{{ route('administrativo.produto.acessorio.salvar')}}" method="POST" onsubmit="return enviarCores()">
                        @csrf
                        @isset($permissao)
                            <input type="hidden" name="idEditar" value="{{ $id = $permissao->role_id }}">
                        @endisset

                        <div class="card-body row">
                            <div class="form-group col-md-5">
                                <label for="tamanhoAcesso">Tamanho de Acesso</label>
                                <input type="number" class="form-control" name="tamanho_acesso" id="tamanhoAcesso" placeholder="Digite o tamanho de acesso do usuário" min="0" max="10">
                            </div>

                            <div class="form-group col-md-2">
                                <label for="colorInput">Cor</label>
                                <input type="color" class="form-control" id="colorInput" name="cor" value="{{ $permissao->cor ?? '#000000' }}">
                            </div>
                            
                            <div class="col-md-12 d-flex flex-wrap align-items-center mt-2">
                                <button type="button" class="btn btn-success mr-3" onclick="salvarCor()">Salvar Cor</button>
                                <button type="button" class="btn btn-danger mr-3" onclick="removerUltimaCor()">Remover Cor</button>
                                <p id="mensagemErro" class="text-danger mb-0" style="display: none;">Máximo de 5 cores alcançado!</p>
                            </div>

                            <div class="col-md-12 mt-3">
                                <div id="coresContainer" class="d-flex flex-wrap" style="gap: 10px;"></div>
                            </div>

                            <!-- Campo escondido para armazenar as cores -->
                            <input type="hidden" id="coresInput" name="cores">
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let coresSalvas = []; // Array para armazenar as cores salvas (máximo 5)

    function salvarCor() {
        const colorInput = document.getElementById("colorInput").value;
        const mensagemErro = document.getElementById("mensagemErro");
        const coresContainer = document.getElementById("coresContainer");

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
        coresContainer.innerHTML = ""; // Limpa o contêiner

        coresSalvas.forEach(cor => {
            const divCor = document.createElement("div");
            divCor.style.backgroundColor = cor;
            divCor.style.width = "50px";
            divCor.style.height = "50px";
            divCor.style.borderRadius = "5px";
            divCor.style.border = "1px solid #ddd";
            coresContainer.appendChild(divCor);
        });
    }

    o
    function enviarCores() {
        if (coresSalvas.length === 0) {
            alert("Nenhuma cor foi salva!");
            return false;
        }
        return true; // Permite o envio do formulário
    }
</script>
