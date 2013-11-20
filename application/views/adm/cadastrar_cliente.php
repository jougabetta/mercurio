<div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Cadastrar cliente</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo site_url().'adm/'; ?>">Inicial</a> <span class="divider">/</span></li>
            <li><a href="<?php echo site_url().'adm/usuarios/cadastrar'; ?>">Cadastrar cliente</a> <span class="divider">/</span></li>
            <li class="active">Cliente</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <?php echo form_open(site_url().'adm/cadastrar_cliente'); ?>
    
    	<?php echo form_error('nome'); ?>
        <label>Nome</label>
        <input type="text" name='nome' placeholder='Nome' alt='Nome' class="input-xlarge input-text" value="<?php echo set_value('nome') ?>" />
		
		<?php echo form_error('email'); ?>
		<label>E-mail</label>
		<input type="text" name='email' placeholder='E-mail' alt='E-mail' class="input-xlarge input-text" value="<?php echo set_value('email') ?>" />
		
		<?php echo form_error('telefone'); ?>
		<label>Telefone</label>
		<input type="text" name='telefone' placeholder='Telefone' alt='Telefone' class="input-xlarge input-text" value="<?php echo set_value('telefone') ?>" />
		
		<?php echo form_error('endereco'); ?>
		<label>Endereço</label>
		<input type="text" name='endereco' placeholder='Endereco' alt='Endereco' class="input-xlarge input-text" value="<?php echo set_value('endereco') ?>" />
    	
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