<!-- Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<!-- Seção PIX QR Code -->
<section class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 flex items-center justify-center p-4 w-full md:w-3/4 lg:w-2/3 mx-auto">
  <div class="w-full">
    <!-- Container Principal -->
    <div class="bg-white rounded-3xl shadow-2xl p-8 transform transition-all duration-500 hover:scale-105">
      <!-- Header -->
      <div class="text-center mb-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
          </svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Pagamento PIX</h2>
        <p class="text-gray-600">Escaneie o código QR para finalizar sua compra</p>
      </div>

      <!-- QR Code Container -->
      <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-6 mb-6 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 animate-gradient"></div>
        
        <!-- QR Code Placeholder -->
        <div id="qr-container" class="bg-white rounded-xl p-4 flex items-center justify-center min-h-[280px] relative">
          <div id="qr-placeholder" class="text-center">
            <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-r from-blue-200 to-purple-200 rounded-full flex items-center justify-center animate-spin">
              <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
              </svg>
            </div>
            <p class="text-gray-500 font-medium">Gerando código QR...</p>
            <p class="text-sm text-gray-400 mt-1">Aguarde um momento</p>
          </div>
          
          <!-- QR Code aparecerá aqui -->
          <div id="qr-code" class="hidden">
            <img id="qr-image" class="w-full max-w-[250px] mx-auto rounded-lg shadow-lg" alt="Código QR PIX">
          </div>
        </div>
      </div>

      <!-- Informações do Pagamento -->
      <div class="space-y-4 mb-6">
        <div class="bg-blue-50 rounded-xl p-4 border-l-4 border-blue-500">
          <div class="flex justify-between items-center">
            <span class="text-gray-600 font-medium">Valor:</span>
            <span id="payment-amount" class="text-2xl font-bold text-blue-600">R$ 0,00</span>
          </div>
        </div>
        
        <div class="bg-green-50 rounded-xl p-4 border-l-4 border-green-500">
          <div class="flex justify-between items-center">
            <span class="text-gray-600 font-medium">Chave PIX:</span>
            <button id="copy-key-btn" class="text-green-600 font-mono text-sm hover:bg-green-100 px-2 py-1 rounded transition-colors">
              <span id="pix-key">carregando...</span>
              <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Instruções -->
      <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-4 mb-6">
        <h3 class="font-semibold text-gray-800 mb-2 flex items-center">
          <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          Como pagar
        </h3>
        <ol class="text-sm text-gray-600 space-y-1">
          <li>1. Abra o app do seu banco</li>
          <li>2. Escolha a opção PIX</li>
          <li>3. Escaneie o código QR</li>
          <li>4. Confirme o pagamento</li>
        </ol>
      </div>

      <!-- Botões de Ação -->
      <div class="space-y-3">
        <button id="copy-qr-btn" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
          Copiar Código PIX
        </button>
        
        <button id="refresh-qr-btn" class="w-full border-2 border-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl hover:bg-gray-50 transition-all duration-300">
          Atualizar Código QR
        </button>
      </div>

      <!-- Status do Pagamento -->
      <div id="payment-status" class="mt-6 text-center">
        <div class="flex items-center justify-center space-x-2 text-orange-600">
          <div class="w-2 h-2 bg-orange-400 rounded-full animate-pulse"></div>
          <span class="text-sm font-medium">Aguardando pagamento...</span>
        </div>
      </div>
    </div>

    <!-- Floating Action Button para suporte -->
    <button class="fixed bottom-6 right-6 bg-gradient-to-r from-green-500 to-emerald-500 text-white p-4 rounded-full shadow-2xl hover:scale-110 transition-transform duration-300 z-10">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
      </svg>
    </button>
  </div>
</section>

<style>
  @keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
  }
  
  .animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
  }
  
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .fade-in-up {
    animation: fadeInUp 0.6s ease-out;
  }
</style>

<script>
// Simular dados do PIX
const pixData = {
  amount: "{{ $valor }}",
  pixKey: "{{ $qr_code }}",
  qrCode: "{{ $qr_code_base64 }}" // placeholder
};

// Função para simular carregamento do QR Code
function loadQRCode() {
  const placeholder = document.getElementById('qr-placeholder');
  const qrCode = document.getElementById('qr-code');
  const qrImage = document.getElementById('qr-image');
  
  setTimeout(() => {
    placeholder.classList.add('hidden');
    qrImage.src = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=' + encodeURIComponent('PIX QR Code - ' + pixData.amount);
    qrCode.classList.remove('hidden');
    qrCode.classList.add('fade-in-up');
  }, 2000);
}

// Função para copiar chave PIX
function copyPixKey() {
  const pixKey = document.getElementById('pix-key').textContent;
  navigator.clipboard.writeText(pixKey).then(() => {
    showNotification('Chave PIX copiada!', 'success');
  });
}

// Função para copiar código QR (em implementação real, seria o código PIX)
function copyQRCode() {
  const pixCode = 'PIX CODE AQUI'; // Substitua pelo código PIX real
  navigator.clipboard.writeText(pixCode).then(() => {
    showNotification('Código PIX copiado!', 'success');
  });
}

// Função para mostrar notificações
function showNotification(message, type) {
  const notification = document.createElement('div');
  notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg text-white font-medium transform transition-all duration-300 ${
    type === 'success' ? 'bg-green-500' : 'bg-red-500'
  }`;
  notification.textContent = message;
  notification.style.transform = 'translateX(400px)';
  
  document.body.appendChild(notification);
  
  setTimeout(() => {
    notification.style.transform = 'translateX(0)';
  }, 100);
  
  setTimeout(() => {
    notification.style.transform = 'translateX(400px)';
    setTimeout(() => {
      document.body.removeChild(notification);
    }, 300);
  }, 3000);
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
  // Carregar dados do PIX
  document.getElementById('payment-amount').textContent = pixData.amount;
  document.getElementById('pix-key').textContent = pixData.pixKey;
  
  // Carregar QR Code
  loadQRCode();
  
  // Botão copiar chave PIX
  document.getElementById('copy-key-btn').addEventListener('click', copyPixKey);
  
  // Botão copiar código QR
  document.getElementById('copy-qr-btn').addEventListener('click', copyQRCode);
  
  // Botão atualizar QR
  document.getElementById('refresh-qr-btn').addEventListener('click', function() {
    const qrCode = document.getElementById('qr-code');
    const placeholder = document.getElementById('qr-placeholder');
    
    qrCode.classList.add('hidden');
    placeholder.classList.remove('hidden');
    
    loadQRCode();
    showNotification('QR Code atualizado!', 'success');
  });
  
  // Simular mudança de status do pagamento (para demonstração)
  setTimeout(() => {
    const status = document.getElementById('payment-status');
    status.innerHTML = `
      <div class="flex items-center justify-center space-x-2 text-green-600">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <span class="text-sm font-medium">Pagamento confirmado!</span>
      </div>
    `;
  }, 15000); // Simula pagamento após 15 segundos
});
</script>