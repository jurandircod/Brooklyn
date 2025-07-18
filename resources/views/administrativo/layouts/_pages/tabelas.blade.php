
    <style>

        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }
        
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 40px;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .diagram {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            position: relative;
        }
        
        .class-box {
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border: 2px solid #3498db;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .class-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            border-color: #2980b9;
        }
        
        .class-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3498db, #2980b9);
        }
        
        .class-name {
            font-size: 1.4em;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            text-align: center;
            padding: 10px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border-radius: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
        
        .attributes, .methods {
            margin-bottom: 15px;
        }
        
        .section-title {
            font-weight: bold;
            color: #34495e;
            margin-bottom: 8px;
            padding: 5px 10px;
            background: linear-gradient(135deg, #ecf0f1, #bdc3c7);
            border-radius: 5px;
            font-size: 0.9em;
        }
        
        .attribute, .method {
            font-family: 'Courier New', monospace;
            font-size: 0.85em;
            color: #2c3e50;
            margin: 4px 0;
            padding: 3px 8px;
            background: rgba(52, 152, 219, 0.1);
            border-radius: 4px;
            border-left: 3px solid #3498db;
        }
        
        .pk {
            color: #e74c3c;
            font-weight: bold;
        }
        
        .fk {
            color: #f39c12;
            font-weight: bold;
        }
        
        .enum {
            color: #9b59b6;
            font-style: italic;
        }
        
        .relationship {
            position: absolute;
            z-index: 10;
            pointer-events: none;
        }
        
        .legend {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 15px;
            font-size: 0.8em;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            margin: 5px 0;
        }
        
        .legend-color {
            width: 15px;
            height: 15px;
            border-radius: 3px;
            margin-right: 8px;
        }
        
        .core-entity {
            border-color: #e74c3c;
        }
        
        .support-entity {
            border-color: #f39c12;
        }
        
        .relationship-entity {
            border-color: #9b59b6;
        }
        
        .system-entity {
            border-color: #95a5a6;
        }
        
        @media (max-width: 768px) {
            .diagram {
                grid-template-columns: 1fr;
            }
            
            .legend {
                position: static;
                margin-bottom: 20px;
            }
        }
    </style>

    <div class="container">
        <h1>📊 Diagrama de Classes - Sistema Brooklyn</h1>
        
        <div class="legend">
            <div class="legend-item">
                <div class="legend-color" style="background: #e74c3c;"></div>
                <span>Entidades Core</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #f39c12;"></div>
                <span>Entidades de Apoio</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #9b59b6;"></div>
                <span>Entidades de Relacionamento</span>
            </div>
            <div class="legend-item">
                <div class="legend-color" style="background: #95a5a6;"></div>
                <span>Entidades de Sistema</span>
            </div>
        </div>
        
        <div class="diagram">
            <!-- Entidades Core -->
            <div class="class-box core-entity">
                <div class="class-name">👤 User</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute">+ name: VARCHAR(255)</div>
                    <div class="attribute">+ email: VARCHAR(255)</div>
                    <div class="attribute">+ email_verified_at: TIMESTAMP</div>
                    <div class="attribute fk">+ role_id: BIGINT (FK)</div>
                    <div class="attribute">+ password: VARCHAR(255)</div>
                    <div class="attribute">+ remember_token: VARCHAR(100)</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box core-entity">
                <div class="class-name">📦 Produto</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute">+ nome: VARCHAR(255)</div>
                    <div class="attribute">+ valor: DOUBLE</div>
                    <div class="attribute">+ material: VARCHAR(255)</div>
                    <div class="attribute fk">+ categoria_id: BIGINT (FK)</div>
                    <div class="attribute fk">+ marca_id: BIGINT (FK)</div>
                    <div class="attribute enum">+ estado: ENUM('ativo', 'inativo')</div>
                    <div class="attribute">+ descricao: VARCHAR(255)</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box core-entity">
                <div class="class-name">🛒 Carrinho</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute fk">+ user_id: BIGINT (FK)</div>
                    <div class="attribute enum">+ status: ENUM('ativo', 'finalizado')</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box core-entity">
                <div class="class-name">📋 Pedido</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute fk">+ user_id: BIGINT (FK)</div>
                    <div class="attribute fk">+ endereco_id: BIGINT (FK)</div>
                    <div class="attribute enum">+ status: ENUM('aguardando', 'pago', 'enviado', 'entregue', 'cancelado')</div>
                    <div class="attribute">+ total: DECIMAL(10,2)</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <!-- Entidades de Apoio -->
            <div class="class-box support-entity">
                <div class="class-name">📂 Categoria</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute">+ nome: VARCHAR(255)</div>
                    <div class="attribute">+ descricao: VARCHAR(255)</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box support-entity">
                <div class="class-name">🏷️ Marca</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute">+ nome: VARCHAR(255)</div>
                    <div class="attribute">+ descricao: VARCHAR(255)</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box support-entity">
                <div class="class-name">🔐 Permissao</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ role_id: BIGINT (PK)</div>
                    <div class="attribute">+ tipo_acesso: VARCHAR(255)</div>
                    <div class="attribute">+ descricao: VARCHAR(255)</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box support-entity">
                <div class="class-name">🏠 Endereco</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute">+ logradouro: VARCHAR(255)</div>
                    <div class="attribute">+ numero: VARCHAR(255)</div>
                    <div class="attribute">+ complemento: VARCHAR(255)</div>
                    <div class="attribute">+ bairro: VARCHAR(255)</div>
                    <div class="attribute">+ cidade: VARCHAR(255)</div>
                    <div class="attribute">+ estado: VARCHAR(255)</div>
                    <div class="attribute">+ telefone: VARCHAR(255)</div>
                    <div class="attribute">+ cep: VARCHAR(255)</div>
                    <div class="attribute fk">+ user_id: BIGINT (FK)</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <!-- Entidades de Relacionamento -->
            <div class="class-box relationship-entity">
                <div class="class-name">🛍️ ItemCarrinho</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute fk">+ carrinho_id: BIGINT (FK)</div>
                    <div class="attribute fk">+ produto_id: BIGINT (FK)</div>
                    <div class="attribute">+ quantidade: INT</div>
                    <div class="attribute">+ preco_unitario: DECIMAL(10,2)</div>
                    <div class="attribute">+ preco_total: DECIMAL(10,2)</div>
                    <div class="attribute">+ tamanho: VARCHAR(255)</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box relationship-entity">
                <div class="class-name">⭐ Avaliacao</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute fk">+ produto_id: BIGINT (FK)</div>
                    <div class="attribute fk">+ user_id: BIGINT (FK)</div>
                    <div class="attribute">+ estrelas: TINYINT</div>
                    <div class="attribute">+ comentario: TEXT</div>
                    <div class="attribute">+ data_avaliacao: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box relationship-entity">
                <div class="class-name">📦 Estoque</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute">+ quantidade: DOUBLE</div>
                    <div class="attribute fk">+ produto_id: BIGINT (FK)</div>
                    <div class="attribute">+ quantidadeP: DOUBLE</div>
                    <div class="attribute">+ quantidadeM: DOUBLE</div>
                    <div class="attribute">+ quantidadeG: DOUBLE</div>
                    <div class="attribute">+ quantidadeGG: DOUBLE</div>
                    <div class="attribute">+ quantidade775: DOUBLE</div>
                    <div class="attribute">+ quantidade8: DOUBLE</div>
                    <div class="attribute">+ quantidade825: DOUBLE</div>
                    <div class="attribute">+ quantidade85: DOUBLE</div>
                    <div class="attribute enum">+ ativo: ENUM('S', 'N')</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box relationship-entity">
                <div class="class-name">📸 Foto</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute">+ url_imagem: VARCHAR(255)</div>
                    <div class="attribute fk">+ produto_id: BIGINT (FK)</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <!-- Entidades de Sistema -->
            <div class="class-box system-entity">
                <div class="class-name">📞 Contato</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute">+ nome: VARCHAR(255)</div>
                    <div class="attribute">+ sobrenome: VARCHAR(255)</div>
                    <div class="attribute">+ email: VARCHAR(255)</div>
                    <div class="attribute">+ telefone: VARCHAR(255)</div>
                    <div class="attribute">+ mensagem: VARCHAR(255)</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                    <div class="attribute">+ updated_at: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box system-entity">
                <div class="class-name">🔑 PasswordReset</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute">+ email: VARCHAR(255)</div>
                    <div class="attribute">+ token: VARCHAR(255)</div>
                    <div class="attribute">+ created_at: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box system-entity">
                <div class="class-name">❌ FailedJob</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: BIGINT (PK)</div>
                    <div class="attribute">+ connection: TEXT</div>
                    <div class="attribute">+ queue: TEXT</div>
                    <div class="attribute">+ payload: LONGTEXT</div>
                    <div class="attribute">+ exception: LONGTEXT</div>
                    <div class="attribute">+ failed_at: TIMESTAMP</div>
                </div>
            </div>
            
            <div class="class-box system-entity">
                <div class="class-name">🔄 Migration</div>
                <div class="attributes">
                    <div class="section-title">Atributos</div>
                    <div class="attribute pk">+ id: INT (PK)</div>
                    <div class="attribute">+ migration: VARCHAR(255)</div>
                    <div class="attribute">+ batch: INT</div>
                </div>
            </div>
        </div>
    </div>
