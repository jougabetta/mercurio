<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadastre_se extends CI_Controller {

	public function index()
	{
		$this->load->view('header');
		$this->load->view('cadastre_se');
		$this->load->view('footer');
	}

	public function enviar(){

		$this -> form_validation -> set_rules('nome', 'Nome', 'required');
		$this -> form_validation -> set_rules('email', 'E-mail', 'required');
		$this -> form_validation -> set_rules('telefone', 'Telefone', 'required');
		$this -> form_validation -> set_rules('endereco', 'Endereço', 'required');
		$this -> form_validation -> set_rules('senha', 'Senha', 'required');
		$this -> form_validation -> set_rules('confirmar_senha', 'Confirmar Senha', 'required|callback_confirma_senha');

		if( $this -> form_validation -> run() ):

			foreach( $this -> input -> post() as $key => $val ):
			
				$$key = $val;

			endforeach;		

			$this -> cliente -> nome = $nome;
			$this -> cliente -> email = $email;
			$this -> cliente -> telefone = $telefone;
			$this -> cliente -> endereco = $endereco;
			$this -> cliente -> status = 1;

			if( $this -> cliente -> cadastrar() ):

				$this -> session -> set_flashdata('return', 'success');

			else:

				$this -> session -> set_flashdata('return', 'error');

			endif;				

			redirect('cadastre_se/', 'refresh');

		else:

			$this -> index();

		endif; 

	}

	public function confirma_senha($senha_confirm){

		$senha = $this -> input -> post('senha');

		if( $senha_confirm == $senha ):

			return true;

		else:

			$this -> form_validation -> set_message('confirma_senha', 'A senha não confirma.');
			return false;

		endif;

	}
	
}