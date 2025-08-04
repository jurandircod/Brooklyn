<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard de Suporte</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            color: #666;
            font-size: 1.1rem;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .stat-card.total i { color: #3498db; }
        .stat-card.pending i { color: #f39c12; }
        .stat-card.resolved i { color: #27ae60; }
        .stat-card.urgent i { color: #e74c3c; }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 30px;
        }

        .contacts-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .filters {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background: #f8f9fa;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .filter-btn.active {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .search-box {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #eee;
            border-radius: 15px;
            font-size: 1rem;
            margin-bottom: 25px;
            transition: border-color 0.3s ease;
        }

        .search-box:focus {
            outline: none;
            border-color: #667eea;
        }

        .contact-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-left: 4px solid #ddd;
        }

        .contact-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .contact-card.pending { border-left-color: #f39c12; }
        .contact-card.resolved { border-left-color: #27ae60; }
        .contact-card.urgent { border-left-color: #e74c3c; }

        .contact-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .contact-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
        }

        .contact-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-resolved {
            background: #d4edda;
            color: #155724;
        }

        .status-urgent {
            background: #f8d7da;
            color: #721c24;
        }

        .contact-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .contact-detail {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
        }

        .contact-detail i {
            width: 16px;
            color: #667eea;
        }

        .contact-message {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            font-style: italic;
            color: #555;
        }

        .contact-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-success {
            background: #27ae60;
            color: white;
        }

        .btn-warning {
            background: #f39c12;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .response-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-height: 80vh;
            overflow-y: auto;
        }

        .response-form {
            display: none;
        }

        .response-form.active {
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-textarea {
            min-height: 150px;
            resize: vertical;
        }

        .response-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #ddd;
        }

        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .contact-info {
                grid-template-columns: 1fr;
            }
            
            .filters {
                justify-content: center;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header fade-in">
            <h1><i class="fas fa-headset"></i> Dashboard de Suporte</h1>
            <p>Gerencie e responda aos contatos de seus clientes</p>
        </div>

        <div class="stats fade-in">
            <div class="stat-card total">
                <i class="fas fa-envelope"></i>
                <div class="stat-number" id="totalContacts">0</div>
                <div class="stat-label">Total de Contatos</div>
            </div>
            <div class="stat-card pending">
                <i class="fas fa-clock"></i>
                <div class="stat-number" id="pendingContacts">0</div>
                <div class="stat-label">Pendentes</div>
            </div>
            <div class="stat-card resolved">
                <i class="fas fa-check-circle"></i>
                <div class="stat-number" id="resolvedContacts">0</div>
                <div class="stat-label">Resolvidos</div>
            </div>
            <div class="stat-card urgent">
                <i class="fas fa-exclamation-triangle"></i>
                <div class="stat-number" id="urgentContacts">0</div>
                <div class="stat-label">Urgentes</div>
            </div>
        </div>

        <div class="main-content fade-in">
            <div class="contacts-section">
                <div class="section-header">
                    <h2 class="section-title">Contatos Recebidos</h2>
                </div>

                <input type="text" class="search-box" placeholder="🔍 Pesquisar por nome, email ou telefone..." id="searchInput">

                <div class="filters">
                    <button class="filter-btn active" data-filter="all">Todos</button>
                    <button class="filter-btn" data-filter="pending">Pendentes</button>
                    <button class="filter-btn" data-filter="resolved">Respondidos</button>
                    <button class="filter-btn" data-filter="urgent">Urgentes</button>
                </div>

                <div id="contactsList">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>Nenhum contato encontrado</h3>
                        <p>Os contatos aparecerão aqui quando forem recebidos</p>
                    </div>
                </div>
            </div>

            <div class="response-panel">
                <h2 class="section-title">Responder Contato</h2>
                
                <div id="noSelection" class="empty-state">
                    <i class="fas fa-comment-dots"></i>
                    <h3>Selecione um contato</h3>
                    <p>Escolha um contato da lista para enviar uma resposta</p>
                </div>

                <div id="responseForm" class="response-form">
                    <div class="form-group">
                        <label class="form-label">Para:</label>
                        <input type="text" class="form-input" id="recipientName" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-input" id="recipientEmail" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Assunto:</label>
                        <input type="text" class="form-input" id="responseSubject" placeholder="Re: Sua mensagem de contato">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Mensagem:</label>
                        <textarea class="form-input form-textarea" id="responseMessage" placeholder="Digite sua resposta aqui..."></textarea>
                    </div>
                    
                    <div class="response-actions">
                        <button class="btn btn-primary" onclick="sendResponse()">
                            <i class="fas fa-paper-plane"></i> Enviar Resposta
                        </button>
                        <button class="btn btn-success" onclick="markAsResolved()">
                            <i class="fas fa-check"></i> Marcar como Resolvido
                        </button>
                        <button class="btn btn-warning" onclick="clearForm()">
                            <i class="fas fa-times"></i> Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Configuração CSRF para Laravel
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        
        // Variáveis globais
        let contacts = [];

        // Adicionar função updateStats para compatibilidade
        function updateStats() {
            loadStats();
        }

        // Função para carregar contatos do servidor
        async function loadContacts() {
            try {
                const response = await fetch("{{route('admin.suporte.api.contatos')}}", {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                if (!response.ok) throw new Error('Erro ao carregar contatos');
                
                const result = await response.json();
                if (result.success) {
                    contacts = result.data.map(contact => ({
                        ...contact,
                        status: contact.status === 'pendente' ? 'pending' : 
                                contact.status === 'resolvido' ? 'resolved' : 'urgent'
                    }));
                    updateStats();
                    filterContacts(currentFilter);
                } else {
                    console.error('Erro:', result.message);
                }
            } catch (error) {
                console.error('Erro ao carregar contatos:', error);
            }
        }

        // Função para carregar estatísticas
        async function loadStats() {
            try {
                const response = await fetch("{{route('admin.suporte.api.estatisticas')}}", {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                if (!response.ok) throw new Error('Erro ao carregar estatísticas');
                
                const result = await response.json();
                if (result.success) {
                    const stats = result.data;
                    document.getElementById('totalContacts').textContent = stats.total;
                    document.getElementById('pendingContacts').textContent = stats.pendentes;
                    document.getElementById('resolvedContacts').textContent = stats.resolvidos;
                    document.getElementById('urgentContacts').textContent = stats.urgentes;
                }
            } catch (error) {
                console.error('Erro ao carregar estatísticas:', error);
            }
        }

        function getStatusLabel(status) {
            const labels = {
                'pending': 'Pendente',
                'resolved': 'Resolvido',
                'urgent': 'Urgente'
            };
            return labels[status] || status;
        }

        function renderContacts(contactsToRender = contacts) {
            const contactsList = document.getElementById('contactsList');
            
            if (contactsToRender.length === 0) {
                contactsList.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>Nenhum contato encontrado</h3>
                        <p>Nenhum contato corresponde aos filtros aplicados</p>
                    </div>
                `;
                return;
            }

            contactsList.innerHTML = contactsToRender.map(contact => `
                <div class="contact-card ${contact.status}" data-id="${contact.id}">
                    <div class="contact-header">
                        <div class="contact-name">${contact.name}</div>
                        <div class="contact-status status-${contact.status}">
                            ${getStatusLabel(contact.status)}
                        </div>
                    </div>
                    
                    <div class="contact-info">
                        <div class="contact-detail">
                            <i class="fas fa-envelope"></i>
                            <span>${contact.email}</span>
                        </div>
                        <div class="contact-detail">
                            <i class="fas fa-phone"></i>
                            <span>${contact.phone}</span>
                        </div>
                        <div class="contact-detail">
                            <i class="fas fa-calendar"></i>
                            <span>${contact.date}</span>
                        </div>
                        <div class="contact-detail">
                            <i class="fas fa-clock"></i>
                            <span>${contact.time}</span>
                        </div>
                    </div>
                    
                    <div class="contact-message">
                        "${contact.message}"
                    </div>
                    
                    <div class="contact-actions">
                        <button class="btn btn-primary" onclick="selectContact(${contact.id})">
                            <i class="fas fa-reply"></i> Responder
                        </button>
                        ${contact.status !== 'resolved' ? `
                            <button class="btn btn-success" onclick="quickResolve(${contact.id})">
                                <i class="fas fa-check"></i> Resolver
                            </button>
                        ` : ''}
                        ${contact.status !== 'urgent' ? `
                            <button class="btn btn-danger" onclick="markAsUrgent(${contact.id})">
                                <i class="fas fa-exclamation"></i> Urgente
                            </button>
                        ` : ''}
                    </div>
                </div>
            `).join('');
        }

        function selectContact(contactId) {
            currentContact = contacts.find(c => c.id === contactId);
            
            if (currentContact) {
                document.getElementById('noSelection').style.display = 'none';
                document.getElementById('responseForm').classList.add('active');
                
                document.getElementById('recipientName').value = currentContact.name;
                document.getElementById('recipientEmail').value = currentContact.email;
                document.getElementById('responseSubject').value = `Re: Sua mensagem de contato`;
                document.getElementById('responseMessage').value = `Olá ${currentContact.name},\n\nObrigado por entrar em contato conosco.\n\n`;
            }
        }

        function sendResponse() {
            if (!currentContact) return;
            
            const subject = document.getElementById('responseSubject').value;
            const message = document.getElementById('responseMessage').value;
            
            if (!subject || !message) {
                alert('Por favor, preencha todos os campos da resposta.');
                return;
            }
            
            // Desabilitar botão durante o envio
            const sendBtn = document.querySelector('.btn-primary');
            const originalText = sendBtn.innerHTML;
            sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
            sendBtn.disabled = true;
            
            // Enviar via AJAX
            fetch("{{route('admin.suporte.api.resposta')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    contato_id: currentContact.id,
                    assunto: subject,
                    mensagem: message
                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Resposta enviada com sucesso!');
                    loadContacts();
                    loadStats();
                    clearForm();
                } else {
                    alert('Erro ao enviar resposta: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao enviar resposta. Tente novamente.');
            })
            .finally(() => {
                sendBtn.innerHTML = originalText;
                sendBtn.disabled = false;
            });
        }

        function markAsResolved() {
            if (!currentContact) return;
            
            updateContactStatus(currentContact.id, 'resolvido');
        }

        function quickResolve(contactId) {
            updateContactStatus(contactId, 'resolvido');
        }

        function markAsUrgent(contactId) {
            updateContactStatus(contactId, 'urgente');
        }

        // Função para atualizar status via AJAX
        async function updateContactStatus(contactId, status) {
            try {
                const response = await fetch("{{route('admin.suporte.api.status')}}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        contato_id: contactId,
                        status: status
                    })
                });
                
                const result = await response.json();
                if (result.success) {
                    loadContacts();
                    loadStats();
                    if (currentContact && currentContact.id === contactId) {
                        clearForm();
                    }
                } else {
                    alert('Erro ao atualizar status: ' + result.message);
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro ao atualizar status. Tente novamente.');
            }
        }

        function clearForm() {
            currentContact = null;
            document.getElementById('noSelection').style.display = 'block';
            document.getElementById('responseForm').classList.remove('active');
            document.getElementById('responseSubject').value = '';
            document.getElementById('responseMessage').value = '';
        }

        function filterContacts(status) {
            currentFilter = status;
            
            // Atualizar botões ativos
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`[data-filter="${status}"]`).classList.add('active');
            
            // Realizar busca no servidor com filtro
            const searchTerm = document.getElementById('searchInput').value;
            performServerSearch(searchTerm, status);
        }

        function searchContacts() {
            const searchTerm = document.getElementById('searchInput').value;
            
            // Fazer busca no servidor se houver termo de pesquisa
            if (searchTerm.length > 2 || searchTerm.length === 0) {
                performServerSearch(searchTerm, currentFilter);
            }
        }

        // Função para realizar busca no servidor
        async function performServerSearch(termo, status) {
            try {
                const url = new URL("{{route('admin.suporte.api.buscar')}}", window.location.origin);
                url.searchParams.append('termo', termo);
                url.searchParams.append('status', status === 'all' ? 'all' : 
                                       status === 'pending' ? 'pendente' : 
                                       status === 'resolved' ? 'resolvido' : 'urgente');
                
                const response = await fetch(url, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });
                
                if (!response.ok) throw new Error('Erro na busca');
                
                const result = await response.json();
                if (result.success) {
                    const searchResults = result.data.map(contact => ({
                        ...contact,
                        status: contact.status === 'pendente' ? 'pending' : 
                                contact.status === 'resolvido' ? 'resolved' : 'urgent'
                    }));
                    renderContacts(searchResults);
                } else {
                    console.error('Erro na busca:', result.message);
                }
            } catch (error) {
                console.error('Erro na busca:', error);
            }
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Carregar dados iniciais
            loadContacts();
            loadStats();
            
            // Filtros
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const filter = this.getAttribute('data-filter');
                    filterContacts(filter);
                });
            });
            
            // Pesquisa com debounce
            let searchTimeout;
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(searchContacts, 300);
            });
        });

        // Atualizar dados a cada 30 segundos
        setInterval(() => {
            loadContacts();
            loadStats();
        }, 30000);
    </script>
</body>
</html>