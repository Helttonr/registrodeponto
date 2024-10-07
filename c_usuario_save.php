<?php
require_once('Connections/connections.php');
$PDO = db_connect();

session_start();

// Verifica se os dados foram enviados
$Matricula = filter_input(INPUT_POST, "Matricula", FILTER_SANITIZE_STRING);
$Nome = filter_input(INPUT_POST, "Nome", FILTER_SANITIZE_STRING);
$Setor = filter_input(INPUT_POST, "Setor", FILTER_SANITIZE_STRING);
$Turno = filter_input(INPUT_POST, "Turno", FILTER_SANITIZE_STRING);
$Email = filter_input(INPUT_POST, "Email", FILTER_SANITIZE_EMAIL);
$Senha = filter_input(INPUT_POST, "Senha", FILTER_SANITIZE_STRING);
$Perfil = filter_input(INPUT_POST, "Perfil", FILTER_SANITIZE_STRING);
$Unidade = filter_input(INPUT_POST, "Unidade", FILTER_SANITIZE_STRING);
$Ativo = filter_input(INPUT_POST, "Ativo", FILTER_SANITIZE_STRING);

$action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING);

try {
    // Inicia a transação
    $PDO->beginTransaction();

    if ($action == "insert") {
        // Verifica se a matrícula já existe
        $sql_entrada  = "SELECT Matricula FROM usuario WHERE Matricula = :Matricula";
        $stmt_entrada = $PDO->prepare($sql_entrada);
        $stmt_entrada->bindParam(':Matricula', $Matricula);
        $stmt_entrada->execute();
        $result = $stmt_entrada->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['funcionario'] = "";
            $PDO->rollBack(); // Rollback da transação em caso de erro
            header("Location: c_usuario.php");
            exit;
        } else {
            $sql_entrada = "INSERT INTO usuario (Matricula, Nome, Setor, Turno, Email, Senha, Perfil, Unidade) 
                            VALUES (:Matricula, :Nome, :Setor, :Turno, :Email, :Senha, :Perfil, :Unidade)";
            $stmt_entrada = $PDO->prepare($sql_entrada);
            $stmt_entrada->bindParam(':Matricula', $Matricula);
            $stmt_entrada->bindParam(':Nome', $Nome);
            $stmt_entrada->bindParam(':Setor', $Setor);
            $stmt_entrada->bindParam(':Turno', $Turno);
            $stmt_entrada->bindParam(':Email', $Email);
            $stmt_entrada->bindParam(':Senha', $Senha);
            $stmt_entrada->bindParam(':Perfil', $Perfil);
            $stmt_entrada->bindParam(':Unidade', $Unidade);
            $result = $stmt_entrada->execute();
            if ($result) {
                $PDO->commit(); // Commit antes do redirecionamento
                $_SESSION['salvo'] = "Salvo com Sucesso";
                header("Location: c_usuario.php");
                exit;
            }
        }
    } elseif ($action == "update") {
        $sql_entrada = "UPDATE usuario SET Nome=:Nome, Setor=:Setor, Turno=:Turno, Email=:Email, 
                        Senha=:Senha, Perfil=:Perfil, Unidade=:Unidade, Ativo=:Ativo WHERE Matricula=:Matricula";
        $stmt_entrada = $PDO->prepare($sql_entrada);
        $stmt_entrada->bindParam(':Matricula', $Matricula);
        $stmt_entrada->bindParam(':Nome', $Nome);
        $stmt_entrada->bindParam(':Setor', $Setor);
        $stmt_entrada->bindParam(':Turno', $Turno);
        $stmt_entrada->bindParam(':Email', $Email);
        $stmt_entrada->bindParam(':Senha', $Senha);
        $stmt_entrada->bindParam(':Perfil', $Perfil);
        $stmt_entrada->bindParam(':Unidade', $Unidade);
        $stmt_entrada->bindParam(':Ativo', $Ativo);
        $result = $stmt_entrada->execute();
        if ($result) {
            $PDO->commit(); // Commit antes do redirecionamento
            $_SESSION['edit'] = "Editado Com Sucesso!";
            header("Location: c_usuario.php");
            exit;
        } else {
            $PDO->rollBack();
            $_SESSION['edit'] = "Erro: Não foi possível editar!";
            header("Location: c_usuario.php");
            exit;
        }
    }
} catch (Exception $e) {
    // Rollback da transação em caso de erro
    $PDO->rollBack();

    // Redireciona com mensagem de erro
    $_SESSION['erro'] = "Erro: " . $e->getMessage();
    header("Location: c_area.php");
    exit;
}
?>
