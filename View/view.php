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
            <nav class="navbar">
                
                    <img src="imagens/logo.png" alt="Logo do site" class="logo">
            </nav>
            <header class="cabecalho-c">
            <div class="conteudo-cabecalho-c">
                <div class="texto-cabecalho-c">
                    <h1>APRENDA A PROGRAMAR DE FORMA PRÁTICA</h1>
                    <p>Antes de aprender uma linguagem, aprenda a pensar como um programador. 
                    Desenvolva sua lógica, pratique com pseudocódigo e evolua naturalmente até
                     a programação real.</p>
                    <a href="login.php" class="começar">COMEÇAR AGORA</a>
                </div>
            </div>
            <div class="imagem-cabecalho-c">
                <img src="imagens/img1.png" alt="Imagem de programação">
            </div>
        </header>
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
                <div class="login-formulario">
                    <div class="login-titulo">
                        <h1>Conecte-se</h1>
                    </div>
                    <form action="admin.php" method="post">
                        <div class="login-inputs">
                        

                            <input type="email" placeholder="Digite seu email" id="email_usuario" name="email_usuario" required><br>

                            <input type="password" placeholder="Digite sua senha" id="senha_usuario" name="senha_usuario" required><br>

                            <a href="index.php">Voltar para ao inicio</a>
                            <div style="color: red;">'.$string.'</div>

                            <div class="login-btn">
                                <input type="submit" name="btnLoginAdmin" value="Entrar">
                            </div>
                        </div>

                    </form>
                <div>
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

    public function DashboardPage($string, $modulos = [], $aulas = [], $abaAtiva = 'modulo', $linguagens = [], $status = 'info'){
        $opcoes_modulo = '<option value="">Selecione um modulo</option>';
        $opcoes_aula = '<option value="">Selecione uma aula</option>';
        $viewsPermitidas = ["modulo", "linguagem", "aula", "exercicio"];

        if (!in_array($abaAtiva, $viewsPermitidas, true)) {
            $abaAtiva = 'linguagem';
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
            <div class="dashboard-container">
                <aside class="dashboard-menu">
                    <a href="index.php" class="btn-voltar">Home</a>
                    
                    <details class="menu-dropdown">
                        <summary class="menu-item">Cadastro</summary>
                        <div class="menu-dropdown-content">
                            <a class="dropdown-link" href="#form-linguagem">Linguagem</a>
                            <a class="dropdown-link" href="#form-modulo">Módulo</a>
                            <a class="dropdown-link" href="#form-aula">Aula</a>
                            <a class="dropdown-link" href="#form-exercicio">Exercício</a>
                        </div>
                    </details>
                </aside>

                <div class="dashboard-conteudo" id="dashboard-conteudo">
                    <div class="dashboard-cabecalho">
                        <div class="dashboard-mensagem" id="dashboard-mensagem">
                            '.$this->renderDashboardToast($string, $status).'
                        </div>
                    </div>
                    
                    <section id="form-linguagem" class="form-panel-inline">
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
                    </section>

                    <section id="form-modulo" class="form-panel-inline">
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
                    </section>

                    <section id="form-aula" class="form-panel-inline">
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
                    </section>

                    <section id="form-exercicio" class="form-panel-inline">
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
                                        <option value="alternativa">Multipla escolha</option>
                                        <option value="completar">Completar lacunas</option>
                                        <option value="ordenar">Ordenar blocos</option>
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
                    </section>
                </div>
            </div>

            <template id="template-tipo-alternativa">
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
            </template>

            <template id="template-linguagem">
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

            </template>

            <template id="template-aula">
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
            </template>

            <template id="template-exercicio">
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
                                <option value="alternativa">Multipla escolha</option>
                                <option value="completar">Completar lacunas</option>
                                <option value="ordenar">Ordenar blocos</option>
                            </select>
                        </div>
                    </div>

                    <div class="campo-formulario">
                        <label for="pergunta_exercicio">Pergunta</label>
                        <textarea id="pergunta_exercicio" name="pergunta_exercicio" rows="4" placeholder="Digite o enunciado do exercicio" required></textarea>
                    </div>

                    <div id="tipos-exercicio-conteudo" class="bloco-dinamico"></div>

                    <button type="submit" name="btnSalvarExercicio" class="btn-salvar">Salvar Exercicio</button>
                </form>
            </template>

            <template id="template-tipo-alternativa">
                <div class="card-tipo">
                    <h3>Opcoes da Multipla Escolha</h3>
                    <div class="campo-formulario">
                        <label for="opcao_1">Opcao 1</label>
                        <input type="text" id="opcao_1" name="opcao_1" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="opcao_2">Opcao 2</label>
                        <input type="text" id="opcao_2" name="opcao_2" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="opcao_3">Opcao 3</label>
                        <input type="text" id="opcao_3" name="opcao_3">
                    </div>
                    <div class="campo-formulario">
                        <label for="opcao_4">Opcao 4</label>
                        <input type="text" id="opcao_4" name="opcao_4">
                    </div>
                    <div class="campo-formulario">
                        <label for="opcao_correta">Opcao correta</label>
                        <select id="opcao_correta" name="opcao_correta" required>
                            <option value="">Selecione</option>
                            <option value="1">Opcao 1</option>
                            <option value="2">Opcao 2</option>
                            <option value="3">Opcao 3</option>
                            <option value="4">Opcao 4</option>
                        </select>
                    </div>
                </div>
            </template>

            <template id="template-tipo-completar">
                <div class="card-tipo">
                    <h3>Texto com Lacunas</h3>
                    <div class="campo-formulario">
                        <label for="texto_lacunas">Texto base</label>
                        <textarea id="texto_lacunas" name="texto_lacunas" rows="5" placeholder="Use ___ para marcar lacunas"></textarea>
                    </div>
                    <div class="campo-formulario">
                        <label for="respostas_lacunas">Respostas corretas</label>
                        <input type="text" id="respostas_lacunas" name="respostas_lacunas" placeholder="Ex: variavel, constante, funcao">
                    </div>
                </div>
            </template>

            <template id="template-tipo-ordenar">
                <div class="card-tipo">
                    <h3>Ordenacao de Blocos</h3>
                    <div class="campo-formulario">
                        <label for="bloco_1">Bloco 1</label>
                        <input type="text" id="bloco_1" name="bloco_1" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="bloco_2">Bloco 2</label>
                        <input type="text" id="bloco_2" name="bloco_2" required>
                    </div>
                    <div class="campo-formulario">
                        <label for="bloco_3">Bloco 3</label>
                        <input type="text" id="bloco_3" name="bloco_3">
                    </div>
                    <div class="campo-formulario">
                        <label for="bloco_4">Bloco 4</label>
                        <input type="text" id="bloco_4" name="bloco_4">
                    </div>
                    <div class="campo-formulario">
                        <label for="ordem_correta">Ordem correta</label>
                        <input type="text" id="ordem_correta" name="ordem_correta" placeholder="Ex: 2,1,3,4" required>
                    </div>
                </div>
            </template>

            <script src="js/dashboard.js" defer></script>
        ';
    }

    // Selecionarcurso_Page removed; merged into SalaGeralPage

    public function SalaGeralPage($modulos, $aula, $linguagens, $selectedLinguagem = null){
        $html_modulos = '';
        $html_listarcursos = '';
        $level_counter = 0;
        
        foreach ($linguagens as $linguagem) {
            $imgRaw = $linguagem['img'] ?? '';
            $imgRaw = is_string($imgRaw) ? trim($imgRaw) : '';

            if ($imgRaw === '') {
                $imgSrc = 'imagens/img_curso.png';
            } else {
                $imgSrc = $imgRaw;
            }

            $html_listarcursos .= '
                <div class="curso-card">
                    <div class="img-curso">
                        <img src="' . htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8') . '" alt="Logo">
                    </div>
                    <div class="estrutura">
                        <div class="titulo">
                            <h3>' . htmlspecialchars($linguagem['nome_linguagem'] ?? '', ENT_QUOTES, 'UTF-8') . '</h3>
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
        
        foreach ($modulos as $modulo) {
            $html_modulos .= '
                <div class="titulo-conteudo">
                    <h2>' . $modulo['titulo_modulo'] . '</h2>
                </div>
            ';
            
            foreach ($aula as $itemAula) {
                if ($itemAula['id_modulo'] == $modulo['id_modulo']) {
                    $level_counter++;
                    $html_modulos .= '
                        <a id="'.$itemAula['id_aula'].'" href="atividade.php?id_aula=' .$itemAula['id_aula']. '" class="btn-selecionar" title="'.$itemAula['titulo_aula'].'">Level ' . $level_counter . '</a>
                    ';
                }
            }
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

        if(!isset($_SESSION["login"]) == false) {

       echo '
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

                        <button type="button" class="menu-item" data-view="perfil">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                height="20"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2">
                                <path d="M20 21a8 8 0 0 0-16 0"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>

                            <span>Perfil</span>

                        </button>

                        <div class="dropdown">

                            <button type="button" class="menu-item dropdown-btn" data-view="config">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="3"/>
                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06A1.65 1.65 0 0 0 15 19.4a1.65 1.65 0 0 0-1 .6 1.65 1.65 0 0 0-.33 1V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-.33-1 1.65 1.65 0 0 0-1-.6 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-.6-1 1.65 1.65 0 0 0-1-.33H3a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1-.33 1.65 1.65 0 0 0 .6-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06A2 2 0 1 1 7.13 3.6l.06.06A1.65 1.65 0 0 0 9 4.6h.2a1.65 1.65 0 0 0 1-.6 1.65 1.65 0 0 0 .33-1V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 .33 1 1.65 1.65 0 0 0 1 .6h.2a1.65 1.65 0 0 0 1.82-.33l.06-.06A2 2 0 1 1 20.4 7.13l-.06.06A1.65 1.65 0 0 0 19.4 9v.2a1.65 1.65 0 0 0 .6 1 1.65 1.65 0 0 0 1 .33H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1 .33 1.65 1.65 0 0 0-.6 1z"/>
                                </svg>

                                <span>Configurações</span>

                            </button>

                            <div class="dropdown-content">

                                <button type="button" class="menu-item" data-view="editar">
                                    Editar Perfil
                                </button>

                                <a href="dashboard.php">Dashboard</a>

                                <a href="sair.php">Sair</a>

                            </div>

                        </div>

                    </nav>

                    <div class="sidebar-footer">

                        <img src="imagens/capivara.png"
                            alt="Capivara"
                            class="capivara-img">

                        <h4>Continue aprendendo!</h4>

                        <p>
                            Escolha um curso e comece sua jornada.
                        </p>

                    </div>

                </div>

                <div class="sala-conteudo" id="sala-conteudo" data-view-inicial="' . ($selectedLinguagem ? 'conteudo' : 'cursos') . '">
                    <div class="sala-cabecalho">
                        <h1 id="sala-titulo"></h1>
                    </div>
                    <div id="sala-formulario"></div>
                </div>
            </div>

            <template id="template-conteudo">
                <div class="conteudo-container">
                    <div class="conteudo-atividade">
                            <div class="conteudo-aulas">
                                '.$html_modulos.'
                            </div>
                    </div>
                    
                </div>
            </template>

            <template id="template-cursos">
            <div class="curso-container">
                <div class="curso-cabecalho">
                    <div class="filtrar-busca">
                        <p>Selecione a linguagem que deseja aprender.</p>
                        <div class="buscar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d176ed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
                            <input type="text" placeholder="Pesquisar Linguagem...">
                        </div>
                    </div>
                    <div class="espaco">A</div>
                    <div class="filtrar">A</div>
                    
                </div>
                <div class="conteudo-cursos">
                    <div class="cursos-lista">
                        '.$html_listarcursos.'
                    </div>
                </div>
            </div>
            </template>

            <template id="template-perfil">
                                <a href="sala.php?id_linguagem=' . htmlspecialchars($linguagem['id_linguagem'], ENT_QUOTES, 'UTF-8') . '" class="btn-selecionar">Selecionar</a>
                            </div>
                        ';
                        
                        echo '
                    </div>
                </div>
            </template>

            <template id="template-perfil">
                <div class="conteudo-perfil">
                    <h2>Informações do Usuário</h2>
                    <div class="perfil-info">
                        <div class="campo-info">
                            <label>Nome:</label>
                            <span id="nome-usuario">Carregando...</span>
                        </div>
                        <div class="campo-info">
                            <label>Email:</label>
                            <span id="email-usuario">Carregando...</span>
                        </div>
                        <div class="campo-info">
                            <label>Progresso Geral:</label>
                            <div class="progresso-bar">
                                <div class="progresso-fill" style="width: 0%;"></div>
                            </div>
                            <span id="progresso-percentual">0%</span>
                        </div>
                        <!-- Outras informações de progresso -->
                    </div>
                </div>
            </template>

            <template id="template-config">
                <div class="conteudo-config">
                    <h2>Configurações</h2>
                    <form class="form-config">
                        <div class="campo-formulario">
                            <label for="notificacoes">Notificações:</label>
                            <input type="checkbox" id="notificacoes" name="notificacoes">
                        </div>
                        <div class="campo-formulario">
                            <label for="tema">Tema:</label>
                            <select id="tema" name="tema">
                                <option value="claro">Claro</option>
                                <option value="escuro">Escuro</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-salvar">Salvar Configurações</button>
                    </form>
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