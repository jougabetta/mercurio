<?php

	class Usuario extends CI_Model{

		public $id;
		public $nome;
		public $email;
		public $senha;
		public $status;
		// public $conexao;

		function __construct(){

			parent::__construct();

		}

		function verificar_acesso(){

			if( $this -> session -> userdata('user') != '' ){

				$email = $this -> session -> userdata('user');

				$sel_usuario = $this -> db -> query("SELECT * FROM usuarios WHERE email='{$email}' AND status='1'");

				$usuario = $sel_usuario -> result();

				if( count( $usuario ) <= 0 ){

					return false;

				}

				if( $usuario[0] -> status == 0 ){

					return false;

				}

				$this -> id = $usuario[0] -> id;
				$this -> nome = $usuario[0] -> nome;
				$this -> email = $usuario[0] -> email;

				return true;

			}else{

				return false;

			}

		}

		function verificar_login($email, $senha){

			$sel_usuario = $this -> db -> query("SELECT email FROM usuarios WHERE email='$email' AND senha='$senha' AND status='1'");

			if( $sel_usuario -> num_rows == 1 ){

				return true;

			}else{

				return false;

			}

		}

		function get_all(){

			$sel_usuarios = $this -> db -> query('SELECT * FROM usuarios');

			return $usuarios = $sel_usuarios -> result();

		}

		function get($id){

			$sel_usuario = $this -> db -> query("SELECT * FROM usuarios WHERE id='$id'");

			return $usuario = $sel_usuario -> result();

		}

		function cadastrar(){

			if( $this -> db -> query("INSERT INTO usuarios SET nome='{$this->nome}', email='{$this -> email}', senha='{$this -> senha}', status='{$this -> status}'") ){

				return $this -> db-> insert_id();

			}
			
			return false;			

		}

		function editar(){

			if( $this -> db -> query("UPDATE usuarios SET nome='{$this->nome}', email='{$this -> email}', status='{$this -> status}' WHERE id='{$this -> id}'") ){

				return true;

			}else{

				die( $this -> db -> error() );

			}
			
		}

		function delete($id){

			if( $this -> db -> query("DELETE FROM usuarios WHERE id='$id'") ){

				return true;

			}
			
			return false;			

		}

	}
	
?>