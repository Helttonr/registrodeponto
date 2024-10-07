<?php
require_once('Connections/connections.php');
$PDO = db_connect();

// Inclui o cabeçalho e a estrutura do layout
require_once('./inc/main.inc.php');



?>


<div class="container-fluid">
<form id="form1" name="form1" class="form-horizontal" method="POST" action="c_usuario-alterar-save.php">

    <div class="card mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger"><i class="fa fa-pencil-alt" aria-hidden="true"></i>Alterar Senha</h6>
      </div>
      <!-- MSG de Alert -->
      <?php include('message/message.php'); ?>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-4 form-group">                
                <label for="senhaatual"><b>Senha Atual:</b></label>
                <input type="password" class="form-control" id="senhaatual" name="senhaatual" placeholder="Digite Senha Atual" required>
              </div>
              <div class="col-sm-4 form-group">    
                <label for="novasenha"><b>Nova Senha:</b></label>
                <input type="password" class="form-control" id="novasenha" name="novasenha" placeholder="Digite Nova Senha" required>
              </div>
              <div class="col-sm-4 form-group">    
                <label for="confirmacao"><b>Repita a nova senha:</b></label>
                <input type="password" class="form-control" id="confirmacao" name="confirmacao" placeholder="Repita a nova senha" required>
              </div>
            </div>
            <br>

            <!-- Botão de Gravar -->
            <div class="footer">
              <button type="submit" data-toggle="tooltip" data-placement="top" title="Salvar" class="btn btn-primary">Salvar </button>
              <a id="voltar_pagina" href="principal.php" class=" btn btn-danger" title="Voltar ao início"><span class="fa fa-home"></span></a>
              </button>
            </div>
</form>



<?php require_once('./inc/footer.inc.php'); ?>