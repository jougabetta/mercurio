<?php

	class Opcional extends CI_Model{

		public $id;
		public $nome;
		public $preco;
		public $valor;
		public $status;

		function __construct(){

			parent::__construct();

		}

		function get($id){

			$sel_opcional = $this -> db -> query("SELECT * FROM opcionais WHERE id='$id'");

			return $sel_opcional -> result();

		}

		function cadastrar(){

			if( $this -> db -> query("INSERT INTO opcionais SET nome='{$this->nome}', valor='{$this -> valor}', preco='{$this -> preco}', status='{$this -> status}'") ){

				return $this -> db-> insert_id();

			}
			
			return false;			

		}

		function editar(){

			if( $this -> db -> query("UPDATE opcionais SET nome='{$this->nome}', valor='{$this -> valor}', preco='{$this -> preco}', status='{$this -> status}' WHERE id='{$this -> id}'") ){

				return true;

			}
			
			return false;			

		}

		function get_all(){

			$sel_opcionais = $this -> db -> query('SELECT * FROM opcionais');

			return $opcionais = $sel_opcionais -> result();

		}

		function delete($id){

			if( $this -> db -> query("DELETE FROM opcionais WHERE id='$id'") ){

				return true;

			}
			
			return false;			

		}

	}
	
?>