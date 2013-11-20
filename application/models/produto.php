<?php

	class Produto extends CI_Model{

		public $id;
		public $nome;
		public $slug;
		public $imagem;
		public $descricao;
		public $preco;
		public $preco_promocional;
		public $status;
		public $opcionais = array();

		function __construct(){
			
			parent::__construct();
			
		}

		function get($id){

			$sel_produto = $this -> db -> query("SELECT * FROM produtos WHERE id='$id'");

			return $sel_produto -> result();

		}

		function get_opcionais($id){

			$sel_produto_opcionais = $this -> db -> query("SELECT * FROM produtos_opcionais WHERE produto='$id'");
			
			$opcionais = array();

			foreach ($sel_produto_opcionais -> result() as $key => $produto_opcional) {

				$opcionais[] = $produto_opcional -> opcional;

			}

			return $opcionais;

		}

		function get_in($ids){

			$sel_produtos = $this -> db -> query("SELECT * FROM produtos WHERE id IN($ids)");

			return $sel_produtos -> result();

		}

		function cadastrar(){

			if( $this -> db -> query("INSERT INTO produtos SET nome='{$this->nome}', slug='{$this -> slug}', imagem='{$this -> imagem}', descricao='{$this -> descricao}', preco='{$this -> preco}', preco_promocional='{$this -> preco_promocional}', status='{$this -> status}'") ){

				$id = $this -> db-> insert_id();

				foreach ($this -> opcionais as $key => $opcional) {

					if( ! $this -> db -> query("INSERT INTO produtos_opcionais SET produto='$id', opcional='$opcional'") ){

						return false;

					}
				
				}

				return $id;

			}
			
			return false;			

		}

		function editar(){

			if( $this -> db -> query("UPDATE produtos SET nome='{$this->nome}', slug='{$this -> slug}', imagem='{$this -> imagem}', descricao='{$this -> descricao}', preco='{$this -> preco}', preco_promocional='{$this -> preco_promocional}', status='{$this -> status}' WHERE id='{$this -> id}'") ){

				if( $this -> db -> query("DELETE FROM produtos_opcionais WHERE produto='$this->id'") ){

					foreach ($this -> opcionais as $key => $opcional) {

						if( ! $this -> db -> query("INSERT INTO produtos_opcionais SET produto='{$this->id}', opcional='{$opcional}'") ){

							return false;

						}
					
					}

				}

				return true;

			}
			
			return false;			

		}

		function get_all(){

			$sel_produtos = $this -> db -> query('SELECT * FROM produtos');

			return $produtos = $sel_produtos -> result();

		}

		function delete($id){

			if( $this -> db -> query("DELETE FROM produtos WHERE id='$id'") ){

				return true;

			}
			
			return false;			

		}

	}
	
?>