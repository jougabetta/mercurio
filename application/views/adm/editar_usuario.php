<div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Editar usuário</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo site_url().'adm/'; ?>">Inicial</a> <span class="divider">/</span></li>
            <li><a href="<?php echo site_url().'adm/usuarios/editar/'.$user -> id; ?>">Editar usuário</a> <span class="divider">/</span></li>
            <li class="active">Usuário</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">

      <?php if( $this -> session -> userdata('sucesso') != '' ){ ?>

        <p class='sucesso'><?php echo $this -> session -> userdata('sucesso'); ?></p>
    
      <?php $this -> session -> unset_userdata('sucesso'); } ?>

    <?php echo form_open(site_url().'adm/editar_usuario'); ?>
    	<input type="hidden" name='id' value='<?php echo $user -> id; ?>' />
    	<?php echo form_error('nome'); ?>
        <label>Nome</label>
        <input type="text" name='nome' placeholder='Nome' alt='Nome' class="input-xlarge input-text" value="<?php echo $user -> nome; ?>" />
		<?php echo form_error('email'); ?>
		<label>E-mail</label>
		<input type="text" name='email' placeholder='E-mail' alt='E-mail' class="input-xlarge input-text" value="<?php echo $user -> email; ?>" />
		
    <?php echo form_error('status'); ?>
		<label>Status</label>
    <label class='label-checkbox'>

      <label class='order-checkbox'> Ativado <input type="radio" name='status' value='1' <?php if( $user -> status == 1 ){ echo 'checked=checked'; } ?> /></label>
      <label class='order-checkbox'> Desativado <input type="radio" name='status' value='0' <?php if( $user -> status == 0 ){ echo 'checked=checked'; } ?> /></label>
    
    </label>
    
    <br/>
    	<input type='submit' class="btn btn-primary" value='Editar' />
    </form>
      </div>
  </div>

</div>