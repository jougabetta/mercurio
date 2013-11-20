<?php

	class Cliente extends CI_Model{

		public $id;
		public $nome;
		public $email;
		public $endereco;
		public $telefone;
		public $status;
		public $data_cadastro;

		function __construct(){

			parent::__construct();
			
		}

		function get($id){

			$sel_cliente = $this -> db -> query("SELECT * FROM clientes WHERE id='$id'");

			return $sel_cliente -> result();

		}

		function search_by_name($word){

			$sel_clientes = $this -> db -> query("SELECT * FROM clientes WHERE nome LIKE '%$word%'");

			return $sel_clientes -> result();

		}

		function search_by_address($id){

			$sel_endereco = $this -> db -> query("SELECT endereco FROM clientes WHERE id='$id'");

			return $sel_endereco -> result();

		}

		function cadastrar(){

			$this -> data_cadastro = date('Y-m-d H:i:s');

			if( $this -> db -> query("INSERT INTO clientes SET nome='{$this->nome}', email='{$this->email}', telefone='{$this -> telefone}', endereco='{$this -> endereco}', status='{$this -> status}', data_cadastro='{$this -> data_cadastro}'") ){

				return $this -> db-> insert_id();

			}
			
			return false;			

		}

		function editar(){

			if( $this -> db -> query("UPDATE clientes SET nome='{$this->nome}', email='{$this->email}', telefone='{$this -> telefone}', endereco='{$this -> endereco}', status='{$this -> status}' WHERE id='{$this -> id}'") ){

				return true;

			}
			
			return false;			

		}

		function get_all($limite=''){

			if($limite){
				$limite = "LIMIT $limite";
			}

			$sel_clientes = $this -> db -> query('SELECT * FROM clientes $limite ORDER BY id DESC');

			return $clientes = $sel_clientes -> result();

		}

		function delete($id){

			if( $this -> db -> query("DELETE FROM clientes WHERE id='$id'") ){

				return true;

			}
			
			return false;			

		}

	}
	
?>