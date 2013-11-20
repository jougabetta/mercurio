<div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Editar entregador</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo site_url().'adm/'; ?>">Inicial</a> <span class="divider">/</span></li>
            <li><a href="<?php echo site_url().'adm/entregadores/editar/'.$entregador -> id; ?>">Editar entregador</a> <span class="divider">/</span></li>
            <li class="active">Entregador</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">

	  <?php if( $this -> session -> userdata('sucesso') != '' ){ ?>

		<p class='sucesso'><?php echo $this -> session -> userdata('sucesso'); ?></p>
	
	  <?php $this -> session -> unset_userdata('sucesso'); } ?>

      <?php echo form_open(site_url().'adm/editar_entregador'); ?>
    	<input type="hidden" name='id' value='<?php echo $entregador -> id; ?>' />

    	<?php echo form_error('nome'); ?>
        <label>Nome</label>
        <input type="text" name='nome' placeholder='Nome' alt='Nome' class="input-xlarge input-text" value="<?php echo $entregador -> nome; ?>" />
		
		<?php echo form_error('email'); ?>
		<label>E-mail</label>
		<input type="text" name='email' placeholder='E-mail' alt='E-mail' class="input-xlarge input-text" value="<?php echo $entregador -> email; ?>">

		<?php echo form_error('telefone'); ?>
		<label>Telefone</label>
		<input type="text" name='telefone' placeholder='Telefone' alt='Telefone' class="input-xlarge input-text" value="<?php echo $entregador -> telefone; ?>" />
		
		<?php echo form_error('endereco'); ?>
		<label>Endereço</label>
		<textarea name='endereco' placeholder='Endereço' alt='Endereço'><?php echo $entregador -> endereco; ?></textarea>

		<?php echo form_error('cidade'); ?>
		<label>Cidade</label>
		<input type="text" name='cidade' placeholder='Cidade' alt='Cidade' class="input-text" value="<?php echo $entregador -> cidade; ?>" />

		<?php echo form_error('cep'); ?>
		<label>Cep</label>
		<input type="text" name='cep' placeholder='Cep' alt='Cep' class="input-text" value="<?php echo $entregador -> cep; ?>" />

		<?php echo form_error('estado'); ?>
		<label>Estado</label>
		<input type="text" name='estado' placeholder='Estado' alt='Estado' class="input-text" value="<?php echo $entregador -> estado; ?>" />

		<?php echo form_error('filial'); ?>
		<label>Filial</label>
		<?php 
			$checked = '';
			foreach ($filiais as $key => $filial) {  
				if( $entregador -> filial == $filial -> id ){ $checked = 'checked="checked"'; }
		?>

		<label> <?php echo $filial -> nome; ?> <input type="radio" <?php echo $checked; ?> name='filial' value='<?php echo $filial -> id; ?>' /></label>

		<?php } ?>

		<?php echo form_error('status'); ?>
		<label>Status</label>
		<label class='label-checkbox'>

			<label class='order-checkbox'> Ativado <input type="radio" name='status' value='1' <?php if( $entregador -> status == 1 ){ echo 'checked=checked'; } ?> /></label>
			<label class='order-checkbox'> Desativado <input type="radio" name='status' value='0' <?php if( $entregador -> status == 0 ){ echo 'checked=checked'; } ?> /></label>

		</label>

		<br/>

    	<input type='submit' class="btn btn-primary" value='Editar' />

    </form>
      </div>
  </div>

</div>