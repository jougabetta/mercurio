<div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Editar filial</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo site_url().'adm/'; ?>">Inicial</a> <span class="divider">/</span></li>
            <li><a href="<?php echo site_url().'adm/filiais/editar/'.$filial -> id; ?>">Editar filial</a> <span class="divider">/</span></li>
            <li class="active">Filial</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">

      <?php if( $this -> session -> userdata('sucesso') != '' ){ ?>

        <p class='sucesso'><?php echo $this -> session -> userdata('sucesso'); ?></p>
    
      <?php $this -> session -> unset_userdata('sucesso'); } ?>

      <?php echo form_open(site_url().'adm/editar_filial'); ?>
    	<input type="hidden" name='id' value='<?php echo $filial -> id; ?>' />

    	<?php echo form_error('nome'); ?>
        <label>Nome</label>
        <input type="text" name='nome' placeholder='Nome' alt='Nome' class="input-xlarge input-text" value="<?php echo $filial -> nome; ?>" />
		
		<?php echo form_error('endereco'); ?>
		<label>Endereço</label>
		<textarea name='endereco' placeholder='Endereço' alt='Endereço'><?php echo $filial -> endereco; ?></textarea>

		<?php echo form_error('cidade'); ?>
		<label>Cidade</label>
		<input type="text" name='cidade' placeholder='Cidade' alt='Cidade' class="input-text" value="<?php echo $filial -> cidade; ?>" />
		
		<?php echo form_error('estado'); ?>
		<label>Estado</label>
		<input type="text" name='estado' placeholder='Estado' alt='Estado' class="input-text" value="<?php echo $filial -> estado; ?>" />

		<?php echo form_error('status'); ?>
		<label>Status</label>
    <label class='label-checkbox'>

      <label class='order-checkbox'> Ativado <input type="radio" name='status' value='1' <?php if( $filial -> status == 1 ){ echo 'checked=checked'; } ?> /></label>
      <label class='order-checkbox'> Desativado <input type="radio" name='status' value='0' <?php if( $filial -> status == 0 ){ echo 'checked=checked'; } ?> /></label>
    
    </label>
    
		<br/>

    	<input type='submit' class="btn btn-primary" value='Editar' />

    </form>
      </div>
  </div>

</div>