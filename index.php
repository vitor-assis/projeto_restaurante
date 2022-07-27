<?php

require_once("usuario/UsuarioController.class.php");
$usuario_control = new UsuarioController();
if (count($_POST) > 0) {
    $valores = $_POST;
    $resultado = $usuario_control->login($valores);
}

if (isset($_GET) && $_GET['e'] == 1) {
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(S)iFood</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>

<body class="text-center">
    <main class="form-sigin">
        <h2>LOGIN</h2>
        <div class="form-floating mb-3 container">
            <form id="form_login" class="form-signin floating" action="index.php" method="post">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" name="email" placeholder="Digite seu e-mail">
                    <label for="floatingInput">E-mail</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="senha" placeholder="Digite sua senha" required>
                    <label for="floatingPassword">Senha</label>
                </div>
                <br>
                <div class="d-grid gap-2">
                <input type="submit" id="submeter" value="Entrar" class="btn btn-success btn-block">
                </div>
                <br><br>
                <?php if (isset($resultado) && $resultado["cod"] == 0) : ?>
                    <div class="alert alert-danger">
                        <?php echo $resultado["msg"]; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </main>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>