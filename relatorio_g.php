<link rel="icon" type="img/png" href="./img/ponto.png" alt="Custom Icon" class="custom-icon">
<?php require_once('Connections/connections.php');
$PDO = db_connect();
// Inclui o cabeçalho e a estrutura do layout
require_once('./inc/main.inc.php');

$agora = date('Y-m-d'); // Obtém a data atual sem hora

// Consulta para obter os horários batidos para o dia atual
$sql = "SELECT COUNT(ID) as total 
        FROM usuario";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);





?>
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header py-3 text-center">
            <h5 class="m-0 font-weight-bold text-primary">
                <i class="icofont-chart-histogram"></i> Dashboard
            </h5>
        </div>
        <hr class="hr-shadow">
        <div class="row justify-content-center">
            <div class="col-md-3 mb-4">
                <a href="encarregados.php?turno=1°Turno" style="text-decoration: none;" title="Clique para ver mais detalhes Pendente de Encarregado efetuar o lançamento">
                    <div class="card border-left-info shadow h-100 py-2 clickable-div " style="border-right: 5px solid #007bff;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1"></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Funcionários<p> Total : <?= $result['total'] ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300 pulsate"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="encarregados.php?turno=1°Turno" style="text-decoration: none;" title="Clique para ver mais detalhes Pendente de Encarregado efetuar o lançamento">
                    <div class="card border-left-info shadow h-100 py-2 clickable-div" style="border-right: 5px solid #f5ef42;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1"></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Horas trabalhadas no mês: 2</div>
                                </div>
                                <div class="col-auto">

                                    <i class="icon icofont-sand-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="encarregados.php?turno=1°Turno" style="text-decoration: none;" title="Clique para ver mais detalhes Pendente de Encarregado efetuar o lançamento">
                    <div class="card border-left-info shadow h-100 py-2 clickable-div" style="border-right: 5px solid #cc3014;">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1"></div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">Faltas: 2</div>
                                </div>
                                <div class="col-auto">
                                    <i class="icofont-travelling fa-2x text-gray-300 pulsate"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


   




    <?php require_once('./inc/footer.inc.php'); ?>