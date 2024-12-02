<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Seu site</title>
</head>
<body>
    <!-- Cabeçalho principal com logo e barra de pesquisa -->
    <header class="Primeiro">
        <div class="logo">
            <img src="Texto_do_seu_parágrafo-removebg-preview.png" alt="Logo">
        </div>
        <form class="example" action="/action_page.php" style="margin:auto;max-width:300px">
           <input type="text" placeholder="Search.." name="search2">
           <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    <div class="Login-Cadastro">
    <form action="cadastro_usuario.php" method="post">
         <a href="Web Projeto/Login/Login_user.php">Login</a>
         <a href="cadastro_usuario.php">Cadastro</a>
    </div>
    </header>
    <!-- Barra de navegação -->
    <nav class="Sub">
        <ul>
            <li><a href="#home">Página Inicial</a></li> 
            <li><a href="#produtos">Produtos</a></li>
            <li><a href="#ofertas">Ofertas</a></li>
            <li><a href="#cadastro">Cadastro</a></li>
            <li><a href="#contato">Contato</a></li>
        </ul>
    </nav>

    <!-- Conteúdo principal -->
    <div class="content">
        <img src="pexels-pixabay-276724.jpg" alt="Imagem de exemplo">
    </div>
    <div class="conteudo">
       <h2>Seu Conteúdo Aqui</h2>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <!-- Seção Institucional -->
            <div class="footer-section">
                <h4>Institucional</h4>
                <ul>
                    <li><a href="#">Sobre Nós</a></li>
                    <li><a href="#">Trabalhe Conosco</a></li>
                    <li><a href="#">Programa de Afiliados</a></li>
                    <li><a href="#">Eventos</a></li>
                </ul>
            </div>

            <!-- Seção Ajuda -->
            <div class="footer-section">
                <h4>Ajuda</h4>
                <ul>
                    <li><a href="#">Trocas e Devoluções</a></li>
                    <li><a href="#">Minha Conta</a></li>
                    <li><a href="#">Meus Pedidos</a></li>
                    <li><a href="#">Pagamentos</a></li>
                </ul>
            </div>

            <!-- Seção Políticas -->
            <div class="footer-section">
                <h4>Políticas</h4>
                <ul>
                    <li><a href="#">Regulamentos</a></li>
                    <li><a href="#">Política de Privacidade</a></li>
                    <li><a href="#">Segurança</a></li>
                </ul>
            </div>

            <!-- Central de Relacionamento -->
            <div class="footer-section central-relacionamento">
                <h4>Central de Relacionamento</h4>
                <button class="btn-duvidas">Tire suas dúvidas</button>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2024 Sua Empresa. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
