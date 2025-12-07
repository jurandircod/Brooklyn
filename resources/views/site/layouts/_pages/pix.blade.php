<!-- resources/views/site/pix.blade.php (ou substitua o conteúdo atual) -->
<style>
    /* cor base fornecida */
    :root { --brand: #5A1F2D; }
    .brand-bg { background: linear-gradient(90deg, rgba(90,31,45,1) 0%, rgba(40,20,30,0.9) 100%); }
    .brand { color: var(--brand); }
    .btn-brand { background: var(--brand); }
    .shadow-soft { box-shadow: 0 6px 30px rgba(90,31,45,0.12); }
</style>

<div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl p-6 shadow-soft">
            <!-- Cabeçalho pequeno -->
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-lg brand-bg flex items-center justify-center text-white">
                    <svg class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M12 8v8M8 12h8"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-semibold text-gray-800">Pagamento PIX</h1>
                    <p class="text-xs text-gray-500">Escaneie o QR ou copie o código</p>
                </div>
            </div>

            <!-- Quantia -->
            <div class="mb-4">
                <div class="flex items-baseline justify-between">
                    <div class="text-sm text-gray-500">Valor</div>
                    <div class="text-2xl font-extrabold brand">{{ $pixData['amount'] ?? 'R$ 0,00' }}</div>
                </div>
            </div>

            <!-- QR card -->
            <div class="bg-gray-50 rounded-xl p-4 mb-4 flex items-center justify-center">
                <div id="qr-wrap" class="text-center w-full">
                    <!-- Placeholder / carregando -->
                    <div id="qr-placeholder" class="text-gray-400">
                        <div class="w-40 h-40 rounded-lg bg-white flex items-center justify-center mx-auto mb-2 shadow">
                            <svg class="w-10 h-10 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582M20 20v-5h-.582"></path>
                            </svg>
                        </div>
                        <div class="text-xs">Gerando QR…</div>
                    </div>

                    <div id="qr-image-wrap" class="hidden">
                        <img id="qr-image" class="w-40 h-40 mx-auto rounded-md shadow" alt="QR Code PIX">
                    </div>
                </div>
            </div>

            <!-- Ações compactas -->
            <div class="flex gap-2 mb-4">
                <button id="copy-qr-btn" class="flex-1 py-2 rounded-lg text-white font-medium btn-brand">Copiar código</button>
                <button id="copy-key-btn" class="flex-1 py-2 rounded-lg border border-gray-200 text-sm text-gray-700">Copiar chave</button>
            </div>

            <!-- Chave PIX (discreta) -->
            <div class="text-center text-xs text-gray-500 mb-3">
                <div>Chave PIX</div>
                <div id="pix-key" class="font-mono text-sm text-gray-700 break-all mt-1">—</div>
            </div>

            <!-- Observação curta -->
            <div class="text-center text-xs text-gray-400">
                Abra o app do banco → PIX → Escanear QR. Pagamentos costumam aparecer rápido, mas pode variar por banco.
            </div>
        </div>
    </div>
</div>

<script>
/*
  pixData: dados vindos do backend (ex.: id, amount, pix_copia_cola, qr_code_base64, ticket_url, etc.)
  pedidoId: tenta pegar de $pedidoId passado pelo controller, ou de external_reference/pedido_id dentro do pixData
*/
const pixData = {!! json_encode($pixData) !!};
const pedidoId = {!! json_encode($pedidoId ?? data_get($pixData, 'external_reference') ?? data_get($pixData, 'pedido_id') ?? null) !!};
console.log(pedidoId);


// Normalize quick-access props
pixData.pix_key = pixData.pix_copia_cola ?? pixData.ticket_url ?? pixData.pix_key ?? null;
pixData.qr_code_base64 = pixData.qr_code_base64 ?? pixData.qr_code ?? null; // alguns retornos usam qr_code

function isBase64Image(str) {
    if (!str || typeof str !== 'string') return false;
    return /^data:image\/[a-zA-Z]+;base64,/.test(str) || /^[A-Za-z0-9+/=\r\n]+$/.test(str);
}

function showQRFromBase64(b64) {
    const img = document.getElementById('qr-image');
    if (/^data:image\/[a-zA-Z]+;base64,/.test(b64)) {
        img.src = b64;
    } else {
        img.src = 'data:image/png;base64,' + b64.replace(/\r?\n|\r/g, '');
    }
    document.getElementById('qr-placeholder').classList.add('hidden');
    document.getElementById('qr-image-wrap').classList.remove('hidden');
}

function showQRFromPayload(payload) {
    const img = document.getElementById('qr-image');
    const qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=' + encodeURIComponent(payload);
    img.src = qrUrl;
    document.getElementById('qr-placeholder').classList.add('hidden');
    document.getElementById('qr-image-wrap').classList.remove('hidden');
}

function showInvalidQR() {
    document.getElementById('qr-placeholder').innerHTML =
        '<div class="text-sm text-gray-400">QR inválido</div>';
}

// Inicialização da UI do QR e botões
function init() {
    // Exibir chave
    document.getElementById('pix-key').textContent = pixData.pix_key || '—';

    // Carregar QR: tenta base64 primeiro, depois payload (copia-e-cola) e por último fallback
    const b64 = pixData.qr_code_base64 || null;
    const payload = pixData.payload || pixData.pix_copia_cola || pixData.payload_qr || null;

    if (b64 && b64.length > 50 && /^[A-Za-z0-9+/=\r\n]+$/.test(b64)) {
        showQRFromBase64(b64);
    } else if (b64 && /^data:image\/[a-zA-Z]+;base64,/.test(b64)) {
        showQRFromBase64(b64);
    } else if (payload && payload.length > 10) {
        showQRFromPayload(payload);
    } else {
        showInvalidQR();
    }

    // copiar chave
    document.getElementById('copy-key-btn').addEventListener('click', function() {
        const txt = pixData.pix_key || '';
        if (!txt) return showToast('Nada para copiar');
        navigator.clipboard.writeText(txt).then(() => showToast('Chave copiada'));
    });

    // copiar payload ou chave
    document.getElementById('copy-qr-btn').addEventListener('click', function() {
        let toCopy = pixData.payload || pixData.pix_key || '';
        if (!toCopy && pixData.qr_code_base64) toCopy = pixData.pix_key || pixData.qr_code_base64;
        if (!toCopy) return showToast('Nada para copiar');
        navigator.clipboard.writeText(toCopy).then(() => showToast('Código copiado'));
    });

    // inicia polling automaticamente se tivermos pedidoId
    if (pedidoId) {
        startPollingConfirmation();
    } else {
        // se não houver pedidoId, informa no console (não tenta polling)
        console.warn('Pedido ID não informado — polling desabilitado.');
    }
}

function showToast(message) {
    const el = document.createElement('div');
    el.className = 'fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-black text-white text-sm px-4 py-2 rounded-md';
    el.textContent = message;
    document.body.appendChild(el);
    setTimeout(() => el.remove(), 2200);
}

/* =====================
   Polling: checa o status do pedido
   ===================== */
const POLL_INTERVAL = 3000; // ms
const MAX_ATTEMPTS = 60;    // 60 * 3s = 3 minutos
let attempts = 0;
let pollTimer = null;

async function checkPaymentStatus() {
    attempts++;
    try {
        const res = await fetch(`/pedido/${pedidoId}/status`, {
            credentials: 'same-origin',
            headers: { 'Accept': 'application/json' }
        });

        if (res.status === 200) {
            const data = await res.json();
            const status = (data.status || '').toLowerCase();

            // ajuste conforme seus nomes (pago / paid / approved)
            if (status === 'pago' || status === 'paid' || status === 'approved') {
                clearInterval(pollTimer);
                onPaymentConfirmed(data);
                return;
            }

            // opcional: se quiser atualizar um texto de status, faça aqui
            // document.getElementById('some-status').textContent = data.status;
            return;
        } else if (res.status === 404) {
            clearInterval(pollTimer);
            showToast('Pedido não encontrado. Verifique em seus pedidos.');
            return;
        } else {
            // outros códigos HTTP -> apenas log
            console.warn('Resposta inesperada ao checar status:', res.status);
        }
    } catch (err) {
        console.error('Erro ao checar status do pedido:', err);
    }

    if (attempts >= MAX_ATTEMPTS) {
        clearInterval(pollTimer);
        showToast('Tempo de espera esgotado. Verifique seu pedido em "Meus pedidos" mais tarde.');
    }
}

function startPollingConfirmation() {
    // checa imediatamente e depois em intervalos
    checkPaymentStatus();
    pollTimer = setInterval(checkPaymentStatus, POLL_INTERVAL);
}

function onPaymentConfirmed(info) {
    // substitui o conteúdo do QR por mensagem de sucesso
    const wrap = document.getElementById('qr-wrap');
    wrap.innerHTML = `
      <div class="text-center p-4">
        <svg class="w-20 h-20 mx-auto text-green-600 mb-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M5 13l4 4L19 7"></path>
        </svg>
        <div class="text-lg font-semibold text-gray-800">Pagamento confirmado</div>
        <div class="text-sm text-gray-500 mt-1">Obrigado! Seu pedido foi confirmado.</div>
      </div>
    `;

    showToast('Pagamento confirmado!');

    // redireciona para página de confirmação/visualização do pedido (opcional)
    setTimeout(() => {
        // ajuste a rota conforme seu projeto
        window.location.href = `/perfil/confirmar/pedido/${pedidoId}`;
    }, 1400);
}

document.addEventListener('DOMContentLoaded', init);
</script>
