		 <!---start-content---->
		 <div class="content">
		 	<!---start-contact---->
		 	<div class="contact">
		 		<div class="wrap">
				<div class="section group">				
				<div class="col span_1_of_3">
					<div class="contact_info">
			    	 	<h3>Find Us Here</h3>
			    	 		<div class="map">
								<iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=R+Sebasti%C3%A3o+Ant%C3%B4nio+Teixeira+16+-+Lagoinha+nova+friburgo&amp;aq=&amp;sll=-22.912863,-42.447052&amp;sspn=0.373789,0.676346&amp;t=h&amp;ie=UTF8&amp;hq=R+Sebasti%C3%A3o+Ant%C3%B4nio+Teixeira+16+-+Lagoinha+nova+friburgo&amp;hnear=&amp;radius=15000&amp;ll=-22.287604,-42.546498&amp;spn=0.071946,0.071946&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com.br/maps?f=q&amp;source=embed&amp;hl=pt-BR&amp;geocode=&amp;q=R+Sebasti%C3%A3o+Ant%C3%B4nio+Teixeira+16+-+Lagoinha+nova+friburgo&amp;aq=&amp;sll=-22.912863,-42.447052&amp;sspn=0.373789,0.676346&amp;t=h&amp;ie=UTF8&amp;hq=R+Sebasti%C3%A3o+Ant%C3%B4nio+Teixeira+16+-+Lagoinha+nova+friburgo&amp;hnear=&amp;radius=15000&amp;ll=-22.287604,-42.546498&amp;spn=0.071946,0.071946" style="color:#0000FF;text-align:left">Exibir mapa ampliado</a></small>					   		
							</div>
      				</div>
      			<div class="company_address">
				     	<h3>Information :</h3>
						<p>500 Lorem Ipsum Dolor Sit,</p>
						<p>22-56-2-9 Sit Amet, Lorem,</p>
						<p>USA</p>
				   		<p>Phone:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span><a href="#">info(at)mycompany.com</span></a></p>
				   		<p>Follow on: <span><a href="#">Facebook</a></span>, <span><a href="#">Twitter</a></span></p>
				   </div>
				</div>				
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3>Contact Us</h3>
					    <?php echo form_open('contato/enviar', array('id'=>'form-contato')); ?>
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
						     	<span><label>TELEFONE</label></span>
						    	<?php echo form_error('telefone'); ?>
						    	<span><input name="telefone" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>MENSAGEM</label></span>
						    	<?php echo form_error('mensagem'); ?>
						    	<span><textarea name="mensagem"> </textarea></span>
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
