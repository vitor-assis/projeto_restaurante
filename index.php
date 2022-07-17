<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pedidos 1.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h2>Efetue login</h2>
        <form id="form_login" action="login.php" method="post">

            <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required class="form-control">
            <br>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required class="form-control">
            <br>

            <?php if (isset($resultado) && $resultado["cod"] == 0) : ?>
                <div class="alert alert-danger">
                    <?php echo $resultado["msg"]; ?>
                </div>
            <?php endif; ?>

            <input type="submit" id="submeter" value="Entrar" class="btn btn-primary">

        </form>


    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>