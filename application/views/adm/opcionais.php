<div class="content">
        
        <div class="header">
            
        <h1 class="page-title">Opcionais</h1>
        </div>
        
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url().'adm/'; ?>">Inicial</a> <span class="divider">/</span></li>
            <li class="active">Opcionais</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="btn-toolbar">
    <a href="<?php echo site_url().'adm/opcionais/cadastrar'; ?>" class="btn btn-primary"><i class="icon-plus"></i> Novo opcional</a>
  <div class="btn-group">
  </div>
</div>
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome</th>
          <th>Valor</th>
          <th>Preço</th>
          <th>Status</th>
          <th style="width: 26px;"></th>
        </tr>
      </thead>
      <tbody>

      	<?php foreach ($opcionais as $key => $opcional) { ?>

	        <tr>
	          <td><?php echo $opcional -> id; ?></td>
	          <td><?php echo $opcional -> nome; ?></td>
            <td><?php echo $opcional -> valor; ?></td>
	          <td>R$ <?php echo number_format($opcional -> preco, 2, ',', '.'); ?></td>
	          <td><?php echo $opcional -> status ? 'Ativo' : 'Desativado' ; ?></td>
	          <td>
	              <a href="<?php echo site_url().'adm/opcionais/editar/'.$opcional -> id; ?>" title="Editar"><i class="icon-pencil"></i></a>
	              <a href="<?php echo site_url().'adm/opcionais/deletar/'.$opcional -> id; ?>" class='delete-button' alt='deletar este opcional' role="button" data-toggle="modal"><i class="icon-remove"></i></a>
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
