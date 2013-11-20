<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends CI_Controller {

	public function index()
	{
		$this->load->view('header');
		$this->load->view('contato');
		$this->load->view('footer');
	}

	public function enviar(){

		$this -> form_validation -> set_rules('nome', 'Nome', 'required');
		$this -> form_validation -> set_rules('email', 'E-mail', 'required');
		// $this -> form_validation -> set_rules('telefone', 'Telefone', 'required');
		$this -> form_validation -> set_rules('mensagem', 'Mensagem', 'required');

		if( $this -> form_validation -> run() ):

			foreach( $_POST as $key => $val ):
			
				$$key = $val;

			endforeach;		

			die("nome: $nome, email: $email, telefone: $telefone, mensagem: $mensagem");					

		else:

			$this -> index();

		endif; 

	}
	
}