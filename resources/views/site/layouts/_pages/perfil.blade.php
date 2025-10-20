<link rel="stylesheet" href="{{ asset('css/site/perfil/customize.css') }}">

<!-- User Dashboard Section -->
<section class="py-8 md:py-12">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                
                <!-- Sidebar -->
                <div class="lg:w-1/4 bg-gray-50 border-r border-gray-200">
                    <div class="sidebar p-4">
                        <ul class="nav nav-tabs flex flex-col space-y-2" id="myTab">
                            <li class="nav-item">
                                <button class="nav-link w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:bg-gray-200 @if (empty($activeTab) && empty($_GET['activeTab'])) active bg-blue-600 text-white @elseif ((isset($activeTab) && $activeTab == 'dash') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'dash')) active bg-blue-600 text-white @else text-gray-700 @endif"
                                    id="dash-tab" data-bs-toggle="tab" data-bs-target="#dash" type="button"
                                    onclick="showTabContent(event, 'dash')">
                                    <i class="fas fa-tachometer-alt text-lg"></i>
                                    <span class="font-semibold">Painel</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:bg-gray-200 @if ((isset($activeTab) && $activeTab == 'profile') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'profile')) active bg-blue-600 text-white @else text-gray-700 @endif"
                                    id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                                    onclick="showTabContent(event, 'profile')">
                                    <i class="fas fa-user text-lg"></i>
                                    <span class="font-semibold">Perfil</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:bg-gray-200 @if ((isset($activeTab) && $activeTab == 'endereco') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'endereco')) active bg-blue-600 text-white @else text-gray-700 @endif"
                                    id="endereco-tab" data-bs-toggle="tab" data-bs-target="#endereco" type="button"
                                    onclick="showTabContent(event, 'endereco')">
                                    <i class="fas fa-plus-circle text-lg"></i>
                                    <span class="font-semibold">Novo Endereço</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:bg-gray-200 @if ((isset($activeTab) && $activeTab == 'order') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'order')) active bg-blue-600 text-white @else text-gray-700 @endif"
                                    id="order-tab" data-bs-toggle="tab" data-bs-target="#order" type="button"
                                    onclick="showTabContent(event, 'order')">
                                    <i class="fas fa-shopping-bag text-lg"></i>
                                    <span class="font-semibold">Pedidos</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:bg-gray-200 @if ((isset($activeTab) && $activeTab == 'save') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'save')) active bg-blue-600 text-white @else text-gray-700 @endif"
                                    id="save-tab" data-bs-toggle="tab" data-bs-target="#save" type="button"
                                    onclick="showTabContent(event, 'save')">
                                    <i class="fas fa-map-marker-alt text-lg"></i>
                                    <span class="font-semibold">Endereços</span>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-300 hover:bg-gray-200 @if ((isset($activeTab) && $activeTab == 'security') || (isset($_GET['activeTab']) && $_GET['activeTab'] == 'security')) active bg-blue-600 text-white @else text-gray-700 @endif"
                                    id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button"
                                    onclick="showTabContent(event, 'security')">
                                    <i class="fas fa-shield-alt text-lg"></i>
                                    <span class="font-semibold">Segurança</span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="lg:w-3/4">
                    <div class="content-area p-4 md:p-6">
                        
                        <!-- Mobile Menu Button -->
                        <div class="filter-button mb-4 lg:hidden">
                            <button class="btn btn-solid-default w-full flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors filter-btn">
                                <i class="fas fa-bars"></i>
                                <span>Menu</span>
                            </button>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            
                            <!-- Dashboard Tab -->
                            <div class="tab-pane fade @if (empty($activeTab) && empty($_GET['activeTab'])) show active @endif" id="dash">
                                <h2 class="text-2xl md:text-3xl font-bold mb-4 text-gray-800">Informações Pessoais</h2>
                                
                                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl p-6 mb-6 text-white">
                                    <h6 class="text-lg mb-2 text-white">Olá, <span class="font-bold text-white">{{ Auth::user()->name }}</span></h6>
                                    <p class="text-sm opacity-90">Gerencie suas informações no painel de controle.</p>
                                </div>

                                <!-- Stats Cards -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg">
                                        <div class="flex items-center gap-4">
                                            <div class="bg-white/20 rounded-lg p-3">
                                                <i class="fas fa-box text-2xl"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm opacity-90 text-white">Total de Pedidos</p>
                                                <h3 class="text-3xl font-bold text-white">{{ $pedidos->count() }}</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-6 text-white shadow-lg">
                                        <div class="flex items-center gap-4">
                                            <div class="bg-white/20 rounded-lg p-3">
                                                <i class="fas fa-clock text-2xl"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm opacity-90 text-white">Pendentes</p>
                                                <h3 class="text-3xl font-bold text-white">{{ $pedidos->where('status', 'aguardando')->count() }}</h3>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg">
                                        <div class="flex items-center gap-4">
                                            <div class="bg-white/20 rounded-lg p-3">
                                                <i class="fas fa-shopping-cart text-2xl"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm opacity-90 text-white">No Carrinho</p>
                                                <h3 class="text-3xl font-bold text-white">{{ Auth::user()->carrinhos->count() }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Cards -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="border border-gray-200 rounded-xl p-5 bg-white">
                                        <div class="flex justify-between items-center mb-4 pb-4 border-b">
                                            <h4 class="text-lg font-semibold text-gray-800">Contato</h4>
                                            <a href="{{ route('site.perfil.exibirEndereco') }}" class="text-blue-600 hover:text-blue-700 flex items-center gap-1 text-sm">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-gray-700">{{ Auth::user()->name }}</p>
                                            <p class="text-gray-600 text-sm">{{ Auth::user()->email }}</p>
                                            <a href="#" class="text-blue-600 hover:text-blue-700 text-sm inline-block mt-2">Alterar Senha</a>
                                        </div>
                                    </div>

                                    <div class="border border-gray-200 rounded-xl p-5 bg-white">
                                        <div class="flex justify-between items-center mb-4 pb-4 border-b">
                                            <h4 class="text-lg font-semibold text-gray-800">Newsletter</h4>
                                            <a href="#" class="text-blue-600 hover:text-blue-700 flex items-center gap-1 text-sm">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                        </div>
                                        <p class="text-gray-600 text-sm">Você não está inscrito em nenhuma newsletter.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Orders Tab -->
                            <div class="tab-pane fade" id="order">
                                <div id="pedidos-table-container">
                                    @include('site.layouts._pages.perfil.partials.pedidos-table', ['pedidos' => $pedidos])
                                </div>
                                <div id="pedidos-pagination-container" class="mt-4">
                                    @include('site.layouts._pages.perfil.partials.pedidos-pagination', ['pedidos' => $pedidos])
                                </div>
                            </div>

                            <!-- Saved Addresses Tab -->
                            <div class="tab-pane fade @isset($activeTab) @if ($activeTab == 6) show active @endif @endisset @isset($_GET['activeTab']) @if ($_GET['activeTab'] == 6) show active @endif @endisset" id="save">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                                    <h3 class="text-2xl font-bold text-gray-800">Endereços Salvos</h3>
                                    <a href="{{ route('site.perfil.exibirEndereco') }}" class="btn btn-solid-default flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors whitespace-nowrap">
                                        <i class="fas fa-plus"></i> Adicionar
                                    </a>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @isset($enderecosMostrar)
                                        @if ($enderecosMostrar->isEmpty())
                                            <div class="col-span-full text-center py-12">
                                                <i class="fas fa-map-marker-alt text-5xl text-gray-300 mb-4"></i>
                                                <p class="text-gray-500">Você ainda não salvou nenhum endereço.</p>
                                            </div>
                                        @else
                                            @foreach ($enderecosMostrar as $endereco)
                                                <div class="border border-gray-200 rounded-xl p-5 bg-white hover:shadow-lg transition-shadow">
                                                    <div class="flex justify-between items-start mb-4 pb-4 border-b">
                                                        <h5 class="text-lg font-semibold text-gray-800">{{ $endereco->cidade }}</h5>
                                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">Casa</span>
                                                    </div>
                                                    
                                                    <div class="space-y-2 mb-4 text-sm">
                                                        <p class="text-gray-700"><span class="font-semibold">Endereço:</span> {{ $endereco->bairro }}</p>
                                                        <p class="text-gray-700"><span class="font-semibold">Número:</span> {{ $endereco->numero }}</p>
                                                        <p class="text-gray-700"><span class="font-semibold">Estado:</span> {{ $endereco->estado }}</p>
                                                        <p class="text-gray-700"><span class="font-semibold">CEP:</span> {{ $endereco->cep }}</p>
                                                        <p class="text-gray-700"><span class="font-semibold">Telefone:</span> {{ $endereco->telefone }}</p>
                                                    </div>

                                                    <div class="flex gap-2 pt-4 border-t">
                                                        <a href="{{ route('site.perfil.enviaParaformEnderecos', ['id' => $endereco->id]) }}" 
                                                           class="flex-1 flex items-center justify-center gap-2 px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-sm">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </a>
                                                        <a href="{{ route('site.perfil.removerEndereco', ['id' => $endereco->id]) }}" 
                                                           class="flex-1 flex items-center justify-center gap-2 px-3 py-2 border border-red-300 rounded-lg text-red-600 hover:bg-red-50 transition-colors text-sm">
                                                            <i class="fas fa-trash"></i> Remover
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endisset
                                </div>
                            </div>

                            <!-- Profile Tab -->
                            <div class="tab-pane fade" id="profile">
                                <div class="flex justify-between items-center mb-6">
                                    <h3 class="text-2xl font-bold text-gray-800">Perfil</h3>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail"
                                        class="btn btn-solid-default flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                </div>

                                <div class="border border-gray-200 rounded-xl p-6 bg-white mb-6">
                                    <h5 class="text-lg font-semibold mb-4 text-gray-800">Informações do Usuário</h5>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="text-sm font-semibold text-gray-700 block mb-1">{{ Auth::user()->name }}</label>
                                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                                        </div>
                                        <div>
                                            <label class="text-sm font-semibold text-gray-700 block mb-1">
                                                @if (isset(Auth::user()->enderecos()->first()->cidade)) {{ Auth::user()->enderecos()->first()->cidade }}@else Nenhum Endereço @endif
                                            </label>
                                            <p class="text-gray-600">
                                                @if (isset(Auth::user()->enderecos()->first()->bairro)) {{ Auth::user()->enderecos()->first()->bairro }}@else Cadastre um endereço @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border border-gray-200 rounded-xl p-6 bg-white">
                                    <h5 class="text-lg font-semibold mb-4 text-gray-800">Contato</h5>
                                    <div>
                                        <label class="text-sm font-semibold text-gray-700 block mb-1">Telefone</label>
                                        <p class="text-gray-600">
                                            @if (isset(Auth::user()->enderecos()->first()->telefone)) {{ Auth::user()->enderecos()->first()->telefone }}@else Não cadastrado @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Tab -->
                            <div class="tab-pane fade" id="security">
                                <div class="border border-red-200 rounded-xl p-6 bg-red-50">
                                    <h3 class="text-2xl font-bold text-red-600 mb-4">Deletar Conta</h3>
                                    <p class="text-gray-700 mb-4">Olá <span class="font-semibold">{{ Auth::user()->name }}</span>, lamentamos saber que você gostaria de deletar sua conta.</p>
                                    
                                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                                        <h6 class="font-semibold text-yellow-800 mb-2 flex items-center gap-2">
                                            <i class="fas fa-exclamation-triangle"></i> Nota Importante
                                        </h6>
                                        <p class="text-sm text-yellow-700 mb-2">Deletar sua conta removerá permanentemente seu perfil, configurações e todas as informações associadas.</p>
                                        <p class="text-sm text-yellow-700">Uma vez deletada, você será desconectado e não poderá fazer login novamente.</p>
                                    </div>

                                    <button id="btn-delete-account" class="btn btn-danger flex items-center gap-2 px-6 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition-colors"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="fas fa-trash-alt"></i> Deletar Conta
                                    </button>
                                </div>
                            </div>

                            <!-- Address Form Tab -->
                            <div class="tab-pane fade @isset($activeTab) @if ($activeTab == 3) show active @endif @endisset @isset($_GET['activeTab']) @if ($_GET['activeTab'] == 3) show active @endif @endisset" id="endereco">
                                <div class="border border-gray-200 rounded-xl p-6 bg-white">
                                    <h3 class="text-2xl font-bold mb-6 text-gray-800 flex items-center gap-2">
                                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                                        @isset($enderecoEditar) Editar Endereço @else Cadastrar Endereço @endisset
                                    </h3>
                                    
                                    <form action="{{ isset($enderecoEditar) ? route('site.perfil.editarEndereco', ['id' => $enderecoEditar->id]) : route('site.perfil.salvarEndereco') }}" method="POST">
                                        @csrf
                                        @isset($enderecoEditar)
                                            <input type="hidden" name="id" value="{{ $enderecoEditar->id }}">
                                        @endisset
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="form-group">
                                                <label for="input-phone" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                                    <i class="fas fa-phone text-blue-600"></i> Telefone <span class="text-red-500">*</span>
                                                </label>
                                                <input type="tel" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                                    @isset($enderecoEditar) value="{{ $enderecoEditar->telefone }}" @endisset
                                                    name="telefone" id="input-phone" placeholder="(11) 99999-9999">
                                                @if ($errors->has('telefone'))
                                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('telefone') }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="input-cep" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                                    <i class="fas fa-mail-bulk text-blue-600"></i> CEP <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                                    value="{{ isset($enderecoEditar) ? $enderecoEditar->cep : old('cep') }}"
                                                    name="cep" id="input-cep" placeholder="00000-000">
                                                @if ($errors->has('cep'))
                                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('cep') }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="input-city" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                                    <i class="fas fa-city text-blue-600"></i> Cidade <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                                    value="{{ isset($enderecoEditar) ? $enderecoEditar->cidade : old('cidade') }}"
                                                    name="cidade" id="input-city" placeholder="Nome da cidade">
                                                @if ($errors->has('cidade'))
                                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('cidade') }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="input-uf" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                                    <i class="fas fa-flag text-blue-600"></i> Estado <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                                    value="{{ isset($enderecoEditar) ? $enderecoEditar->estado : old('estado') }}"
                                                    name="estado" id="input-uf" placeholder="SP">
                                                @if ($errors->has('estado'))
                                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('estado') }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="input-complemento" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                                    <i class="fas fa-info-circle text-blue-600"></i> Complemento
                                                </label>
                                                <input type="text" name="complemento" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                                    value="{{ isset($enderecoEditar->complemento) ? $enderecoEditar->complemento : old('complemento') }}"
                                                    id="input-complemento" placeholder="Apartamento, bloco, etc.">
                                                @if ($errors->has('complemento'))
                                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('complemento') }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="input-logradouro" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                                    <i class="fas fa-road text-blue-600"></i> Logradouro <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" name="logradouro" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                                    value="{{ isset($enderecoEditar) ? $enderecoEditar->logradouro : old('logradouro') }}"
                                                    id="input-logradouro" placeholder="Rua, Avenida, etc.">
                                                @if ($errors->has('logradouro'))
                                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('logradouro') }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="input-numero" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                                    <i class="fas fa-hashtag text-blue-600"></i> Número <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" name="numero" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                                    value="{{ isset($enderecoEditar) ? $enderecoEditar->numero : old('numero') }}"
                                                    id="input-numero" placeholder="123">
                                                @if ($errors->has('numero'))
                                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('numero') }}</p>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="input-bairro" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                                                    <i class="fas fa-map text-blue-600"></i> Bairro <span class="text-red-500">*</span>
                                                </label>
                                                <input type="text" name="bairro" class="form-control w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                                    value="{{ isset($enderecoEditar) ? $enderecoEditar->bairro : old('bairro') }}"
                                                    id="input-bairro" placeholder="Nome do bairro">
                                                @if ($errors->has('bairro'))
                                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('bairro') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex flex-col sm:flex-row gap-3 mt-6">
                                            <button type="submit" class="btn btn-solid-default flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                                <i class="fas fa-save"></i>
                                                @isset($enderecoEditar) Atualizar @else Salvar @endisset
                                            </button>
                                            <a href="/perfil?activeTab=3" class="btn flex items-center justify-center gap-2 px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition-colors">
                                                <i class="fas fa-times"></i> Cancelar
                                            </a>
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

<!-- Newsletter Section -->
<section class="bg-gradient-to-r from-purple-600 to-indigo-600 py-12 md:py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-6">
            <div class="lg:w-2/3 text-white">
                <h2 class="text-2xl md:text-3xl font-bold mb-3">Assine Nossa Newsletter</h2>
                <p class="text-white/90">Receba novidades sobre nossos produtos incríveis.</p>
            </div>
            <div class="lg:w-1/3 w-full">
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="text" class="flex-1 px-4 py-3 rounded-lg border-0 focus:ring-2 focus:ring-white/50 transition-all" placeholder="Seu email">
                    <button class="btn bg-white text-purple-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors whitespace-nowrap flex items-center justify-center gap-2" type="button">
                        <i class="fas fa-paper-plane"></i> Assinar
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Mobile Sidebar Styles */
@media (max-width: 1023px) {
    .sidebar {
        position: fixed;
        top: 0;
        left: -100%;
        width: 280px;
        height: 100vh;
        z-index: 1000;
        background: white;
        transition: left 0.3s ease;
        overflow-y: auto;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    
    .sidebar.show {
        left: 0;
    }
    
    .sidebar.show::before {
        content: '';
        position: fixed;
        top: 0;
        left: 280px;
        width: calc(100vw - 280px);
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }
}

/* Active nav link styles */
.nav-link.active {
    background: linear-gradient(135deg, var(--theme-color) 0%, var(--theme-color-hover) 100%) !important;
    color: black !important;
}

/* Smooth transitions */
.nav-link {
    transition: all 0.3s ease;
}

/* Form focus styles */
.form-control:focus {
    outline: none;
    border-color: var(--theme-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

/* Button hover effects */
.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Card hover effects */
.hover\:shadow-lg:hover {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Responsive text sizing */
@media (max-width: 640px) {
    .stats-card h3 {
        font-size: 1.5rem;
    }
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Mobile menu toggle
    $('.filter-btn').click(function() {
        $('.sidebar').toggleClass('show');
    });

    // Close sidebar when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('.sidebar, .filter-btn').length) {
            $('.sidebar').removeClass('show');
        }
    });

    // CEP lookup functionality
    $('#input-cep').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        
        if (cep.length === 8) {
            $.ajax({
                url: '/cep/' + cep,
                method: 'GET',
                success: function(response) {
                    if (response.city && response.uf) {
                        $('#input-uf').val(response.uf);
                        $('#input-city').val(response.city);
                        $('#input-uf').attr('readonly', true);
                        $('#input-city').attr('readonly', true);
                    } else {
                        alert('CEP não encontrado!');
                    }
                },
                error: function() {
                    alert('Erro ao buscar o CEP.');
                }
            });
        } else if (cep.length > 0) {
            alert('Digite um CEP válido!');
        }
    });

    // Form animations
    $('.form-control').focus(function() {
        $(this).parent().addClass('focused');
    });

    $('.form-control').blur(function() {
        if ($(this).val() === '') {
            $(this).parent().removeClass('focused');
        }
    });

    // Smooth scroll
    $('a[href^="#"]').click(function(e) {
        e.preventDefault();
        var target = $($(this).attr('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 100
            }, 500);
        }
    });
});
</script>

<script>
function showTabContent(event, tabId) {
    // Hide all tabs
    const elementosConteudo = document.querySelectorAll('#myTabContent .tab-pane');
    elementosConteudo.forEach(elemento => {
        elemento.classList.remove('active', 'show');
    });

    // Deactivate all buttons
    const botoesSidebar = document.querySelectorAll('#myTab .nav-link');
    botoesSidebar.forEach(botao => {
        botao.classList.remove('active');
    });

    // Activate clicked button
    event.currentTarget.classList.add('active');

    // Show corresponding content
    const tabAtiva = document.getElementById(tabId);
    if (tabAtiva) {
        tabAtiva.classList.add('active', 'show');
    }
    
    // Close mobile sidebar
    if (window.innerWidth < 1024) {
        document.querySelector('.sidebar').classList.remove('show');
    }
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const paginationContainer = document.getElementById('pedidos-pagination-container');

    // Delegation for pagination clicks
    if (paginationContainer) {
        paginationContainer.addEventListener('click', function(e) {
            const link = e.target.closest('a.page-link');
            if (!link) return;

            e.preventDefault();
            loadPage(link.href);
        });
    }

    // Function to load pages via AJAX
    function loadPage(url) {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            document.getElementById('pedidos-table-container').innerHTML = data.table;
            document.getElementById('pedidos-pagination-container').innerHTML = data.pagination;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});
</script>