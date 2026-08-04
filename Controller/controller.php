<?php

require_once __DIR__ . "/../Model/model.php";
require_once __DIR__ . "/../View/view.php";

class Controller {

    public function Index(){
        $model = new Model();
        $visao = new View();

        $string = $model->livre();
        //$visao->header("");
        $visao->Homepage($string);
        $visao->footer("");
    }

    public function Cadastro(){
        $model = new Model();
        $visao = new View();

        $string = $model->cadastro_model();
        $visao->Cadastropage($string);
    }

    public function Login(){
        $model = new Model();
        $visao = new View();

        $string = $model->Login_model();
        $visao->Loginpage($string);
    }

    public function Recuperar_senha(){
        $model = new Model();
        $visao = new View();

        $string = $model->Solicitar_recuperacao_senha();
        $visao->SolicitarRecuperacaoSenhaPage($string);
    }

    public function NovaSenha(){
        $model = new Model();
        $visao = new View();

        $string = $model->NovaSenha_model();
        $visao->NovaSenhaPage($string);
    }

    public function Admin(){
        $model = new Model();
        $visao = new View();

        $string = $model->Login_Admin_model();
        $visao->Login_admin_page($string);
    }

    public function Dashboard(){
        $model = new Model();
        $visao = new View();

        $result = $model->Dashboard_model();
        $message = "";
        $status = "info";

        if (is_array($result)) {
            $message = $result["message"] ?? "";
            $status = (($result["status"] ?? "") === "success") ? "success" : "error";

            if (($result["status"] ?? "") === "success") {
                $view = $result["view"] ?? "modulo";
                $location = "dashboard.php?view=" . urlencode($view) . "&message=" . urlencode($message) . "&status=" . urlencode($status);
                header("Location: " . $location);
                exit;
            }
        } else {
            $message = (string) $result;
        }

        if (isset($_GET["message"])) {
            $message = trim((string) $_GET["message"]);
        }

        if (isset($_GET["status"])) {
            $statusParam = strtolower(trim((string) $_GET["status"]));
            if (in_array($statusParam, ["success", "error", "info"], true)) {
                $status = $statusParam;
            }
        }

        $modulos = $model->listar_modulo();
        $aulas = $model->listar_aulas();
        $linguagens = $model->listar_linguagens();
        $abaAtiva = $model->obter_aba_dashboard_ativa();
        $visao->DashboardPage($message, $modulos, $aulas, $abaAtiva, $linguagens, $status);
    }

    public function SalaGeral($linguagem_id = null){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $model = new Model();
        $visao = new View();

        $selectedLinguagem = null;
        $messageInicio = '';
        $enrolledLinguagens = [];
        $userId = $_SESSION['id_usuario'] ?? null;

        if ($userId) {
            $enrolledLinguagens = $model->listar_linguagens_inscritas_por_usuario($userId);
        }

        if ($userId) {
            $model->garantir_configuracao_usuario($userId);
        }

        if ($linguagem_id && $linguagem_id > 0) {
            $modulos = $model->listar_modulo_por_linguagem($linguagem_id);
            $selectedLinguagem = $model->obter_linguagem_por_id($linguagem_id);
            $moduloAtual = !empty($modulos[0]['id_modulo']) ? (int) $modulos[0]['id_modulo'] : null;

            if ($userId) {
                $model->marcar_linguagem_acessada($userId, $linguagem_id);
                $model->atualizar_configuracao_usuario($userId, [
                    'id_linguagem_atual' => $linguagem_id,
                    'id_modulo_atual' => $moduloAtual,
                    'id_aula_atual' => null,
                    'ultima_linguagem_acessada' => $linguagem_id,
                    'atualizar_ultimo_acesso' => true,
                ]);
                $model->inscrever_usuario_em_linguagem($userId, $linguagem_id);
                $_SESSION['last_linguagem'] = $linguagem_id;
            }
        } else {
            $last = $_SESSION['last_linguagem'] ?? null;
            if (!$last && $userId) {
                $last = $model->obter_ultimo_curso_acessado_do_usuario($userId);
                if ($last) {
                    $_SESSION['last_linguagem'] = $last;
                }
            }

            if ($userId) {
                $model->atualizar_configuracao_usuario($userId, [
                    'atualizar_ultimo_acesso' => true,
                ]);
            }

            if ($last) {
                $modulos = $model->listar_modulo_por_linguagem($last);
                $selectedLinguagem = $model->obter_linguagem_por_id($last);
            } else {
                $modulos = [];
                $messageInicio = 'Selecione um curso para acessar os módulos.';
            }
        }

        $aula = $model->listar_aulas();
        $linguagens = $model->listar_linguagens();
        $visao->SalaGeralPage($modulos, $aula, $linguagens, $selectedLinguagem, $messageInicio, $enrolledLinguagens);
    }

    // Selecionar_Curso removed; functionality merged into SalaGeral

    public function Atividade($id_aula = null){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION["login"]) || !isset($_SESSION["id_usuario"])) {
            header("Location: login.php");
            exit();
        }

        $model = new Model();
        $visao = new View();
        $id_usuario = $_SESSION["id_usuario"];

        if ($id_aula && $id_usuario) {
            $aulaDetalhe = $model->obter_aula_por_id($id_aula);
            if ($aulaDetalhe) {
                $model->atualizar_configuracao_usuario($id_usuario, [
                    'id_linguagem_atual' => $aulaDetalhe['id_linguagem'] ?? null,
                    'id_modulo_atual' => $aulaDetalhe['id_modulo'] ?? null,
                    'id_aula_atual' => $id_aula,
                    'ultima_linguagem_acessada' => $aulaDetalhe['id_linguagem'] ?? null,
                    'atualizar_ultimo_acesso' => true,
                ]);
            }
        }

        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["acao"]) && $_POST["acao"] === "salvar_progresso") {
            $total_exercicios = (int) ($_POST["total_exercicios"] ?? 0);
            $exercicios_corretos = (int) ($_POST["exercicios_corretos"] ?? 0);

            $model->salvar_progresso_aula($id_usuario, $id_aula, $total_exercicios, $exercicios_corretos);

            header("Location: sala.php");
            exit;
        }
        
        $aula = $model->listar_aulas();
        $atividade = $id_aula ? $model->listar_atividade_por_aula($id_aula) : [];
        $visao->AtividadePage($aula, $atividade, $id_aula);
    }

}