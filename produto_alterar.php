<?php
session_start();
if (isset($_SESSION["nome_usuario"])) : ?>

    <?php
    require_once("produto/ProdutoController.class.php");
    $produto_control = new ProdutoController();
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produto</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>

    <body>
        <div class="container">
            <?php
            $id_prod = $_GET["id_prod"];
            $produtos = $produto_control->selecionar($id_prod);
            ?>

            <form action="alterar_produto.php" method="post">
                <h2>Alterar produtos</h2>
                <br>
                <div class="form-group">
                    <label for="id_produto">ID do produto</label>
                    <input required readonly value="<?= $produtos[0]['id'] ?>" type="number" class="form-control" id="id_prod" name="id_prod">
                </div>
                <br>
                <div class="form-group">
                    <label for="nome_produto">Nome do produto</label>
                    <input required value="<?= $produtos[0]['nome'] ?>" type="text" class="form-control" id="nome_produto" name="nome_produto" placeholder="Digite o nome do produto">
                </div>
                <br>
                <div class="form-group">
                    <label for="categoria_produto">Categoria do produto</label>
                    <input required value="<?= $produtos[0]['categoria'] ?>" type="text" class="form-control" id="categoria_produto" name="categoria_produto" placeholder="Digite a categoria do produto">
                </div>
                <br>
                <div class="form-group">
                    <label for="valor_produto">Valor unitario (R$)</label>
                    <input value="<?= $produtos[0]['valor']; ?>" type="number" step=".01" class="form-control" id="valor_produto" name="valor_produto" placeholder="Digite o valor unitario do produto">
                </div>
                <br>
                <div class="form-group">
                    <label for="foto_produto">Foto do produto</label>
                    <input type="file" class="form-control" id="foto_produto" name="foto_produto">
                </div>
                <br>
                <div class="form-group">
                    <label for="foto_produto">Informações adicionais</label>
                    <textarea class="form-control" value="" name="info_produto" id="info_produto" rows="4" cols="50" rows="10"><?= $produtos[0]['info_adicional'] ?></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Alterar produto</button>
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