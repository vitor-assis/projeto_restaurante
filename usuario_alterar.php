<?php
session_start();
if (isset($_SESSION["nome_usuario"])) : ?>

    <?php
    require_once("usuario/UsuarioController.class.php");
    $usuario_control = new UsuarioController();
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar usuário</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>

    <body>
        <div class="container">
            <?php
            $id_usuario = $_GET["id_usuario"];
            $usuario = $usuario_control->selecionarUsEdit($id_usuario);
            ?>

            <form action="alterar_usuario.php" method="post">
                <h2>Alterar usuário</h2>
                <br>
                <div class="form-group">
                    <label for="id_usuario">ID do usuario</label>
                    <input required readonly value="<?= $usuario[0]['id'] ?>" type="number" class="form-control" id="id_usuario" name="id_usuario">
                </div>
                <br>
                <div class="form-group">
                    <label for="nome_usuario">Nome do usuário</label>
                    <input required value="<?= $usuario[0]['nome'] ?>" type="text" class="form-control" id="nome_usuario" name="nome" placeholder="Digite o nome do usuario">
                </div>
                <br>
                <div class="form-group">
                    <label for="email_usuario">E-mail do usuário</label>
                    <input required value="<?= $usuario[0]['email'] ?>" type="email" class="form-control" id="email_usuario" name="email" placeholder="Digite o e-mail do usuario">
                </div>
                <br>
                <div class="form-group">
                    <label for="Senha_usuario">Senha do usuário</label>
                    <input required readonly diseabled value="<?= $usuario[0]['senha'] ?>" type="password" class="form-control" id="senha_usuario" name="senha" placeholder="Digite o Senha do usuario">
                </div>
                <br>
                <div class="alert alert-warning" role="alert">
                    <span> Para recuperação de senha entre em contato com o administrador do sistema </span>
                </div>

                <br>
                <button type="submit" class="btn btn-primary">Alterar usuário</button>
                <br><br>
            </form>

            <?php if (isset($resultado)) : ?>
                <div class="alert <?= $resultado["style"] ?>">
                    <?php echo $resultado["msg"] ?>
                </div>
            <?php endif ?>

            <br><br>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </html>
<?php else : ?>
    <div class="alert alert-danger">
        Você não esta logado no sistema.
    </div>
<?php endif ?>