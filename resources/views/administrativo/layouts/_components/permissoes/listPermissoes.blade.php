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

                                             <div class="row">
                                                 <div class="col-md-4">
                                                     <form action="{{ route('administrativo.enviarPermissao.usuario') }}" method="post">
                                                        @csrf
                                                        <input name="role_id" value="{{ $permissao->role_id }}" hidden>
                                                        
                                                        <button type="submit"
                                                             class="btn btn-sm btn-warning" type="button"
                                                             data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                             <i class="fas fa-comments"></i>Alterar
                                                         </button>
                                                     </form>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <form
                                                         action="{{ route('administrativo.removerPermissao') }}"
                                                         method="post">
                                                         @csrf
                                                         <input name="role_id" value="{{ $permissao->role_id }}"
                                                            hidden>
                                                         <button type="submit" class="btn btn-sm btn-danger mt-1" type="d">
                                                             <i class="fas fa-comments"></i>Excluir
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
         </div>
     </div>
     <!-- iCheck -->

 </div>
 <!-- /.card -->
