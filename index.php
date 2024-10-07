<link rel="icon" type="img/png" href="./img/assets/ico/icon.png" alt="Custom Icon" class="custom-icon">



<?php
require_once('Connections/connections.php');
$PDO = db_connect();

session_start();
@$matricula = $_SESSION['smatricula'];
@$perfil = $_SESSION['sperfil'];
@$nome = $_SESSION['snome'];
@$unidade = $_SESSION['sunidade'];


$matricula = isset($_POST['matricula']) ? $_POST['matricula'] : null;
$senha = isset($_POST["password"]) ? $_POST["password"] : null;


require_once('./inc/header.inc.php');



$alertlogin = 'none';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sql_user = "SELECT Matricula,Nome, Unidade, Turno,Perfil,  Senha, Email FROM usuario WHERE (Matricula = :matricula OR Email = :matricula) AND senha =:senha ";
    $stmt_user = $PDO->prepare($sql_user);
    $stmt_user->bindParam(':matricula', $matricula);
    $stmt_user->bindParam(':senha', $senha);
    $stmt_user->execute();
    $result = $stmt_user->fetch(PDO::FETCH_ASSOC);
    if (is_array($result)) {
        session_start();
        $_SESSION['smatricula'] = $matricula;
        $_SESSION['snome'] = $result['Nome'];
        $_SESSION['sperfil'] = $result['Perfil'];
        $_SESSION['sunidade'] = $result['Unidade'];
        $_SESSION['sturno'] = $result['Turno'];
        header("Location: principal.php");
    } else {
        $_SESSION['validacao_usuario'] = "";
        header("Location: index.php");
        exit(0);
    }
}


?>

<main class="form-signin">

    <body class="sb-nav-fixed">
        <style>
            #layoutSidenav {

                background-color: lightgray !important;
            }
        </style>
        <div id="">
            <div id="">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header bg-primary">
                                        <h3 class="text-center  font-weight-light my-4">

                                            <a style="color: white;" class="navbar-brand ps-1" href="principal.php">
                                                <i class="icofont-travelling mr-1"></i>
                                                <h5 class="d-inline"><b>Entrada / </b></h5>
                                                <h5 class="d-inline"><b>Saida</b></h5>
                                                <i class="icofont-runner-alt-1 ml-2"></i>
                                            </a>


                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="">
                                            <!-- MSG de Alert -->
                                            <?php include('message/message.php'); ?>


                                            <div class="form-floating">
                                                <input type="Text" class="form-control" id="matricula" name="matricula" autofocus>
                                                <label for="floatingInput">Matricula ou Email:</label>
                                            </div>

                                            <br>
                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                <label for="floatingPassword">Senha:</label>
                                            </div>

                                            <br>
                                            <button type="submit" class="w-100 btn btn-lg btn-primary" value="Login" name="submit">Enter</button>


                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </main>


    </body>

    </html>

    <?php require_once('./inc/footer.inc.php'); ?>