<footer class="mt-16 bg-gradient-to-br from-[#6F2E2F] to-[#5D2728] text-gray-100">
    <!-- MAIN -->
    <div class="container mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
            <!-- Contato -->
            <div class="space-y-6">
                <img src="assets/images/logo.png" class="w-36 mb-6 hover:scale-105 transition-transform duration-300" alt="logo">
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-phone text-amber-400 mt-1"></i>
                        <div>
                            <span class="font-semibold text-gray-200">Telefone:</span>
                            <p class="text-gray-300">(44) 9974-7097</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-amber-400 mt-1"></i>
                        <div>
                            <span class="font-semibold text-gray-200">Endereço:</span>
                            <p class="text-gray-300">Cruzeiro do Oeste/PR</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-envelope text-amber-400 mt-1"></i>
                        <div>
                            <span class="font-semibold text-gray-200">Email:</span>
                            <p class="text-gray-300 break-all">jurandiraparecido19651965@gmail.com</p>
                        </div>
                    </li>
                </ul>
            </div>
            
            <!-- Links -->
            <div>
                <h3 class="text-xl font-bold mb-6 text-white relative inline-block">
                    Sobre Nós
                    <span class="absolute bottom-0 left-0 w-12 h-1 bg-amber-400 rounded-full"></span>
                </h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="/" class="hover:text-amber-400 hover:translate-x-1 inline-block transition-all duration-300">→ Início</a></li>
                    <li><a href="/pesquisa/produtos" class="hover:text-amber-400 hover:translate-x-1 inline-block transition-all duration-300">→ Produtos</a></li>
                    <li><a href="/sobre" class="hover:text-amber-400 hover:translate-x-1 inline-block transition-all duration-300">→ Sobre Nós</a></li>
                    <li><a href="/contato" class="hover:text-amber-400 hover:translate-x-1 inline-block transition-all duration-300">→ Contato</a></li>
                </ul>
            </div>
            
            <!-- Categorias -->
            <div>
                <h3 class="text-xl font-bold mb-6 text-white relative inline-block">
                    Categorias
                    <span class="absolute bottom-0 left-0 w-12 h-1 bg-amber-400 rounded-full"></span>
                </h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="shop.html" class="hover:text-amber-400 hover:translate-x-1 inline-block transition-all duration-300">→ Últimos Oversizeds</a></li>
                    <li><a href="shop.html" class="hover:text-amber-400 hover:translate-x-1 inline-block transition-all duration-300">→ Novos Jeans</a></li>
                    <li><a href="shop.html" class="hover:text-amber-400 hover:translate-x-1 inline-block transition-all duration-300">→ Novos Skates</a></li>
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div>
                <h3 class="text-xl font-bold mb-6 text-white relative inline-block">
                    Fique em Contato
                    <span class="absolute bottom-0 left-0 w-12 h-1 bg-amber-400 rounded-full"></span>
                </h3>
                <div class="flex items-stretch bg-white/10 backdrop-blur-sm rounded-lg overflow-hidden mb-4 shadow-lg border border-white/20 hover:border-amber-400/50 transition-all duration-300">
                    <input type="text" placeholder="Seu Email"
                        class="w-full bg-transparent px-4 py-3 text-sm placeholder-gray-400 focus:outline-none text-white">
                    <button class="px-5 bg-amber-500 hover:bg-amber-600 transition-colors duration-300 text-white">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                <p class="text-sm text-gray-300 leading-relaxed">
                    Fique atualizado com as nossas últimas notícias e ofertas especiais.
                </p>
                <!-- Redes Sociais -->
                <div class="flex gap-3 mt-6">
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-amber-500 hover:scale-110 transition-all duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-amber-500 hover:scale-110 transition-all duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-amber-500 hover:scale-110 transition-all duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- SUB FOOTER -->
    <div class="bg-black/20 backdrop-blur-sm py-6 border-t border-white/10">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <!-- Pagamentos -->
            <div class="flex items-center gap-4 flex-wrap justify-center md:justify-start">
                <span class="text-sm font-medium">Nós aceitamos:</span>
                <img src="{{asset('images/payment-icon/1.jpg')}}" class="h-8 opacity-90 hover:opacity-100 transition-opacity rounded" alt="">
                <img src="{{asset('images/payment-icon/2.jpg')}}" class="h-8 opacity-90 hover:opacity-100 transition-opacity rounded" alt="">
                <img src="{{asset('images/payment-icon/3.jpg')}}" class="h-8 opacity-90 hover:opacity-100 transition-opacity rounded" alt="">
                <img src="{{asset('images/payment-icon/4.jpg')}}" class="h-8 opacity-90 hover:opacity-100 transition-opacity rounded" alt="">
            </div>
            <!-- Copyright -->
            <p class="text-sm text-gray-300">© 2024, <span class="font-semibold text-white">Brooklyn SkateShop</span>. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>