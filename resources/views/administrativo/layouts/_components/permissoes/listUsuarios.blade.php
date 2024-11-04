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
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Nível de permissão</th>
                                    <th>Alterar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $users)
                                    <tr>
                                        <td>{{ $users->name }}</td>
                                        <td>{{ $users->email }}</td>
                                        <td>{{ $users->role_id }} - max: 10</td>
                                        <td>
                                            <div class="row">
                                                <form action="{{ route('administrativo.editarPermissao.usuario') }}"
                                                    method="post">
                                                    <div class="col">
                                                        @csrf
                                                        <select name="role_id_alter" class="form-control">
                                                            @foreach ($permissoes as $permissao)
                                                                @if ($permissao->role_id == $users->role_id)
                                                                    <option value="{{ $permissao->role_id }}" selected>
                                                                        {{ $permissao->tipo_acesso }}</option>
                                                                @else
                                                                    <option value="{{ $permissao->role_id }}">
                                                                        {{ $permissao->tipo_acesso }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <input type="" name="user_id" value="{{ $users->id }}" hidden>
                                                        <button type="submit" class="btn btn-sm btn-warning mt-1"
                                                            type="d">
                                                            Alterar
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Nível de permissão</th>
                                    <th>Alterar</th>
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
