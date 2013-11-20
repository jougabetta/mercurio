<div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Cadastrar Filial</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo site_url().'adm/'; ?>">Inicial</a> <span class="divider">/</span></li>
            <li><a href="<?php echo site_url().'adm/usuarios/cadastrar'; ?>">Cadastrar filial</a> <span class="divider">/</span></li>
            <li class="active">Filial</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <?php echo form_open(site_url().'adm/cadastrar_filial'); ?>

    	<?php echo form_error('nome'); ?>
        <label>Nome</label>
        <input type="text" name='nome' placeholder='Nome' alt='Nome' class="input-xlarge input-text" value="<?php echo set_value('nome') ?>" />
		
		<?php echo form_error('endereco'); ?>
		<label>Endereço</label>
		<textarea name='endereco' placeholder='Endereço' alt='Endereço'><?php echo set_value('endereco') ?></textarea>

		<?php echo form_error('cidade'); ?>
		<label>Cidade</label>
		<input type="text" name='cidade' placeholder='Cidade' alt='Cidade' class="input-text" value="<?php echo set_value('cidade') ?>" />
		
		<?php echo form_error('estado'); ?>
		<label>Estado</label>
		<input type="text" name='estado' placeholder='Estado' alt='Estado' class="input-text" value="<?php echo set_value('estado') ?>" />

    	<?php echo form_error('status'); ?>
		<label>Status</label>
        <label class='label-checkbox'>

          <label class='order-checkbox'> Ativado <input type="radio" name='status' value='1' <?php if( set_value('status') == 1 ){ echo 'checked=checked'; } ?> checked='checked' /></label>
          <label class='order-checkbox'> Desativado <input type="radio" name='status' value='0' <?php if( set_value('status') != '' && set_value('status') == 0 ){ echo 'checked=checked'; } ?> /></label>

        </label>
        
        <br/>

    	<input type='submit' class="btn btn-primary" value='Cadastrar' />

    </form>
      </div>
  </div>

</div>