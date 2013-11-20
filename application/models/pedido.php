<?php

	class Pedido extends CI_Model{

		public $id;
		public $valor;
		public $troco;
		public $cliente;
		public $data;
		public $hora_marcada;
		public $meio_pagamento;
		public $entregador;
		public $filial;
		public $status; // 0 = pendente; 1 = entregue; 2 = saiu para entrega;

		function __construct(){

			parent::__construct();
			
			$this -> data = date('Y-m-d');
			$this -> status = 0;

		}

		public function get($id){

			$sel_pedido = $this -> db -> query("SELECT * FROM pedidos WHERE id='{$this->id}'");

			return $sel_pedido -> result();

		}

		public function get_data($de='', $ate=''){

			$sel_pedidos = $this -> db -> query("SELECT * FROM pedidos WHERE data >= '$de' AND data <= '$ate' ");

			return $sel_pedidos -> result();

		}

		public function get_all(){

			$sel_pedidos = $this -> db -> query("SELECT * FROM pedidos ");

			return $sel_pedidos -> result();

		}

		function delete($id){

			if( $this -> db -> query("DELETE FROM pedidos WHERE id='$id'") ){

				return true;

			}
			
			return false;			

		}
		
	}
	
?>