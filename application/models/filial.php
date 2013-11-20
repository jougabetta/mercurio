<?php

	class Filial extends CI_Model{

		public $id;
		public $nome;
		public $endereco;
		public $cidade;
		public $estado;
		public $status;

		function __construct(){

			parent::__construct();
			
		}

		function get($id){

			$sel_filial = $this -> db -> query("SELECT * FROM filiais WHERE id='$id'");

			return $sel_filial -> result();

		}

		function cadastrar(){

			if( $this -> db -> query("INSERT INTO filiais SET nome='{$this->nome}', endereco='{$this -> endereco}', cidade='{$this -> cidade}', estado='{$this -> estado}', status='{$this -> status}'") ){

				return $this -> db-> insert_id();

			}
			
			return false;			

		}

		function editar(){

			if( $this -> db -> query("UPDATE filiais SET nome='{$this->nome}', endereco='{$this -> endereco}', cidade='{$this -> cidade}', estado='{$this -> estado}', status='{$this -> status}' WHERE id='{$this -> id}'") ){

				return true;

			}
			
			return false;			

		}

		function get_all(){

			$sel_filiais = $this -> db -> query('SELECT * FROM filiais');

			return $filiais = $sel_filiais -> result();

		}

		function delete($id){

			if( $this -> db -> query("DELETE FROM filiais WHERE id='$id'") ){

				return true;

			}
			
			return false;			

		}

	}
	
?>