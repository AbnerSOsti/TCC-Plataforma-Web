<?php

ob_start();
class View{
    public function header($string){
        if(!isset($_SESSION["login"]) == true) {
        echo '
            <header class="navbar">
                <div class="nav-container">
                <a href="cadastro.php">Cadastro</a>
                <a href="login.php">Login</a>
                <a href="dashboard.php">Dashboard</a>
                
                    

                </div>
            </header>
        ';
        } else {
            echo '
            <header class="navbar">
                <div class="nav-container">
                    <a href="index.php">Home</a>
                    <a href="cadastro.php">Cadastro</a>
                    <a href="admin.php">Admin</a>
                    '.(isset($_SESSION["nome_usuario"]) ? $_SESSION["nome_usuario"] : '').'
                    <a href="sair.php">Sair</a>
                </div>
            </header>
        ';
        }
      
    }

    public function Homepage($string){
        if(isset($_SESSION["login"]) == true) {
        header("Location: sala.php");
        } else {
            echo '
        <header class="header-navbar">
        <div class="container navbar-wrapper">
            <a href="#" class="brand-logo">
                <div class="logo-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-code-xml preview-icon"><path d="m18 16 4-4-4-4"/><path d="m6 8-4 4 4 4"/><path d="m14.5 4-5 16"/></svg></div>
                <div class="logo-text">Beginner <span>Dev</span></div>
            </a>

            <button class="mobile-toggle" id="mobileMenuBtn" aria-label="Abrir Menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            <ul class="nav-links" id="navLinks">
                <li><a href="#inicio">Início</a></li>
                <li><a href="#trilha">Trilha do Curso</a></li>
                <li><a href="#recursos">Como Funciona</a></li>
            </ul>

            <div class="nav-actions">
                <a href="login.php" class="btn btn-outline">Entrar</a>
                <a href="cadastro.php" class="btn btn-primary">Cadastrar</a>
            </div>
        </div>
    </header>

    <section class="hero-section" id="inicio">
        <div class="container hero-grid">
            <div class="hero-content">
                <div class="badge-tag">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1e90ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rocket preview-icon"><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5"/><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09"/><path d="M9 12a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.4 22.4 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 .05 5 .05"/></svg>
                     Método Prático e Descomplicado
                </div>
                <h1>Aprenda <span class="highlight">Lógica de Programação</span> sem travar no código</h1>
                <p>Desenvolva seu raciocínio com desafios visuais e interativos. Domine os conceitos fundamentais da lógica antes de passar para Portugol e sintaxe real em C++.</p>
                
                <div class="hero-buttons">
                    <a href="login.php" class="btn btn-primary">
                        Começar Agora
                    </a>
                    <a href="#recursos" class="btn btn-accent">
                        <i class="fa-solid fa-sparkles"></i> Conhecer a Plataforma
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Passo a Passo</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">3 Etapas</div>
                        <div class="stat-label">Evolução Guiada</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">C++</div>
                        <div class="stat-label">Linguagem Final</div>
                    </div>
                </div>
            </div>

            <div class="hero-preview">
                <div class="code-card-wrapper">
                    <div class="code-header">
                        <div class="dots">
                            <span></span><span></span><span></span>
                        </div>
                        <div class="code-title">primeiro_algoritmo.cpp</div>
                    </div>
                    <div class="code-body">
                        <span class="comment">// Sua jornada de aprendizado sem complicações</span><br>
                        <span class="keyword">#include</span> &lt;iostream&gt;<br>
                        <span class="keyword">using namespace</span> std;<br><br>
                        <span class="keyword">int</span> <span class="function">main</span>() {<br>
                        &nbsp;&nbsp;<span class="comment">// 1. Construa o raciocínio lógico</span><br>
                        &nbsp;&nbsp;<span class="comment">// 2. Pratique com Portugol</span><br>
                        &nbsp;&nbsp;<span class="comment">// 3. Escreva seu primeiro código em C++</span><br>
                        &nbsp;&nbsp;cout &lt;&lt; <span class="string">"Bem-vindo ao Beginner Dev!"</span>;<br>
                        &nbsp;&nbsp;<span class="keyword">return</span> 0;<br>
                        }
                    </div>
                </div>

                <div class="floating-badge">
                    <div class="badge-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1e90ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap preview-icon"><path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/></svg>
                    </div>
                    <div class="badge-text">
                        <strong>Aprendizado Sem Frustração</strong>
                        <span>Progressão natural e no seu tempo</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="course-section" id="trilha">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Curso em Destaque</span>
                <h2>Lógica e Pensamento Computacional</h2>
                <p>Nossa trilha para iniciantes é dividida em 3 grandes etapas para você aprender sem sobrecarga e ganhar confiança a cada módulo.</p>
            </div>

            <div class="modules-grid">
                <!-- Etapa 1 -->
                <div class="module-card">
                    <div class="module-step">1</div>
                    <span class="module-tag module-tag-1">Módulos 1 e 2</span>
                    <h3>Fundamentos & Raciocínio</h3>
                    <p>Desenvolva seu pensamento estruturado resolvendo problemas com lógica pura, sem precisar decorar comandos difíceis.</p>
                    <ul class="module-topics">
                        <li><i class="fa-solid fa-check"></i> Divisão de Problemas em Partes</li>
                        <li><i class="fa-solid fa-check"></i> Sequenciamento Lógico</li>
                        <li><i class="fa-solid fa-check"></i> Ordenação de Instruções</li>
                    </ul>
                    <a href="cadastro.php" class="btn btn-outline" style="width: 100%;">Iniciar Módulo</a>
                </div>

                <!-- Etapa 2 -->
                <div class="module-card">
                    <div class="module-step">2</div>
                    <span class="module-tag module-tag-2">Módulos 3 e 4</span>
                    <h3>Pseudocódigo (Portugol)</h3>
                    <p>Aprenda a estruturar algoritmos usando comandos em português, facilitando o entendimento de decisões e repetições.</p>
                    <ul class="module-topics">
                        <li><i class="fa-solid fa-check"></i> Variáveis e Guardando Dados</li>
                        <li><i class="fa-solid fa-check"></i> Tomada de Decisão (Se / Senão)</li>
                        <li><i class="fa-solid fa-check"></i> Laços de Repetição</li>
                    </ul>
                    <a href="cadastro.php" class="btn btn-outline" style="width: 100%;">Iniciar Módulo</a>
                </div>

                <!-- Etapa 3 -->
                <div class="module-card">
                    <div class="module-step">3</div>
                    <span class="module-tag module-tag-3">Módulos 5 e 6</span>
                    <h3>Sintaxe Real em C++</h3>
                    <p>Aplique toda a lógica acumulada na linguagem C++, escrevendo programas reais e prontos para rodar no seu computador.</p>
                    <ul class="module-topics">
                        <li><i class="fa-solid fa-check"></i> Estrutura Básica do C++</li>
                        <li><i class="fa-solid fa-check"></i> Entrada e Saída de Dados</li>
                        <li><i class="fa-solid fa-check"></i> Resolução de Desafios Reais</li>
                    </ul>
                    <a href="cadastro.php" class="btn btn-outline" style="width: 100%;">Iniciar Módulo</a>
                </div>
            </div>
        </div>
    </section>

    <section class="features-section" id="recursos">
        <div class="container">
            <div class="section-header">
                <span class="section-subtitle">Como Você Vai Aprender</span>
                <h2>3 Formatos Interativos de Exercícios</h2>
                <p>Para garantir que você entenda os conceitos sem monotonia, combinamos três métodos práticos que variam conforme a sua evolução no curso.</p>
            </div>

            <div class="methods-grid">
                <!-- Método 1: Ordenação de Blocos -->
                <div class="method-card">
                    <div class="method-header">
                        <div class="method-icon method-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-blocks preview-icon"><path d="M10 22V7a1 1 0 0 0-1-1H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5a1 1 0 0 0-1-1H2"/><rect x="14" y="2" width="8" height="8" rx="1"/></svg>
                        </div>
                        <h3>1. Ordenação de Blocos</h3>
                    </div>
                    <p>Organize passos e instruções na ordem exata de execução. Excelente para exercitar a sequência lógica inicial antes de digitar código.</p>

                    <div class="method-preview">
                        <span class="preview-label">Exemplo Interativo</span>
                        <div class="block-item-mini">1. Ler valor de X <i class="fa-solid fa-grip-vertical"></i></div>
                        <div class="block-item-mini">2. Processar cálculo <i class="fa-solid fa-grip-vertical"></i></div>
                        <div class="block-item-mini">3. Exibir resultado <i class="fa-solid fa-grip-vertical"></i></div>
                    </div>
                </div>

                <!-- Método 2: Múltipla Escolha -->
                <div class="method-card">
                    <div class="method-header">
                        <div class="method-icon method-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-check preview-icon"><path d="M16 5H3"/><path d="M16 12H3"/><path d="M11 19H3"/><path d="m15 18 2 2 4-4"/></svg>
                        </div>
                        <h3>2. Múltipla Escolha</h3>
                    </div>
                    <p>Avalie cenários e identifique a alternativa correta. Ideal para fixar tomada de decisão, operadores relacionais e conceitos teóricos.</p>

                    <div class="method-preview">
                        <span class="preview-label">Exemplo Interativo</span>
                        <div class="choice-option"><i class="fa-regular fa-circle"></i> Repetir 5 vezes</div>
                        <div class="choice-option active"><i class="fa-solid fa-circle-check"></i> Se idade &gt;= 18</div>
                        <div class="choice-option"><i class="fa-regular fa-circle"></i> Criar variável</div>
                    </div>
                </div>

                <!-- Método 3: Completar Lacunas -->
                <div class="method-card">
                    <div class="method-header">
                        <div class="method-icon method-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen preview-icon"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                        </div>
                        <h3>3. Completar Lacunas</h3>
                    </div>
                    <p>Preencha os termos que faltam em trechos de pseudocódigo e C++. Ajuda na transição suave para a escrita de sintaxe real.</p>

                    <div class="method-preview">
                        <span class="preview-label">Exemplo Interativo</span>
                        <div class="gap-code">
                            cout &lt;&lt; <span class="gap-box">"Olá"</span>;
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner sobre Orientações e Feedbacks Cadastrados -->
            <div class="feedback-banner">
                <div class="banner-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1e90ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-messages-circle preview-icon"><path d="M19.95 10.05a7 7 0 011.412 7.872 1 1 0 00-.058.787l.675 2.089a1 1 0 01-1.236 1.168l-2.155-.631a1 1 0 00-.745.06 7 7 0 01-7.793-1.445"/><path d="M2.696 12.708a1 1 0 00-.058-.785 7 7 0 113.518 3.473 1 1 0 00-.744-.061l-2.155.63a1 1 0 01-1.236-1.167z"/></svg>
                </div>
                <div class="banner-text">
                    <h4>Feedback Imediato para Cada Exercício</h4>
                    <p>Ao tentar responder qualquer atividade, a plataforma verifica sua resposta e apresenta orientações diretas cadastradas para aquela questão, explicando o motivo do resultado para que você aprenda com cada tentativa.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <section class="cta-section">
            <h2>Pronto para aprender programação de verdade?</h2>
            <p>Cadastre-se gratuitamente, acesse a trilha de Lógica de Programação e comece agora mesmo.</p>
            <a href="cadastro.php" class="btn btn-primary" style="padding: 1rem 2.5rem; font-size: 1.1rem; color: #ffffff;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-plus preview-icon"><path d="M2 21a8 8 0 0 1 13.292-6"/><circle cx="10" cy="8" r="5"/><path d="M19 16v6"/><path d="M22 19h-6"/></svg>
                 Criar Conta
            </a>
        </section>
    </div>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-info">
                    <h4>Beginner Dev</h4>
                    <p>Plataforma interativa para ensino de lógica e raciocínio computacional. Feita para ajudar quem quer aprender a programar do zero com confiança e sem traumas.</p>
                </div>

                <div class="footer-links">
                    <h5>Navegação</h5>
                    <ul>
                        <li><a href="#inicio">Início</a></li>
                        <li><a href="#trilha">Trilha do Curso</a></li>
                        <li><a href="#recursos">Como Funciona</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h5>Links Úteis</h5>
                    <ul>
                        <li><a href="cadastro.php">Criar Conta</a></li>
                        <li><a href="login.php">Área do Aluno</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2026 Beginner Dev. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

            ';
        }
    }

    public function Cadastropage($string){
        echo '
            <div class="cadastro-container">
                <div class="cadastro-card">
                    <div class="cadastro-titulo">
                        <h1>Bem-vindo!</h1>
                        <p>Faça seu cadastro para acessar sua conta</p>
                    </div>
                    <form action="cadastro.php" method="post">
                        <div class="formulario">

                            <div class="inputicon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                <input type="text" placeholder="Digite seu nome" id="nome_usuario" name="nome_usuario" required>
                            </div>
                            <div class="inputicon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                <input type="email" placeholder="Digite seu email" id="email_usuario" name="email_usuario" required>
                            </div>
                            <div class="inputicon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                <input type="password" placeholder="Digite sua senha" id="senha_usuario" name="senha_usuario" required>
                                <button type="button" class="toggle-password" onclick="togglePasswordVisibility()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                            </div>

                            <div style="color: red;">'.$string.'</div>

                            <div class="cadastro-btn">
                                <input type="submit" name="btnCadastro" value="Cadastrar">
                            </div>
                        </div>

                    </form>

                    <div class="divisao">
                        <hr>
                        <p>ou escolha uma opção</p>
                        <hr>
                    </div>

                    <div class="opcoes">
                        <button onclick="window.location.href=\'login.php\'">
                            <div class="opcoes-texto">
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-icon lucide-circle-user"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="10" r="3"/><path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"/></svg></div>
                                <div style="margin-right: 10px;">
                                    <p>Fazer Login</p>
                                </div>
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></div>
                            </div>
                        </button>
                        <button onclick="window.location.href=\'recuperarsenha.php\'">
                            <div class="opcoes-texto">
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
                                <div style="margin-right: 10px;">
                                    <p>Recuperar Acesso</p>
                                </div>
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></div>
                            </div>
                        </button>
                    </div>


                </div>
                <button class="btn-voltar" onclick="window.location.href=\'index.php\'">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                Voltar para o inicio</button>

            </div>
        ';
        
    }

    public function Loginpage($string){
        echo '

            <div class="login-container">
                <div class="login-card">
                    <div class="login-titulo">
                        <h1>Bem-vindo de volta!</h1>
                        <p>Continue seu aprendizado.</p>
                    </div>
                    <form action="login.php" method="post">
                        <div class="formulario">
                        

                            <div class="inputicon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                                <input type="email" placeholder="Digite seu email" id="email_usuario" name="email_usuario" required><br>
                            </div>
    
                            <div class="inputicon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                <input type="password" placeholder="Digite sua senha" id="senha_usuario" name="senha_usuario" required><br>
                                <button type="button" class="toggle-password" onclick="togglePasswordVisibility()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                            </div>
                            <div style="color: red;">'.$string.'</div>
                            
                            <div class="login-btn">
                                <input type="submit" name="btnLogin" value="Entrar">
                            </div>

                        </div>

                    </form>

                    <div class="divisao">
                        <hr>
                        <p>ou escolha uma opção</p>
                        <hr>
                    </div>

                    <div class="opcoes">
                        <button onclick="window.location.href=\'cadastro.php\'">
                            <div class="opcoes-texto">
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-icon lucide-circle-user"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="10" r="3"/><path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"/></svg></div>
                                <div style="margin-right: 10px;">
                                    <p>Criar Conta</p>
                                </div>
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></div>
                            </div>
                        </button>
                        <button onclick="window.location.href=\'recuperarsenha.php\'">
                            <div class="opcoes-texto">
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
                                <div style="margin-right: 10px;">
                                    <p>Recuperar Acesso</p>
                                </div>
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></div>
                            </div>
                        </button>
                    </div>


                </div>

                <button class="btn-voltar" onclick="window.location.href=\'index.php\'">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                Voltar para o inicio</button>

            </div>
        ';
        
    }

    public function Login_admin_page($string){
        echo '
           <div class="login-container">
                <div class="login-card">
                    <div class="login-titulo">
                        <h1>Gerenciamento</h1>
                        <p>Painel Administrativo.</p>
                    </div>
                    <form action="admin.php" method="post">
                        <div class="formulario">
                        

                            <div class="inputicon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                                <input type="email" placeholder="Digite seu email" id="email_usuario" name="email_usuario" required><br>
                            </div>
    
                            <div class="inputicon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                <input type="password" placeholder="Digite sua senha" id="senha_usuario" name="senha_usuario" required><br>
                                <button type="button" class="toggle-password" onclick="togglePasswordVisibility()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/></svg>
                                </button>
                            </div>
                            <div style="color: red;">'.$string.'</div>
                            
                            <div class="login-btn">
                                <input type="submit" name="btnLoginAdmin" value="Entrar">
                            </div>

                        </div>

                    </form>

                </div>

                <button class="btn-voltar" onclick="window.location.href=\'index.php\'">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                Voltar para o inicio</button>

            </div>
        ';
        
    }

    public function SolicitarRecuperacaoSenhaPage($string){
        echo '

            <div class="recuperacao-container">
                <div class="recuperacao-card">
                    <div class="recuperacao-titulo">
                        <h1>Bem-vindo!</h1>
                        <p>Digite seu email para recuperar a senha</p>
                    </div>
                    <form action="recuperarsenha.php" method="post">
                        <div class="formulario">
                            <div class="inputicon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                                <input type="email" placeholder="Digite seu email" id="email_usuario" name="email_usuario" required>
                            </div>
                            <div style="color: green;">'.$string.'</div>

                            <div class="recuperacao-btn">
                                <input type="submit" name="btnRecuperar" value="Enviar E-mail">
                            </div>
                        </div>

                    </form>

                    <div class="divisao">
                        <hr>
                        <p>ou escolha uma opção</p>
                        <hr>
                    </div>
                    
                    <div class="opcoes">
                        <button onclick="window.location.href=\'cadastro.php\'">
                            <div class="opcoes-texto">
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-icon lucide-circle-user"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="10" r="3"/><path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"/></svg></div>
                                <div style="margin-right: 10px;">
                                    <p>Criar Conta</p>
                                </div>
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></div>
                            </div>
                        </button>
                        <button onclick="window.location.href=\'login.php\'">
                            <div class="opcoes-texto">
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg></div>
                                <div style="margin-right: 10px;">
                                    <p>Fazer login</p>
                                </div>
                                <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right-icon lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></div>
                            </div>
                        </button>
                    </div>

                </div>

                <button class="btn-voltar" onclick="window.location.href=\'index.php\'">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left-icon lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                Voltar para o inicio</button>

            </div>
        ';
        
    }

    public function NovaSenhaPage($string){
        $token = $_POST["token"] ?? $_GET["token"] ?? "";
        echo '
        <div class="novasenha-container">
            <div class="novasenha-card">

                <div class="novasenha-titulo">
                        <h1>Recuperar Senha</h1>
                </div>

                <form action="" method="post">
                    <div class="novasenha-inputs">
                        <input type="hidden" 
                            name="token" 
                            value="'.htmlspecialchars($token).'">

                        <input type="password" name="senha_cliente" placeholder="Digite sua nova senha" class="input"required>

                        <input type="password" name="confirmar_senha" placeholder="Confirme sua nova senha" class="input"required>
                        <a href="index.php">Voltar para ao inicio</a>
                        <div style="color: red; width: 100%; text-align: center; margin-top: 10px;">'.$string.'</div>

                        <div class="novasenha-btn">
                            <input type="submit" name="btnRedefinir" value="Redefinir Senha">
                        </div>
                            
                    </div>
                </form>

            </div>
        </div>
        ';
    }

    private function renderDashboardToast($message, $status = 'info') {
        $messageText = trim((string) $message);

        if ($messageText === '') {
            return '';
        }

        $status = in_array($status, ['success', 'error', 'info'], true) ? $status : 'info';
        $titulo = $status === 'success' ? 'Sucesso' : ($status === 'error' ? 'Erro' : 'Aviso');
        $messageSafe = nl2br(htmlspecialchars($messageText, ENT_QUOTES, 'UTF-8'));

        return '<div class="dashboard-toast toast-' . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . '" role="alert">
                    <div class="toast-content">
                        <strong>' . htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8') . '</strong>
                        <span>' . $messageSafe . '</span>
                    </div>
                    <button type="button" class="toast-close" aria-label="Fechar">×</button>
                </div>';
    }

    public function DashboardPage($string, $modulos = [], $aulas = [], $abaAtiva = 'modulo', $linguagens = [], $status = 'info', $linguagemSelecionada = null, $modulosCurso = [], $moduloSelecionado = null, $aulasModulo = [], $aulaSelecionada = null, $exerciciosAula = [], $exercicioSelecionado = null, $itensExercicio = []){
        $opcoes_modulo = '<option value="">Selecione um modulo</option>';
        $opcoes_aula = '<option value="">Selecione uma aula</option>';
        $viewsPermitidas = ["gerenciar", "modulo", "linguagem", "aula", "exercicio", "editar-curso", "editar-modulo", "editar-aula", "editar-exercicio"];

        $html_gerenciar = '';

            foreach ($linguagens as $linguagem) {
            $imgRaw = $linguagem['img'] ?? '';
            $imgRaw = is_string($imgRaw) ? trim($imgRaw) : '';
            $nomeCurso = (string) ($linguagem['nome_linguagem'] ?? '');
            $nivelCurso = (string) ($linguagem['nivel'] ?? '');
            $nivelFiltro = strtr(strtolower($nivelCurso), [
                'á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a',
                'é' => 'e', 'ê' => 'e', 'í' => 'i', 'ó' => 'o',
                'ô' => 'o', 'õ' => 'o', 'ú' => 'u', 'ç' => 'c'
            ]);
            $nivelClasse = in_array($nivelFiltro, ['iniciante', 'intermediario', 'avancado'], true)
                ? $nivelFiltro
                : 'padrao';

            if ($imgRaw === '') {
                $imgSrc = 'imagens/img_curso.png';
            } else {
                $imgSrc = $imgRaw;
            }

            $html_gerenciar .='
            <div class="curso-card" data-linguagem-id="' . htmlspecialchars($linguagem['id_linguagem'] ?? '', ENT_QUOTES, 'UTF-8') . '" data-nome="' . htmlspecialchars($nomeCurso, ENT_QUOTES, 'UTF-8') . '" data-nivel="' . htmlspecialchars($nivelFiltro, ENT_QUOTES, 'UTF-8') . '">

                                <div class="curso-img">
                                    <img src="' . htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($nomeCurso, ENT_QUOTES, 'UTF-8') . '">
                                </div>

                                <div class="curso-info">

                                    <h3>' . htmlspecialchars($nomeCurso, ENT_QUOTES, 'UTF-8') . '</h3>

                                    <p style="flex: 1;">
                                        ' . htmlspecialchars($linguagem['descricao'] ?? '', ENT_QUOTES, 'UTF-8') . '
                                    </p>

                                    <span class="badge ' . $nivelClasse . '">
                                        ' . htmlspecialchars($nivelCurso, ENT_QUOTES, 'UTF-8') . '
                                    </span>

                                    <form class="form-editar-curso" action="dashboard.php" method="get">
                                        <input type="hidden" name="view" value="editar-curso">
                                        <input type="hidden" name="linguagem" value="' . htmlspecialchars((string) ($linguagem['id_linguagem'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                                        <button class="btn-editar" type="submit">Editar Curso →</button>
                                    </form>

                                </div>

                            </div>
            ';
        }


        if (!in_array($abaAtiva, $viewsPermitidas, true)) {
            $abaAtiva = 'gerenciar';
        }

        $cursoEdicao = is_array($linguagemSelecionada) ? $linguagemSelecionada : [];
        $imagemCursoEdicao = trim((string) ($cursoEdicao['img'] ?? ''));
        if ($imagemCursoEdicao === '') {
            $imagemCursoEdicao = 'imagens/img_curso.png';
        }
        $moduloEdicao = is_array($moduloSelecionado) ? $moduloSelecionado : [];
        $aulaEdicao = is_array($aulaSelecionada) ? $aulaSelecionada : [];
        $exercicioEdicao = is_array($exercicioSelecionado) ? $exercicioSelecionado : [];

        $htmlModulosCurso = '';
        if (is_array($modulosCurso) && count($modulosCurso) > 0) {
            foreach ($modulosCurso as $moduloCurso) {
                $htmlModulosCurso .= '
                    <tr>
                        <td>' . htmlspecialchars((string) ($moduloCurso['titulo_modulo'] ?? ''), ENT_QUOTES, 'UTF-8') . '</td>
                        <td class="descricao-modulo">' . htmlspecialchars((string) ($moduloCurso['descricao_modulo'] ?? ''), ENT_QUOTES, 'UTF-8') . '</td>
                        <td class="coluna-ordem">' . htmlspecialchars((string) ($moduloCurso['ordem_modulo'] ?? ''), ENT_QUOTES, 'UTF-8') . '</td>
                        <td class="coluna-acoes">
                            <div class="dropdown-acoes-modulo">
                                <button type="button" class="btn-menu-modulo" data-action="toggle-menu-modulo" aria-label="Abrir ações do módulo" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ellipsis">
                                        <circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/>
                                    </svg>
                                </button>
                                <div class="menu-acoes-modulo">
                                    <a class="menu-link" href="dashboard.php?view=editar-modulo&amp;modulo=' . urlencode((string) ($moduloCurso['id_modulo'] ?? '')) . '">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                        Editar
                                    </a>
                                    <form action="dashboard.php" method="post" onsubmit="return confirm(\'Excluir este módulo e todas as aulas vinculadas?\');">
                                        <input type="hidden" name="dashboard_view" value="editar-modulo">
                                        <input type="hidden" name="id_modulo" value="' . htmlspecialchars((string) ($moduloCurso['id_modulo'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                                        <button type="submit" name="btnExcluirModulo" class="acao-deletar-modulo">Deletar</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>';
            }
        } else {
            $htmlModulosCurso = '
                <tr>
                    <td colspan="4" class="tabela-sem-registros">Nenhum módulo cadastrado para este curso.</td>
                </tr>';
        }

        $htmlAulasModulo = '';
        if (is_array($aulasModulo) && count($aulasModulo) > 0)
            {
                foreach ($aulasModulo as $aulaCurso)
                {
                     $htmlAulasModulo .= '
                       <tr>
                         <td>' . htmlspecialchars((string) ($aulaCurso['titulo_aula'] ?? ''), ENT_QUOTES, 'UTF-8') . '</td>
                        <td class="descricao-modulo">' . htmlspecialchars((string) ($aulaCurso['conteudo_aula'] ?? ''), ENT_QUOTES, 'UTF-8') . '</td>
                        <td class="coluna-ordem">' . htmlspecialchars((string) ($aulaCurso['ordem_aula'] ?? ''), ENT_QUOTES, 'UTF-8') . '</td>
                        <td class="coluna-acoes">
                            <div class="dropdown-acoes-modulo">
                                <button type="button" class="btn-menu-modulo" data-action="toggle-menu-modulo" aria-label="Abrir ações do módulo" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ellipsis">
                                        <circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/>
                                    </svg>
                                </button>
                                <div class="menu-acoes-modulo">
                                    <a class="menu-link" href="dashboard.php?view=editar-aula&amp;aula=' . urlencode((string) ($aulaCurso['id_aula'] ?? '')) . '">Editar</a>
                                    <form action="dashboard.php" method="post" onsubmit="return confirm(\'Excluir esta aula e todos os exercícios vinculados?\');">
                                        <input type="hidden" name="dashboard_view" value="editar-aula">
                                        <input type="hidden" name="id_aula" value="' . htmlspecialchars((string) ($aulaCurso['id_aula'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                                        <button type="submit" name="btnExcluirAula" class="acao-deletar-modulo">Deletar</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>';

                }
            } else {
                $htmlAulasModulo = '
                    <tr>
                        <td colspan="4" class="tabela-sem-registros">Nenhuma aula cadastrada para este módulo.</td>
                    </tr>';
            }

        $htmlExerciciosAula = '';
        if (is_array($exerciciosAula) && count($exerciciosAula) > 0) {
            foreach ($exerciciosAula as $exercicioAula) {
                $htmlExerciciosAula .= '
                    <tr>
                        <td>' . htmlspecialchars((string) ($exercicioAula['tipo_exercicio'] ?? ''), ENT_QUOTES, 'UTF-8') . '</td>
                        <td class="descricao-modulo">' . htmlspecialchars((string) ($exercicioAula['pergunta'] ?? ''), ENT_QUOTES, 'UTF-8') . '</td>
                        <td>' . htmlspecialchars((string) ($exercicioAula['feedback_erro'] ?? ''), ENT_QUOTES, 'UTF-8') . '</td>
                        <td class="coluna-acoes">
                            <div class="dropdown-acoes-modulo">
                                <button type="button" class="btn-menu-modulo" data-action="toggle-menu-modulo" aria-label="Abrir ações do exercício" aria-expanded="false">•••</button>
                                <div class="menu-acoes-modulo">
                                    <a class="menu-link" href="dashboard.php?view=editar-exercicio&amp;exercicio=' . urlencode((string) ($exercicioAula['id_exercicio'] ?? '')) . '">Editar</a>
                                    <form action="dashboard.php" method="post" onsubmit="return confirm(\'Excluir este exercício e seus itens vinculados?\');">
                                        <input type="hidden" name="dashboard_view" value="editar-exercicio">
                                        <input type="hidden" name="id_exercicio" value="' . htmlspecialchars((string) ($exercicioAula['id_exercicio'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                                        <button type="submit" name="btnExcluirExercicio" class="acao-deletar-modulo">Deletar</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>';
            }
        } else {
            $htmlExerciciosAula = '<tr><td colspan="4" class="tabela-sem-registros">Nenhum exercício cadastrado para esta aula.</td></tr>';
        }

        $htmlItensExercicio = '';
        $tipoExercicioEdicao = trim((string) ($exercicioEdicao['tipo_exercicio'] ?? ''));
        if (is_array($itensExercicio) && count($itensExercicio) > 0) {
            foreach ($itensExercicio as $itemExercicio) {
                $idItem = $itemExercicio['id_opcao'] ?? $itemExercicio['id_bloco'] ?? $itemExercicio['id'] ?? '';
                $camposItem = '';

                if ($tipoExercicioEdicao === 'multipla_escolha') {
                    $camposItem = '<div class="linha-formulario"><div class="campo-formulario" style="flex:1"><label>Opção</label><input type="text" name="texto_opcao" value="' . htmlspecialchars((string) ($itemExercicio['texto_opcao'] ?? ''), ENT_QUOTES, 'UTF-8') . '" required></div><div class="campo-formulario" style="width:180px"><label>Correta</label><select name="correta"><option value="0">Incorreta</option><option value="1"' . (!empty($itemExercicio['correta']) ? ' selected' : '') . '>Correta</option></select></div></div>';
                } elseif ($tipoExercicioEdicao === 'completar_lacunas') {
                    $camposItem = '<div class="campo-formulario"><label>Resposta correta</label><input type="text" name="resposta_correta" value="' . htmlspecialchars((string) ($itemExercicio['resposta_correta'] ?? ''), ENT_QUOTES, 'UTF-8') . '" required></div>';
                } elseif ($tipoExercicioEdicao === 'ordenar_blocos') {
                    $camposItem = '<div class="linha-formulario"><div class="campo-formulario" style="flex:1"><label>Bloco</label><input type="text" name="texto_bloco" value="' . htmlspecialchars((string) ($itemExercicio['texto_bloco'] ?? ''), ENT_QUOTES, 'UTF-8') . '" required></div><div class="campo-formulario campo-ordem-selecionado" style="width:140px"><label>Ordem</label><input type="number" name="ordem_correta" min="1" value="' . htmlspecialchars((string) ($itemExercicio['ordem_correta'] ?? ''), ENT_QUOTES, 'UTF-8') . '" required></div></div>';
                }

                // formulário de atualização (sempre disponível)
                $formAtualizar = '<form action="dashboard.php" method="post" class="form-item-atualizar">'
                    . '<input type="hidden" name="dashboard_view" value="editar-exercicio">'
                    . '<input type="hidden" name="id_exercicio" value="' . htmlspecialchars((string) ($exercicioEdicao['id_exercicio'] ?? ''), ENT_QUOTES, 'UTF-8') . '">'
                    . '<input type="hidden" name="id_item_exercicio" value="' . htmlspecialchars((string) $idItem, ENT_QUOTES, 'UTF-8') . '">'
                    . '<div class="campos-item-exercicio">' . $camposItem . '</div>'
                    . '<button type="submit" name="btnAtualizarItemExercicio" class="btn-salvar">Atualizar</button>'
                    . '</form>';

                // Remover botão de exclusão por item: manter apenas o botão de deletar no topo (excluir exercício inteiro)
                $htmlItensExercicio .= '<div class="item-exercicio-edicao">' . $formAtualizar . '</div>';
            }
        } else {
            $htmlItensExercicio = '<p class="tabela-sem-registros">Nenhum item cadastrado para este tipo de exercício.</p>';
        }

        if (is_array($modulos)) {
            foreach ($modulos as $modulo) {
                $id = htmlspecialchars((string) ($modulo["id_modulo"] ?? ""), ENT_QUOTES, 'UTF-8');
                $titulo = htmlspecialchars((string) ($modulo["titulo_modulo"] ?? ""), ENT_QUOTES, 'UTF-8');

                if ($id !== "" && $titulo !== "") {
                    $opcoes_modulo .= '<option value="' . $id . '">' . $titulo . '</option>';
                }
            }
        }

        $opcoes_linguagem = '<option value="">Selecione uma linguagem</option>';
        if (is_array($linguagens)) {
            foreach ($linguagens as $linguagem) {
                $idLing = htmlspecialchars((string) ($linguagem["id_linguagem"] ?? ""), ENT_QUOTES, 'UTF-8');
                $nomeLing = htmlspecialchars((string) ($linguagem["nome_linguagem"] ?? ""), ENT_QUOTES, 'UTF-8');
                if ($idLing !== "" && $nomeLing !== "") {
                    $opcoes_linguagem .= '<option value="' . $idLing . '">' . $nomeLing . '</option>';
                }
            }
        }

        if (is_array($aulas)) {
            foreach ($aulas as $aula) {
                $id = htmlspecialchars((string) ($aula["id_aula"] ?? ""), ENT_QUOTES, 'UTF-8');
                $tituloAula = htmlspecialchars((string) ($aula["titulo_aula"] ?? ""), ENT_QUOTES, 'UTF-8');
                $tituloModulo = htmlspecialchars((string) ($aula["titulo_modulo"] ?? ""), ENT_QUOTES, 'UTF-8');

                if ($id !== "" && $tituloAula !== "") {
                    $rotulo = $tituloModulo !== '' ? $tituloModulo . ' - ' . $tituloAula : $tituloAula;
                    $opcoes_aula .= '<option value="' . $id . '">' . $rotulo . '</option>';
                }
            }
        }

        echo '
            <link rel="stylesheet" href="css/dashboard.css">
                <div class="dashboard-overlay"></div>
                <button type="button" class="dashboard-menu-toggle" aria-label="Abrir menu" aria-controls="dashboard-menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                <div class="dashboard-container">
                    <aside class="dashboard-menu" id="dashboard-menu">
                        <a href="index.php" class="btn-voltar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m12 19-7-7 7-7"/><path d="M19 12H5"/>
                            </svg>
                            Home
                        </a>
                        <nav class="dashboard-nav">
                            <button type="button" class="menu-item active" data-view="gerenciar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                </svg>
                                <span>Gerenciar</span>
                            </button>
                            <button type="button" class="menu-item" data-view="linguagem">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m5 8 6 6"/><path d="m19 8-6 6"/>
                                </svg>
                                <span>Nova Linguagem</span>
                            </button>
                            <button type="button" class="menu-item" data-view="modulo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                                </svg>
                                <span>Novo Módulo</span>
                            </button>
                            <button type="button" class="menu-item" data-view="aula">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                </svg>
                                <span>Nova Aula</span>
                            </button>
                            <button type="button" class="menu-item" data-view="exercicio">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 3v18"/><path d="M3 12h18"/>
                                </svg>
                                <span>Novo Exercício</span>
                            </button>
                        </nav>
                    </aside>

                    <div class="dashboard-conteudo" id="dashboard-conteudo" data-view-inicial="' . htmlspecialchars($abaAtiva, ENT_QUOTES, 'UTF-8') . '">
                        <div class="dashboard-topbar">
                            <div class="dashboard-user-dropdown">
                                <button type="button" class="dashboard-user-dropdown-button" aria-label="Abrir menu do usuário" aria-expanded="false">
                                    <span class="dashboard-user-avatar" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/>
                                        </svg>
                                    </span>
                                    <span class="dashboard-user-name">' . htmlspecialchars((string) ($_SESSION['nome_usuario'] ?? 'Administrador'), ENT_QUOTES, 'UTF-8') . '</span>
                                    <span class="dashboard-user-caret" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </span>
                                </button>
                                <div class="dashboard-user-dropdown-menu" aria-label="Menu do usuário">
                                    <a href="sair.php" class="dashboard-user-dropdown-item dashboard-logout-item">Sair</a>
                                </div>
                            </div>
                        </div>

                        <div class="dashboard-cabecalho">
                            <div class="dashboard-mensagem" id="dashboard-mensagem">
                                '.$this->renderDashboardToast($string, $status).'
                            </div>
                        </div>

                        <div id="dashboard-container-conteudo"></div>
                    </div>
                </div>

            <template id="template-gerenciar">
                <div class="gerenciar-cursos">
                    <div class="topo-gerenciar">
                        <div class="titulo-area">
                            <h1>Cursos</h1>
                            <p>Gerencie todos os cursos cadastrados na plataforma.</p>
                        </div>
                        <button class="btn-novo" type="button" data-view="linguagem">
                            + Novo Curso
                        </button>
                    </div>
                    <div class="barra-filtros">
                        <input
                            type="search"
                            placeholder="Pesquisar curso..."
                            class="campo-pesquisa"
                            aria-label="Pesquisar curso">
                        <select>
                            <option>Todos os níveis</option>
                            <option>Iniciante</option>
                            <option>Intermediário</option>
                            <option>Avançado</option>
                        </select>
                        <select>
                            <option>Mais recentes</option>
                            <option>Mais antigos</option>
                            <option>A-Z</option>
                            <option>Z-A</option>
                        </select>
                        <div class="admin-curso-filtros" aria-label="Filtrar por nível">
                            <button type="button" class="admin-curso-filtro-btn active" data-filtro="todos">Todos</button>
                            <button type="button" class="admin-curso-filtro-btn" data-filtro="iniciante">Iniciante</button>
                            <button type="button" class="admin-curso-filtro-btn" data-filtro="intermediario">Intermediário</button>
                            <button type="button" class="admin-curso-filtro-btn" data-filtro="avancado">Avançado</button>
                        </div>
                    </div>
                    <div class="lista-cursos">
                        ' .$html_gerenciar. '
                    </div>
                    <div class="admin-curso-sem-resultados" hidden>
                        <strong>Nenhum curso encontrado.</strong>
                        <p>Tente outro termo ou altere o filtro selecionado.</p>
                    </div>
                </div>
            </template>

            <template id="template-editar-curso">
                <section class="form-panel-inline editar-curso-panel" aria-labelledby="titulo-editar-curso">
                    <div class="form-panel-header">
                        <h3 id="titulo-editar-curso">Editar Curso</h3>
                    </div>
                    <div class="editar-curso-acoes">
                        <form action="dashboard.php" method="post" onsubmit="return confirm(\'Excluir esta linguagem, seus módulos, aulas e exercícios?\');">
                            <input type="hidden" name="dashboard_view" value="editar-curso">
                            <input type="hidden" name="id_linguagem" value="' . htmlspecialchars((string) ($cursoEdicao['id_linguagem'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                            <button type="submit" name="btnExcluirLinguagem" class="btn-deletar-curso">Deletar Curso</button>
                        </form>
                    </div>
                    <form class="form-painel editar-curso-form" action="dashboard.php" method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="dashboard_view" value="editar-curso">
                        <input type="hidden" id="editar-curso-id" name="id_linguagem" value="' . htmlspecialchars((string) ($cursoEdicao['id_linguagem'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                        <div class="meta-dados">
                            <div class="meta-item">
                                <span>Criado por</span>
                                <strong>' . htmlspecialchars((string) (($cursoEdicao['nome_admin_criador'] ?? $cursoEdicao['id_admin_criador'] ?? '')), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Data de criação</span>
                                <strong>' . htmlspecialchars((string) ($cursoEdicao['data_criacao'] ?? ''), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Atualizado por</span>
                                <strong>' . htmlspecialchars((string) (($cursoEdicao['nome_admin_editor'] ?? $cursoEdicao['id_admin_editor'] ?? '')), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Última atualização</span>
                                <strong>' . htmlspecialchars((string) ($cursoEdicao['data_atualizacao'] ?? ''), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                        </div>
                        <div class="campo-formulario">
                            <label for="editar-curso-nome">Nome da Linguagem</label>
                            <input type="text" id="editar-curso-nome" name="nome_linguagem" value="' . htmlspecialchars((string) ($cursoEdicao['nome_linguagem'] ?? ''), ENT_QUOTES, 'UTF-8') . '" required>
                        </div>

                        <div class="campo-formulario">
                            <label for="editar-curso-descricao">Descrição</label>
                            <textarea id="editar-curso-descricao" name="descricao_linguagem" rows="5">' . htmlspecialchars((string) ($cursoEdicao['descricao'] ?? ''), ENT_QUOTES, 'UTF-8') . '</textarea>
                        </div>

                        <div class="campo-formulario">
                            <label for="editar-curso-nivel">Nível</label>
                            <input type="text" id="editar-curso-nivel" name="nivel_linguagem" value="' . htmlspecialchars((string) ($cursoEdicao['nivel'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                        </div>

                        <div class="campo-formulario">
                            <label>Imagem atual</label>
                            <div class="editar-curso-imagem-atual">
                                <img src="' . htmlspecialchars($imagemCursoEdicao, ENT_QUOTES, 'UTF-8') . '" alt="Imagem atual do curso">
                                <span>Imagem cadastrada</span>
                            </div>
                        </div>

                        <div class="campo-img">
                            <label for="editar-curso-imagem">Substituir imagem</label>
                            <input type="file" id="editar-curso-imagem" name="img" accept="image/*">
                        </div>

                        <button type="submit" name="btnAtualizarLinguagem" class="btn-salvar">Atualizar Curso</button>
                    </form>

                    <hr class="editar-curso-divisor">

                    <section class="editar-curso-modulos" aria-labelledby="titulo-modulos-curso">
                        <div class="editar-curso-modulos-cabecalho">
                            <div>
                                <h4 id="titulo-modulos-curso">Módulos do Curso</h4>
                                <p>Gerencie os módulos vinculados a esta linguagem.</p>
                            </div>
                        </div>

                        <div class="editar-curso-tabela-wrapper">
                            <table class="tabela-modulos">
                                <thead>
                                    <tr>
                                        <th scope="col">Título</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col" class="coluna-ordem">Ordem</th>
                                        <th scope="col" class="coluna-acoes"><span class="visualmente-oculto">Ações</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ' . $htmlModulosCurso . '
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <hr class="editar-curso-divisor">
                </section>
            </template>

            <template id="template-editar-modulo">
                <section class="form-panel-inline editar-curso-panel" aria-labelledby="titulo-editar-modulo">
                    <div class="form-panel-header">
                        <h3 id="titulo-editar-modulo">Módulo</h3>
                    </div>
                    <div class="editar-curso-acoes">
                        <a class="btn-voltar-painel" href="dashboard.php?view=editar-curso&amp;linguagem=' . urlencode((string) ($moduloEdicao['id_linguagem'] ?? '')) . '">Voltar ao curso</a>
                        <form action="dashboard.php" method="post" onsubmit="return confirm(\'Excluir este módulo e todas as aulas vinculadas?\');">
                            <input type="hidden" name="dashboard_view" value="editar-modulo">
                            <input type="hidden" name="id_modulo" value="' . htmlspecialchars((string) ($moduloEdicao['id_modulo'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                            <button type="submit" name="btnExcluirModulo" class="btn-deletar-curso">Deletar Módulo</button>
                        </form>
                    </div>
                    <form class="form-painel dados-selecionados" action="dashboard.php" method="post">
                        <input type="hidden" name="dashboard_view" value="editar-modulo">
                        <input type="hidden" name="id_modulo" value="' . htmlspecialchars((string) ($moduloEdicao['id_modulo'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                        <div class="meta-dados">
                            <div class="meta-item">
                                <span>Criado por</span>
                                <strong>' . htmlspecialchars((string) (($moduloEdicao['nome_admin_criador'] ?? $moduloEdicao['id_admin_criador'] ?? '')), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Data de criação</span>
                                <strong>' . htmlspecialchars((string) ($moduloEdicao['data_criacao'] ?? ''), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Atualizado por</span>
                                <strong>' . htmlspecialchars((string) (($moduloEdicao['nome_admin_editor'] ?? $moduloEdicao['id_admin_editor'] ?? '')), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Última atualização</span>
                                <strong>' . htmlspecialchars((string) ($moduloEdicao['data_atualizacao'] ?? ''), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                        </div>
                        <div class="campo-formulario">
                            <label>Título do módulo</label>
                            <input type="text" name="titulo_modulo" value="' . htmlspecialchars((string) ($moduloEdicao['titulo_modulo'] ?? ''), ENT_QUOTES, 'UTF-8') . '" required>
                        </div>
                        <div class="campo-formulario">
                            <label>Descrição</label>
                            <textarea name="descricao_modulo" rows="5" required>' . htmlspecialchars((string) ($moduloEdicao['descricao_modulo'] ?? ''), ENT_QUOTES, 'UTF-8') . '</textarea>
                        </div>
                        <div class="campo-formulario campo-ordem-selecionado">
                            <label>Ordem</label>
                            <input type="number" name="ordem_modulo" min="1" value="' . htmlspecialchars((string) ($moduloEdicao['ordem_modulo'] ?? ''), ENT_QUOTES, 'UTF-8') . '" required>
                        </div>
                        <button type="submit" name="btnAtualizarModulo" class="btn-salvar">Atualizar Módulo</button>
                    </form>
                    <hr class="editar-curso-divisor">
                    <section class="editar-curso-modulos" aria-labelledby="titulo-aulas-modulo">
                        <div class="editar-curso-modulos-cabecalho">
                            <div>
                                <h4 id="titulo-aulas-modulo">Aulas do Módulo</h4>
                                <p>Gerencie as aulas vinculadas a este módulo.</p>
                            </div>
                        </div>
                        <div class="editar-curso-tabela-wrapper">
                            <table class="tabela-modulos">
                                <thead><tr><th scope="col">Título</th><th scope="col">Conteúdo</th><th scope="col" class="coluna-ordem">Ordem</th><th scope="col" class="coluna-acoes"><span class="visualmente-oculto">Ações</span></th></tr></thead>
                                <tbody>' . $htmlAulasModulo . '</tbody>
                            </table>
                        </div>
                    </section>
                </section>
            </template>

            <template id="template-editar-aula">
                <section class="form-panel-inline editar-curso-panel" aria-labelledby="titulo-editar-aula">
                    <div class="form-panel-header">
                        <h3 id="titulo-editar-aula">Aula</h3>
                    </div>
                    <div class="editar-curso-acoes">
                        <a class="btn-voltar-painel" href="dashboard.php?view=editar-modulo&amp;modulo=' . urlencode((string) ($aulaEdicao['id_modulo'] ?? '')) . '">Voltar ao módulo</a>
                        <form action="dashboard.php" method="post" onsubmit="return confirm(\'Excluir esta aula e todos os exercícios vinculados?\');">
                            <input type="hidden" name="dashboard_view" value="editar-aula">
                            <input type="hidden" name="id_aula" value="' . htmlspecialchars((string) ($aulaEdicao['id_aula'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                            <button type="submit" name="btnExcluirAula" class="btn-deletar-curso">Deletar Aula</button>
                        </form>
                    </div>
                    <form class="form-painel dados-selecionados" action="dashboard.php" method="post">
                        <input type="hidden" name="dashboard_view" value="editar-aula">
                        <input type="hidden" name="id_aula" value="' . htmlspecialchars((string) ($aulaEdicao['id_aula'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                        <div class="meta-dados">
                            <div class="meta-item">
                                <span>Criado por</span>
                                <strong>' . htmlspecialchars((string) (($aulaEdicao['nome_admin_criador'] ?? $aulaEdicao['id_admin_criador'] ?? '')), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Data de criação</span>
                                <strong>' . htmlspecialchars((string) ($aulaEdicao['data_criacao'] ?? ''), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Atualizado por</span>
                                <strong>' . htmlspecialchars((string) (($aulaEdicao['nome_admin_editor'] ?? $aulaEdicao['id_admin_editor'] ?? '')), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Última atualização</span>
                                <strong>' . htmlspecialchars((string) ($aulaEdicao['data_atualizacao'] ?? ''), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                        </div>
                        <div class="campo-formulario">
                            <label>Título da aula</label>
                            <input type="text" name="titulo_aula" value="' . htmlspecialchars((string) ($aulaEdicao['titulo_aula'] ?? ''), ENT_QUOTES, 'UTF-8') . '" required>
                        </div>
                        <div class="campo-formulario">
                            <label>Conteúdo</label>
                            <textarea name="conteudo_aula" rows="5" required>' . htmlspecialchars((string) ($aulaEdicao['conteudo_aula'] ?? ''), ENT_QUOTES, 'UTF-8') . '</textarea>
                        </div>
                        <div class="campo-formulario campo-ordem-selecionado">
                            <label>Ordem</label>
                            <input type="number" name="ordem_aula" min="1" value="' . htmlspecialchars((string) ($aulaEdicao['ordem_aula'] ?? ''), ENT_QUOTES, 'UTF-8') . '" required>
                        </div>
                        <button type="submit" name="btnAtualizarAula" class="btn-salvar">Atualizar Aula</button>
                    </form>
                    <hr class="editar-curso-divisor">
                    <section class="editar-curso-modulos" aria-labelledby="titulo-exercicios-aula">
                        <div class="editar-curso-modulos-cabecalho">
                            <div>
                                <h4 id="titulo-exercicios-aula">Exercícios da Aula</h4>
                                <p>Exercícios vinculados a esta aula.</p>
                            </div>
                        </div>
                        <div class="editar-curso-tabela-wrapper">
                            <table class="tabela-modulos">
                                <thead><tr><th scope="col">Tipo</th><th scope="col">Pergunta</th><th scope="col">Feedback de erro</th><th scope="col" class="coluna-acoes"><span class="visualmente-oculto">Ações</span></th></tr></thead>
                                <tbody>' . $htmlExerciciosAula . '</tbody>
                            </table>
                        </div>
                    </section>
                </section>
            </template>

            <template id="template-editar-exercicio">
                <section class="form-panel-inline editar-curso-panel" aria-labelledby="titulo-editar-exercicio">
                    <div class="form-panel-header"><h3 id="titulo-editar-exercicio">Exercício</h3></div>
                    <div class="editar-curso-acoes">
                        <a class="btn-voltar-painel" href="dashboard.php?view=editar-aula&amp;aula=' . urlencode((string) ($exercicioEdicao['id_aula'] ?? '')) . '">Voltar à aula</a>
                        <form action="dashboard.php" method="post" onsubmit="return confirm(\'Excluir este exercício e todos os itens vinculados?\');">
                            <input type="hidden" name="dashboard_view" value="editar-exercicio">
                            <input type="hidden" name="id_exercicio" value="' . htmlspecialchars((string) ($exercicioEdicao['id_exercicio'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                            <button type="submit" name="btnExcluirExercicio" class="btn-deletar-curso">Deletar Exercício</button>
                        </form>
                    </div>
                    <form class="form-painel dados-selecionados" action="dashboard.php" method="post">
                        <input type="hidden" name="dashboard_view" value="editar-exercicio">
                        <input type="hidden" name="id_exercicio" value="' . htmlspecialchars((string) ($exercicioEdicao['id_exercicio'] ?? ''), ENT_QUOTES, 'UTF-8') . '">
                        <div class="meta-dados">
                            <div class="meta-item">
                                <span>Criado por</span>
                                <strong>' . htmlspecialchars((string) (($exercicioEdicao['nome_admin_criador'] ?? $exercicioEdicao['id_admin_criador'] ?? '')), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Data de criação</span>
                                <strong>' . htmlspecialchars((string) ($exercicioEdicao['data_criacao'] ?? ''), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Atualizado por</span>
                                <strong>' . htmlspecialchars((string) (($exercicioEdicao['nome_admin_editor'] ?? $exercicioEdicao['id_admin_editor'] ?? '')), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                            <div class="meta-item">
                                <span>Última atualização</span>
                                <strong>' . htmlspecialchars((string) ($exercicioEdicao['data_atualizacao'] ?? ''), ENT_QUOTES, 'UTF-8') . '</strong>
                            </div>
                        </div>
                        <div class="campo-formulario"><label>Tipo do exercício</label><input type="text" value="' . htmlspecialchars((string) ($exercicioEdicao['tipo_exercicio'] ?? ''), ENT_QUOTES, 'UTF-8') . '" readonly></div>
                        <div class="campo-formulario"><label>Pergunta</label><textarea name="pergunta_exercicio" rows="5" required>' . htmlspecialchars((string) ($exercicioEdicao['pergunta'] ?? ''), ENT_QUOTES, 'UTF-8') . '</textarea></div>
                        <div class="campo-formulario"><label>Feedback de erro</label><input type="text" name="feedback_erro" value="' . htmlspecialchars((string) ($exercicioEdicao['feedback_erro'] ?? ''), ENT_QUOTES, 'UTF-8') . '"></div>
                        <button type="submit" name="btnAtualizarExercicio" class="btn-salvar">Atualizar Exercício</button>
                    </form>
                    <hr class="editar-curso-divisor">
                    <section class="editar-curso-modulos" aria-labelledby="titulo-itens-exercicio">
                        <div class="editar-curso-modulos-cabecalho"><div><h4 id="titulo-itens-exercicio">Itens do tipo ' . htmlspecialchars($tipoExercicioEdicao, ENT_QUOTES, 'UTF-8') . '</h4><p>Edite ou exclua somente os itens vinculados a este exercício.</p></div></div>
                        <div class="itens-exercicio-lista">' . $htmlItensExercicio . '</div>
                    </section>
                </section>
            </template>

            <template id="template-linguagem">
                <div class="form-panel-inline">
                    <div class="form-panel-header">
                        <h3>Cadastrar Linguagem</h3>
                    </div>
                    <form class="form-painel" action="dashboard.php" method="post" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="dashboard_view" value="linguagem">
                        <div class="campo-formulario">
                            <label for="nome_linguagem">Nome da Linguagem</label>
                            <input type="text" id="nome_linguagem" name="nome_linguagem" placeholder="Ex: PHP" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="descricao_linguagem">Descrição</label>
                            <textarea id="descricao_linguagem" name="descricao_linguagem" rows="4" placeholder="Descreva a linguagem"></textarea>
                        </div>
                        <div class="campo-formulario">
                            <label for="nivel_linguagem">Nível</label>
                            <input type="text" id="nivel_linguagem" name="nivel_linguagem" placeholder="Ex: Iniciante">
                        </div>
                        <div class="campo-img">
                            <input type="file" id="img" name="img" accept="image/*">
                        </div>
                        <button type="submit" name="btnSalvarLinguagem" class="btn-salvar">Salvar Linguagem</button>
                    </form>
                </div>
            </template>

            <template id="template-modulo">
                <div class="form-panel-inline">
                    <div class="form-panel-header">
                        <h3>Cadastrar Módulo</h3>
                    </div>
                    <form class="form-painel" action="dashboard.php" method="post" autocomplete="off">
                        <input type="hidden" name="dashboard_view" value="modulo">
                        <div class="campo-formulario">
                            <label for="titulo_modulo">Titulo do Modulo</label>
                            <input type="text" id="titulo_modulo" name="titulo_modulo" placeholder="Ex: Logica de Programacao" required>
                        </div>
                        <div class="campo-formulario">
                            <label for="descricao_modulo">Descricao do Modulo</label>
                            <textarea id="descricao_modulo" name="descricao_modulo" rows="5" placeholder="Descreva o objetivo deste modulo" required></textarea>
                        </div>
                        <div class="campo-formulario">
                            <label for="id_linguagem">Linguagem</label>
                            <select id="id_linguagem" name="id_linguagem" required>
                                '.$opcoes_linguagem.'
                            </select>
                        </div>
                        <div class="campo-formulario">
                            <label for="ordem_modulo">Ordem do Modulo (opcional)</label>
                            <input type="number" id="ordem_modulo" name="ordem_modulo" min="1" placeholder="Ex: 1">
                        </div>
                        <button type="submit" name="btnSalvarModulo" class="btn-salvar">Salvar Modulo</button>
                    </form>
                </div>
            </template>

            <template id="template-aula">
                <div class="form-panel-inline">
                    <div class="form-panel-header">
                        <h3>Cadastrar Aula</h3>
                    </div>
                    <form class="form-painel" action="dashboard.php" method="post" autocomplete="off">
                        <input type="hidden" name="dashboard_view" value="aula">
                        <div class="linha-formulario">
                            <div class="campo-formulario">
                                <label for="id_modulo_aula">Modulo</label>
                                <select id="id_modulo_aula" name="id_modulo_aula" required>
                                    '.$opcoes_modulo.'
                                </select>
                            </div>
                            <div class="campo-formulario">
                                <label for="titulo_aula">Titulo da Aula</label>
                                <input type="text" id="titulo_aula" name="titulo_aula" placeholder="Ex: Estruturas condicionais" required>
                            </div>
                        </div>
                        <div class="campo-formulario">
                            <label for="conteudo_aula">Conteudo da Aula</label>
                            <textarea id="conteudo_aula" name="conteudo_aula" rows="8" placeholder="Escreva o conteudo da aula" required></textarea>
                        </div>
                        <div class="campo-formulario">
                            <label for="ordem_aula">Ordem da Aula (opcional)</label>
                            <input type="number" id="ordem_aula" name="ordem_aula" min="1" placeholder="Ex: 1">
                        </div>
                        <button type="submit" name="btnSalvarAula" class="btn-salvar">Salvar Aula</button>
                    </form>
                </div>
            </template>

            <template id="template-exercicio">
                <div class="form-panel-inline">
                    <div class="form-panel-header">
                        <h3>Cadastrar Exercício</h3>
                    </div>
                    <form class="form-painel" action="dashboard.php" method="post" autocomplete="off">
                        <input type="hidden" name="dashboard_view" value="exercicio">
                        <div class="linha-formulario">
                            <div class="campo-formulario">
                                <label for="id_aula_exercicio">Aula</label>
                                <select id="id_aula_exercicio" name="id_aula_exercicio" required>
                                    '.$opcoes_aula.'
                                </select>
                            </div>
                            <div class="campo-formulario">
                                <label for="tipo_exercicio">Tipo do Exercicio</label>
                                <select id="tipo_exercicio" name="tipo_exercicio" required>
                                    <option value="">Selecione o tipo</option>
                                    <option value="multipla_escolha">Multipla escolha</option>
                                    <option value="completar_lacunas">Completar lacunas</option>
                                    <option value="ordenar_blocos">Ordenar blocos</option>
                                </select>
                            </div>
                        </div>
                        <div class="campo-formulario">
                            <label for="pergunta_exercicio">Pergunta</label>
                            <textarea id="pergunta_exercicio" name="pergunta_exercicio" rows="4" placeholder="Digite o enunciado do exercicio" required></textarea>
                            <label for="feedback_erro">Feedback para resposta incorreta</label>
                            <textarea id="feedback_erro" 
                            name="feedback_erro" 
                            rows="4" 
                            placeholder="Escreva uma explicação que será exibida quando o aluno responder incorretamente. Explique o erro e, se possível, dê uma dica para chegar à resposta correta." 
                            required></textarea>
                        </div>
                        <div id="tipos-exercicio-conteudo" class="bloco-dinamico"></div>
                        <button type="submit" name="btnSalvarExercicio" class="btn-salvar">Salvar Exercicio</button>
                    </form>
                </div>
            </template>

        ';
    }

    // Selecionarcurso_Page removed; merged into SalaGeralPage

    public function SalaGeralPage($modulos, $aula, $linguagens, $selectedLinguagem = null, $messageInicio = '', $enrolledLinguagens = []){
        $html_modulos = '';
        $html_listarcursos = '';
        $html_inscritos = '';
        $level_counter = 0;
        
        foreach ($linguagens as $linguagem) {
            $imgRaw = $linguagem['img'] ?? '';
            $imgRaw = is_string($imgRaw) ? trim($imgRaw) : '';
            $nomeCurso = htmlspecialchars((string)($linguagem['nome_linguagem'] ?? 'Curso'), ENT_QUOTES, 'UTF-8');
            $nivelCurso = strtolower((string)($linguagem['nivel'] ?? ''));

            $imagemHtml = '';
            if ($imgRaw !== '') {
                $imagemHtml = '<img src="' . htmlspecialchars($imgRaw, ENT_QUOTES, 'UTF-8') . '" alt="' . $nomeCurso . '">';
            } else {
                $imagemHtml = '<img src="imagens/img_curso.png" alt="' . $nomeCurso . '">';
            }

            $html_listarcursos .= '
                <div class="curso-card" data-nome="' . strtolower(htmlspecialchars((string)($linguagem['nome_linguagem'] ?? ''), ENT_QUOTES, 'UTF-8')) . '" data-nivel="' . htmlspecialchars($nivelCurso, ENT_QUOTES, 'UTF-8') . '">
                    <div class="img-curso">
                        ' . $imagemHtml . '
                    </div>
                    <div class="estrutura">
                        <div class="titulo">
                            <h3>' . $nomeCurso . '</h3>
                        </div>
                        <div class="descricao">
                            <p>' . htmlspecialchars($linguagem['descricao'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>
                        </div>
                        <div class="nivel">
                            <p>' . htmlspecialchars($linguagem['nivel'] ?? '', ENT_QUOTES, 'UTF-8') . '</p>
                        </div>
                        <div class="btn-selecionarcurso">
                            <a href="sala.php?linguagem=' . htmlspecialchars($linguagem['id_linguagem'] ?? '', ENT_QUOTES, 'UTF-8') . '" >Selecionar</a>
                        </div>
                    </div>
                </div>
            ';
        }
        
        foreach ($modulos as $indexModulo => $modulo) {
            $tituloModulo = htmlspecialchars((string)($modulo['titulo_modulo'] ?? ''), ENT_QUOTES, 'UTF-8');
            $descricaoModulo = htmlspecialchars((string)($modulo['descricao_modulo'] ?? ''), ENT_QUOTES, 'UTF-8');
            $idModulo = (int)($modulo['id_modulo'] ?? 0);
            $aulasDoModulo = [];

            foreach ($aula as $itemAula) {
                if ((int)($itemAula['id_modulo'] ?? 0) === $idModulo) {
                    $aulasDoModulo[] = $itemAula;
                }
            }

            $totalAulas = count($aulasDoModulo);
            $aulasConcluidas = 0;
            $aulasHtml = '';

            foreach ($aulasDoModulo as $indiceAula => $itemAula) {
                $numeroAula = $indiceAula + 1;
                $tituloAula = htmlspecialchars((string)($itemAula['titulo_aula'] ?? ''), ENT_QUOTES, 'UTF-8');
                $conteudoAula = trim((string)($itemAula['conteudo_aula'] ?? ''));
                $descricaoAula = $conteudoAula !== '' ? preg_replace('/\s+/', ' ', $conteudoAula) : 'Continue sua jornada com esta aula.';
                $descricaoAula = htmlspecialchars($descricaoAula, ENT_QUOTES, 'UTF-8');
                $idAula = (int)($itemAula['id_aula'] ?? 0);
                $estadoAula = $itemAula['estado_aula'] ?? 'pendente';
                $aulaConcluida = $estadoAula === 'concluida';
                $aulaBloqueada = $estadoAula === 'bloqueada';

                if ($aulaConcluida) {
                    $aulasConcluidas++;
                }

                $badgeHtml = '';
                $botaoHtml = '';

                if ($aulaConcluida) {
                    $badgeHtml = '<span class="check-badge success">✓ Concluído</span>';
                    $botaoHtml = '<a href="atividade.php?id_aula=' . $idAula . '" class="aula-revisar-btn" title="Abrir aula">Revisar</a>';
                } elseif ($aulaBloqueada) {
                    $badgeHtml = '<span class="check-badge locked" aria-label="Aula bloqueada"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="11" width="14" height="10" rx="2"></rect><path d="M8 11V8a4 4 0 1 1 8 0v3"></path></svg> Bloqueada</span>';
                    $botaoHtml = '<button type="button" class="aula-revisar-btn disabled" disabled aria-disabled="true" tabindex="-1">Revisar</button>';
                } else {
                    $badgeHtml = '<span class="check-badge pending">Pendente</span>';
                    $botaoHtml = '<a href="atividade.php?id_aula=' . $idAula . '" class="aula-revisar-btn" title="Abrir aula">Revisar</a>';
                }

                $aulasHtml .= '
                    <div class="modulo-aula-item ' . ($aulaConcluida ? 'is-complete' : '') . ' ' . ($aulaBloqueada ? 'is-blocked' : '') . '">
                        <div class="aula-numero">' . $numeroAula . '</div>
                        <div class="aula-info">
                            <div class="aula-titulo">Aula ' . $numeroAula . ' - ' . $tituloAula . '</div>
                            <div class="aula-descricao">' . $descricaoAula . '</div>
                        </div>
                        <div class="aula-actions">
                            ' . $badgeHtml . '
                            ' . $botaoHtml . '
                        </div>
                    </div>
                ';
            }

            $html_modulos .= '
                <section class="modulo-card" data-modulo="' . $idModulo . '">
                    <div class="modulo-header">
                        <div class="modulo-header-main">
                            <span class="modulo-badge">' . ($indexModulo + 1) . '</span>
                            <button class="modulo-info-btn" type="button" command="show-modal" commandfor="modulo-dialog-' . $idModulo . '" aria-label="Abrir descrição do módulo">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="12" cy="12" r="9"></circle>
                                    <path d="M12 16v-4"></path>
                                    <path d="M12 8h.01"></path>
                                </svg>
                            </button>
                            <div class="modulo-header-text">
                                <h2>Módulo ' . ($indexModulo + 1) . ': ' . $tituloModulo . '</h2>
                            </div>
                        </div>

                        <div class="modulo-actions">
                            <div class="modulo-progress">
                                <span class="progress-check" style="background: #1d9b5d; color: #ffffff;">✓</span>
                                <span>' . $aulasConcluidas . ' / ' . $totalAulas . ' aulas</span>
                            </div>

                            <button class="modulo-toggle" type="button" aria-label="Expandir módulo" aria-expanded="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <dialog class="modulo-dialog" id="modulo-dialog-' . $idModulo . '">
                        <form method="dialog" class="modulo-dialog-form">
                            <div class="modulo-dialog-header">
                                <h3>Módulo ' . ($indexModulo + 1) . ': ' . $tituloModulo . '</h3>
                                <button class="modulo-dialog-close" type="submit" aria-label="Fechar descrição do módulo">✕</button>
                            </div>
                            <div class="modulo-dialog-body">
                                <p>' . ($descricaoModulo !== '' ? $descricaoModulo : 'Aprofunde os conceitos deste módulo e avance na sua jornada.') . '</p>
                            </div>
                        </form>
                    </dialog>

                    <div class="modulo-body">
                        ' . $aulasHtml . '
                    </div>
                </section>
            ';
        }

        // $selectedHtml = '';
        // $dataViewInicial = 'cursos';
        // if ($selectedLinguagem) {
        //     $selImg = $selectedLinguagem['img'] ?? '';
        //     $selImg = is_string($selImg) ? trim($selImg) : '';
        //     $selImgSrc = $selImg === '' ? 'imagens/img_curso.jpg' : htmlspecialchars($selImg, ENT_QUOTES, 'UTF-8');
        //     $selectedHtml = '<div class="selected-course"><div class="selected-header"><img src="' . $selImgSrc . '" alt="' . htmlspecialchars($selectedLinguagem['nome_linguagem'] ?? '', ENT_QUOTES, 'UTF-8') . '" class="selected-img"><div class="selected-info"><h2>' . htmlspecialchars($selectedLinguagem['nome_linguagem'] ?? '', ENT_QUOTES, 'UTF-8') . '</h2><p>' . nl2br(htmlspecialchars($selectedLinguagem['descricao'] ?? '', ENT_QUOTES, 'UTF-8')) . '</p><p><strong>Nível:</strong> ' . htmlspecialchars($selectedLinguagem['nivel'] ?? '', ENT_QUOTES, 'UTF-8') . '</p></div></div></div>';
        //     $dataViewInicial = 'conteudo';
        // }

        $html_inscritos = '';

        $messageInicio = trim((string) $messageInicio);
        if ($selectedLinguagem) {
            $conteudo_principal = '
            <div class="conteudo-atividade">
                <div class="conteudo-aulas">
                    ' . $html_modulos . '
                </div>
            </div>
            ';
        } else {
            $conteudo_principal = '';
        }

        $usuarioAtual = [];
        $idUsuarioSessao = isset($_SESSION['id_usuario']) ? (int) $_SESSION['id_usuario'] : 0;
        if ($idUsuarioSessao > 0) {
            $modelUsuarioPerfil = new Model();
            $usuarioAtual = $modelUsuarioPerfil->obter_usuario_por_id($idUsuarioSessao);
        }

        $nomeUsuarioPerfil = trim((string)($usuarioAtual['nome_usuario'] ?? $_SESSION['nome_usuario'] ?? 'Usuário'));
        $emailUsuarioPerfil = trim((string)($usuarioAtual['email_usuario'] ?? $_SESSION['email_usuario'] ?? 'usuario@dominio.com'));
        $nomeUsuarioTopbar = trim((string)($usuarioAtual['nome_usuario'] ?? $_SESSION['nome_usuario'] ?? 'Usuário'));

        $perfilCursosHtml = '';
        if (is_array($enrolledLinguagens) && count($enrolledLinguagens) > 0) {
            $modelPerfil = new Model();

            foreach ($enrolledLinguagens as $linguagem) {
                $cursoNome = htmlspecialchars((string)($linguagem['nome_linguagem'] ?? 'Curso'), ENT_QUOTES, 'UTF-8');
                $cursoImg = trim((string)($linguagem['img'] ?? ''));
                $cursoImgSrc = $cursoImg !== '' ? htmlspecialchars($cursoImg, ENT_QUOTES, 'UTF-8') : 'imagens/img_curso.png';

                $idLing = (int)($linguagem['id_linguagem'] ?? 0);
                $porcentagemCurso = 0;

                if ($idLing > 0) {
                    $modulosCurso = $modelPerfil->listar_modulo_por_linguagem($idLing);
                    $totalAulasCurso = 0;
                    $aulasConcluidasCurso = 0;

                    foreach ($modulosCurso as $moduloCurso) {
                        $idModuloCurso = (int)($moduloCurso['id_modulo'] ?? 0);
                        foreach ($aula as $itemAula) {
                            if ((int)($itemAula['id_modulo'] ?? 0) === $idModuloCurso) {
                                $totalAulasCurso++;
                                if (($itemAula['estado_aula'] ?? null) === 'concluida') {
                                    $aulasConcluidasCurso++;
                                }
                            }
                        }
                    }

                    if ($totalAulasCurso > 0) {
                        $porcentagemCurso = (int) round(($aulasConcluidasCurso / $totalAulasCurso) * 100);
                    }
                }

                $porcentagemCurso = max(0, min(100, $porcentagemCurso));
                $progressDeg = ($porcentagemCurso / 100) * 360;

                $perfilCursosHtml .= '
                    <div class="perfil-curso-item">
                        <a href="sala.php?linguagem=' . $idLing . '" class="perfil-curso-link" aria-label="Abrir curso ' . $cursoNome . '">
                            <div class="perfil-curso-ring" style="--progress: ' . $porcentagemCurso . '; --progress-deg: ' . $progressDeg . 'deg;">
                                <div class="perfil-curso-ring-inner">
                                    <img src="' . $cursoImgSrc . '" alt="' . $cursoNome . '">
                                </div>
                            </div>
                        </a>
                        <div class="perfil-curso-meta">
                            <span class="perfil-curso-nome">' . $cursoNome . '</span>
                            <span class="perfil-curso-percent">' . $porcentagemCurso . '% concluído</span>
                        </div>
                    </div>
                ';
            }
        } else {
            $perfilCursosHtml = '<div class="perfil-vazio">Você ainda não está cadastrado em nenhum curso.</div>';
        }

        if(!isset($_SESSION["login"]) == false) {

       echo '
            <div class="sala-overlay"></div>
            <button type="button" class="sala-menu-toggle" aria-label="Abrir menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="sala-container">
                <div class="sala-menu">

                    <div class="sidebar-logo">

                        <div class="logo-topo">
                            <img src="imagens/logo-beginner-dev.png"
                                alt="Beginner Dev"
                                class="sidebar-logo-img">
                                
                            <div class="logo-texto">
                                <h2>Beginner Dev</h2>
                                
                            </div>
                        </div>

                    </div>

                    <nav class="sidebar-nav">

                        <button type="button" class="menu-item active" data-view="conteudo">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">
                                <path d="M3 10.5 12 3l9 7.5"/>
                                <path d="M5 9.5V21h14V9.5"/>
                            </svg>

                            <span>Início</span>

                        </button>

                        <button type="button" class="menu-item" data-view="cursos">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                            </svg>

                            <span>Cursos</span>

                        </button>


                    </nav>

                    <div class="sidebar-footer">

                        <img src="imagens/astro.png"
                            alt="Astro"
                            class="capivara-img">

                        <h4>Continue aprendendo!</h4>

                        <p>
                            Escolha um curso e comece sua jornada.
                        </p>

                    </div>

                </div>

                <div class="sala-conteudo" id="sala-conteudo" data-view-inicial="' . ($selectedLinguagem ? 'conteudo' : 'cursos') . '">
                    <div class="sala-topbar">
                        <div class="sala-topbar-spacer"></div>

                        <div class="user-dropdown">
                            <button type="button" class="user-dropdown-button" aria-label="Abrir menu do usuário">
                                <span class="user-avatar" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21a8 8 0 0 0-16 0"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                </span>

                                <span class="user-name">' . htmlspecialchars((string) $nomeUsuarioTopbar, ENT_QUOTES, 'UTF-8') . '</span>
                                <span class="user-caret" aria-hidden="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6"/>
                                    </svg>
                                </span>
                            </button>

                            <div class="user-dropdown-menu" aria-label="Menu do usuário">
                                <button type="button" class="user-dropdown-item menu-item" data-view="perfil">Perfil</button>
                                <a href="sair.php" class="user-dropdown-item logout-item">Sair</a>
                            </div>
                        </div>
                    </div>

                    <div id="sala-formulario"></div>
                </div>
            </div>

            <template id="template-conteudo">
                <div class="conteudo-container">
                    '.$conteudo_principal.'
                </div>
            </template>

            <template id="template-cursos">
            <div class="curso-container">
                <div class="curso-cabecalho">
                    <div class="filtrar-busca">
                        <p>Selecione a linguagem que deseja aprender.</p>
                        <div class="buscar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
                            <input type="text" class="curso-search-input" placeholder="Pesquisar Linguagem...">
                        </div>
                    </div>
                    <div class="curso-filtros" aria-label="Filtros de cursos">
                        <button type="button" class="curso-filtro-btn active" data-filtro="todos">Todos</button>
                        <button type="button" class="curso-filtro-btn" data-filtro="iniciante">Iniciante</button>
                        <button type="button" class="curso-filtro-btn" data-filtro="intermediario">Intermediário</button>
                        <button type="button" class="curso-filtro-btn" data-filtro="avancado">Avançado</button>
                    </div>
                </div>
                <div class="conteudo-cursos">
                    <div class="cursos-lista">
                        '.$html_listarcursos.'
                    </div>
                    <div class="curso-sem-resultados" hidden>
                        <strong>Nenhum curso encontrado.</strong>
                        <p>Tente outra palavra-chave ou altere o filtro selecionado.</p>
                    </div>
                </div>
            </div>
            </template>

            <template id="template-perfil">
                <div class="conteudo-perfil">
                    <div class="perfil-header">
                        <div class="perfil-avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21a8 8 0 0 0-16 0"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <div>
                            <h2>Perfil</h2>
                            <p>Informações do usuário</p>
                        </div>
                    </div>

                    <div class="perfil-info-card">
                        <div class="campo-info">
                            <label>Nome:</label>
                            <span>' . htmlspecialchars($nomeUsuarioPerfil, ENT_QUOTES, 'UTF-8') . '</span>
                        </div>
                        <div class="campo-info">
                            <label>Email:</label>
                            <span>' . htmlspecialchars($emailUsuarioPerfil, ENT_QUOTES, 'UTF-8') . '</span>
                        </div>
                    </div>

                    <hr class="perfil-divisor">

                    <div class="perfil-cursos-section">
                        <div class="perfil-cursos-header">
                            <h3>Cursos matriculados</h3>
                        </div>
                        <div class="perfil-cursos-list">
                            ' . $perfilCursosHtml . '
                        </div>
                    </div>
                </div>
            </template>

            <template id="template-editar">
                <div class="conteudo-editar">
                    <h2>Editar Perfil</h2>
                    <form class="form-editar">
                        <div class="campo-formulario">
                            <label for="nome-editar">Nome:</label>
                            <input type="text" id="nome-editar" name="nome-editar" placeholder="Digite seu nome">
                        </div>
                        <div class="campo-formulario">
                            <label for="email-editar">Email:</label>
                            <input type="email" id="email-editar" name="email-editar" placeholder="Digite seu email">
                        </div>
                        <div class="campo-formulario">
                            <label for="senha-atual">Senha Atual:</label>
                            <input type="password" id="senha-atual" name="senha-atual" placeholder="Digite sua senha atual">
                        </div>
                        <div class="campo-formulario">
                            <label for="nova-senha">Nova Senha:</label>
                            <input type="password" id="nova-senha" name="nova-senha" placeholder="Digite sua nova senha">
                        </div>
                        <button type="submit" class="btn-salvar">Salvar Alterações</button>
                    </form>
                </div>
            </template>
        ';
        }
    }
            
    
    public function AtividadePage($aula, $exercicios, $id_aula) {
        $jsonExercicios = json_encode($exercicios, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        $total = count($exercicios);

        echo '
            <link rel="stylesheet" href="css/atividade.css">
            <div class="atividade-page">
                <div class="atividade-header">
                    <a href="sala.php" class="btn-cancelar">Cancelar</a>
                    <div class="atividade-progresso">
                        <div class="barra-progresso">
                            <div class="barra-progresso-fill" id="barra-progresso-fill"></div>
                        </div>
                        <div class="progresso-info">
                            <span id="porcentagem">0%</span>
                            <span id="texto-progresso">0 de ' . $total . ' corretos</span>
                        </div>
                    </div>
                </div>

                <div class="atividade-conteudo">
                    <div id="container-exercicio" class="exercicio-card">
                        <h2 id="pergunta-texto"></h2>
                        <div id="respostas"></div>
                        <div style="display: flex; justify-content: end; margin-top: 20px;">
                        <button id="btn-responder" class="btn-responder">Responder</button>
                        </div>
                        <div id="feedback" class="feedback"></div>
                    </div>
                </div>

                <div class="atividade-footer">
                    <div id="tempo-final" class="tempo-final" style="display:none;"></div>
                    <form id="form-progresso" method="post">
                        <input type="hidden" name="acao" value="salvar_progresso">
                        <input type="hidden" name="id_aula" value="' . htmlspecialchars($id_aula, ENT_QUOTES, 'UTF-8') . '">
                        <input type="hidden" name="total_exercicios" id="total_exercicios" value="' . $total . '">
                        <input type="hidden" name="exercicios_corretos" id="exercicios_corretos" value="0">
                        <input type="hidden" name="tempo_segundos" id="tempo_segundos" value="0">
                        <button type="submit" id="btn-continuar" class="btn-continuar" style="display:none;">Continuar</button>
                    </form>
                </div>
            </div>

            <script>
                const atividadeData = ' . $jsonExercicios . ';
            </script>
            <script src="js/atividade.js?v=2" defer></script>
        ';
    }

    public function footer($string){
        
    }

}
