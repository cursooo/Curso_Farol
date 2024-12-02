<?php
include("conexao.php");

// Definir quantos usuários mostrar por página
$usuarios_por_pagina = 10;

// Pega o número da página atual a partir da URL (caso não exista, define como 1)
$pagina_atual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina_atual - 1) * $usuarios_por_pagina;

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
    }

    $stmt->close();
}

// Atualiza o usuário se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_usuario'])) {
    $id_usuario = intval($_POST['id_usuario']);
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    $stmt = $conexao->prepare("UPDATE tb_usuarios SET nome = ?, email = ? WHERE id_usuario = ?");
    $stmt->bind_param("ssi", $nome, $email, $id_usuario);

    if ($stmt->execute()) {
        echo "Usuário atualizado com sucesso!";
        header("Location: listar_editar.php"); // Redireciona após editar
        exit;
    } else {
        echo "Erro ao atualizar o usuário: " . $stmt->error;
    }

    $stmt->close();
}

// Conta o total de usuários para calcular o número total de páginas
$resultado_total = $conexao->query("SELECT COUNT(*) as total FROM tb_usuarios");
$total_usuarios = $resultado_total->fetch_assoc()['total'];
$total_paginas = ceil($total_usuarios / $usuarios_por_pagina);

// Lista os usuários da página atual
$stmt = $conexao->prepare("SELECT id_usuario, nome, email FROM tb_usuarios LIMIT ?, ?");
$stmt->bind_param("ii", $offset, $usuarios_por_pagina);
$stmt->execute();
$resultado = $stmt->get_result();

$usuarios = [];
if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Estilos para os botões de ação */
        .btn {
            padding: 8px 16px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #4CAF50; /* Verde */
        }

        .btn-delete {
            background-color: #f44336; /* Vermelho */
        }

        .btn-view {
            background-color: #2196F3; /* Azul */
        }

        .btn:hover {
            opacity: 0.8;
        }

        /* Estilos para o formulário de edição */
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            opacity: 0.8;
        }

        /* Paginação */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            margin: 0 4px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #45a049;
        }

        .pagination .active {
            background-color: #2196F3;
        }

    </style>
</head>
<body>

    <h1>Gerenciar Usuários</h1>

    <!-- Formulário de edição -->
    <?php if ($usuario_editar): ?>
        <h2>Editar Usuário</h2>
        <form method="post" action="">
            <input type="hidden" name="id_usuario" value="<?= $usuario_editar['id_usuario'] ?>">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($usuario_editar['nome']) ?>" required><br>
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario_editar['email']) ?>" required><br>
            <button type="submit">Salvar Alterações</button>
        </form>
    <?php endif; ?>

    <!-- Lista de usuários -->
    <h2>Lista de Usuários</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($usuarios) > 0): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario['id_usuario'] ?></td>
                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td>
                            <!-- Botões de Ação -->
                            <a href="editar.php?id=<?= $usuario['id_usuario'] ?>" class="btn btn-edit">Editar</a>
                            <a href="delete.php?id=<?= $usuario['id_usuario'] ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?')" class="btn btn-delete">Excluir</a>
                            <a href="consultar.php?id=<?= $usuario['id_usuario'] ?>" class="btn btn-view">Consultar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum usuário encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Paginação -->
    <div class="pagination">
        <?php if ($pagina_atual > 1): ?>
            <a href="?pagina=1">&laquo; Primeira</a>
            <a href="?pagina=<?= $pagina_atual - 1 ?>">&lt; Anterior</a>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
            <a href="?pagina=<?= $i ?>" class="<?= $i == $pagina_atual ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($pagina_atual < $total_paginas): ?>
            <a href="?pagina=<?= $pagina_atual + 1 ?>">Próxima &gt;</a>
            <a href="?pagina=<?= $total_paginas ?>">Última &raquo;</a>
        <?php endif; ?>
    </div>

</body>
</html>
