var root = 'http://localhost/mercurio/adm/';

function adicionar_produto(element){

	var el = $(element).parent();
	var id = el.find('.produto-id').text();
	var nome = el.find('.produto-nome').text();
	var preco = el.find('.produto-preco').text();

	$('.lista-produtos ul').append('<li><a href=\''+root+'produtos/editar/'+id+'\'>'+nome+' - R$ '+preco+'</a> <a href=\'#\' class=\'retirar\'>retirar</a></li>');
	$.post('http://localhost/mercurio/adm/adicionar_produtos', { produto: id }, function(data){ console.log(data); });

}

$(function(){

	//verificação de placeholder
	if( !Modernizr.input.placeholder ){ $('input[type=text], textarea').val( $('input[type=text]').attr('alt') ); }

	$('.delete-button').click(function(event){

		var confirmacao = confirm('Você realmente deseja ' + $(this).attr('alt'));

		if( !confirmacao ){

			event.preventDefault();

		}

	});

	//Pedidos functions
	$('#nome-cliente').keyup(function(){

		var wd = $(this).val();
		if( wd != '' ){
			$('#cliente-search').load(root+'load_clientes', { 'word': wd });
		}else{
			$('#cliente-search').empty();
		}

	});

	var endereco = '';
	$('.search-box').on('click', function(event){

		var valor = $(event.target).text();
		var id = $(event.target).attr('alt');

		$(this).siblings('input[type=text]').val( valor ).end().empty();

		$('input[name=endereco]').load(root+'load_endereco', { 'id': id }, function(data){ endereco=data; $(this).val(data); });

	});

	$('.trocar').click(function(){ 

		var valor = $(this).val();

		if( valor == 'outro'){

			$(this).siblings('input[type=text]').val(''); 
			
			$(this).val('do cliente');

		}else if( valor == 'do cliente' ){

			$(this).siblings('input[type=text]').val(endereco); 

			$(this).val('outro');


		}

	});

	$('#sel_produtos').click(function(){
		
		$('.box-sel').show().find('div').load( root+'load_produtos' );

	});

	$('.fechar').click(function(event){ event.preventDefault(); $(this).parent().hide(); });

	$('.retirar').on('click', function(){ $.post('http://localhost/mercurio/adm/retirar_produtos', { produto: $(this).attr('alt') }); $(this).parent().remove(); });

});