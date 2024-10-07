<?php
require_once('Connections/connections.php');
$PDO = db_connect();

// Inclui o cabeçalho e a estrutura do layout
require_once('./inc/main.inc.php');


$idretorna = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING); // Sanitização da entrada
// Utilize parâmetros preparados para prevenir injeção de SQL
$sql_edit = "SELECT * FROM usuario WHERE Matricula = :Matricula";
$stmt_edit = $PDO->prepare($sql_edit);
$stmt_edit->bindParam(':Matricula', $idretorna, PDO::PARAM_STR);
$stmt_edit->execute();
$edit = $stmt_edit->fetch(PDO::FETCH_ASSOC);


/*  Select Menu de  Cadastro de Usuario na pesquisa */
$sql = "SELECT  * FROM usuario where Ativo = 'SIM'  ";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*  Select Menu de  Cadastro de perfil */
$sql_parada = "SELECT  * FROM  c_perfil";
$stmt = $PDO->prepare($sql_parada);
$stmt->execute();
$Perfil = $stmt->fetchAll(PDO::FETCH_ASSOC);


/*  Select Menu de  Cadastro de Unidade */
$sql_parada = "SELECT  * FROM  c_unidade";
$stmt = $PDO->prepare($sql_parada);
$stmt->execute();
$Unidade = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*  Select Menu de  Cadastro de turno */
$sql_parada = "SELECT  * FROM  c_turno";
$stmt = $PDO->prepare($sql_parada);
$stmt->execute();
$turno = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*  Select Menu de  Cadastro de c_atividade */
$sql_parada = "SELECT  * FROM c_atividade";
$stmt = $PDO->prepare($sql_parada);
$stmt->execute();
$Atividade = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql_parada = "SELECT  * FROM c_ativo";
$stmt = $PDO->prepare($sql_parada);
$stmt->execute();
$ativo = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>



<form id="form1" name="form1" class="form-horizontal" method="POST" action="c_usuario_save.php">
  <div class="col-lg-12">
    <div class="card mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Editar</h6>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-1" style="display: none;">
            <label>ID</label>
            <input type="text" class="form-control" id="ID" name="ID" value="<?php echo $edit['ID']; ?>">
          </div>

          <div class="col-sm-2 form-group">
            <label class="form-label"><b>Matricula:</b></label>
            <input type="text" class="form-control" id="Matricula" name="Matricula" placeholder="Digite Matricula" value="<?php echo $edit['Matricula']; ?>">
          </div>

          <div class="col-sm-5 form-group">
            <label class="form-label"><b>Nome Completo:</b></label>
            <input type="text" class="form-control" id="Nome" name="Nome" placeholder="Digite Seu Nome Completo" value="<?php echo $edit['Nome']; ?>">
          </div>


          <div class="col-sm-3 form-group">
            <label class="form-label"><b>Setor:</b></label>
            <select class="form-control" name="Setor" id="Setor">
              <option> <?php echo $edit['Setor']; ?></option>
              <?php foreach ($Atividade as $row) {
                echo "<option >$row[Nome] </option>";
              }   ?>
            </select>
          </div>

          <div class="col-sm-2 form-group">
            <label class="form-label"><b>Turno:</b></label>
            <select class="form-control" name="Turno" id="Turno">
              <option> <?php echo $edit['Turno']; ?></option>
              <?php foreach ($turno as $row) {
                echo "<option >$row[nome] </option>";
              }   ?>
            </select>
          </div>
          <div class="col-sm-2 form-group">
            <label class="form-label"><b>Perfil:</b></label>
            <select class="form-control" name="Perfil" id="Perfil" required <?php echo ($perfil !== 'administrador') ? 'disabled' : ''; ?>>
              <?php
              foreach ($Perfil as $row) {
                if ($perfil === 'administrador' || $row['Nome'] !== 'administrador') {
                  echo "<option>$row[Nome]</option>";
                }
              }
              ?>
            </select>
          </div>

          <div class="col-sm-4 form-group">
            <label class="form-label"><b>E-mail:</b></label>
            <input type="email" class="form-control" id="Email" name="Email" placeholder="Digite Seu E-mail" value="<?php echo $edit['Email']; ?>">
          </div>


          <div class="col-sm-2 form-group">
            <label class="form-label"><b>Unidade:</b></label>
            <select class="form-control" name="Unidade" id="Unidade" required>
              <option> <?php echo $edit['Unidade']; ?></option>
              <?php foreach ($Unidade as $row) {
                echo "<option >$row[Nome] </option>";
              }   ?>
            </select>
          </div>
          <div class="col-sm-2 form-group">
            <label class="form-label"><b>Senha:</b></label>
            <input type="password" class="form-control" id="Senha" name="Senha" value="<?php echo $edit['Senha']; ?>">
          </div>

          <div class="col-sm-2 form-group">
            <label class="form-label"><b>Ativo:</b></label>
            <select class="form-control" name="Ativo" id="Ativo">
              <option><?php echo $edit['ativo']; ?></option>
              <?php foreach ($ativo as $row) {
                echo "<option >$row[Nome] </option>";
              }   ?>
            </select>
          </div>
        </div>
        <!-- Botão de Gravar -->
        <div class="footer">
          <button type="submit" data-toggle="tooltip" data-placement="top" title="Salvar" class="btn btn-primary" name="action" id="action" value="update">Salvar
          </button>
          <a id="voltar_pagina" href="principal.php" class=" btn btn-danger" title="Voltar ao início"><span class="fa fa-home"></span></a>
          </button>
        </div>
</form>



<?php require_once('./inc/footer.inc.php'); ?>