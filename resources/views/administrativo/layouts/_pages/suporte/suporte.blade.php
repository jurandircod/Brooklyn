
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/administrativo/suporte/suporte.css') }}">
</head>

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
                    <div class="pagination-info" id="paginationInfo">
                        Página 1 de 1 (0 contatos)
                    </div>
                </div>

                <input type="text" class="search-box" placeholder="🔍 Pesquisar por nome, email ou telefone..."
                    id="searchInput">

                <div class="filters">
                    <button class="filter-btn active" data-filter="all">Todos</button>
                    <button class="filter-btn" data-filter="pending">Pendentes</button>
                    <button class="filter-btn" data-filter="resolved">Respondidos</button>
                    <button class="filter-btn" data-filter="urgent">Urgentes</button>
                </div>

                <div class="loading-spinner" id="loadingSpinner">
                    <i class="fas fa-spinner"></i>
                    <p>Carregando contatos...</p>
                </div>

                <div id="contactsList">
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>Nenhum contato encontrado</h3>
                        <p>Os contatos aparecerão aqui quando forem recebidos</p>
                    </div>
                </div>

                <div class="pagination-container" id="paginationContainer" style="display: none;">
                    <div class="pagination-info-container">
                        <div class="page-size-selector">
                            <label>Mostrar:</label>
                            <select class="page-size-select" id="pageSizeSelect">
                                <option value="10">10 por página</option>
                                <option value="20" selected>20 por página</option>
                                <option value="50">50 por página</option>
                                <option value="100">100 por página</option>
                            </select>
                        </div>
                        <div class="pagination-info" id="paginationSummary">
                            Mostrando 1-20 de 100 contatos
                        </div>
                    </div>

                    <div class="pagination" id="pagination">
                        <!-- Paginação será gerada aqui -->
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
                        <input type="text" class="form-input" id="responseSubject"
                            placeholder="Re: Sua mensagem de contato">
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
        let currentContact = null;
        let currentFilter = 'all';
        let currentPage = 1;
        let pageSize = 20;
        let totalPages = 1;
        let totalContacts = 0;
        let isLoading = false;

        // Função para mostrar/esconder loading
        function showLoading(show = true) {
            const spinner = document.getElementById('loadingSpinner');
            const contactsList = document.getElementById('contactsList');

            if (show) {
                spinner.classList.add('active');
                contactsList.style.display = 'none';
            } else {
                spinner.classList.remove('active');
                contactsList.style.display = 'block';
            }
        }

        // Função para carregar contatos do servidor com paginação
        async function loadContacts(page = 1, size = pageSize, searchTerm = '', filter = 'all') {
            if (isLoading) return;

            isLoading = true;
            showLoading(true);

            try {
                const url = new URL("{{ route('admin.suporte.api.contatos') }}", window.location.origin);
                url.searchParams.append('page', page);
                url.searchParams.append('per_page', size);

                if (searchTerm) {
                    url.searchParams.append('search', searchTerm);
                }

                if (filter !== 'all') {
                    const statusMap = {
                        'pending': 'pendente',
                        'resolved': 'resolvido',
                        'urgent': 'urgente'
                    };
                    url.searchParams.append('status', statusMap[filter] || filter);
                }

                const response = await fetch(url, {
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Erro ao carregar contatos');

                const result = await response.json();
                if (result.success) {
                    // Assumindo que o backend retorna paginação no formato:
                    // { success: true, data: { data: [...], current_page: 1, last_page: 5, total: 100, per_page: 20 } }
                    const paginationData = result.data;

                    contacts = paginationData.data.map(contact => ({
                        ...contact,
                        status: contact.status === 'pendente' ? 'pending' : contact.status === 'resolvido' ?
                            'resolved' : 'urgent'
                    }));

                    currentPage = paginationData.current_page || page;
                    totalPages = paginationData.last_page || 1;
                    totalContacts = paginationData.total || 0;
                    pageSize = paginationData.per_page || size;

                    renderContacts(contacts);
                    updatePaginationInfo();
                    renderPagination();

                } else {
                    console.error('Erro:', result.message);
                    renderContacts([]);
                }
            } catch (error) {
                console.error('Erro ao carregar contatos:', error);
                renderContacts([]);
            } finally {
                isLoading = false;
                showLoading(false);
            }
        }

        // Função para carregar estatísticas (mantida igual)
        async function loadStats() {
            try {
                const response = await fetch("{{ route('admin.suporte.api.estatisticas') }}", {
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

        // Função para atualizar informações da paginação
        function updatePaginationInfo() {
            const paginationInfo = document.getElementById('paginationInfo');
            const paginationSummary = document.getElementById('paginationSummary');
            const paginationContainer = document.getElementById('paginationContainer');

            paginationInfo.textContent = `Página ${currentPage} de ${totalPages} (${totalContacts} contatos)`;

            const startItem = ((currentPage - 1) * pageSize) + 1;
            const endItem = Math.min(currentPage * pageSize, totalContacts);

            if (totalContacts > 0) {
                paginationSummary.textContent = `Mostrando ${startItem}-${endItem} de ${totalContacts} contatos`;
                paginationContainer.style.display = totalPages > 1 ? 'flex' : 'none';
            } else {
                paginationSummary.textContent = 'Nenhum contato encontrado';
                paginationContainer.style.display = 'none';
            }
        }

        // Função para renderizar a paginação
        function renderPagination() {
            const pagination = document.getElementById('pagination');

            if (totalPages <= 1) {
                pagination.innerHTML = '';
                return;
            }

            let paginationHTML = '';

            // Botão Anterior
            paginationHTML += `
                <button class="pagination-btn ${currentPage <= 1 ? 'disabled' : ''}" 
                        onclick="changePage(${currentPage - 1})" 
                        ${currentPage <= 1 ? 'disabled' : ''}>
                    <i class="fas fa-chevron-left"></i>
                </button>
            `;

            // Lógica para mostrar páginas
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, currentPage + 2);

            // Ajustar para sempre mostrar 5 páginas quando possível
            if (endPage - startPage < 4) {
                if (startPage === 1) {
                    endPage = Math.min(totalPages, startPage + 4);
                } else {
                    startPage = Math.max(1, endPage - 4);
                }
            }

            // Primeira página se não estiver no range
            if (startPage > 1) {
                paginationHTML += `
                    <button class="pagination-btn" onclick="changePage(1)">1</button>
                `;
                if (startPage > 2) {
                    paginationHTML += `<span class="pagination-ellipsis">...</span>`;
                }
            }

            // Páginas no range
            for (let i = startPage; i <= endPage; i++) {
                paginationHTML += `
                    <button class="pagination-btn ${i === currentPage ? 'active' : ''}" 
                            onclick="changePage(${i})">${i}</button>
                `;
            }

            // Última página se não estiver no range
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    paginationHTML += `<span class="pagination-ellipsis">...</span>`;
                }
                paginationHTML += `
                    <button class="pagination-btn" onclick="changePage(${totalPages})">${totalPages}</button>
                `;
            }

            // Botão Próximo
            paginationHTML += `
                <button class="pagination-btn ${currentPage >= totalPages ? 'disabled' : ''}" 
                        onclick="changePage(${currentPage + 1})" 
                        ${currentPage >= totalPages ? 'disabled' : ''}>
                    <i class="fas fa-chevron-right"></i>
                </button>
            `;

            pagination.innerHTML = paginationHTML;
        }

        // Função para mudar de página
        function changePage(page) {
            if (page < 1 || page > totalPages || page === currentPage || isLoading) return;

            const searchTerm = document.getElementById('searchInput').value;
            loadContacts(page, pageSize, searchTerm, currentFilter);
        }

        // Função para mudar tamanho da página
        function changePageSize(newSize) {
            pageSize = parseInt(newSize);
            currentPage = 1; // Resetar para primeira página

            const searchTerm = document.getElementById('searchInput').value;
            loadContacts(currentPage, pageSize, searchTerm, currentFilter);
        }

        function getStatusLabel(status) {
            const labels = {
                'pending': 'Pendente',
                'resolved': 'Resolvido',
                'urgent': 'Urgente'
            };
            return labels[status] || status;
        }

        function renderContacts(contactsToRender = []) {
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
                document.getElementById('responseMessage').value =
                    `Olá ${currentContact.name},\n\nObrigado por entrar em contato conosco.\n\n`;
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
            fetch("{{ route('admin.suporte.api.resposta') }}", {
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
                        refreshCurrentPage();
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
                const response = await fetch("{{ route('admin.suporte.api.status') }}", {
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
                    refreshCurrentPage();
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

        // Função para atualizar página atual mantendo filtros e busca
        function refreshCurrentPage() {
            const searchTerm = document.getElementById('searchInput').value;
            loadContacts(currentPage, pageSize, searchTerm, currentFilter);
            loadStats();
        }

        function filterContacts(status) {
            currentFilter = status;
            currentPage = 1; // Resetar para primeira página quando mudar filtro

            // Atualizar botões ativos
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelector(`[data-filter="${status}"]`).classList.add('active');

            // Carregar contatos com novo filtro
            const searchTerm = document.getElementById('searchInput').value;
            loadContacts(currentPage, pageSize, searchTerm, currentFilter);
        }

        function searchContacts() {
            const searchTerm = document.getElementById('searchInput').value;
            currentPage = 1; // Resetar para primeira página quando pesquisar

            // Carregar contatos com termo de busca
            loadContacts(currentPage, pageSize, searchTerm, currentFilter);
        }

        // Função para compatibilidade (mantida para não quebrar código existente)
        function updateStats() {
            loadStats();
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
                searchTimeout = setTimeout(searchContacts,
                500); // Aumentei para 500ms para reduzir chamadas
            });

            // Seletor de tamanho de página
            document.getElementById('pageSizeSelect').addEventListener('change', function() {
                changePageSize(this.value);
            });

            // Atalhos de teclado para navegação
            document.addEventListener('keydown', function(e) {
                // Apenas se não estiver digitando em um input
                if (e.target.tagName.toLowerCase() === 'input' || e.target.tagName.toLowerCase() ===
                    'textarea') {
                    return;
                }

                if (e.key === 'ArrowLeft' && currentPage > 1) {
                    e.preventDefault();
                    changePage(currentPage - 1);
                } else if (e.key === 'ArrowRight' && currentPage < totalPages) {
                    e.preventDefault();
                    changePage(currentPage + 1);
                }
            });
        });

        // Atualizar dados a cada 30 segundos (só se não estiver carregando)
        setInterval(() => {
            if (!isLoading) {
                refreshCurrentPage();
            }
        }, 30000);

        // Função para ir para uma página específica (útil para implementação futura)
        function goToPage() {
            const pageInput = prompt(`Digite o número da página (1-${totalPages}):`);
            const page = parseInt(pageInput);

            if (page && page >= 1 && page <= totalPages) {
                changePage(page);
            } else if (pageInput !== null) {
                alert('Número de página inválido!');
            }
        }

        // Adicionar event listener para scroll infinito (opcional - descomente se desejar)
        /*
        let isScrollLoading = false;
        window.addEventListener('scroll', function() {
            if (isScrollLoading || isLoading) return;
            
            const scrollHeight = document.documentElement.scrollHeight;
            const scrollTop = document.documentElement.scrollTop;
            const clientHeight = document.documentElement.clientHeight;
            
            if (scrollTop + clientHeight >= scrollHeight - 100) {
                if (currentPage < totalPages) {
                    isScrollLoading = true;
                    changePage(currentPage + 1);
                    setTimeout(() => { isScrollLoading = false; }, 1000);
                }
            }
        });
        */
    </script>
