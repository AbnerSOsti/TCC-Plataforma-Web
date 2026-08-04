<?php
header('Content-Type: text/html; charset=utf-8');
class Model {
    protected $conn;
    // protected $pdo;
    public function __construct() {
            include('conexao.php');
            $db = new Database();
            $this->conn = $db->connect();
    }

    private function getUtcNow() {
        return new DateTimeImmutable('now', new DateTimeZone('UTC'));
    }

    private function getRecoveryTokenData() {
        $expiresAt = $this->getUtcNow()->modify('+1 hour');

        return [
            'token' => bin2hex(random_bytes(16)) . '.' . $expiresAt->getTimestamp(),
            'expires_at' => $expiresAt->format('Y-m-d H:i:s'),
        ];
    }

    private function getEmbeddedTokenExpiration($token) {
        if (empty($token) || strpos($token, '.') === false) {
            return null;
        }

        $parts = explode('.', $token);
        $timestamp = end($parts);

        if (!ctype_digit((string) $timestamp)) {
            return null;
        }

        return (int) $timestamp;
    }

    private function isRecoveryTokenExpired($token, $expiresAt) {
        $embeddedExpiration = $this->getEmbeddedTokenExpiration($token);

        if ($embeddedExpiration !== null) {
            return $embeddedExpiration < $this->getUtcNow()->getTimestamp();
        }

        if (empty($expiresAt)) {
            return true;
        }

        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $expiresAt) === 1) {
            $expiration = DateTimeImmutable::createFromFormat(
                'Y-m-d H:i:s',
                $expiresAt . ' 23:59:59',
                new DateTimeZone('UTC')
            );

            if ($expiration === false) {
                return true;
            }

            return $expiration < $this->getUtcNow();
        }

        $expiration = DateTimeImmutable::createFromFormat(
            'Y-m-d H:i:s',
            $expiresAt,
            new DateTimeZone('UTC')
        );

        if ($expiration === false) {
            return true;
        }

        return $expiration < $this->getUtcNow();
    }
    
     public function cadastro_model(){
        
         if(isset($_POST["btnCadastrar"]) || isset($_POST["btnCadastro"])){

            $nome_usuario     = $_POST["nome_usuario"];
            $email_usuario    = $_POST["email_usuario"];
            $senha_usuario    = password_hash($_POST["senha_usuario"], PASSWORD_DEFAULT);
            $tipo_usuario     =  "ALUNO"; // Definindo o tipo de usuário como "Aluno"
            $datacadastro_usuario     = date('Y-m-d H:i:s');

        require_once('conexao.php');
        $db = new Database();
        $conn = $db->connect();

        if ($conn) {
            try {

                $query_check = "SELECT 1 FROM cadastro_usuario WHERE email_usuario = :email LIMIT 1";
                $stmt_check = $conn->prepare($query_check);
                $stmt_check->bindParam(":email", $email_usuario);
                $stmt_check->execute();

                if ($stmt_check->fetchColumn()) {
                    $string = "Este e-mail ja esta cadastrado.";
                    return $string;
                }

                $query = "INSERT INTO cadastro_usuario (
                            nome_usuario, email_usuario, senha_usuario, tipo_usuario, datacadastro_usuario
                        ) VALUES (
                            :nome, :email, :senha, :tipo, :data
                        )";

                $stmt = $conn->prepare($query);

                $stmt->bindParam(":nome", $nome_usuario);
                $stmt->bindParam(":email", $email_usuario);
                $stmt->bindParam(":senha", $senha_usuario);
                $stmt->bindParam(":tipo", $tipo_usuario);
                $stmt->bindParam(":data", $datacadastro_usuario);

                $stmt->execute();

            } catch (PDOException $e) {
                echo "Erro na escrita: " . $e->getMessage();
            }
        }
        }
    } 
    
    public function Login_model(){
        if(isset($_POST["btnLogin"])){

            $email_usuario    = $_POST["email_usuario"];
            $senha_usuario    = $_POST["senha_usuario"];

        require_once('conexao.php');
        $db = new Database();
        $conn = $db->connect();

        if ($conn) {
            try {

                $query = "SELECT * FROM cadastro_usuario WHERE email_usuario = :email";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":email", $email_usuario);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (password_verify($senha_usuario, $user['senha_usuario']) && $user['tipo_usuario'] === 'ALUNO') {
                        session_start();
                        $_SESSION["login"] = true;
                        $_SESSION["id_usuario"] = $user['id_usuario'];
                        $_SESSION["nome_usuario"] = $user['nome_usuario'];
                        $_SESSION["tipo_usuario"] = $user['tipo_usuario'];

                        $this->garantir_configuracao_usuario($user['id_usuario']);
                        $this->atualizar_configuracao_usuario($user['id_usuario'], [
                            'atualizar_ultimo_login' => true,
                            'atualizar_ultimo_acesso' => true,
                        ]);

                        $configuracao = $this->obter_configuracao_usuario($user['id_usuario']);
                        $_SESSION['last_linguagem'] = $configuracao['ultima_linguagem_acessada'] ?? $configuracao['id_linguagem_atual'] ?? null;
                        
                        header("Location: sala.php");
                        exit();
                    } else {
                        $string = "Senha incorreta.";
                        return $string;
                    }
                } else {
                    $string = "Email não encontrado.";
                    return $string;
                }

            } catch (PDOException $e) {
                echo "Erro na leitura: " . $e->getMessage();
            }
        }
        }
    }

    public function Login_Admin_model(){
        if(isset($_POST["btnLoginAdmin"])){

            $email_usuario    = $_POST["email_usuario"];
            $senha_usuario    = $_POST["senha_usuario"];

        require_once('conexao.php');
        $db = new Database();
        $conn = $db->connect();

        if ($conn) {
            try {

                $query = "SELECT * FROM cadastro_usuario WHERE email_usuario = :email";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":email", $email_usuario);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (password_verify($senha_usuario, $user['senha_usuario']) && $user['tipo_usuario'] === 'ADMIN') {
                        session_start();
                        $_SESSION["login"] = true;
                        $_SESSION["id_usuario"] = $user['id_usuario'];
                        $_SESSION["nome_usuario"] = $user['nome_usuario'];
                        $_SESSION["tipo_usuario"] = $user['tipo_usuario'];
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        $string = "Senha incorreta.";
                        return $string;
                    }
                } else {
                    $string = "Email não encontrado.";
                    return $string;
                }

            } catch (PDOException $e) {
                echo "Erro na leitura: " . $e->getMessage();
            }
        }
        }
    }

    public function Solicitar_recuperacao_senha(){
        if (isset($_POST["btnRecuperar"])) {

        $email = $_POST["email_usuario"] ?? "";

        if (empty($email)) {
            return "Informe um e-mail válido.";
        }

        require_once('conexao.php');
        $db = new Database();
        $conn = $db->connect();

        if ($conn) {

            $table = null;
            $emailColumn = null;

            $sql = "SELECT 1 FROM cadastro_usuario WHERE email_usuario = :email LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->fetchColumn()) {
                $table = "cadastro_usuario";
                $emailColumn = "email_usuario";
            }

            if ($table === null) {
                return "Email não encontrado ou inexistente";
            }

            $sqlNome = "SELECT nome_usuario FROM cadastro_usuario WHERE email_usuario = :email LIMIT 1";
            $stmtNome = $conn->prepare($sqlNome);
            $stmtNome->bindParam(':email', $email);
            $stmtNome->execute();
            $resultado = $stmtNome->fetch(PDO::FETCH_ASSOC);
            $nomeUsuario = $resultado ? $resultado['nome_usuario'] : "Usuário";


            // Gera token
            $tokenData = $this->getRecoveryTokenData();
            $token = $tokenData['token'];
            $expira = $tokenData['expires_at'];

            // Atualiza token no banco
            $up = $conn->prepare("UPDATE {$table} SET token_recuperacao = :token, token_expira = :expira WHERE {$emailColumn} = :email");
            $up->bindParam(":token", $token);
            $up->bindParam(":expira", $expira);
            $up->bindParam(":email", $email);
            $up->execute();

            // Envia email
            require_once __DIR__ . '/../vendor/autoload.php';

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'abnersarilhoosti@gmail.com';
                //$mail->Password   = 'rhoellbwpybzhfnd'; original padrão
                $mail->Password   = 'ftutzznooqcectuj'; // criei no emai abner
                
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
                $mail->setFrom('abnersarilhoosti@gmail.com', 'Suporte');
                $mail->addAddress($email);
    
                $link = "http://localhost/TCC/novasenha.php?token=" . rawurlencode($token);

                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Mudança da Senha';
                $mail->Body = "
                <meta charset='UTF-8'>
                    <div style='max-width:600px;margin:0 auto;background:#ffffff;border-radius:18px;overflow:hidden;box-shadow:0 8px 25px rgba(0,0,0,0.08);font-family:Arial,Helvetica,sans-serif;color:#333;'>

                        <div style='background:linear-gradient(135deg,#2563eb,#1e40af);padding:40px 20px;text-align:center;color:white;'>
                            <h1 style='font-size:32px;margin:0 0 10px 0;'>
                                Suporte de Recuperação de Senha
                            </h1>

                            <p style='font-size:16px;margin:0;opacity:0.9;'>
                                Recuperação de Senha
                            </p>
                        </div>

                        <div style='padding:40px 35px;'>

                            <h2 style='font-size:24px;margin-bottom:20px;color:#111827;'>
                                Olá, $nomeUsuario 👋
                            </h2>

                            <p style='font-size:16px;line-height:1.7;margin-bottom:20px;color:#4b5563;'>
                                Recebemos uma solicitação para redefinir a senha da sua conta.
                            </p>

                            <p style='font-size:16px;line-height:1.7;margin-bottom:20px;color:#4b5563;'>
                                Para criar uma nova senha, clique no botão abaixo:
                            </p>

                            <div style='text-align:center;margin:35px 0;'>

                                <a 
                                    href='$link'
                                    style='
                                        display:inline-block;
                                        background:#2563eb;
                                        color:#ffffff;
                                        text-decoration:none;
                                        padding:16px 32px;
                                        border-radius:12px;
                                        font-size:16px;
                                        font-weight:bold;
                                    '
                                >
                                    Redefinir Senha
                                </a>

                            </div>

                            <p style='font-size:16px;line-height:1.7;margin-bottom:20px;color:#4b5563;'>
                                Caso o botão não funcione, copie e cole o link abaixo no navegador:
                            </p>

                            <div style='
                                background:#f3f4f6;
                                border-radius:10px;
                                padding:15px;
                                word-break:break-all;
                                font-size:14px;
                                color:#374151;
                                margin-bottom:25px;'>
                                $link
                            </div>

                            <div style='
                                background:#fff7ed;
                                border-left:5px solid #f59e0b;
                                padding:15px;
                                border-radius:8px;
                                font-size:14px;
                                color:#92400e;
                                margin-bottom:30px;
                            '>
                                ⚠️ Este link é válido por tempo limitado e poderá ser utilizado apenas uma vez.
                            </div>

                            <p style='font-size:16px;line-height:1.7;color:#4b5563;'>
                                Se você não solicitou a recuperação de senha, ignore este email.
                                Nenhuma alteração será realizada em sua conta.
                            </p>

                        </div>

                        <div style='
                            background:#f9fafb;
                            text-align:center;
                            padding:25px;
                            font-size:14px;
                            color:#6b7280;
                            border-top:1px solid #e5e7eb;'>
                            Atenciosamente,<br>

                            <strong style='color:#111827;'>
                            Equipe de Suporte
                            </strong>
                        </div>

                    </div>
                    ";
                //$mail->SMTPDebug = 2;
                $mail->send();
                return "E-mail de recuperação enviado.";

            } catch (Exception $e) {
                return "Erro ao enviar email: " . $e->getMessage();
            }

        } else {
            return "Erro ao conectar ao banco!";
        }
        }
    }

    public function NovaSenha_model(){
        $token = $_GET["token"] ?? $_POST["token"] ?? "";

        if (empty($token)) {
            return "Token inválido.";
        }

        require_once('conexao.php');
        $db = new Database();
        $conn = $db->connect();

        if (!$conn) {
            return "Erro ao conectar ao banco!";
        }

        $table = null;
        $passwordColumn = null;

        $sql = "SELECT token_expira FROM cadastro_usuario WHERE token_recuperacao = :token LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $table = "cadastro_usuario";
            $passwordColumn = "senha_usuario";
        }

        if ($table === null) {
            return "Token inválido ou já utilizado.";
        }

        if ($this->isRecoveryTokenExpired($token, $row["token_expira"])) {
            return "Token expirado. Solicite uma nova recuperação.";
        }

        if (!isset($_POST["btnRedefinir"])) {
            return "";
        }

        $senha = $_POST["senha_cliente"] ?? $_POST["senha_usuario"] ?? "";
        $confirmar = $_POST["confirmar_senha"] ?? "";

        if (empty($senha) || empty($confirmar)) {
            return "Preencha todos os campos.";
        }

        if ($senha !== $confirmar) {
            return "As senhas não conferem.";
        }

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $up = $conn->prepare("UPDATE {$table} SET {$passwordColumn} = :senha, token_recuperacao = NULL, token_expira = NULL WHERE token_recuperacao = :token");
        $up->bindParam(':senha', $senhaHash);
        $up->bindParam(':token', $token);
        $up->execute();

        if ($up->rowCount() > 0) {
            return "Senha redefinida com sucesso. Faça login com a nova senha.";
        }

        return "Não foi possível redefinir a senha. Tente novamente.";
    }

    private function getDashboardViewFromRequest() {
        $viewsPermitidas = ["modulo", "linguagem", "aula", "exercicio"];
        $view = trim((string) ($_POST["dashboard_view"] ?? $_GET["view"] ?? ""));

        if (in_array($view, $viewsPermitidas, true)) {
            return $view;
        }

        if (isset($_POST["btnSalvarLinguagem"])) {
            return "linguagem";
        }

        if (isset($_POST["btnSalvarAula"])) {
            return "aula";
        }

        if (isset($_POST["btnSalvarExercicio"])) {
            return "exercicio";
        }

        return "modulo";
    }

    public function obter_aba_dashboard_ativa() {
        return $this->getDashboardViewFromRequest();
    }

    private function normalizarInteiroPositivo($valor) {
        if ($valor === null || $valor === "") {
            return null;
        }

        if (filter_var($valor, FILTER_VALIDATE_INT) === false) {
            return null;
        }

        $valor = (int) $valor;

        return $valor > 0 ? $valor : null;
    }

    private function moduloExiste($idModulo) {
        $query = "SELECT 1 FROM modulos WHERE id_modulo = :id_modulo LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_modulo", $idModulo, PDO::PARAM_INT);
        $stmt->execute();

        return (bool) $stmt->fetchColumn();
    }

    private function aulaExiste($idAula) {
        $query = "SELECT 1 FROM aulas WHERE id_aula = :id_aula LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_aula", $idAula, PDO::PARAM_INT);
        $stmt->execute();

        return (bool) $stmt->fetchColumn();
    }

    private function buscarProximaOrdemAula($idModulo) {
        $query = "SELECT COALESCE(MAX(ordem_aula), 0) + 1 FROM aulas WHERE id_modulo = :id_modulo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_modulo", $idModulo, PDO::PARAM_INT);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    private function cadastrarAulaDashboard() {
        $idModulo = $this->normalizarInteiroPositivo($_POST["id_modulo_aula"] ?? null);
        $tituloAula = trim($_POST["titulo_aula"] ?? "");
        $conteudoAula = trim($_POST["conteudo_aula"] ?? "");
        $ordemAula = $this->normalizarInteiroPositivo($_POST["ordem_aula"] ?? null);

        if ($idModulo === null) {
            return [
                "status" => "error",
                "message" => "Selecione um modulo valido para a aula."
            ];
        }

        if ($tituloAula === "" || $conteudoAula === "") {
            return [
                "status" => "error",
                "message" => "Preencha titulo e conteudo da aula."
            ];
        }

        if (!$this->moduloExiste($idModulo)) {
            return [
                "status" => "error",
                "message" => "O modulo selecionado nao existe mais."
            ];
        }

        if ($ordemAula === null) {
            $ordemAula = $this->buscarProximaOrdemAula($idModulo);
        }

        $queryCheck = "SELECT 1 FROM aulas WHERE id_modulo = :id_modulo AND titulo_aula = :titulo_aula LIMIT 1";
        $stmtCheck = $this->conn->prepare($queryCheck);
        $stmtCheck->bindParam(":id_modulo", $idModulo, PDO::PARAM_INT);
        $stmtCheck->bindParam(":titulo_aula", $tituloAula);
        $stmtCheck->execute();

        if ($stmtCheck->fetchColumn()) {
            return [
                "status" => "error",
                "message" => "Ja existe uma aula com este titulo neste modulo."
            ];
        }

        $query = "INSERT INTO aulas (id_modulo, titulo_aula, conteudo_aula, ordem_aula)
                  VALUES (:id_modulo, :titulo_aula, :conteudo_aula, :ordem_aula)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_modulo", $idModulo, PDO::PARAM_INT);
        $stmt->bindParam(":titulo_aula", $tituloAula);
        $stmt->bindParam(":conteudo_aula", $conteudoAula);
        $stmt->bindParam(":ordem_aula", $ordemAula, PDO::PARAM_INT);
        $stmt->execute();

        return [
            "status" => "success",
            "message" => "Aula cadastrada com sucesso."
        ];
    }

    private function inserirExercicioBase($idAula, $tipoExercicio, $pergunta, $feedbackErro) {
        $query = "INSERT INTO exercicios (id_aula, tipo_exercicio, pergunta, feedback_erro)
                  VALUES (:id_aula, :tipo_exercicio, :pergunta, :feedback_erro)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_aula", $idAula, PDO::PARAM_INT);
        $stmt->bindParam(":tipo_exercicio", $tipoExercicio);
        $stmt->bindParam(":pergunta", $pergunta);
        $stmt->bindParam(":feedback_erro", $feedbackErro);
        $stmt->execute();

        return (int) $this->conn->lastInsertId();
    }

    private function salvarExercicioAlternativa($idExercicio) {
        $opcoes = [];

        for ($indice = 1; $indice <= 4; $indice++) {
            $textoOpcao = trim($_POST["opcao_" . $indice] ?? "");

            if ($textoOpcao !== "") {
                $opcoes[$indice] = $textoOpcao;
            }
        }

        if (count($opcoes) < 2) {
            throw new RuntimeException("Cadastre pelo menos duas opcoes na multipla escolha.");
        }

        $opcaoCorreta = $this->normalizarInteiroPositivo($_POST["opcao_correta"] ?? null);

        if ($opcaoCorreta === null || !isset($opcoes[$opcaoCorreta])) {
            throw new RuntimeException("Selecione uma opcao correta valida para a multipla escolha.");
        }

        $query = "INSERT INTO exercicio_opcoes (id_exercicio, texto_opcao, correta)
                  VALUES (:id_exercicio, :texto_opcao, :correta)";
        $stmt = $this->conn->prepare($query);

        foreach ($opcoes as $indice => $textoOpcao) {
            $correta = $indice === $opcaoCorreta ? 1 : 0;
            $stmt->bindParam(":id_exercicio", $idExercicio, PDO::PARAM_INT);
            $stmt->bindParam(":texto_opcao", $textoOpcao);
            $stmt->bindParam(":correta", $correta, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    private function salvarExercicioCompletar($idExercicio, $perguntaBase) {
        $textoLacunas = trim($_POST["texto_lacunas"] ?? "");
        $respostas = trim($_POST["respostas_lacunas"] ?? "");

        if ($textoLacunas === "") {
            throw new RuntimeException("Informe o texto base do exercicio de completar.");
        }

        if ($respostas === "") {
            throw new RuntimeException("Informe ao menos uma resposta correta para o exercicio de completar.");
        }

        $listaRespostas = array_values(array_filter(array_map('trim', explode(',', $respostas)), function ($item) {
            return $item !== "";
        }));

        if (empty($listaRespostas)) {
            throw new RuntimeException("Informe respostas corretas validas separadas por virgula.");
        }

        $quantidadeLacunas = substr_count($textoLacunas, '___');

        if ($quantidadeLacunas > 0 && $quantidadeLacunas !== count($listaRespostas)) {
            throw new RuntimeException("A quantidade de respostas deve ser igual a quantidade de lacunas marcadas com ___.");
        }

        $perguntaCompleta = $perguntaBase . "\n\nTexto base:\n" . $textoLacunas;
        $queryUpdate = "UPDATE exercicios SET pergunta = :pergunta WHERE id_exercicio = :id_exercicio";
        $stmtUpdate = $this->conn->prepare($queryUpdate);
        $stmtUpdate->bindParam(":pergunta", $perguntaCompleta);
        $stmtUpdate->bindParam(":id_exercicio", $idExercicio, PDO::PARAM_INT);
        $stmtUpdate->execute();

        $query = "INSERT INTO exercicio_completar (id_exercicio, resposta_correta)
                  VALUES (:id_exercicio, :resposta_correta)";
        $stmt = $this->conn->prepare($query);

        foreach ($listaRespostas as $respostaCorreta) {
            $stmt->bindParam(":id_exercicio", $idExercicio, PDO::PARAM_INT);
            $stmt->bindParam(":resposta_correta", $respostaCorreta);
            $stmt->execute();
        }
    }

    private function salvarExercicioOrdenar($idExercicio) {
        $blocos = [];

        for ($indice = 1; $indice <= 4; $indice++) {
            $textoBloco = trim($_POST["bloco_" . $indice] ?? "");

            if ($textoBloco !== "") {
                $blocos[$indice] = $textoBloco;
            }
        }

        if (count($blocos) < 2) {
            throw new RuntimeException("Cadastre pelo menos dois blocos para ordenar.");
        }

        $ordemInformada = trim($_POST["ordem_correta"] ?? "");

        if ($ordemInformada === "") {
            throw new RuntimeException("Informe a ordem correta dos blocos.");
        }

        $ordemIndices = array_values(array_filter(array_map('trim', explode(',', $ordemInformada)), function ($item) {
            return $item !== "";
        }));

        if (count($ordemIndices) !== count($blocos)) {
            throw new RuntimeException("A ordem correta deve listar todos os blocos uma unica vez.");
        }

        $ordemPorBloco = [];

        foreach ($ordemIndices as $posicao => $indiceOriginal) {
            if (!ctype_digit($indiceOriginal)) {
                throw new RuntimeException("A ordem correta deve conter apenas numeros separados por virgula.");
            }

            $indiceOriginal = (int) $indiceOriginal;

            if (!isset($blocos[$indiceOriginal]) || isset($ordemPorBloco[$indiceOriginal])) {
                throw new RuntimeException("A ordem correta informada nao corresponde aos blocos cadastrados.");
            }

            $ordemPorBloco[$indiceOriginal] = $posicao + 1;
        }

        $query = "INSERT INTO exercicio_blocos (id_exercicio, texto_bloco, ordem_correta)
                  VALUES (:id_exercicio, :texto_bloco, :ordem_correta)";
        $stmt = $this->conn->prepare($query);

        foreach ($blocos as $indice => $textoBloco) {
            $ordemCorreta = $ordemPorBloco[$indice] ?? null;

            if ($ordemCorreta === null) {
                throw new RuntimeException("A ordem correta precisa contemplar todos os blocos preenchidos.");
            }

            $stmt->bindParam(":id_exercicio", $idExercicio, PDO::PARAM_INT);
            $stmt->bindParam(":texto_bloco", $textoBloco);
            $stmt->bindParam(":ordem_correta", $ordemCorreta, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    private function cadastrarExercicioDashboard() {
        $idAula = $this->normalizarInteiroPositivo($_POST["id_aula_exercicio"] ?? null);
        $tipoExercicio = trim($_POST["tipo_exercicio"] ?? "");
        $pergunta = trim($_POST["pergunta_exercicio"] ?? "");
        $feedbackErro = trim($_POST["feedback_erro"] ?? "");
        $tiposPermitidos = ["alternativa", "completar", "ordenar"];

        if ($idAula === null) {
            return [
                "status" => "error",
                "message" => "Selecione uma aula valida para o exercicio."
            ];
        }

        if (!$this->aulaExiste($idAula)) {
            return [
                "status" => "error",
                "message" => "A aula selecionada nao existe mais."
            ];
        }

        if ($pergunta === "") {
            return [
                "status" => "error",
                "message" => "Preencha a pergunta do exercicio."
            ];
        }

        if (!in_array($tipoExercicio, $tiposPermitidos, true)) {
            return [
                "status" => "error",
                "message" => "Selecione um tipo de exercicio valido."
            ];
        }

        try {
            $this->conn->beginTransaction();

            $idExercicio = $this->inserirExercicioBase($idAula, $tipoExercicio, $pergunta, $feedbackErro);

            if ($tipoExercicio === "alternativa") {
                $this->salvarExercicioAlternativa($idExercicio);
            }

            if ($tipoExercicio === "completar") {
                $this->salvarExercicioCompletar($idExercicio, $pergunta);
            }

            if ($tipoExercicio === "ordenar") {
                $this->salvarExercicioOrdenar($idExercicio);
            }

            $this->conn->commit();

            return [
                "status" => "success",
                "message" => "Exercicio cadastrado com sucesso.",
                "view" => "exercicio"
            ];
        } catch (Throwable $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }

            return [
                "status" => "error",
                "message" => $e instanceof RuntimeException
                    ? $e->getMessage()
                    : "Erro ao cadastrar exercicio: " . $e->getMessage(),
                "view" => "exercicio"
            ];
        }
    }

    public function dashboard_model(){
        // Cadastro de modulo, linguagem, aula e exercicio a partir do dashboard
        if (!$this->conn) {
            return "Erro ao conectar ao banco!";
        }
        // Cadastro Modulo
        if(isset($_POST["btnSalvarModulo"])){

            $titulo_modulo = trim($_POST["titulo_modulo"] ?? "");
            $descricao_modulo = trim($_POST["descricao_modulo"] ?? "");
            $ordem_modulo = isset($_POST["ordem_modulo"]) && $_POST["ordem_modulo"] !== ""
                ? (int) $_POST["ordem_modulo"]
                : null;
            $id_linguagem = isset($_POST["id_linguagem"]) && $_POST["id_linguagem"] !== ""
                ? (int) $_POST["id_linguagem"]
                : null;

            if ($titulo_modulo === "" || $descricao_modulo === "") {
                return [
                    "status" => "error",
                    "message" => "Preencha titulo e descricao do modulo.",
                    "view" => "modulo"
                ];
            }

            if ($id_linguagem === null || $id_linguagem <= 0) {
                return [
                    "status" => "error",
                    "message" => "Selecione a linguagem do modulo.",
                    "view" => "modulo"
                ];
            }

            if ($ordem_modulo !== null && $ordem_modulo < 1) {
                return [
                    "status" => "error",
                    "message" => "A ordem do modulo deve ser maior que zero.",
                    "view" => "modulo"
                ];
            }

            try {

                $query_check = "SELECT 1 FROM modulos WHERE titulo_modulo = :titulo LIMIT 1";
                $stmt_check = $this->conn->prepare($query_check);
                $stmt_check->bindParam(":titulo", $titulo_modulo);
                $stmt_check->execute();

                if ($stmt_check->fetchColumn()) {
                    return [
                        "status" => "error",
                        "message" => "Ja existe um modulo com este titulo.",
                        "view" => "modulo"
                    ];
                }

                $query_check_linguagem = "SELECT 1 FROM linguagens WHERE id_linguagem = :id LIMIT 1";
                $stmt_check_linguagem = $this->conn->prepare($query_check_linguagem);
                $stmt_check_linguagem->bindParam(":id", $id_linguagem, PDO::PARAM_INT);
                $stmt_check_linguagem->execute();

                if (!$stmt_check_linguagem->fetchColumn()) {
                    return [
                        "status" => "error",
                        "message" => "Linguagem selecionada invalida.",
                        "view" => "modulo"
                    ];
                }

                if ($ordem_modulo === null) {
                    $query_ordem = "SELECT COALESCE(MAX(ordem_modulo), 0) + 1 AS proxima_ordem FROM modulos";
                    $stmt_ordem = $this->conn->query($query_ordem);
                    $ordem_modulo = (int) $stmt_ordem->fetchColumn();
                }

                $query = "INSERT INTO modulos (
                            titulo_modulo, descricao_modulo, ordem_modulo, id_linguagem
                        ) VALUES (
                            :titulo, :descricao, :ordem, :id_linguagem
                        )";

                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(":titulo", $titulo_modulo);
                $stmt->bindParam(":descricao", $descricao_modulo);
                $stmt->bindParam(":ordem", $ordem_modulo);
                $stmt->bindParam(":id_linguagem", $id_linguagem, PDO::PARAM_INT);

                $stmt->execute();

                return [
                    "status" => "success",
                    "message" => "Modulo cadastrado com sucesso.",
                    "view" => "modulo"
                ];

            } catch (PDOException $e) {
                return [
                    "status" => "error",
                    "message" => "Erro ao cadastrar modulo: " . $e->getMessage(),
                    "view" => "modulo"
                ];
            }
        }
        // Cadastro Linguagem
        if (isset($_POST["btnSalvarLinguagem"])) {
            $nome_linguagem = trim($_POST["nome_linguagem"] ?? "");
            $descricao = trim($_POST["descricao_linguagem"] ?? "");
            $nivel = trim($_POST["nivel_linguagem"] ?? "");
            $img_path = null;
            

            if ($nome_linguagem === "") {
                return [
                    "status" => "error",
                    "message" => "Preencha o nome da linguagem.",
                    "view" => "linguagem"
                ];
            }

            $arquivo = $_FILES["img"] ?? null;

            if($arquivo && isset($arquivo["tmp_name"]) && $arquivo["tmp_name"] !== ""){
                if($arquivo["error"] !== UPLOAD_ERR_OK){
                    return[
                        "status" => "error",
                        "message" => "Erro ao enviar a imagem",
                        "view" => "linguagem"
                    ];
                }

                $extensao = strtolower(pathinfo($arquivo["name"], PATHINFO_EXTENSION));
                $extensoesPermitidas = ["jpg", "jpeg", "png", "gif", "webp"];

                if(!in_array($extensao, $extensoesPermitidas, true)){
                    return[
                        "status" => "error",
                        "message" => "Formato da imagem invalido. Use JPG, JPEG, PNG, GIF ou WEBP",
                        "view" => "linguagem"
                    ];
                }
                $pastaUploads = dirname(__DIR__) . "/uploads";
                
                if(!is_dir($pastaUploads)){
                    mkdir($pastaUploads, 0777, true);
                }
                $nomeArquivo = bin2hex(random_bytes(16)) . ($extensao ? "." . $extensao : "");
                $destino = $pastaUploads . "/" . $nomeArquivo;

                if (!move_uploaded_file($arquivo["tmp_name"], $destino)) {
                    return [
                        "status" => "error",
                        "message" => "Não foi possível salvar a imagem na pasta uploads.",
                        "view" => "linguagem"
                    ];
                }

                $img_path = "uploads/" . $nomeArquivo;
            }

            try {
                $query_check_lang = "SELECT 1 FROM linguagens WHERE nome_linguagem = :nome LIMIT 1";
                $stmt_check_lang = $this->conn->prepare($query_check_lang);
                $stmt_check_lang->bindParam(":nome", $nome_linguagem);
                $stmt_check_lang->execute();

                if ($stmt_check_lang->fetchColumn()) {
                    return [
                        "status" => "error",
                        "message" => "Ja existe uma linguagem com esse nome.",
                        "view" => "linguagem"
                    ];
                }

                $query = "INSERT INTO linguagens (
                            nome_linguagem, descricao, nivel, img
                        ) VALUES (
                            :nome, :descricao, :nivel, :img
                        )";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":nome", $nome_linguagem);
                $stmt->bindParam(":descricao", $descricao);
                $stmt->bindParam(":nivel", $nivel);
                $stmt->bindParam(":img", $img_path);
                $stmt->execute();
                

                return [
                    "status" => "success",
                    "message" => "Linguagem cadastrada com sucesso.",
                    "view" => "linguagem"
                ];
            } catch (PDOException $e) {
                return [
                    "status" => "error",
                    "message" => "Erro ao cadastrar linguagem: " . $e->getMessage(),
                    "view" => "linguagem"
                ];
            }
        }

        // Cadastro Aula
        if (isset($_POST["btnSalvarAula"])) {
            return $this->cadastrarAulaDashboard();
        }
        // Cadastro Exercicio
        if (isset($_POST["btnSalvarExercicio"])) {
            return $this->cadastrarExercicioDashboard();
        }

        return "";
    }

    public function listar_modulo(){
        if(!$this->conn) {
            return [];
        }
        try { 
            $query = "SELECT id_modulo, titulo_modulo FROM modulos ORDER BY ordem_modulo ASC, id_modulo ASC";
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    public function listar_aulas(){
        if (!$this->conn) {
            return [];
        }

        try {
            $query = "SELECT a.id_aula, a.titulo_aula, a.id_modulo, m.titulo_modulo
                      FROM aulas a
                      INNER JOIN modulos m ON m.id_modulo = a.id_modulo
                      ORDER BY m.ordem_modulo ASC, a.ordem_aula ASC, a.id_aula ASC";
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function listar_linguagens(){
        if (!$this->conn) {
            return [];
        }

        try {
            $query = "SELECT id_linguagem, nome_linguagem, descricao, nivel, img, data_criacao FROM linguagens ORDER BY id_linguagem ASC";
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function listar_linguagens_inscritas_por_usuario($id_usuario){
        if (!$this->conn || !$id_usuario) {
            return [];
        }

        try {
            $query = "SELECT l.id_linguagem, l.nome_linguagem, l.descricao, l.nivel, l.img, ul.data_inscricao, ul.data_ultimo_acesso
                      FROM usuario_linguagem ul
                      INNER JOIN linguagens l ON l.id_linguagem = ul.id_linguagem
                      WHERE ul.id_usuario = :id_usuario
                      ORDER BY ul.data_ultimo_acesso DESC, ul.data_inscricao DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function garantir_configuracao_usuario($id_usuario){
        if (!$this->conn || !$id_usuario) {
            return false;
        }

        try {
            $query = "INSERT INTO usuario_configuracao (id_usuario, ultimo_login, ultimo_acesso, tema)
                      VALUES (:id_usuario, NOW(), NOW(), 'claro')
                      ON DUPLICATE KEY UPDATE id_usuario = id_usuario";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obter_configuracao_usuario($id_usuario){
        if (!$this->conn || !$id_usuario) {
            return [];
        }

        try {
            $query = "SELECT id_usuario, id_linguagem_atual, id_modulo_atual, id_aula_atual, ultimo_acesso, ultimo_login, ultima_linguagem_acessada, tema
                      FROM usuario_configuracao
                      WHERE id_usuario = :id_usuario
                      LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    public function atualizar_configuracao_usuario($id_usuario, array $dados = []){
        if (!$this->conn || !$id_usuario) {
            return false;
        }

        $this->garantir_configuracao_usuario($id_usuario);

        $updates = [];
        $params = [':id_usuario' => $id_usuario];

        if (array_key_exists('id_linguagem_atual', $dados)) {
            $updates[] = 'id_linguagem_atual = :id_linguagem_atual';
            $params[':id_linguagem_atual'] = $dados['id_linguagem_atual'];
        }

        if (array_key_exists('id_modulo_atual', $dados)) {
            $updates[] = 'id_modulo_atual = :id_modulo_atual';
            $params[':id_modulo_atual'] = $dados['id_modulo_atual'];
        }

        if (array_key_exists('id_aula_atual', $dados)) {
            $updates[] = 'id_aula_atual = :id_aula_atual';
            $params[':id_aula_atual'] = $dados['id_aula_atual'];
        }

        if (array_key_exists('ultima_linguagem_acessada', $dados)) {
            $updates[] = 'ultima_linguagem_acessada = :ultima_linguagem_acessada';
            $params[':ultima_linguagem_acessada'] = $dados['ultima_linguagem_acessada'];
        }

        if (!empty($dados['tema'])) {
            $updates[] = 'tema = :tema';
            $params[':tema'] = $dados['tema'];
        }

        if (!empty($dados['atualizar_ultimo_login'])) {
            $updates[] = 'ultimo_login = NOW()';
        }

        if (!empty($dados['atualizar_ultimo_acesso'])) {
            $updates[] = 'ultimo_acesso = NOW()';
        }

        if (empty($updates)) {
            return true;
        }

        try {
            $query = 'UPDATE usuario_configuracao SET ' . implode(', ', $updates) . ' WHERE id_usuario = :id_usuario';
            $stmt = $this->conn->prepare($query);

            foreach ($params as $param => $value) {
                if ($param === ':id_usuario') {
                    $stmt->bindValue($param, $value, PDO::PARAM_INT);
                } else {
                    $stmt->bindValue($param, $value);
                }
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obter_ultimo_curso_acessado_do_usuario($id_usuario){
        if (!$this->conn || !$id_usuario) {
            return null;
        }

        try {
            $configuracao = $this->obter_configuracao_usuario($id_usuario);
            if (!empty($configuracao['ultima_linguagem_acessada'])) {
                return (int) $configuracao['ultima_linguagem_acessada'];
            }

            if (!empty($configuracao['id_linguagem_atual'])) {
                return (int) $configuracao['id_linguagem_atual'];
            }

            return null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function marcar_linguagem_acessada($id_usuario, $id_linguagem){
        if (!$this->conn || !$id_usuario || !$id_linguagem) {
            return false;
        }

        return $this->atualizar_configuracao_usuario($id_usuario, [
            'ultima_linguagem_acessada' => $id_linguagem,
            'id_linguagem_atual' => $id_linguagem,
            'atualizar_ultimo_acesso' => true,
        ]);
    }

    public function inscrever_usuario_em_linguagem($id_usuario, $id_linguagem){
        if (!$this->conn || !$id_usuario || !$id_linguagem) {
            return false;
        }

        try {
            $query = "INSERT INTO usuario_linguagem (id_usuario, id_linguagem, data_inscricao, data_ultimo_acesso)
                      VALUES (:id_usuario, :id_linguagem, NOW(), NOW())
                      ON DUPLICATE KEY UPDATE data_ultimo_acesso = NOW()";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_linguagem', $id_linguagem, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obter_linguagem_por_id($id){
        if (!$this->conn || !$id) return null;

        try{
            $query = "SELECT id_linguagem, nome_linguagem, descricao, nivel, img, data_criacao FROM linguagens WHERE id_linguagem = :id LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? $row : null;
        } catch(PDOException $e){
            return null;
        }
    }

    public function listar_modulo_por_linguagem($linguagem_id){
        if (!$this->conn) return [];
        
        $query ="
        SELECT id_modulo, titulo_modulo, descricao_modulo FROM modulos
        WHERE id_linguagem = :id_linguagem ORDER BY ordem_modulo ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_linguagem", $linguagem_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obter_aula_por_id($id_aula){
        if (!$this->conn || !$id_aula) {
            return null;
        }

        try {
            $query = "SELECT a.id_aula, a.id_modulo, m.id_linguagem
                      FROM aulas a
                      INNER JOIN modulos m ON m.id_modulo = a.id_modulo
                      WHERE a.id_aula = :id_aula
                      LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }


    public function listar_atividade_por_aula($id_aula){
        if (!$this->conn || !$id_aula) return [];
        $query = "SELECT id_exercicio, tipo_exercicio, pergunta, feedback_erro FROM exercicios
                  WHERE id_aula = :id_aula ORDER BY id_exercicio ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
        $stmt->execute();

        $atividades = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $row['tipo_exercicio'] = trim($row['tipo_exercicio']);

            if ($row['tipo_exercicio'] === 'alternativa') {
                $row['opcoes'] = $this->listar_opcoes_por_exercicio($row['id_exercicio']);
            } elseif ($row['tipo_exercicio'] === 'completar') {
                $row['resposta_correta'] = $this->obter_resposta_completar($row['id_exercicio']);
            } elseif ($row['tipo_exercicio'] === 'ordenar' || $row['tipo_exercicio'] === 'ordenacao') {
                $row['blocos'] = $this->listar_blocos_por_exercicio($row['id_exercicio']);
            } else {
                $row['opcoes'] = [];
            }

            $atividades[] = $row;
        }

        return $atividades;
    }
    
    public function listar_opcoes_por_exercicio($id_exercicio) {
        if (!$this->conn || !$id_exercicio) return [];
        $query = "SELECT id_opcao, texto_opcao, correta FROM exercicio_opcoes
                  WHERE id_exercicio = :id_exercicio 
                  ORDER BY id_opcao ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_exercicio', $id_exercicio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listar_blocos_por_exercicio($id_exercicio) {
        if (!$this->conn || !$id_exercicio) return [];
        $query = "SELECT id_bloco, texto_bloco, ordem_correta FROM exercicio_blocos
                  WHERE id_exercicio = :id_exercicio 
                  ORDER BY id_bloco ASC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_exercicio', $id_exercicio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obter_resposta_completar($id_exercicio) {
        if (!$this->conn || !$id_exercicio) return null;
        $query = "SELECT resposta_correta FROM exercicio_completar
                  WHERE id_exercicio = :id_exercicio 
                  LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_exercicio', $id_exercicio, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function listar_aulas_por_linguagem($id_linguagem){
        if (!$this->conn || !$id_linguagem) return [];
        $query = "
            SELECT a.id_aula, a.titulo_aula, a.id_modulo, m.titulo_modulo
            FROM aulas a
            INNER JOIN modulos m ON m.id_modulo = a.id_modulo
            WHERE m.id_linguagem = :id
            ORDER BY m.ordem_modulo ASC, a.ordem_aula ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id_linguagem, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar_progresso_aula($id_usuario, $id_aula, $total_exercicios, $exercicios_corretos) {
        if (!$this->conn || !$id_usuario || !$id_aula) {
            return false;
        }

        $query = "INSERT INTO progresso_aula 
        (id_usuario, id_aula, status, data_inicio, data_conclusao, total_exercicios, exercicios_corretos)
                  VALUES (:id_usuario, :id_aula, 'concluida', NOW(), NOW(), :total_exercicios, :exercicios_corretos)
                  ON DUPLICATE KEY UPDATE 
                    status = 'concluida',
                    data_conclusao = NOW(),
                    total_exercicios = VALUES(total_exercicios),
                    exercicios_corretos = VALUES(exercicios_corretos)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_aula', $id_aula, PDO::PARAM_INT);
        $stmt->bindParam(':total_exercicios', $total_exercicios, PDO::PARAM_INT);
        $stmt->bindParam(':exercicios_corretos', $exercicios_corretos, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function SalaGeral_model(){
        
    }

    public function livre(){
        echo '';
    }
}