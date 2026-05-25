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

        $string = $model->cadsatro_model();
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

    public function Dashboard(){
        $model = new Model();
        $visao = new View();

        $result = $model->Dashboard_model();
        $message = "";

        if (is_array($result)) {
            $message = $result["message"] ?? "";

            if (($result["status"] ?? "") === "success") {
                $view = $result["view"] ?? "modulo";
                $location = "dashboard.php?view=" . urlencode($view) . "&message=" . urlencode($message);
                header("Location: " . $location);
                exit;
            }
        } else {
            $message = (string) $result;
        }

        if (isset($_GET["message"])) {
            $message = trim((string) $_GET["message"]);
        }

        $modulos = $model->listar_modulo();
        $aulas = $model->listar_aulas();
        $linguagens = $model->listar_linguagens();
        $abaAtiva = $model->obter_aba_dashboard_ativa();
        $visao->DashboardPage($message, $modulos, $aulas, $abaAtiva, $linguagens);
    }


    public function SalaGeral($linguagem_id = null){
        $model = new Model();
        $visao = new View();

        $modulos = $linguagem_id 
        ? $model->listar_modulo_por_linguagem($linguagem_id) 
        : $model->listar_modulo();
        

        $modulos = $model->listar_modulo();

        $aula = $model->listar_aulas();
        $linguagens = $model->listar_linguagens();
        $visao->SalaGeralPage($modulos, $aula, $linguagens);
    }
    public function Selecionar_Curso(){
        $model = new Model();
        $visao = new View();

        $visao->header("");
        $linguagens = $model->listar_linguagens();
        $visao->Selecionarcurso_Page($linguagens);
    }

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