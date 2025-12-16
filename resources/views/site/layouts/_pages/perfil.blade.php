<link rel="stylesheet" href="{{ asset('css/site/perfil/customize.css') }}">

<!-- User Dashboard Section -->
<section class="py-6 md:py-10">
  <div class="container mx-auto px-4">
    <div class="bg-stone-50 rounded-xl shadow overflow-hidden">
      <div class="flex flex-col lg:flex-row">

        <!-- Sidebar -->
        <div class="lg:w-1/4 bg-stone-100 border-stone-200 border-r">
          <div class="sidebar p-3 lg:p-4">
            <ul id="myTab" class="flex flex-col space-y-2">
              <li><button id="dash-tab" data-bs-toggle="tab" data-bs-target="#dash" type="button"
                onclick="showTabContent(event,'dash')"
                class="nav-link w-full flex items-center gap-3 px-3 py-2 rounded-lg transition duration-200 hover:bg-stone-200 text-stone-700 @if (empty($activeTab) && empty($_GET['activeTab'])) active bg-blue-600 text-white @elseif ((isset($activeTab) && $activeTab == 'dash') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'dash')) active bg-blue-600 text-white @endif">
                <i class="fas fa-tachometer-alt text-lg"></i><span class="font-semibold">Painel</span>
              </button></li>

              <li><button id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                onclick="showTabContent(event,'profile')"
                class="nav-link w-full flex items-center gap-3 px-3 py-2 rounded-lg transition duration-200 hover:bg-stone-200 text-stone-700 @if ((isset($activeTab) && $activeTab == 'profile') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'profile')) active bg-blue-600 text-white @endif">
                <i class="fas fa-user text-lg"></i><span class="font-semibold">Perfil</span>
              </button></li>

              <li><button id="endereco-tab" data-bs-toggle="tab" data-bs-target="#endereco" type="button"
                onclick="showTabContent(event,'endereco')"
                class="nav-link w-full flex items-center gap-3 px-3 py-2 rounded-lg transition duration-200 hover:bg-stone-200 text-stone-700 @if ((isset($activeTab) && $activeTab == 'endereco') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'endereco')) active bg-blue-600 text-white @endif">
                <i class="fas fa-plus-circle text-lg"></i><span class="font-semibold">Novo Endereço</span>
              </button></li>

              <li><button id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button"
                onclick="showTabContent(event,'order')"
                class="nav-link w-full flex items-center gap-3 px-3 py-2 rounded-lg transition duration-200 hover:bg-stone-200 text-stone-700 @if ((isset($activeTab) && $activeTab == 'order') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'order')) active bg-blue-600 text-white @endif">
                <i class="fas fa-shopping-bag text-lg"></i><span class="font-semibold">Pedidos</span>
              </button></li>

              <li><button id="save-tab" data-bs-toggle="tab" data-bs-target="#save" type="button"
                onclick="showTabContent(event,'save')"
                class="nav-link w-full flex items-center gap-3 px-3 py-2 rounded-lg transition duration-200 hover:bg-stone-200 text-stone-700 @if ((isset($activeTab) && $activeTab == 'save') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'save')) active bg-blue-600 text-white @endif">
                <i class="fas fa-map-marker-alt text-lg"></i><span class="font-semibold">Endereços</span>
              </button></li>

              <li><button id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button"
                onclick="showTabContent(event,'security')"
                class="nav-link w-full flex items-center gap-3 px-3 py-2 rounded-lg transition duration-200 hover:bg-stone-200 text-stone-700 @if ((isset($activeTab) && $activeTab == 'security') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'security')) active bg-blue-600 text-white @endif">
                <i class="fas fa-shield-alt text-lg"></i><span class="font-semibold">Segurança</span>
              </button></li>
            </ul>
          </div>
        </div>

        <!-- Content Area -->
        <div class="lg:w-3/4">
          <div class="content-area p-4 md:p-6">

            <!-- Mobile Menu Button -->
            <div class="mb-4 lg:hidden">
              <button class="filter-btn w-full flex items-center justify-center gap-2 px-4 py-3 rounded-lg font-semibold bg-amber-700 text-white hover:bg-amber-800 transition">
                <i class="fas fa-bars"></i><span>Menu</span>
              </button>
            </div>

            <div id="myTabContent" class="tab-content">

              <!-- Dashboard -->
              <div id="dash" class="tab-pane fade @if (empty($activeTab) && empty($_GET['activeTab'])) show active @endif">
                <h2 class="text-2xl md:text-3xl font-bold mb-4 text-stone-800">Informações Pessoais</h2>

                <div class="rounded-xl p-5 mb-5 text-stone-800" style="background: linear-gradient(90deg,#E8D7C3,#BFA37A);">
                  <h6 class="text-lg mb-1">Olá, <span class="font-bold">{{ Auth::user()->name }}</span></h6>
                  <p class="text-sm opacity-90">Gerencie suas informações no painel de controle.</p>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                  <div class="rounded-xl p-4 text-white shadow" style="background:linear-gradient(135deg,#8B5E3C,#B5885C);">
                    <div class="flex items-center gap-3">
                      <div class="bg-white/20 rounded-lg p-2"><i class="fas fa-box text-2xl"></i></div>
                      <div><p class="text-sm opacity-90">Total de Pedidos</p><h3 class="text-2xl font-bold">{{ $pedidos->count() }}</h3></div>
                    </div>
                  </div>

                  <div class="rounded-xl p-4 text-white shadow" style="background:linear-gradient(135deg,#7A5A39,#A76F3D);">
                    <div class="flex items-center gap-3">
                      <div class="bg-white/20 rounded-lg p-2"><i class="fas fa-clock text-2xl"></i></div>
                      <div><p class="text-sm opacity-90">Pendentes</p><h3 class="text-2xl font-bold">{{ $pedidos->where('status','aguardando')->count() }}</h3></div>
                    </div>
                  </div>

                  <div class="rounded-xl p-4 text-white shadow" style="background:linear-gradient(135deg,#6B8A60,#3F6B3D);">
                    <div class="flex items-center gap-3">
                      <div class="bg-white/20 rounded-lg p-2"><i class="fas fa-shopping-cart text-2xl"></i></div>
                      <div><p class="text-sm opacity-90">No Carrinho</p><h3 class="text-2xl font-bold">{{ Auth::user()->carrinhos->count() }}</h3></div>
                    </div>
                  </div>
                </div>

                <!-- Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="rounded-xl p-4 bg-white border border-stone-200">
                    <div class="flex justify-between items-center mb-3 pb-3 border-b"><h4 class="font-semibold text-stone-800">Contato</h4>
                      <a href="{{ route('site.perfil.exibirEndereco') }}" class="text-amber-700 text-sm flex items-center gap-1"><i class="fas fa-edit"></i> Editar</a>
                    </div>
                    <div class="space-y-2">
                      <p class="text-stone-700">{{ Auth::user()->name }}</p>
                      <p class="text-stone-500 text-sm">{{ Auth::user()->email }}</p>
                      <a href="#" class="text-amber-700 text-sm inline-block mt-2">Alterar Senha</a>
                    </div>
                  </div>

                  <div class="rounded-xl p-4 bg-white border border-stone-200">
                    <div class="flex justify-between items-center mb-3 pb-3 border-b"><h4 class="font-semibold text-stone-800">Newsletter</h4>
                      <a href="#" class="text-amber-700 text-sm flex items-center gap-1"><i class="fas fa-edit"></i> Editar</a>
                    </div>
                    <p class="text-stone-500 text-sm">Você não está inscrito em nenhuma newsletter.</p>
                  </div>
                </div>
              </div>

              <!-- Orders -->
              <div id="order" class="tab-pane fade @isset($activeTab) @if ($activeTab == 4) show active @endif @endisset @isset($_GET['activeTab']) @if ($_GET['activeTab'] == 3) show active @endif @endisset">
                <div id="pedidos-table-container">@include('site.layouts._pages.perfil.partials.pedidos-table',['pedidos'=>$pedidos])</div>
                <div id="pedidos-pagination-container" class="mt-4">@include('site.layouts._pages.perfil.partials.pedidos-pagination',['pedidos'=>$pedidos])</div>
              </div>

              <!-- Saved Addresses -->
              <div id="save" class="tab-pane fade">
                <div class="flex flex-col sm:flex-row justify-between items-start gap-3 mb-4">
                  <h3 class="text-2xl font-bold text-stone-800">Endereços Salvos</h3>
                  <a href="{{ route('site.perfil.exibirEndereco') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-amber-700 text-white whitespace-nowrap"><i class="fas fa-plus"></i> Adicionar</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  @isset($enderecosMostrar)
                    @if ($enderecosMostrar->isEmpty())
                      <div class="col-span-full text-center py-8 text-stone-500"><i class="fas fa-map-marker-alt text-4xl mb-3"></i><p>Você ainda não salvou nenhum endereço.</p></div>
                    @else
                      @foreach ($enderecosMostrar as $endereco)
                        <div class="rounded-xl p-4 bg-white border border-stone-200 hover:shadow-lg transition">
                          <div class="flex justify-between items-start mb-3 pb-3 border-b">
                            <h5 class="font-semibold text-stone-800">{{ $endereco->cidade }}</h5>
                            <span class="bg-amber-100 text-amber-700 px-2 py-1 rounded-full text-xs">Casa</span>
                          </div>

                          <div class="space-y-1 text-sm text-stone-700 mb-3">
                            <p><span class="font-semibold">Endereço:</span> {{ $endereco->bairro }}</p>
                            <p><span class="font-semibold">Número:</span> {{ $endereco->numero }}</p>
                            <p><span class="font-semibold">Estado:</span> {{ $endereco->estado }}</p>
                            <p><span class="font-semibold">CEP:</span> {{ $endereco->cep }}</p>
                            <p><span class="font-semibold">Telefone:</span> {{ $endereco->telefone }}</p>
                          </div>

                          <div class="flex gap-2 pt-3 border-t">
                            <a href="{{ route('site.perfil.enviaParaformEnderecos', ['id' => $endereco->id]) }}" class="flex-1 py-2 rounded-lg border border-stone-300 text-stone-700 text-center text-sm">Editar</a>
                            <a href="{{ route('site.perfil.removerEndereco', ['id' => $endereco->id]) }}" class="flex-1 py-2 rounded-lg border border-red-300 text-red-600 text-center text-sm">Remover</a>
                          </div>
                        </div>
                      @endforeach
                    @endif
                  @endisset
                </div>
              </div>

              <!-- Profile -->
              <div id="profile" class="tab-pane fade">
                <div class="flex justify-between items-center mb-4">
                  <h3 class="text-2xl font-bold text-stone-800">Perfil</h3>
                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail" class="px-3 py-2 rounded-lg bg-amber-700 text-white"><i class="fas fa-edit"></i> Editar</a>
                </div>

                <div class="rounded-xl p-4 bg-white border border-stone-200 mb-4">
                  <h5 class="font-semibold mb-3 text-stone-800">Informações do Usuário</h5>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                      <label class="text-sm font-semibold block mb-1 text-stone-700">{{ Auth::user()->name }}</label>
                      <p class="text-stone-500">{{ Auth::user()->email }}</p>
                    </div>
                    <div>
                      <label class="text-sm font-semibold block mb-1 text-stone-700">
                        @if (isset(Auth::user()->enderecos()->first()->cidade))
                          {{ Auth::user()->enderecos()->first()->cidade }}
                        @else Nenhum Endereço @endif
                      </label>
                      <p class="text-stone-500">@if (isset(Auth::user()->enderecos()->first()->bairro)) {{ Auth::user()->enderecos()->first()->bairro }} @else Cadastre um endereço @endif</p>
                    </div>
                  </div>
                </div>

                <div class="rounded-xl p-4 bg-white border border-stone-200">
                  <h5 class="font-semibold mb-3 text-stone-800">Contato</h5>
                  <div><label class="text-sm font-semibold block mb-1 text-stone-700">Telefone</label>
                    <p class="text-stone-500">@if (isset(Auth::user()->enderecos()->first()->telefone)) {{ Auth::user()->enderecos()->first()->telefone }} @else Não cadastrado @endif</p>
                  </div>
                </div>
              </div>

              <!-- Security -->
              <div id="security" class="tab-pane fade">
                <div class="rounded-xl p-4 bg-rose-50 border border-rose-200">
                  <h3 class="text-2xl font-bold text-rose-600 mb-3">Deletar Conta</h3>
                  <p class="text-stone-700 mb-3">Olá <span class="font-semibold">{{ Auth::user()->name }}</span>, lamentamos saber que você gostaria de deletar sua conta.</p>

                  <div class="bg-yellow-50 border-yellow-200 rounded p-3 mb-3">
                    <h6 class="font-semibold text-yellow-800 mb-1 flex items-center gap-2"><i class="fas fa-exclamation-triangle"></i> Nota Importante</h6>
                    <p class="text-sm text-yellow-700">Deletar sua conta removerá permanentemente seu perfil, configurações e todas as informações associadas.</p>
                  </div>

                  <button id="btn-delete-account" data-bs-toggle="modal" data-bs-target="#deleteModal" class="px-4 py-2 rounded-lg bg-rose-600 text-white hover:bg-rose-700"><i class="fas fa-trash-alt"></i> Deletar Conta</button>
                </div>
              </div>

              <!-- Endereço (form) -->
              <div id="endereco" class="tab-pane fade @isset($activeTab) @if ($activeTab == 3) show active @endif @endisset @isset($_GET['activeTab']) @if ($_GET['activeTab'] == 3) show active @endif @endisset">
                <div class="rounded-xl p-4 bg-white border border-stone-200">
                  <h3 class="text-2xl font-bold mb-4 text-stone-800 flex items-center gap-2"><i class="fas fa-map-marker-alt text-amber-700"></i>
                    @isset($enderecoEditar) Editar Endereço @else Cadastrar Endereço @endisset
                  </h3>

                  <form action="{{ isset($enderecoEditar) ? route('site.perfil.editarEndereco',['id'=>$enderecoEditar->id]) : route('site.perfil.salvarEndereco') }}" method="POST">
                    @csrf @isset($enderecoEditar) <input type="hidden" name="id" value="{{ $enderecoEditar->id }}"> @endisset

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div class="form-group">
                        <label for="input-phone" class="text-sm font-semibold text-stone-700 mb-1 flex items-center gap-2"><i class="fas fa-phone text-amber-700"></i> Telefone <span class="text-red-500">*</span></label>
                        <input id="input-phone" name="telefone" type="tel" value="{{ isset($enderecoEditar) ? $enderecoEditar->telefone : old('telefone') }}" placeholder="(11) 99999-9999" class="form-control w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-200">
                        @error('telefone')<p class="text-red-500 text-xs mt-1">{{ $errors->first('telefone') }}</p>@enderror
                      </div>

                      <div class="form-group">
                        <label for="input-cep" class="text-sm font-semibold text-stone-700 mb-1 flex items-center gap-2"><i class="fas fa-mail-bulk text-amber-700"></i> CEP <span class="text-red-500">*</span></label>
                        <input id="input-cep" name="cep" type="text" value="{{ isset($enderecoEditar) ? $enderecoEditar->cep : old('cep') }}" placeholder="00000-000" class="form-control w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-200">
                        @if ($errors->has('cep'))<p class="text-red-500 text-xs mt-1">{{ $errors->first('cep') }}</p>@endif
                      </div>

                      <div class="form-group">
                        <label for="input-cpf" class="text-sm font-semibold text-stone-700 mb-1 flex items-center gap-2"><i class="fas fa-flag text-amber-700"></i> CPF <span class="text-red-500">*</span></label>
                        <input id="input-cpf" name="cpf" type="text" value="{{ isset($enderecoEditar) ? $enderecoEditar->cpf : old('cpf') }}" placeholder="000.000.000-00" class="form-control w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-200">
                        @if ($errors->has('cpf'))<p class="text-red-500 text-xs mt-1">{{ $errors->first('cpf') }}</p>@endif
                      </div>

                      <div class="form-group">
                        <label for="input-city" class="text-sm font-semibold text-stone-700 mb-1 flex items-center gap-2"><i class="fas fa-city text-amber-700"></i> Cidade <span class="text-red-500">*</span></label>
                        <input id="input-city" name="cidade" type="text" value="{{ isset($enderecoEditar) ? $enderecoEditar->cidade : old('cidade') }}" placeholder="Nome da cidade" class="form-control w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-200">
                        @if ($errors->has('cidade'))<p class="text-red-500 text-xs mt-1">{{ $errors->first('cidade') }}</p>@endif
                      </div>

                      <div class="form-group">
                        <label for="input-uf" class="text-sm font-semibold text-stone-700 mb-1 flex items-center gap-2"><i class="fas fa-flag text-amber-700"></i> Estado <span class="text-red-500">*</span></label>
                        <input id="input-uf" name="estado" type="text" value="{{ isset($enderecoEditar) ? $enderecoEditar->estado : old('estado') }}" placeholder="SP" class="form-control w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-200">
                        @if ($errors->has('estado'))<p class="text-red-500 text-xs mt-1">{{ $errors->first('estado') }}</p>@endif
                      </div>

                      <div class="form-group">
                        <label for="input-complemento" class="text-sm font-semibold text-stone-700 mb-1 flex items-center gap-2"><i class="fas fa-info-circle text-amber-700"></i> Complemento</label>
                        <input id="input-complemento" name="complemento" type="text" value="{{ isset($enderecoEditar->complemento) ? $enderecoEditar->complemento : old('complemento') }}" placeholder="Apartamento, bloco, etc." class="form-control w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-200">
                        @if ($errors->has('complemento'))<p class="text-red-500 text-xs mt-1">{{ $errors->first('complemento') }}</p>@endif
                      </div>

                      <div class="form-group">
                        <label for="input-logradouro" class="text-sm font-semibold text-stone-700 mb-1 flex items-center gap-2"><i class="fas fa-road text-amber-700"></i> Logradouro <span class="text-red-500">*</span></label>
                        <input id="input-logradouro" name="logradouro" type="text" value="{{ isset($enderecoEditar) ? $enderecoEditar->logradouro : old('logradouro') }}" placeholder="Rua, Avenida, etc." class="form-control w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-200">
                        @if ($errors->has('logradouro'))<p class="text-red-500 text-xs mt-1">{{ $errors->first('logradouro') }}</p>@endif
                      </div>

                      <div class="form-group">
                        <label for="input-numero" class="text-sm font-semibold text-stone-700 mb-1 flex items-center gap-2"><i class="fas fa-hashtag text-amber-700"></i> Número <span class="text-red-500">*</span></label>
                        <input id="input-numero" name="numero" type="text" value="{{ isset($enderecoEditar) ? $enderecoEditar->numero : old('numero') }}" placeholder="123" class="form-control w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-200">
                        @if ($errors->has('numero'))<p class="text-red-500 text-xs mt-1">{{ $errors->first('numero') }}</p>@endif
                      </div>

                      <div class="form-group">
                        <label for="input-bairro" class="text-sm font-semibold text-stone-700 mb-1 flex items-center gap-2"><i class="fas fa-map text-amber-700"></i> Bairro <span class="text-red-500">*</span></label>
                        <input id="input-bairro" name="bairro" type="text" value="{{ isset($enderecoEditar) ? $enderecoEditar->bairro : old('bairro') }}" placeholder="Nome do bairro" class="form-control w-full px-3 py-2 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-200">
                        @if ($errors->has('bairro'))<p class="text-red-500 text-xs mt-1">{{ $errors->first('bairro') }}</p>@endif
                      </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 mt-4">
                      <button type="submit" class="flex-1 px-4 py-2 rounded-lg bg-amber-700 text-white"><i class="fas fa-save"></i> @isset($enderecoEditar) Atualizar @else Salvar @endisset</button>
                      <a href="/perfil?activeTab=3" class="flex-1 px-4 py-2 rounded-lg border border-stone-300 text-stone-700 text-center">Cancelar</a>
                    </div>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- Inline simplified styles (earthy theme + responsive tweaks) -->
<style>
  :root {
    --theme-main: #8B5E3C; /* primary earth */
    --theme-dark: #6b4b2b;
    --theme-accent: #B5885C;
    --theme-on: #fff;
  }

  /* Sidebar mobile */
  @media (max-width: 1023px) {
    .sidebar {
      position: fixed;
      top: 0;
      left: -100%;
      width: 260px;
      height: 100vh;
      z-index: 50;
      background: white;
      transition: left .25s ease;
      overflow-y: auto;
      box-shadow: 2px 0 12px rgba(0,0,0,.12);
    }
    .sidebar.show { left: 0; }
    .sidebar.show::before { content:''; position: fixed; inset:0 0 0 260px; background: rgba(0,0,0,.45); z-index:-1; }
  }

  /* Force active look to earthy even if backend outputs .bg-blue-600 */
  .nav-link.active {
    background: linear-gradient(135deg, var(--theme-main), var(--theme-accent)) !important;
    color: var(--theme-on) !important;
  }

  /* Small helpers */
  .form-control:focus { outline: none; box-shadow: 0 0 0 4px rgba(139,94,60,.08); border-color: var(--theme-main); }
  .btn, .filter-btn { transition: transform .18s ease, box-shadow .18s ease; }
  .btn:hover, .filter-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(0,0,0,.08); }

  /* Reduce padding on very small screens */
  @media (max-width:420px) {
    .content-area { padding-left: .75rem; padding-right: .75rem; }
    .sidebar { width: 220px; }
    .nav-link { padding-left: .75rem; padding-right: .75rem; }
    .grid .rounded-xl { padding: .75rem; }
  }
</style>

<!-- scripts: jQuery kept for mask/CEP; combined logic in single block -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
  (function(){
    // Mobile sidebar toggle
    document.querySelectorAll('.filter-btn').forEach(b=>b.addEventListener('click',()=>document.querySelector('.sidebar').classList.toggle('show')));
    document.addEventListener('click', e => { if(!e.target.closest('.sidebar, .filter-btn')) document.querySelector('.sidebar')?.classList.remove('show'); });

    // show/hide tabs (keeps server-side active classes working)
    window.showTabContent = function(event, tabId){
      document.querySelectorAll('#myTabContent .tab-pane').forEach(el=>el.classList.remove('active','show'));
      document.querySelectorAll('#myTab .nav-link').forEach(b=>b.classList.remove('active'));
      event.currentTarget.classList.add('active');
      document.getElementById(tabId)?.classList.add('active','show');
      if(window.innerWidth < 1024) document.querySelector('.sidebar')?.classList.remove('show');
    };

    // Masks (jQuery.mask)
    $('#input-phone').mask('(00) 00000-0000');
    $('#input-cep').mask('00000-000');
    $('#input-cpf').mask('000.000.000-00');

    // CEP lookup (keeps your existing route)
    $('#input-cep').on('blur', function(){
      var cep = $(this).val().replace(/\D/g,'');
      if(cep.length===8){
        $.get('/cep/'+cep).done(function(response){
          if(response.city && response.uf){
            $('#input-uf').val(response.uf).attr('readonly',true);
            $('#input-city').val(response.city).attr('readonly',true);
          } else { alert('CEP não encontrado!'); }
        }).fail(()=>alert('Erro ao buscar o CEP.'));
      } else if(cep.length>0) alert('Digite um CEP válido!');
    });

    // Vanilla masks fallback (in case jQuery.mask is not loaded) - safe guard
    function simpleMask(input, fn){ try{ fn(input); }catch(e){} }

    // Small helpers used elsewhere in your page
    window.removerMascara = function(v){ return v ? v.replace(/\D/g,'') : ''; };
    window.obterValores = function(){ return { cep: removerMascara($('#input-cep').val()), cpf: removerMascara($('#input-cpf').val()), phone: removerMascara($('#input-phone').val()) };};
    window.validarCampos = function(){ const vals=obterValores(); return { cep: vals.cep.length===8, cpf: vals.cpf.length===11, phone: vals.phone.length===10 || vals.phone.length===11 }; };

    // Pagination ajax delegation (kept same behavior)
    document.addEventListener('click', function(e){
      const link = e.target.closest('#pedidos-pagination-container a.page-link');
      if(!link) return;
      e.preventDefault();
      fetch(link.href, { headers: {'X-Requested-With':'XMLHttpRequest','Accept':'application/json'} })
        .then(r=>{ if(!r.ok) throw r; return r.json(); })
        .then(data=>{ document.getElementById('pedidos-table-container').innerHTML = data.table; document.getElementById('pedidos-pagination-container').innerHTML = data.pagination; })
        .catch(err=>console.error('Pagination error', err));
    });
  })();
</script>
