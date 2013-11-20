<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adm extends CI_Controller {

	public function index(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> clean_client_data(array('produtos_pedido'));

			$clientes = $this -> cliente -> get_all(10);

			$this -> load -> view('adm/header', array('usuario' => $this -> usuario, 'clientes' => $clientes ));
			$this -> load -> view('adm/inicial');
			$this -> load -> view('adm/footer');

		}else{

			$this -> login();

		}

	}

	public function login( $array = NULL ){

		$uri = $this -> uri -> uri_string();

		$array['uri'] = $uri;

		$this -> load -> view('adm/login', $array);
		$this -> load -> view('adm/footer');

	}

	public function logar(){

		if( $this -> usuario -> verificar_acesso() ){

			redirect(site_url().'adm', 'refresh');

		}else{

			$this -> form_validation -> set_rules('email', 'E-mail', 'required|valid_email');
			$this -> form_validation -> set_rules('senha', 'Senha', 'required|max_length[8]');

			if( $this -> form_validation -> run() ){

				$email = $this -> input -> post('email');				
				$senha = $this -> input -> post('senha');
				$uri = $this -> input -> post('uri');

				if( $this -> usuario -> verificar_login($email, $senha) ){

					$this -> session -> set_userdata('user', $email);

					if( $uri != '' ){

						redirect(site_url().$uri, 'refresh');

					}else{

						redirect(site_url().'adm', 'refresh');
						
					}

				}else{

					$this -> login( array('erro' => 'Acesso não permitido') );
							
				}		

			}else{

				$this -> login();

			}

		}

	}

	public function logout(){

		$this -> clean_client_data(array('produtos_pedido', 'user'));

		redirect(site_url().'adm', 'refresh');

	}

	public function clean_client_data($datas){

		foreach ($datas as $key => $data) {

			$array[$data] = '';
		
		}

		$this -> session -> unset_userdata($array);

	}

	public function usuarios($opcao, $id=''){

		//opcoes = listar|cadastrar|editar

		$this -> clean_client_data(array('produtos_pedido'));

		if( $this -> usuario -> verificar_acesso() ){

			if( $opcao == 'listar' ){

				$usuarios = $this -> usuario -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/usuarios', array('usuarios' => $usuarios));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'cadastrar' ){

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_usuario');
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'editar' && $id != '' ){

				$usuario = $this -> usuario -> get($id);

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_usuario', array('user' => $usuario[0]));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'deletar' && $id != '' ){

				$usuario = $this -> usuario -> delete($id);

				$usuarios = $this -> usuario -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/usuarios', array('usuarios' => $usuarios));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}

	}

	public function cadastrar_usuario(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('email', 'E-mail', 'required|valid_email');
			$this -> form_validation -> set_rules('senha', 'Senha', 'required|matches[senha-confirm]|min_length[4]|max_length[8]');
			$this -> form_validation -> set_rules('senha-confirm', 'Confirmar senha', 'required|min_length[4]|max_length[8]');

			if( $this -> form_validation -> run() ){

				$novo_usuario = new Usuario();
				$novo_usuario -> nome = $this -> input -> post('nome');
				$novo_usuario -> email = $this -> input -> post('email');
				$novo_usuario -> senha = $this -> input -> post('senha');
				$novo_usuario -> status = $this -> input -> post('status');

				$novo_usuario -> id = $novo_usuario -> cadastrar();

				if( $novo_usuario -> id ){

					$this -> session -> set_userdata('sucesso', 'Usuário cadastrado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/usuarios/editar/{$novo_usuario -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_usuario');
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	

	}

	public function editar_usuario(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('email', 'E-mail', 'required|valid_email');

			if( $this -> form_validation -> run() ){

				$mesmo_usuario = new Usuario();
				$mesmo_usuario -> id = $this -> input -> post('id');
				$mesmo_usuario -> nome = $this -> input -> post('nome');
				$mesmo_usuario -> email = $this -> input -> post('email');
				$mesmo_usuario -> status =  $this -> input -> post('status');

				$update = $mesmo_usuario -> editar();

				if( $update ){ 

					$this -> session -> set_userdata('sucesso', 'Usuário editado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/usuarios/editar/{$mesmo_usuario -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$usuario = $this -> usuario -> get( $this -> input -> post('id') );

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_usuario', array('user' => $usuario[0]));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	
					
	}

	public function produtos($opcao, $id=''){

		//opcoes = listar|cadastrar|editar

		if( $this -> usuario -> verificar_acesso() ){

			if( $opcao == 'listar' ){

				$produtos = $this -> produto -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/produtos', array('produtos' => $produtos));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'cadastrar' ){

				$opcionais = $this -> opcional -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_produto', array('opcionais'=> $opcionais));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'editar' && $id != '' ){

				$produto = $this -> produto -> get($id);
				$produto_opcionais = $this -> produto -> get_opcionais($id);
				$opcionais = $this -> opcional -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_produto', array('produto' => $produto[0], 'produto_opcionais' => $produto_opcionais ,'opcionais' => $opcionais));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'deletar' && $id != '' ){

				$produto = $this -> produto -> delete($id);

				$produtos = $this -> produto -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/produtos', array('produtos' => $produtos));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}

	}

	public function cadastrar_produto(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('descricao', 'Descrição', 'required');
			$this -> form_validation -> set_rules('preco', 'Preço', 'required');

			if( $this -> form_validation -> run() ){

				$novo_produto = new Produto();
				$novo_produto -> nome = $this -> input -> post('nome');
				$novo_produto -> slug = $novo_produto -> nome;
				$novo_produto -> imagem = $_FILES['userfile']['name'];
				$novo_produto -> descricao = $this -> input -> post('descricao');
				$novo_produto -> preco = $this -> input -> post('preco');
				$novo_produto -> preco_promocional = $this -> input -> post('preco_promocional');
				$novo_produto -> status = $this -> input -> post('status');
				$novo_produto -> opcionais = $this -> input -> post('opcional');

				$config['upload_path'] = './uploads/produtos';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '0';
				$config['max_width']  = '1024';
				$config['max_height']  = '768';

				$this->load->library('upload', $config);

				// if ( ! $this->upload->do_upload() )
				// {

				// 	$error = 'Erro ao enviar imagem: ' . $this->upload->display_errors();

				// 	$opcionais = $this -> opcional -> get_all();

				// 	$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				// 	$this -> load -> view('adm/cadastrar_produto', array('opcionais'=> $opcionais, 'error' => $error));
				// 	$this -> load -> view('adm/footer');

				// }
				// else
				// {

					$novo_produto -> id = $novo_produto -> cadastrar();

					if( $novo_produto -> id ){

						$this -> session -> set_userdata('sucesso', 'Produto cadastrado com sucesso!');

						$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
						redirect("adm/produtos/editar/{$novo_produto -> id}", 'refresh');
						$this -> load -> view('adm/footer');	
										
					}else{

						$this -> session -> set_userdata('error', 'Houve um error no cadastro deste produto.');

						$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
						redirect("adm/produtos/editar/{$novo_produto -> id}", 'refresh');
						$this -> load -> view('adm/footer');

					}

				//}

			}else{

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_produto');
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	

	}

	public function editar_produto(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('descricao', 'Descrição', 'required');
			$this -> form_validation -> set_rules('preco', 'Preço', 'required');

			if( $this -> form_validation -> run() ){

				$mesmo_produto = new Produto();
				$mesmo_produto -> id = $this -> input -> post('id');
				$mesmo_produto -> nome = $this -> input -> post('nome');
				$mesmo_produto -> slug = $mesmo_produto -> nome;
				$mesmo_produto -> imagem = $_FILES['userfile']['name'];
				$mesmo_produto -> descricao = $this -> input -> post('descricao');
				$mesmo_produto -> preco = $this -> input -> post('preco');
				$mesmo_produto -> preco_promocional = $this -> input -> post('preco_promocional');
				$mesmo_produto -> status = $this -> input -> post('status');
				$mesmo_produto -> opcionais = $this -> input -> post('opcional');

				$config['upload_path'] = './uploads/produtos';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '0';
				$config['max_width']  = '1024';
				$config['max_height']  = '768';

				$this->load->library('upload', $config);

				// if ( ! $this->upload->do_upload() )
				// {

				// 	$error = 'Erro ao enviar imagem: ' . $this->upload->display_errors();

				// 	$opcionais = $this -> opcional -> get_all();

				// 	$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				// 	$this -> load -> view('adm/cadastrar_produto', array('opcionais'=> $opcionais, 'error' => $error));
				// 	$this -> load -> view('adm/footer');

				// }
				// else
				// {

					$update = $mesmo_produto -> editar();	

					if( $update ){ 
							
						$this -> session -> set_userdata('sucesso', 'Produto editado com sucesso!');

						$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
						redirect("adm/produtos/editar/{$mesmo_produto -> id}", 'refresh');
						$this -> load -> view('adm/footer');	
										
					}else{

						$this -> session -> set_userdata('error', 'Houve um error na edição deste produto.');

						$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
						redirect("adm/produtos/editar/{$mesmo_produto -> id}", 'refresh');
						$this -> load -> view('adm/footer');
					
					}

				//}

			}else{

				$produto = $this -> produto -> get($id);

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_produto', array('produto' => $produto[0]));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	
					
	}

	public function load_produtos(){

		$html = '<div class=\'order-sels\'>';

		$produtos = $this -> produto -> get_all();

		foreach ($produtos as $key => $produto) {

			$html .= '<div class=\'box-produto\'>';

				$html .= '<img width=\'250\' src=\''.site_url().'/uploads/produtos/'.$produto->imagem.'\' />';
				$html .= '<p class=\'produto-id hidden\'>'.$produto->id.'</p>';
				$html .= '<p class=\'produto-nome\'>'.$produto->nome.'</p>';
				$html .= '<p class=\'produto-preco\'>'.$produto->preco.'</p>';
				$html .= '<input type=\'button\' onclick=\'adicionar_produto(this)\' class=\'adicionar-produto\' value=\'Adicionar\' />';

			$html .= '</div>';

		}

		$html .= '</div>';

		echo $html;

	}

	public function adicionar_produtos(){

		$id = $_POST['produto'];

		if( $this -> session -> userdata('produtos_pedido') == '' ){

			$array_produtos_pedido = array();

		}else{

			$array_produtos_pedido = $this -> session -> userdata('produtos_pedido');

		}

		array_push( $array_produtos_pedido, $id );
		$this -> session -> set_userdata('produtos_pedido', $array_produtos_pedido);
		print_r($array_produtos_pedido);

	}

	public function retirar_produtos(){

		$id = $_POST['produto'];

		$array_produtos_pedido = $this -> session -> userdata('produtos_pedido');

		unset($array_produtos_pedido[ array_search($id, $array_produtos_pedido) ]);

		$this -> session -> set_userdata('produtos_pedido', $array_produtos_pedido);

	}

	public function opcionais($opcao, $id=''){

		//opcoes = listar|cadastrar|editar

		$this -> clean_client_data(array('produtos_pedido'));

		if( $this -> usuario -> verificar_acesso() ){

			if( $opcao == 'listar' ){

				$opcionais = $this -> opcional -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/opcionais', array('opcionais' => $opcionais));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'cadastrar' ){

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_opcional');
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'editar' && $id != '' ){

				$opcional = $this -> opcional -> get($id);

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_opcional', array('opcional' => $opcional[0]));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'deletar' && $id != '' ){

				$opcional = $this -> opcional -> delete($id);

				$opcionais = $this -> opcional -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/opcionais', array('opcionais' => $opcionais));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}

	}

	public function cadastrar_opcional(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('valor', 'Valor', 'required');
			$this -> form_validation -> set_rules('preco', 'Preço', 'required');

			if( $this -> form_validation -> run() ){

				$novo_opcional = new Opcional();
				$novo_opcional -> nome = $this -> input -> post('nome');
				$novo_opcional -> valor = $this -> input -> post('valor');
				$novo_opcional -> preco = $this -> input -> post('preco');
				$novo_opcional -> status = $this -> input -> post('status');

				$novo_opcional -> id = $novo_opcional -> cadastrar();

				if( $novo_opcional -> id ){

					$this -> session -> set_userdata('sucesso', 'Opcional cadastrado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/opcionais/editar/{$novo_opcional -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_opcional');
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	

	}

	public function editar_opcional(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('valor', 'Valor', 'required');
			$this -> form_validation -> set_rules('preco', 'Preço', 'required');

			if( $this -> form_validation -> run() ){

				$mesmo_opcional = new Opcional();
				$mesmo_opcional -> id = $this -> input -> post('id');
				$mesmo_opcional -> nome = $this -> input -> post('nome');
				$mesmo_opcional -> valor = $this -> input -> post('valor');
				$mesmo_opcional -> preco = $this -> input -> post('preco');
				$mesmo_opcional -> status = $this -> input -> post('status');

				$update = $mesmo_opcional -> editar();

				if( $update ){ 
						
					$this -> session -> set_userdata('sucesso', 'Opcional editado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/opcionais/editar/{$mesmo_opcional -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$opcional = $this -> opcional -> get($id);

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_opcional', array('opcional' => $opcional[0]));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	
					
	}

	public function filiais($opcao, $id=''){

		//opcoes = listar|cadastrar|editar

		$this -> clean_client_data(array('produtos_pedido'));

		if( $this -> usuario -> verificar_acesso() ){

			if( $opcao == 'listar' ){

				$filiais = $this -> filial -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/filiais', array('filiais' => $filiais));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'cadastrar' ){

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_filial');
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'editar' && $id != '' ){

				$filial = $this -> filial -> get($id);

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_filial', array('filial' => $filial[0]));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'deletar' && $id != '' ){

				$filial = $this -> filial -> delete($id);

				$filiais = $this -> filial -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/filiais', array('filiais' => $filiais));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}

	}

	public function cadastrar_filial(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('endereco', 'Endereço', 'required');
			$this -> form_validation -> set_rules('cidade', 'Cidade', 'required');
			$this -> form_validation -> set_rules('estado', 'Estado', 'required');

			if( $this -> form_validation -> run() ){

				$nova_filial = new Filial();
				$nova_filial -> nome = $this -> input -> post('nome');
				$nova_filial -> endereco = $this -> input -> post('endereco');
				$nova_filial -> cidade = $this -> input -> post('cidade');
				$nova_filial -> estado = $this -> input -> post('estado');
				$nova_filial -> status = $this -> input -> post('status');

				$nova_filial -> id = $nova_filial -> cadastrar();

				if( $nova_filial -> id ){

					$this -> session -> set_userdata('sucesso', 'Filial cadastrado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/filiais/editar/{$nova_filial -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_filial');
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	

	}

	public function editar_filial(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('endereco', 'Endereço', 'required');
			$this -> form_validation -> set_rules('cidade', 'Cidade', 'required');
			$this -> form_validation -> set_rules('estado', 'Estado', 'required');

			if( $this -> form_validation -> run() ){

				$mesma_filial = new Filial();
				$mesma_filial -> id = $this -> input -> post('id');
				$mesma_filial -> nome = $this -> input -> post('nome');
				$mesma_filial -> endereco = $this -> input -> post('endereco');
				$mesma_filial -> cidade = $this -> input -> post('cidade');
				$mesma_filial -> estado = $this -> input -> post('estado');
				$mesma_filial -> status = $this -> input -> post('status');

				$update = $mesma_filial -> editar();

				if( $update ){ 
					
					$this -> session -> set_userdata('sucesso', 'Filial editado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/filiais/editar/{$mesma_filial -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$filial = $this -> filial -> get($id);

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_filial', array('filial' => $filial[0]));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	
					
	}

	public function entregadores($opcao, $id=''){

		//opcoes = listar|cadastrar|editar

		$this -> clean_client_data(array('produtos_pedido'));

		if( $this -> usuario -> verificar_acesso() ){

			if( $opcao == 'listar' ){

				$entregadores = $this -> entregador -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/entregadores', array('entregadores' => $entregadores));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'cadastrar' ){

				$filiais = $this -> filial -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_entregador', array('filiais' => $filiais));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'editar' && $id != '' ){

				$entregador = $this -> entregador -> get($id);
				$filiais = $this -> filial -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_entregador', array('entregador' => $entregador[0], 'filiais' => $filiais));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'deletar' && $id != '' ){

				$entregador = $this -> entregador -> delete($id);

				$entregadores = $this -> entregador -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/entregadores', array('entregadores' => $entregadores));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}

	}

	public function cadastrar_entregador(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('email', 'E-mail', 'valid_email');
			$this -> form_validation -> set_rules('endereco', 'Endereço', 'required');
			$this -> form_validation -> set_rules('cidade', 'Cidade', 'required');
			$this -> form_validation -> set_rules('cep', 'Cep', 'required');
			$this -> form_validation -> set_rules('estado', 'Estado', 'required');
			$this -> form_validation -> set_rules('filial', 'Filial', 'required');

			if( $this -> form_validation -> run() ){

				$novo_entregador = new Entregador();
				$novo_entregador -> nome = $this -> input -> post('nome');
				$novo_entregador -> email = $this -> input -> post('email');
				$novo_entregador -> telefone = $this -> input -> post('telefone');
				$novo_entregador -> endereco = $this -> input -> post('endereco');
				$novo_entregador -> cidade = $this -> input -> post('cidade');
				$novo_entregador -> estado = $this -> input -> post('estado');
				$novo_entregador -> cep = $this -> input -> post('cep');
				$novo_entregador -> filial = $this -> input -> post('filial');
				$novo_entregador -> status = $this -> input -> post('status');

				$novo_entregador -> id = $novo_entregador -> cadastrar();

				if( $novo_entregador -> id ){

					$this -> session -> set_userdata('sucesso', 'Entregador cadastrado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/entregadores/editar/{$novo_entregador -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$filiais = $this -> filial -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_entregador', array('filiais' => $filiais));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	

	}

	public function editar_entregador(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('email', 'E-mail', 'valid_email');
			$this -> form_validation -> set_rules('endereco', 'Endereço', 'required');
			$this -> form_validation -> set_rules('cidade', 'Cidade', 'required');
			$this -> form_validation -> set_rules('cep', 'Cep', 'required');
			$this -> form_validation -> set_rules('estado', 'Estado', 'required');
			$this -> form_validation -> set_rules('filial', 'Filial', 'required');

			if( $this -> form_validation -> run() ){

				$mesmo_entregador = new Entregador();
				$mesmo_entregador -> id = $this -> input -> post('id');
				$mesmo_entregador -> nome = $this -> input -> post('nome');
				$mesmo_entregador -> email = $this -> input -> post('email');
				$mesmo_entregador -> telefone = $this -> input -> post('telefone');
				$mesmo_entregador -> endereco = $this -> input -> post('endereco');
				$mesmo_entregador -> cidade = $this -> input -> post('cidade');
				$mesmo_entregador -> estado = $this -> input -> post('estado');
				$mesmo_entregador -> cep = $this -> input -> post('cep');
				$mesmo_entregador -> filial = $this -> input -> post('filial');
				$mesmo_entregador -> status = $this -> input -> post('status');

				$update = $mesmo_entregador -> editar();

				if( $update ){ 

					$this -> session -> set_userdata('sucesso', 'Entregador editado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/entregadores/editar/{$mesmo_entregador -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$entregador = $this -> entregador -> get( $this -> input -> post('id') );
				$filiais = $this -> filial -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_entregador', array('entregador' => $entregador[0], 'filiais' => $filiais));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	
					
	}

	public function clientes($opcao, $id=''){

		//opcoes = listar|cadastrar|editar

		$this -> clean_client_data(array('produtos_pedido'));

		if( $this -> usuario -> verificar_acesso() ){

			if( $opcao == 'listar' ){

				$clientes = $this -> cliente -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/clientes', array('clientes' => $clientes));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'cadastrar' ){

				$clientes = $this -> cliente -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_cliente', array('clientes' => $clientes));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'editar' && $id != '' ){

				$cliente = $this -> cliente -> get($id);

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_cliente', array('cliente' => $cliente[0]));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'deletar' && $id != '' ){

				$cliente = $this -> cliente -> delete($id);

				$clientes = $this -> cliente -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/clientes', array('clientes' => $clientes));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}

	}

	public function cadastrar_cliente(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('email', 'E-mail', 'valid_email');
			$this -> form_validation -> set_rules('endereco', 'Endereço', 'required');
			$this -> form_validation -> set_rules('telefone', 'Telefone', 'required');

			if( $this -> form_validation -> run() ){

				$novo_cliente = new Cliente();
				$novo_cliente -> nome = $this -> input -> post('nome');
				$novo_cliente -> email = $this -> input -> post('email');
				$novo_cliente -> telefone = $this -> input -> post('telefone');
				$novo_cliente -> endereco = $this -> input -> post('endereco');
				$novo_cliente -> status = $this -> input -> post('status');

				$novo_cliente -> id = $novo_cliente -> cadastrar();

				if( $novo_cliente -> id ){

					$this -> session -> set_userdata('sucesso', 'Cliente cadastrado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/clientes/editar/{$novo_cliente -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$clientes = $this -> cliente -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_cliente', array('clientes' => $clientes));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	

	}

	public function editar_cliente(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('email', 'E-mail', 'valid_email');
			$this -> form_validation -> set_rules('endereco', 'Endereço', 'required');
			$this -> form_validation -> set_rules('telefone', 'Telefone', 'required');

			if( $this -> form_validation -> run() ){

				$mesmo_cliente = new Cliente();
				$mesmo_cliente -> id = $this -> input -> post('id');
				$mesmo_cliente -> nome = $this -> input -> post('nome');
				$mesmo_cliente -> email = $this -> input -> post('email');
				$mesmo_cliente -> telefone = $this -> input -> post('telefone');
				$mesmo_cliente -> endereco = $this -> input -> post('endereco');
				$mesmo_cliente -> status = $this -> input -> post('status');

				$update = $mesmo_cliente -> editar();

				if( $update ){ 

					$this -> session -> set_userdata('sucesso', 'Cliente editado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/clientes/editar/{$mesmo_cliente -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$cliente = $this -> cliente -> get($id);

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_cliente', array('cliente' => $cliente[0]));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	
					
	}

	public function load_clientes(){

		$word = $_REQUEST['word'];
		$clientes = $this -> cliente -> search_by_name($word);

		$html = '<ul class=\'search-list\'>';

		foreach ($clientes as $key => $cliente) {

			$html .= '<li alt=\''.$cliente -> id.'\'>'.$cliente -> nome.'</li>';

		}

		$html .= '</ul>';

		echo $html;


	}

	public function load_endereco(){

		$id = $_REQUEST['id'];
		$cliente = $this -> cliente -> search_by_address($id);

		echo $cliente[0] -> endereco;

	}

	public function pedidos($opcao, $id=''){

		//opcoes = listar|cadastrar|editar

		if( $this -> usuario -> verificar_acesso() ){

			if( $opcao == 'listar' ){

				$pedidos = $this -> pedido -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/pedidos', array('pedidos' => $pedidos));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'cadastrar' ){

				$entregadores = $this -> entregador -> get_all();
				$filiais = $this -> filial -> get_all();

				$array_produtos_pedido = $this -> session -> userdata('produtos_pedido');

				if( count( $array_produtos_pedido ) > 0 && $array_produtos_pedido != '' ){

					$ids = implode(',', $this -> session -> userdata('produtos_pedido') );

					$produtos = $this -> produto -> get_in($ids);

				}else{

					$produtos = null;

				}

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_pedido', array('entregadores' => $entregadores, 'filiais' => $filiais, 'produtos' => $produtos));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'editar' && $id != '' ){

				$pedidos = $this -> pedido -> get($id);

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_pedido', array('pedido' => $pedido[0]));
				$this -> load -> view('adm/footer');

			}else if( $opcao == 'deletar' && $id != '' ){

				$pedido = $this -> pedido -> delete($id);
				$pedidos = $this -> pedido -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/pedidos', array('pedidos' => $pedidos));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}

	}

	public function cadastrar_pedido(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('email', 'E-mail', 'valid_email');
			$this -> form_validation -> set_rules('endereco', 'Endereço', 'required');
			$this -> form_validation -> set_rules('telefone', 'Telefone', 'required');

			if( $this -> form_validation -> run() ){

				$novo_cliente = new Cliente();
				$novo_cliente -> nome = $this -> input -> post('nome');
				$novo_cliente -> email = $this -> input -> post('email');
				$novo_cliente -> telefone = $this -> input -> post('telefone');
				$novo_cliente -> endereco = $this -> input -> post('endereco');
				$novo_cliente -> status = $this -> input -> post('status');

				$novo_cliente -> id = $novo_cliente -> cadastrar();

				if( $novo_cliente -> id ){

					$this -> session -> set_userdata('sucesso', 'Cliente cadastrado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/clientes/editar/{$novo_cliente -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$clientes = $this -> cliente -> get_all();

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/cadastrar_cliente', array('clientes' => $clientes));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	

	}

	public function editar_pedido(){

		if( $this -> usuario -> verificar_acesso() ){

			$this -> form_validation -> set_rules('nome', 'Nome', 'required|min_length[1]');
			$this -> form_validation -> set_rules('email', 'E-mail', 'valid_email');
			$this -> form_validation -> set_rules('endereco', 'Endereço', 'required');
			$this -> form_validation -> set_rules('telefone', 'Telefone', 'required');

			if( $this -> form_validation -> run() ){

				$mesmo_cliente = new Cliente();
				$mesmo_cliente -> id = $this -> input -> post('id');
				$mesmo_cliente -> nome = $this -> input -> post('nome');
				$mesmo_cliente -> email = $this -> input -> post('email');
				$mesmo_cliente -> telefone = $this -> input -> post('telefone');
				$mesmo_cliente -> endereco = $this -> input -> post('endereco');
				$mesmo_cliente -> status = $this -> input -> post('status');

				$update = $mesmo_cliente -> editar();

				if( $update ){ 

					$this -> session -> set_userdata('sucesso', 'Cliente editado com sucesso!');

					$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
					redirect("adm/clientes/editar/{$mesmo_cliente -> id}", 'refresh');
					$this -> load -> view('adm/footer');	
									
				}

			}else{

				$cliente = $this -> cliente -> get($id);

				$this -> load -> view('adm/header', array('usuario' => $this -> usuario ));
				$this -> load -> view('adm/editar_cliente', array('cliente' => $cliente[0]));
				$this -> load -> view('adm/footer');

			}

		}else{

			$this -> login();

		}	
					
	}
	
}
