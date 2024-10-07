<?php
require_once('Connections/connections.php');
$PDO = db_connect();

session_start();
$matricula = $_SESSION['smatricula'];
$perfil = $_SESSION['sperfil'];
$nome = $_SESSION['snome'];
$unidade = $_SESSION['sunidade'];


require_once('./inc/header.inc.php');


isset($perfil) ?  require_once('./inc/' . $perfil . '.inc.php') : header("Location: index.php");


$senhaatual = isset($_POST["senhaatual"]) ? $_POST["senhaatual"] : null;
$novasenha = isset($_POST["novasenha"]) ? $_POST["novasenha"] : null;
$confirmacao = isset($_POST["confirmacao"]) ? $_POST["confirmacao"] : null;

$sql_edit = "SELECT * FROM usuario where Senha= :senhaatual AND Nome = :nome";
$stmt_edit = $PDO->prepare($sql_edit);
$stmt_edit->bindParam(':senhaatual', $senhaatual);
$stmt_edit->bindParam(':nome', $nome);
$stmt_edit->execute();
$verificasenha = $stmt_edit->rowCount();

if ($verificasenha > 0) {
  if ($novasenha == $confirmacao) {
    $sql_entrada = "UPDATE usuario SET Senha = :senha WHERE Nome=:nome ";
    $stmt_entrada = $PDO->prepare($sql_entrada);
    $stmt_entrada->bindParam(':senha', $novasenha);
    $stmt_entrada->bindParam(':nome', $nome);
    $result = $stmt_entrada->execute();

    echo "<script language='JavaScript' charset='utf-8'>alert('SENHA ALTERADA!')</script>
        <meta HTTP-EQUIV='refresh' CONTENT='0; URL=index.php'>";
  } else {
    echo "<script language='JavaScript' charset='utf-8'>alert('SENHA NAO COINCIDEM!')</script>
        <meta HTTP-EQUIV='refresh' CONTENT='0; URL=c_usuario-altera-senha.php'>";
  }
} else {

  // script JavaScript para exibir o modal de senha incorreta
  echo "
<script>    
    document.addEventListener('DOMContentLoaded', function () {
        var senhaIncorretaModal = new bootstrap.Modal(document.getElementById('senhaIncorretaModal'));
        senhaIncorretaModal.show();
    });
</script>
";
}
?>
<!-- Modal senhaIncorretaModal  -->
<div class="modal fade" id="senhaIncorretaModal" tabindex="-1" role="dialog" aria-labelledby="senhaIncorretaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="senhaIncorretaModalLabel"><i class="fas fa-exclamation-triangle text-danger" aria-hidden="true"></i>
            Senha Incorreta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        A senha fornecida está incorreta. Por favor, verifique e tente novamente.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="fecharModal()">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
  function fecharModal() {
    var senhaIncorretaModal = new bootstrap.Modal(document.getElementById('senhaIncorretaModal'));
    senhaIncorretaModal.hide();
    window.location.href = 'c_usuario-altera-senha.php';
  }
</script>

<?php require_once('./inc/footer.inc.php'); ?>