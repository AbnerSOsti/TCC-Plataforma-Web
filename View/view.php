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
                    <a href="listar_modulos.php">Módulos</a>
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
                <div class="cadastro-formulario">
                    <div class="cadastro-titulo">
                        <h1>Cadastro</h1>
                    </div>
                    <form action="cadastro.php" method="post">
                        <div class="cadastro-inputs">
                        
                            <input type="text" placeholder="Digite seu nome" id="nome_usuario" name="nome_usuario" required>

                            <input type="email" placeholder="Digite seu email" id="email_usuario" name="email_usuario" required>

                            

                            <input type="password" placeholder="Digite sua senha" id="senha_usuario" name="senha_usuario" required><br>

                            <a href="login.php">Já possui uma conta? Faça login</a>
                            <a href="index.php">Voltar para ao inicio</a>
                            <div style="color: red;">'.$string.'</div>

                            <div class="cadastro-btn">
                                <input type="submit" name="btnCadastro" value="Cadastrar">
                            </div>
                        </div>

                    </form>
                <div>
            </div>
        ';
        
    }

    public function Loginpage($string){
        echo '

            <div class="login-container">
                <div class="login-formulario">
                    <div class="login-titulo">
                        <h1>Conecte-se</h1>
                    </div>
                    <form action="login.php" method="post">
                        <div class="login-inputs">
                        

                            <input type="email" placeholder="Digite seu email" id="email_usuario" name="email_usuario" required><br>

                            <input type="password" placeholder="Digite sua senha" id="senha_usuario" name="senha_usuario" required><br>

                            <a href="cadastro.php">Não tem uma conta? Cadastre-se</a>
                            <a href="index.php">Voltar para ao inicio</a>
                            <a href="recuperarsenha.php">Esqueceu sua senha?</a>
                            <div style="color: red;">'.$string.'</div>

                            <div class="login-btn">
                                <input type="submit" name="btnLogin" value="Entrar">
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
                <div class="recuperacao-formulario">
                    <div class="recuperacao-titulo">
                        <h1>Recuperar Senha</h1>
                    </div>
                    <form action="recuperarsenha.php" method="post">
                        <div class="recuperacao-inputs">
                        
                            <input type="email" placeholder="Digite seu email" id="email_usuario" name="email_usuario" required>

                            <a href="cadastro.php">Não tem uma conta? Cadastre-se</a>
                            <a href="index.php">Voltar para ao inicio</a>
                            <div style="color: green;">'.$string.'</div>

                            <div class="recuperacao-btn">
                                <input type="submit" name="btnRecuperar" value="Enviar E-mail">
                            </div>
                        </div>

                    </form>
                <div>
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

    public function DashboardPage($string, $modulos = [], $aulas = [], $abaAtiva = 'modulo', $linguagens = []){
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
            <div class="dashboard-container">
            
                <div class="dashboard-menu">
                <a href="index.php" class="btn-voltar">Voltar</a>
                    <h2>Painel</h2>
                    
                    <button type="button" class="menu-item '.($abaAtiva === 'linguagem' ? 'active' : '').'" data-view="linguagem">Cadastrar Linguagem</button>
                    <button type="button" class="menu-item '.($abaAtiva === 'modulo' ? 'active' : '').'" data-view="modulo">Cadastrar Modulo</button>
                    <button type="button" class="menu-item '.($abaAtiva === 'aula' ? 'active' : '').'" data-view="aula">Cadastrar Aula</button>
                    <button type="button" class="menu-item '.($abaAtiva === 'exercicio' ? 'active' : '').'" data-view="exercicio">Cadastrar Exercicio</button>
                </div>

                <div class="dashboard-conteudo" id="dashboard-conteudo" data-view-inicial="'.$abaAtiva.'">
                    <div class="dashboard-cabecalho">
                        <h1 id="dashboard-titulo">Cadastrar Modulo</h1>
                        <p>Preencha os dados para montar seu conteudo.</p>
                        <div class="dashboard-mensagem">'.$string.'</div>
                    </div>
                    <div id="dashboard-formulario"></div>
                </div>
            
            </div>

            <template id="template-modulo">
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
                <form class="form-painel" action="dashboard.php" method="post" autocomplete="off">
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
        ';
    }

    public function Selecionarcurso_Page($linguagens){
        $html_linguagens = '';
        foreach($linguagens as $linguagem){
            $html_linguagens .= '
                <div class="card">
                    <div class="img">
                    <img src="imagens/img_curso.jpg" alt="" >
                    </div>
                    <div class="card-info">
                        <div class="titulo">
                        <h3>'.$linguagem['nome_linguagem'].'</h3>
                        </div>
                        <div class="categoria">
                        <p>'.$linguagem['nivel'].'</p>
                        </div>
                        <div class="btn">
                        <a id="'.$linguagem['id_linguagem'].'" href="sala.php?id_linguagem=' .$linguagem['id_linguagem']. '" class="btn-selecionar">Comerçar</a>
                        </div>
                    </div>
                </div>
            ';
        }
        echo'
        <div class="curso-container">
            <h1>Selecione um curso para começar</h1>
            <div class="card-container">
                '.$html_linguagens.'
            </div>
        ';
    }

    public function SalaGeralPage($modulos, $aula, $linguagens){
        // $html_modulos = '';
        // foreach ($modulos as $modulo) {
        // echo '<div class="modulo-card">';
        // echo '<h3>' . $modulo['titulo_modulo'] . '</h3>';

        // echo '<div class="aulas-list">';
        // foreach ($aula as $itemAula) {
        //     if ($itemAula['id_modulo'] == $modulo['id_modulo']) {
        //         echo '<div class="aula-item">' . $itemAula['titulo_aula'] . '</div>';
        //     }
        // }
        // echo '</div>';

        // echo '</div>';
        // }

        $html_modulos = '';
        foreach ($modulos as $modulo) {
        $html_modulos = '
            <div class="titulo-conteudo">
                <h2>' . $modulo['titulo_modulo'] . '</h2>
            </div>
        ';
        foreach ($aula as $itemAula) {
            if ($itemAula['id_modulo'] == $modulo['id_modulo']) {
                $html_modulos .= '
                    <div class="aula-item">' . $itemAula['titulo_aula'] . '</div>
                ';
            }
        }
        echo '</div>';

        echo '</div>';
        }

        if(!isset($_SESSION["login"]) == false) {

       echo '
            <div class="sala-container">
                <div class="sala-menu">
                    <div class="sidebar-logo">
                        <img src="imagens/nomelogo.png" alt="Nome do logo" class="sidebar-logo-img">
                    </div>
                    <nav class="sidebar-nav">
                        <button type="button" class="menu-item" data-view="conteudo">Conteúdo</button>
                        <button type="button" class="menu-item" data-view="perfil">Perfil</button>
                        <div class="dropdown">
                            <button type="button" class="menu-item dropdown-btn" data-view="mais">Mais</button>
                            <div class="dropdown-content">
                                <button type="button" class="menu-item" data-view="config">Configurações</button>
                                <button type="button" class="menu-item" data-view="editar">Editar</button>
                                <a href="sair.php">Sair</a>
                                <a href="dashboard.php">dash</a>
                            </div>
                        </div>
                    </nav>
                </div>

                <div class="sala-conteudo" id="sala-conteudo" data-view-inicial="conteudo">
                    <div class="sala-cabecalho">
                        <h1 id="sala-titulo"></h1>
                    </div>
                    <div id="sala-formulario"></div>
                </div>
            </div>

            <template id="template-conteudo">
                <div class="conteudo-container">
                    '.$html_modulos.'
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
            

    public function footer($string){
        
    }

}