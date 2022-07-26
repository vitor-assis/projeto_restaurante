<?php
session_start();
if (isset($_SESSION["nome_usuario"])) :
?>
    <?php
    require_once("usuario/UsuarioController.class.php");
    $usuario_control = new UsuarioController();
    if (count($_POST) > 0) {
        $valores = $_POST;
        $resultado = $usuario_control->cadastrarUs($valores);
    }
    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Usuário</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>

    <body>
        <div class="container">
            <?php require_once('navbar.html'); ?>
            <br><br>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <h4>Cadastrar usuários</h4>
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form action="usuario.php" method="post">
                                <br>
                                <div class="form-group">
                                    <label for="nome_usuario">Nome do usuário</label>
                                    <input required type="text" class="form-control" id="nome_usuario" name="nome_usuario" placeholder="Digite o nome do usuário">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="email_usuario">E-mail do usuário</label>
                                    <input required type="text" class="form-control" id="email_usuario" name="email_usuario" placeholder="Digite o e-mail do usuário">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="senha_usuario">Senha do usuário</label>
                                    <input required type="password" class="form-control" id="senha_usuario" name="senha_usuario" placeholder="Digite o senha do usuário">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Adicionar usuário</button>
                                <br><br>
                                <?php if (isset($resultado)) : ?>
                                    <div class="alert <?= $resultado["style"] ?>">
                                        <?php echo $resultado["msg"] ?>
                                    </div>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            <h4>Usuários cadastrados </h4>
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php $usuarios = $usuario_control->selecionarUs() ?>
                            <?php if (COUNT($usuarios) > 0) : ?>
                                <table id="tab_produto" class="table">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Data de registro</th>
                                        <th>Data de alteraçãoo</th>
                                        <th>Situação</th>
                                        <th>Editar</th>
                                    </tr>
                                    <?php foreach ($usuarios as $u) : ?>
                                        <tr id="usuarios<?= $u['id'] ?>">
                                            <td><?= $u["id"]; ?></td>
                                            <td><?= $u["nome"]; ?></td>
                                            <td><?= $u["email"]; ?></td>
                                            <td><?= $u["dataRegistro"]; ?></td>
                                            <td><?= $u["dataAlteracao"]; ?></td>
                                            <td><?= $u["situacao"]; ?></td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" href="usuario_alterar.php?id_usuario=<?= $u["id"]; ?>">Alterar</a>
                                                <a class="btn btn-danger btn-sm" onclick="removerUsuario('<?= $u['nome'] ?>', <?= $u['id'] ?>)">Remover</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>


        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script>
        function removerUsuario(nomeUsuario, idUsuario) {
            if (confirm("Deseja remover o usuário " + nomeUsuario + "?")) {
                var ajax = new XMLHttpRequest();
                ajax.responseType = "json";
                ajax.open("GET", "usuario_remover.php?id_usuario=" + idUsuario, true);
                ajax.send();
                ajax.addEventListener("readystatechange", function() {
                    if (ajax.status === 200 && ajax.readyState === 4) {
                        resposta = ajax.response.msg;
                        alert(resposta);
                        var linha = document.getElementById("usuarios" + idUsuario);
                        linha.parentNode.removeChild(linha);
                    }
                });
            }
        }
    </script>

    </html>
<?php else : ?>
    <div class="alert alert-danger">
        Você não esta logado no sistema.
    </div>
<?php endif ?>