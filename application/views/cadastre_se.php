		 <!---start-content---->
		 <div class="content">
		 	<!---start-contact---->
		 	<div class="contact">
		 		<div class="wrap">
				<div class="section group">						
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>Cadastre-se</h3>
						
						<?php if( $this -> session -> flashdata('return') == 'success' ){ ?>
			
							<p>Cadastro realizado com sucesso!</p>
	
						<?php }else if( $this -> session -> flashdata('return') == 'error' ){ ?>

							<p>Erro no seu cadastro.</p>

						<?php } ?>

					    <?php echo form_open('cadastre_se/enviar', array('id'=>'form-cadastre_se')); ?>
					    	<div>
						    	<span><label>NOME</label></span>
						    	<?php echo form_error('nome'); ?>
						    	<span><input name="nome" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<?php echo form_error('email'); ?>
						    	<span><input name="email" type="text" class="textbox"></span>
						    </div>
						    <div>
						     	<span><label>ENDEREÇO</label></span>
						    	<?php echo form_error('endereco'); ?>
						    	<span><input name="endereco" type="text" class="textbox"></span>
						    </div>
						    <div>
						     	<span><label>TELEFONE</label></span>
						    	<?php echo form_error('telefone'); ?>
						    	<span><input name="telefone" type="text" class="textbox"></span>
						    </div>
						    <div>
						     	<span><label>SENHA</label></span>
						    	<?php echo form_error('senha'); ?>
						    	<span><input name="senha" type="password" class="textbox"></span>
						    </div>
						    <div>
						     	<span><label>CONFIRMAR SENHA</label></span>
						    	<?php echo form_error('confirmar_senha'); ?>
						    	<span><input name="confirmar_senha" type="password" class="textbox"></span>
						    </div>						   
						    <div>
						   		<span><input type="submit" class="mybutton" value="Submit"></span>
						  	</div>
					    </form>

				    </div>
  				</div>				
			  </div>
			</div>
			</div>
		 	<!---End-contact---->
		 <!---End-content---->
