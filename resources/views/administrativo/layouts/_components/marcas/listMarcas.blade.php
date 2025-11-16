<div class="container-fluid">
  <div>
    <div class="">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listar Acessórios</h3>
          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Funções</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($marcas as $marca)
                  <tr>
                    <td>{{ $marca->nome }}</td>
                    <td>{{ $marca->descricao }}</td>
                    <td>
                      <div class="row">
                        <div class="col-md-4">
                          <!-- Botão abre modal preenchendo todos os dados -->
                          <button type="button"
                                  class="btn btn-sm btn-warning"
                                  onclick="openBrandModal({{ $marca->id }}, '{{ addslashes($marca->nome) }}', '{{ addslashes($marca->descricao) }}')">
                            <i class="fas fa-edit"></i> Alterar
                          </button>
                        </div>

                        <div class="col-md-6">
                          <form action="{{ route('administrativo.marca.excluir') }}" method="post">
                            @csrf
                            <input name="id" value="{{ $marca->id }}" hidden>
                            <button type="submit" class="btn btn-sm btn-danger mt-1">
                              <i class="fas fa-trash"></i> Excluir
                            </button>
                          </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Funções</th>
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
  </div>
  <!-- iCheck -->
</div>

<!-- Modal para Alterar Marca -->
<div id="brandEditModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black bg-opacity-50">
  <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6 mx-4">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold">Alterar Marca</h3>
      <button type="button" class="text-gray-600 hover:text-gray-900" onclick="closeBrandModal()">✕</button>
    </div>

    <form id="brandEditForm" action="{{ route('administrativo.marca.alterar') }}" method="POST">
      @csrf
      <input type="hidden" name="id" id="modal_marca_id">

      <div class="mb-3">
        <label for="modal_marca_nome" class="form-label">Nome da Marca</label>
        <input type="text" name="nome" id="modal_marca_nome" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="modal_marca_descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="modal_marca_descricao" class="form-control" rows="3"></textarea>
      </div>

      <div class="flex justify-end gap-2 mt-4">
        <button type="button" class="btn btn-secondary" onclick="closeBrandModal()">Cancelar</button>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
      </div>
    </form>
  </div>
</div>

<script>
  function openBrandModal(id, nome, descricao) {
    // Preenche os campos do modal com os dados da marca
    document.getElementById('modal_marca_id').value = id;
    document.getElementById('modal_marca_nome').value = nome;
    document.getElementById('modal_marca_descricao').value = descricao;

    // Mostra o modal
    const modal = document.getElementById('brandEditModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Foca no primeiro campo para melhor UX
    document.getElementById('modal_marca_nome').focus();
  }

  function closeBrandModal() {
    const modal = document.getElementById('brandEditModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
  }

  // Fecha o modal ao clicar fora do conteúdo
  document.getElementById('brandEditModal').addEventListener('click', function(e) {
    if (e.target === this) closeBrandModal();
  });

  // Fecha o modal com a tecla ESC
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeBrandModal();
  });

  // Previne o fechamento do modal ao enviar o formulário
  document.getElementById('brandEditForm').addEventListener('submit', function(e) {
    // O formulário será enviado normalmente
    // Você pode adicionar validações aqui se necessário
  });
</script>