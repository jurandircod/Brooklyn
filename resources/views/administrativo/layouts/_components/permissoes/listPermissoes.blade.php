 <div clas="container-fluid">
     <!-- /.card -->
     <div>

         <div class="">
             <div class="col-12">
                 <!-- /.card -->
                 <div class="card">
                     <div class="card-header">
                         <h3 class="card-title">Listar permissoes</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body">
                         <table id="example1" class="table table-bordered table-striped">
                             <thead>
                                 <tr>
                                     <th>Tipo de Usuário</th>
                                     <th>Nível de acesso</th>
                                     <th>Descrição das funções</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($permissoes as $permissao)
                                     <tr>
                                         <td>{{ $permissao->tipo_acesso }}</td>
                                         <td>{{ $permissao->role_id }} - max: 10</td>
                                         <td>{{ $permissao->descricao }}</td>
                                         <td>

                                         <td>
                                             <div class="row">
                                                 <div class="col-md-4">
                                                     <button type="button" class="btn btn-sm btn-warning btn-alterar"
                                                         data-bs-toggle="modal" data-bs-target="#modalEditar"
                                                         data-id="{{ $permissao->role_id }}"
                                                         data-tipo="{{ $permissao->tipo_acesso }}"
                                                         data-desc="{{ $permissao->descricao }}">
                                                         <i class="fas fa-edit"></i> Alterar
                                                     </button>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <form action="{{ route('administrativo.permissao.remover') }}"
                                                         method="post">
                                                         @csrf
                                                         <input name="role_id" value="{{ $permissao->role_id }}" hidden>
                                                         <button type="submit" class="btn btn-sm btn-danger mt-1">
                                                             <i class="fas fa-trash-alt"></i> Excluir
                                                         </button>
                                                     </form>
                                                 </div>
                                             </div>
                                         </td>
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                             <tfoot>
                                 <tr>
                                     <th>Nome</th>
                                     <th>Numero</th>
                                     <th>Setor</th>
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
             <div class="col-12">
                <div class="paginate">
                    {{ $permissoes->links() }}
                </div>
             </div>
         </div>
     </div>
     <!-- iCheck -->

 </div>
 <!-- /.card -->
 

 <!-- Modal Editar -->
 <!-- Modal Editar -->
 <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-centered">
         <div class="modal-content shadow-lg border-0 rounded-3">
             <div class="modal-header bg-gradient-warning text-white">
                 <h5 class="modal-title" id="modalEditarLabel"><i class="fas fa-user-shield"></i> Editar Permissão</h5>
                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
             </div>
             <form action="{{ route('administrativo.permissao.editar') }}" method="post">
                 @csrf
                 <div class="modal-body">
                     <input type="hidden" name="role_id" id="editRoleId">

                     <div class="mb-3">
                         <label class="form-label fw-bold">Tipo de Usuário</label>
                         <input type="text" class="form-control" id="editTipo" name="tipo_acesso" required>
                     </div>

                     <div class="mb-3">
                         <label class="form-label fw-bold">Descrição das Funções</label>
                         <textarea class="form-control" id="editDesc" name="descricao" rows="3" required></textarea>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                         <i class="fas fa-times"></i> Cancelar
                     </button>
                     <button type="submit" class="btn btn-warning">
                         <i class="fas fa-save"></i> Salvar Alterações
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const alterarButtons = document.querySelectorAll(".btn-alterar");

         alterarButtons.forEach(button => {
             button.addEventListener("click", function() {
                 const roleId = this.getAttribute("data-id");
                 const tipo = this.getAttribute("data-tipo");
                 const desc = this.getAttribute("data-desc");

                 document.getElementById("editRoleId").value = roleId;
                 document.getElementById("editTipo").value = tipo;
                 document.getElementById("editDesc").value = desc;
             });
         });
     });
 </script>
