<?php
include("conexao.php");

// Captura o ID do usuário para edição (se enviado)
$id_editar = isset($_GET['id']) ? intval($_GET['id']) : null;
$usuario_editar = null;

// Se houver um ID, busca os dados do usuário
if ($id_editar) {
    $stmt = $conexao->prepare("SELECT * FROM tb_usuarios WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_editar);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario_editar = $resultado->fetch_assoc();
    } else {
        echo "Usuário não encontrado.";
        exit;
    }

    $stmt->close();
}

// Atualiza o usuário se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_usuario'])) {
    $id_usuario = intval($_POST['id_usuario']);
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    // Verifica se a senha foi alterada
    if (!empty($_POST['senha'])) {
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $stmt = $conexao->prepare("UPDATE tb_usuarios SET nome = ?, email = ?, senha = ? WHERE id_usuario = ?");
        $stmt->bind_param("sssi", $nome, $email, $senha, $id_usuario);
    } else {
        $stmt = $conexao->prepare("UPDATE tb_usuarios SET nome = ?, email = ? WHERE id_usuario = ?");
        $stmt->bind_param("ssi", $nome, $email, $id_usuario);
    }

    if ($stmt->execute()) {
        echo "Usuário atualizado com sucesso!";
        header("Location: listar_editar.php"); // Redireciona após editar
        exit;
    } else {
        echo "Erro ao atualizar o usuário: " . $stmt->error;
    }

    $stmt->close();
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>

    <!-- Formulário de edição -->
    <?php if ($usuario_editar): ?>
        <form method="post" action="">
            <input type="hidden" name="id_usuario" value="<?= $usuario_editar['id_usuario'] ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($usuario_editar['nome']) ?>" required><br><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario_editar['email']) ?>" required><br><br>

            <label>Senha (deixe em branco para manter a senha atual):</label>
            <input type="password" name="senha"><br><br>

            <button type="submit">Salvar Alterações</button>
        </form>
    <?php else: ?>
        <p>Usuário não encontrado.</p>
    <?php endif; ?>

</body>
</html>
