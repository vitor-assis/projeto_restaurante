<?php
session_start();
if (isset($_SESSION["nome_usuario"])) :
?>
    <?php
    require_once("cliente/ClienteController.class.php");
    $cliente_control = new ClienteController();
    if (count($_POST) > 0) {
        $valores = $_POST;
        $resultado = $cliente_control->cadastrarCl($valores);
    }
    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clientes</title>
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
                            <h4>Cadastrar clientes</h4>
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form action="cliente.php" method="post">
                                <div class="form-group">
                                    <label for="nome_cliente">Nome do cliente</label>
                                    <input required type="text" class="form-control" id="nome_cliente" name="nome_cliente" placeholder="Digite o nome do cliente">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="cpf_cliente">CPF do cliente</label>
                                    <input required type="text" class="form-control" id="cpf_cliente" name="cpf_cliente" placeholder="Digite o CPF do cliente">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="telefone_cliente">Telefone do cliente</label>
                                    <input required type="tel" class="form-control" id="telefone_cliente" name="telefone_cliente" placeholder="Digite o telefone do cliente">
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="endereco_cliente">Endereço do cliente</label>
                                    <input required type="text" class="form-control" id="endereco_cliente" name="endereco_cliente" placeholder="Digite o endereço do cliente">
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Adicionar cliente</button>
                                <br>
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
                            <h4>Clientes cadastrados</h4>
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <?php $cliente = $cliente_control->selecionarCl() ?>
                            <?php if (COUNT($cliente) > 0) : ?>
                                <table id="tab_produto" class="table">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Telefone</th>
                                        <th>Endereço</th>
                                        <th>Data de registro</th>
                                        <th>Data de alteração</th>
                                        <th>Situacao</th>
                                        <th>Alterar</th>
                                    </tr>
                                    <?php foreach ($cliente as $c) : ?>
                                        <tr id="cliente<?= $c['id'] ?>">
                                            <td><?= $c["id"]; ?></td>
                                            <td><?= $c["nome"]; ?></td>
                                            <td><?= $c["cpf"]; ?></td>
                                            <td><?= $c["telefone"]; ?></td>
                                            <td><?= $c["endereco"]; ?></td>
                                            <td><?= $c["dataRegistro"]; ?></td>
                                            <td><?= $c["dataAlteracao"]; ?></td>
                                            <td><?= $c["situacao"]; ?></td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" href="cliente_alterar.php?id_cliente=<?= $c["id"]; ?>">Alterar</a>
                                                <a class="btn btn-danger btn-sm" onclick="removerCliente('<?= $c['nome'] ?>', <?= $c['id'] ?>)">Remover</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script>
        function removerCliente(nomeCliente, idCliente) {
            if (confirm("Deseja remover o cliente " + nomeCliente + "?")) {
                var ajax = new XMLHttpRequest();
                ajax.responseType = "json";
                ajax.open("GET", "cliente_remover.php?id_cliente=" + idCliente, true);
                ajax.send();
                ajax.addEventListener("readystatechange", function() {
                    if (ajax.status === 200 && ajax.readyState === 4) {
                        resposta = ajax.response.msg;
                        alert(resposta);
                        var linha = document.getElementById("cliente" + idCliente);
                        linha.remove();
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