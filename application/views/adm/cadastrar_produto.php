<div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Cadastrar produto</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo site_url().'adm/'; ?>">Inicial</a> <span class="divider">/</span></li>
            <li><a href="<?php echo site_url().'adm/usuarios/cadastrar'; ?>">Cadastrar produto</a> <span class="divider">/</span></li>
            <li class="active">Produto</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <?php echo form_open_multipart(site_url().'adm/cadastrar_produto'); ?>

        <?php if ( isset($error) && $error != ''): ?>
            
            <p><?php echo $error; ?></p>

        <?php endif ?>

    	<?php echo form_error('nome'); ?>
        <label>Nome</label>
        <input type="text" name='nome' placeholder='Nome' alt='Nome' class="input-xlarge input-text" value="<?php echo set_value('nome') ?>" />
		
		<?php echo form_error('descricao'); ?>
		<label>Descrição</label>
		<textarea name='descricao' placeholder='Descrição' alt='Descrição'><?php echo set_value('descricao') ?></textarea>

		<?php echo form_error('preco'); ?>
		<label>Preço</label>
		<input type="text" name='preco' placeholder='Preço' alt='Preço' class="input-text" value="<?php echo set_value('preco') ?>" />

        <?php echo form_error('preco'); ?>
        <label>Preço promocional</label>
        <input type="text" name='preco_promocional' placeholder='Preço promocional' alt='Preço promocional' class="input-text" value="<?php echo set_value('preco_promocional') ?>" />

        <?php echo form_error('opcionais'); ?>
        <label>Opcionais</label>
        <label class='label-checkbox'>
        <?php foreach ($opcionais as $key => $opcional) { ?>
            
            <label class='order-checkbox'>
                <?php echo $opcional -> nome.'(R$ '.$opcional -> preco.')'; ?> <input type="checkbox" name='opcional[]' class='checkbox' value='<?php echo $opcional -> id; ?>' /> 
                
            </label>

        <?php } ?>
        </label>
        
    	<?php echo form_error('status'); ?>
		<label>Status</label>
        <label class='label-checkbox'>

		  <label class='order-checkbox'> Ativado <input type="radio" name='status' value='1' <?php if( set_value('status') == 1 ){ echo 'checked=checked'; } ?> checked='checked' /></label>
		  <label class='order-checkbox'> Desativado <input type="radio" name='status' value='0' <?php if( set_value('status') != '' && set_value('status') == 0 ){ echo 'checked=checked'; } ?> /></label>

        </label>

        <?php echo form_error('userfile'); ?>
        <label>Imagem</label>
        <input type="file" name='userfile' placeholder='Imagem' alt='Imagem' class="input-text" value="<?php echo set_value('userfile') ?>" />
        <br/>     

    	<input type='submit' class="btn btn-primary" value='Cadastrar' />

    </form>
      </div>
  </div>

</div>