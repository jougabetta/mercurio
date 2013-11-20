<?php

	class Entregador extends CI_Model{

		public $id;
		public $nome;
		public $email;
		public $telefone;
		public $endereco;
		public $cidade;
		public $estado;
		public $cep;
		public $filial;
		public $status;

		function __construct(){

			parent::__construct();
			
		}

		function get($id){

			$sel_entregador = $this -> db -> query("SELECT * FROM entregadores WHERE id='$id'");

			return $sel_entregador -> result();

		}

		function cadastrar(){

			if( $this -> db -> query("INSERT INTO entregadores SET nome='{$this->nome}', email='{$this->email}', telefone='{$this -> telefone}', endereco='{$this -> endereco}', cidade='{$this -> cidade}', cep='{$this -> cep}', estado='{$this -> estado}', filial='{$this -> filial}', status='{$this -> status}'") ){

				return $this -> db-> insert_id();

			}
			
			return false;			

		}

		function editar(){

			if( $this -> db -> query("UPDATE entregadores SET nome='{$this->nome}', email='{$this->email}', telefone='{$this -> telefone}', endereco='{$this -> endereco}', cidade='{$this -> cidade}', cep='{$this -> cep}', estado='{$this -> estado}', filial='{$this -> filial}', status='{$this -> status}' WHERE id='{$this -> id}'") ){

				return true;

			}
			
			return false;			

		}

		function get_all(){

			$sel_entregadores = $this -> db -> query('SELECT * FROM entregadores');

			return $entregadores = $sel_entregadores -> result();

		}

		function delete($id){

			if( $this -> db -> query("DELETE FROM entregadores WHERE id='$id'") ){

				return true;

			}
			
			return false;			

		}

	}
	
?>