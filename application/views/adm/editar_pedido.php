<div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Editar produto</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo site_url().'adm/'; ?>">Inicial</a> <span class="divider">/</span></li>
            <li><a href="<?php echo site_url().'adm/produtos/editar/'.$produto -> id; ?>">Editar produto</a> <span class="divider">/</span></li>
            <li class="active">Produto</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">

      <?php if( $this -> session -> userdata('sucesso') != '' ){ ?>

        <p class='sucesso'><?php echo $this -> session -> userdata('sucesso'); ?></p>
    
      <?php $this -> session -> unset_userdata('sucesso'); } ?>

    <?php echo form_open(site_url().'adm/editar_produto'); ?>
    	<input type="hidden" name='id' value='<?php echo $produto -> id; ?>' />

    	<?php echo form_error('nome'); ?>
        <label>Nome</label>
        <input type="text" name='nome' placeholder='Nome' alt='Nome' class="input-xlarge input-text" value="<?php echo $produto -> nome; ?>" />
		
		<?php echo form_error('descricao'); ?>
		<label>Descrição</label>
		<textarea name='descricao' placeholder='Descrição' alt='Descrição'><?php echo $produto -> descricao; ?></textarea>

		<?php echo form_error('preco'); ?>
		<label>Preço</label>
		<input type="text" name='preco' placeholder='Preço' alt='Preço' class="input-text" value="<?php echo $produto -> preco; ?>" />
		
		<?php echo form_error('status'); ?>
		<label>Status</label>
    <label class='label-checkbox'>

      <label class='order-checkbox'> Ativado <input type="radio" name='status' value='1' <?php if( $produto -> status == 1 ){ echo 'checked=checked'; } ?> /></label>
      <label class='order-checkbox'> Desativado <input type="radio" name='status' value='0' <?php if( $produto -> status == 0 ){ echo 'checked=checked'; } ?> /></label>
    
    </label>
    
		<br/>

    	<input type='submit' class="btn btn-primary" value='Editar' />

    </form>
      </div>
  </div>

</div>