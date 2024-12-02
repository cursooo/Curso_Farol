<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
<form action="insert.php" method="post">
  <label for="fname">Nome Completo:</label>
  <input type="text" id="nome" name="nome" pattern="[A-Za-zÀ-ÿ\s]+" title="Apenas letras e espaços" required><br>
  
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required><br>

  <label for="password">Senha:</label>
  <input type="password" id="senha" name="senha" required><br>
  
  <input type="submit" value="Cadastrar">
</form>

</body>
<style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #808080;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #808080;
        }
    </style>
</html>

