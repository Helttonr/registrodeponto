<?php
require_once('Connections/connections.php');
$PDO = db_connect();

// Inclui o cabeçalho e a estrutura do layout
require_once('./inc/main.inc.php');

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $entrada1 = $_POST['Entrada_1'];
    $saida1 = $_POST['Saida_1'];
    $entrada2 = $_POST['Entrada_2'];
    $saida2 = $_POST['Saida_2'];
    $agora = date('H:i:s'); // Obtém o horário atual
    $hoje = date('Y-m-d'); // Obtém apenas a data atual

    // Consulta para verificar se já existe marcação para o dia atual
    $sql = "SELECT Entrada_1, Saida_1, Entrada_2, Saida_2 FROM registro_ponto 
            WHERE Usuario = :usuario AND DATE(DataHora) = :dataAtual";
    $stmt = $PDO->prepare($sql);
    $stmt->execute([':usuario' => $nome, ':dataAtual' => $hoje]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        // Se não houver marcação, você pode inserir um novo registro ou realizar outras ações
        // Exemplo de inserção de registro (como já discutido antes)
    } else {
        // Se houver marcação, você pode exibir um alerta ou realizar ações específicas
        if (empty($result['Entrada_1']) || empty($result['Saida_1']) || empty($result['Entrada_2']) || empty($result['Saida_2'])) {
            echo "<script>alert('Registro atualizado com sucesso'); window.location.href = 'principal.php';</script>";
        
        } else {
            echo "<script>alert('Todos os registros já estão preenchidos.'); window.location.href = 'principal.php';</script>";
        }
    }


    // Se não houver marcação para o dia, insere um novo registro
    if (!$result) {
        $query = "INSERT INTO registro_ponto (Entrada_1, Usuario, DataHora)
                  VALUES (:Entrada_1,:Usuario, :DataHora)";
        $stmt = $PDO->prepare($query);        
        $stmt->bindParam(':Entrada_1', $agora);        
        $stmt->bindParam(':Usuario', $nome);
        $stmt->bindParam(':DataHora', $hoje); // Insere a data atualno campo DataHora
        $stmt->execute();
        echo "<script>alert('Registro atualizado com sucesso'); window.location.href = 'principal.php';</script>";
        
    } else {
        // Se houver marcação, atualiza os campos que estiverem vazios
        if (empty($result['Entrada_1']) && empty($entrada1)) {
            $query = "UPDATE registro_ponto SET Entrada_1 = :entrada1 WHERE Usuario = :Usuario AND DATE(DataHora) = :dataAtual";
            $stmt = $PDO->prepare($query);
            $stmt->bindParam(':entrada1', $agora);
            $stmt->bindParam(':Usuario', $nome);
            $stmt->bindParam(':dataAtual', $hoje);
            $stmt->execute();
        } elseif (empty($result['Saida_1']) && empty($saida1)) {
            $query = "UPDATE registro_ponto SET Saida_1 = :saida1 WHERE Usuario = :Usuario AND DATE(DataHora) = :dataAtual";
            $stmt = $PDO->prepare($query);
            $stmt->bindParam(':saida1', $agora);
            $stmt->bindParam(':Usuario', $nome);
            $stmt->bindParam(':dataAtual', $hoje);
            $stmt->execute();
        } elseif (empty($result['Entrada_2']) && empty($entrada2)) {
            $query = "UPDATE registro_ponto SET Entrada_2 = :entrada2 WHERE Usuario = :Usuario AND DATE(DataHora) = :dataAtual";
            $stmt = $PDO->prepare($query);
            $stmt->bindParam(':entrada2', $agora);
            $stmt->bindParam(':Usuario', $nome);
            $stmt->bindParam(':dataAtual', $hoje);
            $stmt->execute();
        } elseif (empty($result['Saida_2']) && empty($saida2)) {
            $query = "UPDATE registro_ponto SET Saida_2 = :saida2 WHERE Usuario = :Usuario AND DATE(DataHora) = :dataAtual";
            $stmt = $PDO->prepare($query);
            $stmt->bindParam(':saida2', $agora);
            $stmt->bindParam(':Usuario', $nome);
            $stmt->bindParam(':dataAtual', $hoje);
            $stmt->execute();
        }

        echo "<script>alert('Registro atualizado com sucesso'); window.location.href = 'principal.php';</script>";
        exit();
    }
}
