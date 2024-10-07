<?php
// Tela do Usuário
require_once('Connections/connections.php');
$PDO = db_connect();


// Inclui o cabeçalho e a estrutura do layout
require_once('./inc/main.inc.php');



/*  Select Menu de  Cadastro de Usuario na pesquisa */
$sql = "SELECT  * FROM usuario where Ativo = 'SIM'";
$stmt = $PDO->prepare($sql);
$stmt->execute();
$user = $stmt->fetchAll(PDO::FETCH_ASSOC);





?>
<div class="container-fluid">
  <form id="form1" name="form1" class="form-horizontal" method="POST" action="c_usuario_save.php">
    <div class="col-lg-12">
      <div class="card mb-8">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-plus" aria-hidden="true"></i> Novo Usuário</h6>
        </div>
        <br>
        <!-- MSG de Alert -->
        <?php include('message/message.php'); ?>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-3 form-group">
              <label class="form-label"><b>Matricula:</b></label>
              <input type="text" class="form-control" id="Matricula" name="Matricula" placeholder="Digite Matricula" required>
            </div>

            <div class="col-sm-4 form-group">
              <label class="form-label"><b>Nome Completo:</b></label>
              <input type="text" class="form-control" id="Nome" name="Nome" placeholder="Digite Seu Nome Completo" required>
            </div>

            <div class="col-sm-3 form-group">
              <label class="form-label"><b>Setor:</b></label>
              <select class="form-control" name="Setor" id="Setor" required>
                <option disabled selected>Selecione</option>
                <option>Administrativo</option>
               
              </select>
            </div>

            <div class="col-sm-2 form-group">
              <label class="form-label"><b>Turno:</b></label>
              <select class="form-control" name="Turno" id="Turno" required>
                <option disabled selected>Selecione</option>
                <option>1º Turno</option>
                <option>2º Turno</option>
                <option>3º Turno</option>
                
              </select>
            </div>


            <div class="col-sm-5 form-group">
              <label class="form-label"><b>E-mail:</b></label>
              <input type="email" class="form-control" id="Email" name="Email" placeholder="Digite Seu E-mail">
            </div>

            <div class="col-sm-2 form-group">
              <label class="form-label"><b>Senha:</b></label>
              <input type="password" class="form-control" id="Senha" name="Senha" placeholder="Senha" required>
            </div>
            <div class="col-sm-3 form-group">
              <label class="form-label"><b>Perfil:</b></label>
              <select class="form-control" name="Perfil" id="Perfil" required>
                <option disabled selected>Selecione</option>
                <option>Administrador</option>
                <option>operador</option>
                
                <?php
                foreach ($Perfil as $row) {
                  // Mostra a opção apenas se não for "administrador"
                  if ($row['Nome'] !== 'Administrador') {
                    echo "<option>$row[Nome]</option>";
                  }
                }
                ?>
              </select>
            </div>

            <div class="col-sm-2 form-group">
              <label class="form-label"><b>Unidade:</b></label>
              <select class="form-control" name="Unidade" id="Unidade" required>
                <option disabled selected>Selecione</option>
                <option>Taubate</option>
                
              </select>
            </div>
          </div>
          <!-- Botão de Gravar -->
          <div class="footer">
            <button type="submit" data-toggle="tooltip" data-placement="top" title="Salvar" class="btn btn-primary" name="action" id="action" value="insert">Salvar
            </button>
            <a id="voltar_pagina" href="principal.php" class=" btn btn-danger" title="Voltar ao início"><span class="fa fa-home"></span></a>
            </button>
          </div>
        </div>
        </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover rounded responsive" style="width:100%" id="tabela">
              <thead class="table">
                <tr class="">
                  <th>Matricula</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Unidade</th>
                  <th>Perfil</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($user as $row_func) { ?>
                  <tr>
                    <td><?php echo htmlspecialchars($row_func['Matricula'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row_func['Nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row_func['Email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row_func['Unidade'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row_func['Perfil'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><a href='c_usuario_edit.php?id=<?php echo htmlspecialchars($row_func['Matricula'], ENT_QUOTES, 'UTF-8'); ?>' class='btn btn-outline-danger' data-placement="top" title="Editar"><i class="fa fa-pencil-alt" aria-hidden="true"></i></td>

                  </tr>
                <?PHP } ?>
              </tbody>
            </table>
  </form>
  <?php require_once('./inc/footer.inc.php'); ?>