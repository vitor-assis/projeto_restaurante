<?php
    session_start();
    if(isset($_SESSION["nome_usuario"])):
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <form action="cadastrar_pedido.php" method="post">
            <h5>Olá, <?=$_SESSION["nome_usuario"];?></h5>
            <h2>Escolha de itens do pedidos</h2>
            <br>
            <div class="form-group">
                <label for="nome_produto">Nome do produto</label>
                <input required type="text" class="form-control" id="nome_produto" name="nome_produto" placeholder="Digite o produto">
            </div>
            <br>
            <div class="form-group">
                <label for="qtd_produto">Quantidade</label>
                <input required type="number" class="form-control" id="qtd_produto" name="qtd_produto" minlength="1" maxlength="10">
            </div>
            <br>
            <div class="form-group">
                <label for="obsevacao_produto">Obsevação</label>
                <input type="text" class="form-control" id="obs_produto" name="obs_produto">
            </div>
            <br>
            <div class="form-group">
                <label for="qtd_produto">Preço unitário:</label>
                <input required type="number" step="0.01" class="form-control" id="preco_produto" name="preco_produto" min="0.00">
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Adicionar item ao pedido</button>
            <br>

            <?php if (isset($resultado)) : ?>
                <div class="alert <?= $resultado["style"] ?>">
                    <?php echo $resultado["msg"] ?>
                </div>
            <?php endif ?>

        </form>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>
<?php else: ?>
    <div class="alert alert-danger">
        Você não esta logado no sistema.
    </div>
<?php endif?>