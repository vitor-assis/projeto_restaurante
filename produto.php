<?php
session_start();
if (isset($_SESSION["nome_usuario"])) :
?>
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
            <form action="produto_cadastrar.php" method="post">
                <h2>Cadastro de produtos</h2>
                <br>
                <div class="form-group">
                    <label for="nome_produto">Nome do produto</label>
                    <input required type="text" class="form-control" id="nome_produto" name="nome_produto" placeholder="Digite o nome do produto">
                </div>
                <br>
                <div class="form-group">
                    <label for="categoria_produto">Categoria do produto</label>
                    <input required type="text" class="form-control" id="categoria_produto" name="categoria_produto" placeholder="Digite a categoria do produto">
                </div>
                <br>
                <div class="form-group">
                    <label for="valor_produto">Valor unitario (R$)</label>
                    <input required type="number" step="0.01" class="form-control" id="valor_produto" name="valor_produto" min="0.00" placeholder="Digite o valor unitario do produto">
                </div>
                <br>
                <div class="form-group">
                    <label for="foto_produto">Foto do produto</label>
                    <input type="file" class="form-control" id="foto_produto" name="foto_produto">
                </div>
                <br>
                <div class="form-group">
                    <label for="foto_produto">Informações adicionais</label>
                    <textarea class="form-control" name="info_produto" id="info_produto" rows="4" cols="50" rows="10"></textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Adicionar produto</button>
                <br><br>
                <?php if (isset($resultado)) : ?>
                    <div class="alert <?= $resultado["style"] ?>">
                        <?php echo $resultado["msg"] ?>
                    </div>
                <?php endif ?>
            </form>
            <br><br>

            <?php $produtos = $produto_control->selecionar() ?>

            <?php if (COUNT($produtos) > 0) : ?>
                <h4>Produtos cadastrados</h4>
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Valor</th>
                        <th>Informação Adicional</th>
                        <th>Data</th>
                        <th>Editar</th>
                    </tr>
                    <?php foreach ($produtos as $p) : ?>
                        <tr>
                            <td><?= $p["id"]; ?></td>
                            <td><?= $p["foto"]; ?></td>
                            <td><?= $p["nome"]; ?></td>
                            <td><?= $p["categoria"]; ?></td>
                            <td><?= $p["valor"]; ?></td>
                            <td><?= $p["info_adicional"]; ?></td>
                            <td><?= $p["momento"]; ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm" href="produto_alterar.php?id_prod=<?= $p["id"]; ?>">Alterar</a>
                                <a class="btn btn-danger btn-sm" onclick="return confirm('Confirma a remoção do produto <?= $p['nome']; ?>?')" href="produto_remover.php?id_prod=<?= $p["id"]; ?>">Remover</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </html>
<?php else : ?>
    <div class="alert alert-danger">
        Você não esta logado no sistema.
    </div>
<?php endif ?>