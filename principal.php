<link rel="icon" type="img/png" href="./img/ponto.png" alt="Custom Icon" class="custom-icon">
<?php require_once('Connections/connections.php');
$PDO = db_connect();
// Inclui o cabeçalho e a estrutura do layout
require_once('./inc/main.inc.php');

$agora = date('Y-m-d'); // Obtém a data atual sem hora

// Consulta para obter os horários batidos para o dia atual
$sql = "SELECT ID,Entrada_1, Saida_1, Entrada_2, Saida_2 FROM registro_ponto 
        WHERE Usuario = :usuario AND DATE(DataHora) = :dataAtual";
$stmt = $PDO->prepare($sql);
$stmt->execute([':usuario' => $nome, ':dataAtual' => $agora]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);


?>


<style>
	/* Classe aplicada ao emoji para criar o efeito de aceno */

	.wave-emoji {
		display: inline-block;
		animation: wave 2s infinite;
	}

	@keyframes wave {
		0% {
			transform: rotate(0deg);
		}

		10% {
			transform: rotate(14deg);
		}

		20% {
			transform: rotate(-8deg);
		}

		30% {
			transform: rotate(14deg);
		}

		40% {
			transform: rotate(-4deg);
		}

		50% {
			transform: rotate(10deg);
		}

		60% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(0deg);
		}
	}

	.panel-title {
		opacity: 0;
		animation: fadeIn 1.5s ease-in-out forwards;
	}

	@keyframes fadeIn {
		0% {
			opacity: 0;
		}

		100% {
			opacity: 1;
		}
	}
</style>
<?php
// Verifica se o perfil do usuário é 'administrador'
if ($perfil == 'administrador') {
?>

	<div class="container-fluid">
		<div class="card mb-4">
			<div class="card-header py-3">
				<h5 class="m-0 font-weight-bold text-primary">
					<span class="wave-emoji">👋</span>, Bem-vindo, <?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?>!
				</h5>
			</div>

			<div class="card-body">
				<form action="registro_save.php" method="POST">
					<input type="hidden" name="registro_id" value="<?= isset($result['id']) ? $result['id'] : ''; ?>">
					<div class="d-flex m-5 justify-content-around">
						<h5 class="record">Entrada 1: <i style="color: primary;" class="icofont-wall-clock"></i>
							<?= isset($result['Entrada_1']) ? $result['Entrada_1'] : '--:--'; ?>

							<input type="hidden" class="form-control" id="Entrada_1" name="Entrada_1" value="<?= isset($result['Entrada_1']) ? $result['Entrada_1'] : ''; ?>">
						</h5>
						<h5 class="record">Saída 1: <i style="color: primary;" class="icofont-wall-clock"></i>
						<?= isset($result['Saida_1']) ? $result['Saida_1'] : '--:--'; ?>

							<input type="hidden" class="form-control" id="Saida_1" name="Saida_1" value="<?= isset($result['Saida_1']) ? $result['Saida_1'] : ''; ?>">
						</h5>
					</div>
					<div class="d-flex m-5 justify-content-around">
						<h5 class="record">Entrada 2: <i style="color: primary;" class="icofont-wall-clock"></i>
							<?= isset($result['Entrada_2']) ? $result['Entrada_2'] : '--:--'; ?>
							<input type="hidden" class="form-control" id="Entrada_2" name="Entrada_2" value="<?= isset($result['Entrada_2']) ? $result['Entrada_2'] : ''; ?>">
						</h5>
						<h5 class="record">Saída 2: <i style="color: primary;" class="icofont-wall-clock"></i>
							<?= isset($result['Saida_2']) ? $result['Saida_2'] : '--:--'; ?>
							<input type="hidden" class="form-control" id="Saida_2" name="Saida_2" value="<?= isset($result['Saida_2']) ? $result['Saida_2'] : ''; ?>" onfocus="console.log(this.value)">

						</h5>
					</div>

					<div class="card-footer d-flex justify-content-center">
						<button type="submit" class="btn btn-success btn-lg">
							<i class="icofont-check mr-1"></i>Bater ponto
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	</body>

	</html>

<?php } // Fim da verificação do perfil 
?>

<?php require_once('./inc/footer.inc.php'); ?>