<section class="py-16 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Formulário -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10">
                    <div class="mb-8">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 relative inline-block">
                            Contate-nos
                            <span class="absolute bottom-0 left-0 w-20 h-1 bg-[#6F2E2F] rounded-full"></span>
                        </h2>
                        <p class="text-gray-600 mt-4 leading-relaxed">
                            Seu email será utilizado para envio de novas publicações e informações de contato.
                        </p>
                    </div>

                    <form action="{{route('site.contato.salvar')}}" method="post" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nome -->
                            <div>
                                <label for="first" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nome <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6F2E2F] focus:border-transparent transition-all duration-300 @error('nome') border-red-500 @enderror" 
                                    name="nome" 
                                    value="{{old('nome')}}" 
                                    id="first"
                                    placeholder="Insira seu nome">
                                @if($errors->has('nome'))
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('nome') }}
                                    </p>
                                @endif
                            </div>

                            <!-- Sobrenome -->
                            <div>
                                <label for="last" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Sobrenome <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6F2E2F] focus:border-transparent transition-all duration-300 @error('sobrenome') border-red-500 @enderror" 
                                    value="{{old('sobrenome')}}" 
                                    name="sobrenome" 
                                    id="last"
                                    placeholder="Insira seu sobrenome">
                                @if($errors->has('sobrenome'))
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('sobrenome') }}
                                    </p>
                                @endif
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6F2E2F] focus:border-transparent transition-all duration-300 @error('email') border-red-500 @enderror" 
                                    value="{{old('email')}}" 
                                    name="email" 
                                    id="email"
                                    placeholder="seu@email.com" 
                                    required="">
                                @if($errors->has('email'))
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </div>

                            <!-- Telefone -->
                            <div>
                                <label for="email2" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Telefone <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6F2E2F] focus:border-transparent transition-all duration-300 @error('telefone') border-red-500 @enderror" 
                                    value="{{old('telefone')}}" 
                                    name="telefone" 
                                    id="email2"
                                    placeholder="(44) 99999-9999" 
                                    required="">
                                @if($errors->has('telefone'))
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $errors->first('telefone') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Mensagem -->
                        <div>
                            <label for="comment" class="block text-sm font-semibold text-gray-700 mb-2">
                                Mensagem <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#6F2E2F] focus:border-transparent transition-all duration-300 resize-none @error('mensagem') border-red-500 @enderror" 
                                id="comment" 
                                name="mensagem" 
                                rows="5" 
                                placeholder="Digite sua mensagem aqui..."
                                required="">{{old('mensagem')}}</textarea>
                            @if($errors->has('mensagem'))
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $errors->first('mensagem') }}
                                </p>
                            @endif
                        </div>

                        <input type="hidden" name="status" value="pendente">

                        <!-- Botão -->
                        <div>
                            <button class="w-full md:w-auto px-8 py-3 bg-gradient-to-r from-[#6F2E2F] to-[#5D2728] text-white font-semibold rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2" 
                                type="submit">
                                <span>Enviar Mensagem</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Informações de Contato -->
            <div class="lg:col-span-5">
                <div class="bg-gradient-to-br from-[#6F2E2F] to-[#5D2728] rounded-2xl shadow-xl p-8 md:p-10 text-white h-full">
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-3xl md:text-4xl font-bold mb-3 text-white">Vamos conversar</h2>
                            <p class="text-gray-200 leading-relaxed">
                                Estamos abertos para qualquer sugestão ou apenas para conversar
                            </p>
                        </div>

                        <div class="space-y-6 mt-10">
                            <!-- Endereço -->
                            <div class="flex gap-4 items-start group hover:translate-x-2 transition-transform duration-300">
                                <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-amber-500 transition-colors duration-300">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg mb-1 text-white">Endereço</h4>
                                    <p class="text-gray-200">Cruzeiro do Oeste/PR</p>
                                </div>
                            </div>

                            <!-- Telefone -->
                            <div class="flex gap-4 items-start group hover:translate-x-2 transition-transform duration-300">
                                <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-amber-500 transition-colors duration-300">
                                    <i class="fas fa-phone-alt text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg mb-1 text-white">Telefone</h4>
                                    <p class="text-gray-200">(44) 9974-7097</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex gap-4 items-start group hover:translate-x-2 transition-transform duration-300">
                                <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-amber-500 transition-colors duration-300">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg mb-1 text-white">Email</h4>
                                    <p class="text-gray-200 break-all">jurandiraparecido19651965@gmail.com</p>
                                </div>
                            </div>
                        </div>

                        <!-- Redes Sociais -->
                        <div class="pt-8 mt-8 border-t border-white/20">
                            <p class="text-sm text-gray-200 mb-4">Siga-nos nas redes sociais</p>
                            <div class="flex gap-3">
                                <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-amber-500 hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-amber-500 hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-amber-500 hover:scale-110 transition-all duration-300">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>