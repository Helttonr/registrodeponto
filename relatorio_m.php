<link rel="icon" type="img/png" href="./img/ponto.png" alt="Custom Icon" class="custom-icon">
<?php require_once('Connections/connections.php');
$PDO = db_connect();
// Inclui o cabeçalho e a estrutura do layout
require_once('./inc/main.inc.php');


// Consulta para obter os horários batidos para o dia atual
$sql = "SELECT* FROM registro_ponto ";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header py-3 text-center">
            <h5 class="m-0 font-weight-bold text-primary">
                <i class="icofont-chart-histogram"></i> Relação Mensal
            </h5>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover rounded responsive" style="width:100%" id="tabela">
                    <thead class="table">
                        <tr class="">
                            <th>Nome</th>
                            <th>Data</th>
                            <th>Entrada</th>
                            <th>Saida</th>
                            <th>Entrada</th>
                            <th>Saida</th>

                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['Usuario'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($row['DataHora'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo $row['Entrada_1'] ? htmlspecialchars($row['Entrada_1'], ENT_QUOTES, 'UTF-8') : 'Aguardando'; ?></td>
                                <td><?php echo $row['Saida_1'] ? htmlspecialchars($row['Saida_1'], ENT_QUOTES, 'UTF-8') : 'Aguardando'; ?></td>
                                <td><?php echo $row['Entrada_2'] ? htmlspecialchars($row['Entrada_2'], ENT_QUOTES, 'UTF-8') : 'Aguardando'; ?></td>
                                <td><?php echo $row['Saida_2'] ? htmlspecialchars($row['Saida_2'], ENT_QUOTES, 'UTF-8') : 'Aguardando'; ?></td>

                            </tr>
                        <?PHP } ?>
                    </tbody>
                </table>
                </form>



                <?php require_once('./inc/footer.inc.php'); ?>