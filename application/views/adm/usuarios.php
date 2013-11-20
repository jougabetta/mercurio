
   <div class="content">
        
        <div class="header">
            
        <h1 class="page-title">Usuários</h1>
        </div>
        
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url().'adm/'; ?>">Inicial</a> <span class="divider">/</span></li>
            <li class="active">Usuários</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
    <a href="<?php echo site_url().'adm/usuarios/cadastrar'; ?>" class="btn btn-primary"><i class="icon-plus"></i> Novo usuário</a>
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Status</th>
          <th style="width: 26px;"></th>
        </tr>
      </thead>
      <tbody>

      	<?php foreach ($usuarios as $key => $usuario) { ?>

	        <tr>
	          <td><?php echo $usuario -> id; ?></td>
	          <td><?php echo $usuario -> nome; ?></td>
	          <td><?php echo $usuario -> email; ?></td>
	          <td><?php echo $usuario -> status ? 'Ativo' : 'Desativado' ; ?></td>
	          <td>
	              <a href="<?php echo site_url().'adm/usuarios/editar/'.$usuario -> id; ?>" title="Editar"><i class="icon-pencil"></i></a>
	              <a href="<?php echo site_url().'adm/usuarios/deletar/'.$usuario -> id; ?>" class='delete-button' alt='deletar este usuário' role="button" data-toggle="modal"><i class="icon-remove"></i></a>
	          </td>
	        </tr>

        <?php } ?>

      </tbody>
    </table>
</div>
<!-- <div class="pagination">
    <ul>
        <li><a href="#">Prev</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">Next</a></li>
    </ul>
</div> -->

<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
    </div>
    <div class="modal-body">
        <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
    </div>
</div>