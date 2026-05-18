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

        $modulos = $model->listar_modulos();
        $aulas = $model->listar_aulas();
        $linguagens = $model->listar_linguagens();
        $abaAtiva = $model->obter_aba_dashboard_ativa();
        $visao->DashboardPage($message, $modulos, $aulas, $abaAtiva, $linguagens);
    }


    public function SalaGeral(){
        $model = new Model();
        $visao = new View();


        //$visao->header("");
       // $listar = $model->listar_exercicios();
        $modulos = $model->listar_modulo();
        $aula = $model->listar_aulas();
        $linguagens = $model->listar_linguagens();
        $visao->SalaGeralPage($modulos, $aula, $linguagens);
    }


}