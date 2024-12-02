<?php
include("conexao.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Garante que o ID é um inteiro

    // Prepara a consulta para evitar SQL Injection
    $stmt = $conexao->prepare("DELETE FROM tb_usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID inválido ou não fornecido.";
}

$conexao->close();
?>
