<?php
require 'Model/model.php';

$model = new Model();
$id = (int) $model->conn->query('SELECT id_usuario FROM cadastro_usuario ORDER BY id_usuario LIMIT 1')->fetchColumn();

if (!$id) {
    echo "Nenhum usuario encontrado\n";
    exit(1);
}

$model->garantir_configuracao_usuario($id);
$result = $model->atualizar_configuracao_usuario($id, [
    'atualizar_ultimo_login' => true,
    'atualizar_ultimo_acesso' => true,
]);
$config = $model->obter_configuracao_usuario($id);

echo $result ? 'update_ok' : 'update_fail';
echo PHP_EOL;
echo json_encode($config, JSON_UNESCAPED_UNICODE);
echo PHP_EOL;
