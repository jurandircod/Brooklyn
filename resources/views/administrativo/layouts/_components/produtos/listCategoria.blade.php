<!-- Tailwind modal + table version -->
<div class="p-6">
  <div class="bg-white shadow-xl rounded-xl p-6">
    <h3 class="text-xl font-semibold mb-4">Listar Permissões</h3>

    <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
      <thead class="bg-gray-100">
        <tr>
          <th class="p-3 text-left">Categoria</th>
          <th class="p-3 text-left">Descrição</th>
          <th class="p-3 text-left">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categorias as $categoria)
        <tr class="border-b">
          <td class="p-3">{{ $categoria->nome }}</td>
          <td class="p-3">{{ $categoria->descricao }}</td>
          <td class="p-3">
            <div class="flex gap-2">
              <button onclick="openModal('{{ $categoria->id }}', '{{ $categoria->nome }}', {{ $categoria->descricao }})" class="px-3 py-1 bg-yellow-500 text-white rounded-md text-sm hover:bg-yellow-600">Alterar</button>

              <form action="{{ route('administrativo.produto.categoria.excluir') }}" method="POST">
                @csrf
                <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">
                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">Excluir</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
  <div class="bg-white w-full max-w-md p-6 rounded-xl shadow-lg">
    <h2 class="text-xl font-semibold mb-4">Alterar Categoria</h2>

    <form action="{{ route('administrativo.produto.categoria.alterar') }}" method="POST">
      @csrf
      <input type="hidden" id="modal_categoria_id" name="categoria_id">

      <div class="mb-4">
        <label class=" mb-1 font-medium">Categoria Selecionada</label>
        <input id="modal_categoria_nome" name="nome" type="text" class="w-full p-2 border rounded-md bg-gray-100">
      </div>
            <div class="mb-4">
        <label class=" mb-1 font-medium">Descricão Selecionada</label>
        <input id="modal_categoria_descricao" name="descricao" type="text" class="w-full p-2 border rounded-md bg-gray-100">
      </div>

      <div class="flex justify-end gap-2 mt-4">
        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">Cancelar</button>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Confirmar</button>
      </div>
    </form>
  </div>
</div>

<script>
function openModal(id, nome, descricao) {
    document.getElementById('modal_categoria_id').value = id;
    document.getElementById('modal_categoria_nome').value = nome;
    document.getElementById('modal_categoria_descricao').value = descricao ?? '';
    document.getElementById('editModal').classList.remove('hidden');
    document.getElementById('editModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
    document.getElementById('editModal').classList.remove('flex');
}
</script>
