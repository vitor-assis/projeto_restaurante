<?php
session_start();
if (isset($_SESSION["nome_usuario"])) : ?>

    <?php
    require_once("cliente/ClienteController.class.php");
    $cliente_control = new ClienteController();
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar Cliente</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>

    <body>
        <div class="container">

            <?php
            $id_cliente = $_GET["id_cliente"];
            $cliente = $cliente_control->selecionarClEdit($id_cliente);
            ?>

            <form action="alterar_cliente.php" method="post">
                <h2>Alterar Cliente</h2>
                <br>
                <div class="form-group">
                    <label for="id_cliente">ID do cliente</label>
                    <input required readonly value="<?= $cliente[0]['id'] ?>" type="number" class="form-control" id="id_cliente" name="id_cliente">
                </div>
                <br>
                <div class="form-group">
                    <label for="nome_cliente">Nome do cliente</label>
                    <input required value="<?= $cliente[0]['nome'] ?>" type="text" class="form-control" id="nome_cliente" name="nome_cliente" placeholder="Digite o nome do cliente">
                </div>
                <br>
                <div class="form-group">
                    <label for="cpf_cliente">CPF do cliente</label>
                    <input required value="<?= $cliente[0]['cpf'] ?>" type="text" class="form-control" id="cpf_cliente" name="cpf_cliente" placeholder="Digite o cpf do cliente">
                </div>
                <div class="form-group">
                    <label for="telefone_cliente">Telefone do cliente</label>
                    <input required value="<?= $cliente[0]['telefone'] ?>" type="tel" class="form-control" id="telefone_cliente" name="telefone_cliente" placeholder="Digite o telefone do cliente">
                </div>
                <br>
                <div class="form-group">
                    <label for="endereco_cliente">Endereço do cliente</label>
                    <input required value="<?= $cliente[0]['endereco'] ?>" type="text" class="form-control" id="endereco_cliente" name="endereco_cliente" placeholder="Digite o endereco do cliente">
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