<div class="content">
        
        <div class="header">
            
            <h1 class="page-title">Criar pedido</h1>
        </div>
        
                <ul class="breadcrumb">
            <li><a href="<?php echo site_url().'adm/'; ?>">Inicial</a> <span class="divider">/</span></li>
            <li><a href="<?php echo site_url().'adm/pedidos/cadastrar'; ?>">Criar pedido</a> <span class="divider">/</span></li>
            <li class="active">Pedido</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="well">
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <?php echo form_open(site_url().'adm/cadastrar_pedido'); ?>

    	<?php echo form_error('cliente'); ?>
        <label>
            <label>Cliente</label>
            <input type="text" name='cliente' placeholder='Nome' alt='Nome' id='nome-cliente' class="input-xlarge input-text" value="<?php echo set_value('cliente') ?>" />
            <div id='cliente-search' class='search-box box-shadow'></div>
        </label>
        
        <?php echo form_error('endereco'); ?>
        <label>Endereço</label>
        <label>
            <input type="text" name='endereco' placeholder='Endereço' alt='Endereço' class="input-xlarge input-text" value="<?php echo set_value('endereco') ?>" />
            <input type="button" class='trocar' value='outro' /> 
        </label>

		<?php echo form_error('produtos'); ?>
		<label>Produtos</label>
        <label class='lista-produtos'>
            <ul>
                <?php 

                if( isset($produtos) ){

                    foreach ($produtos as $key => $produto) {
                ?>
                    <input type="hidden" name='produtos[]' value='<?php echo $produto -> id; ?>' />
                    <li><a href="<?php echo site_url(); ?>'produtos/editar/<?php echo $produto -> id ?>"><?php echo $produto -> nome ?> - R$ <?php echo $produto -> preco; ?></a> <a href='#' class='retirar' alt='<?php echo $produto -> id; ?>'>retirar</a></li>

                <?php
                    }

                } 
                ?>
            </ul>
        </label>
        <input type="button" id='sel_produtos' value='Selecionar' /> 
        
		<?php echo form_error('hora_marcada'); ?>
		<label>Hora marcada</label>
		<input type="text" name='hora_marcada' placeholder='Hora marcada' alt='Hora marcada' class="input-text" value="<?php echo set_value('hora_marcada') ?>" />
		
        <?php echo form_error('meio_pagamento'); ?>
        <label>Meio de pagamento</label>
        <select name="meio_pagamento" id="">
            <option value="dinheiro">Dinheiro</option>
            <option value="cartao">Cartão de crédito</option>
        </select>

        <?php echo form_error('troco'); ?>
        <label>Troco</label>
        <input type="text" name='troco' placeholder='Troco' alt='Troco' class="input-text" value="<?php echo set_value('troco') ?>" />          
    
        <?php echo form_error('filial'); ?>
        <label>Filial</label>
        <input type="text" name='filial' placeholder='Filial' alt='Filial' class="input-text" value="<?php echo set_value('filial') ?>" />          
  
        <?php echo form_error('entregador'); ?>
        <label>Entregador</label>
        <input type="text" name='entregador' placeholder='Entregador' alt='Entregador' class="input-text" value="<?php echo set_value('entregador') ?>" />          


    	<input type='submit' class="btn btn-primary" value='Cadastrar' />

    </form>
      </div>
  </div>


    </div>

</div>

<div class='well box-sel box-shadow'><a href="javascript: void(0)" class='fechar'>Fechar X</a><div></div></div>
