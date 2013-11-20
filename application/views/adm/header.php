<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>ss</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>css/adm_style.css">
        
        <link rel="stylesheet" href="<?php echo site_url(); ?>css/font-awesome/css/font-awesome.css">

        <style type="text/css">
            #line-chart {
                height:300px;
                width:800px;
                margin: 0px auto;
                margin-top: 1em;
            }
            .brand { font-family: georgia, serif; }
            .brand .first {
                color: #ccc;
                font-style: italic;
            }
            .brand .second {
                color: #fff;
                font-weight: bold;
            }
        </style>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="../assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

        <script src="<?php echo site_url(); ?>js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    </head>
		

    <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
    <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
    <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
    <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--> 
    <body class=""> 
    <!--<![endif]-->
    
        <div class="navbar">
            <div class="navbar-inner">
                    <ul class="nav pull-right">
                        
                        <li><a href="#" class="hidden-phone visible-tablet visible-desktop" role="button">Configurações</a></li>
                        <li id="fat-menu" class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-user"></i> <?php echo $usuario -> nome; ?>
                                <i class="icon-caret-down"></i>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="<?php echo site_url(); ?>adm/usuarios/editar/<?php echo $usuario -> id; ?>">Minha conta</a></li>
                                <li class="divider"></li>
                                <li><a tabindex="-1" class="visible-phone" href="#">Configurações</a></li>
                                <li class="divider visible-phone"></li>
                                <li><a tabindex="-1" href="<?php echo site_url().'adm/logout'; ?>">Logout</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                    <a class="brand" href="<?php echo site_url().'adm/'; ?>"><span class="first">Mercurio</span> <span class="second">Delivery</span></a>
            </div>
        </div>			

    <nav>
        
    <div class="sidebar-nav">
        <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Painel</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><a href="<?php echo site_url().'adm/'; ?>">Inicial</a></li>            
        </ul>

        <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-key"></i>Usuários<!-- <span class="label label-info">+3</span> --></a>
        <ul id="accounts-menu" class="nav nav-list collapse">
            <li><a href="<?php echo site_url().'adm/usuarios/listar'; ?>">Listar</a></li>
            <li><a href="<?php echo site_url().'adm/usuarios/cadastrar'; ?>">Cadastrar</a></li>
        </ul>

        <a href="#users-menu" class="nav-header" data-toggle="collapse"><i class="icon-user"></i>Clientes<!-- <span class="label label-info">+3</span> --></a>
        <ul id="users-menu" class="nav nav-list collapse">
            <li><a href="<?php echo site_url().'adm/clientes/listar'; ?>">Listar</a></li>
            <li><a href="<?php echo site_url().'adm/clientes/cadastrar'; ?>">Cadastrar</a></li>
        </ul>

        <a href="#orders-menu" class="nav-header" data-toggle="collapse"><i class="icon-money"></i>Pedidos<!-- <span class="label label-info">+3</span> --></a>
        <ul id="orders-menu" class="nav nav-list collapse">
            <li><a href="<?php echo site_url().'adm/pedidos/listar'; ?>">Listar</a></li>
            <li><a href="<?php echo site_url().'adm/pedidos/cadastrar'; ?>">Criar</a></li>
        </ul>

        <a href="#products-menu" class="nav-header" data-toggle="collapse"><i class="icon-tag"></i>Produtos<!-- <span class="label label-info">+3</span> --></a>
        <ul id="products-menu" class="nav nav-list collapse">
            <li><a href="<?php echo site_url().'adm/produtos/listar'; ?>">Listar</a></li>
            <li><a href="<?php echo site_url().'adm/produtos/cadastrar'; ?>">Cadastrar</a></li>
        </ul>

        <a href="#options-menu" class="nav-header" data-toggle="collapse"><i class="icon-list"></i>Opcionais<!-- <span class="label label-info">+3</span> --></a>
        <ul id="options-menu" class="nav nav-list collapse">
            <li><a href="<?php echo site_url().'adm/opcionais/listar'; ?>">Listar</a></li>
            <li><a href="<?php echo site_url().'adm/opcionais/cadastrar'; ?>">Cadastrar</a></li>
        </ul>

        <a href="#filials-menu" class="nav-header" data-toggle="collapse"><i class="icon-home"></i>Filiais<!-- <span class="label label-info">+3</span> --></a>
        <ul id="filials-menu" class="nav nav-list collapse">
            <li><a href="<?php echo site_url().'adm/filiais/listar'; ?>">Listar</a></li>
            <li><a href="<?php echo site_url().'adm/filiais/cadastrar'; ?>">Cadastrar</a></li>
        </ul>

        <a href="#deliver-menu" class="nav-header" data-toggle="collapse"><i class="icon-road"></i>Entregadores<!-- <span class="label label-info">+3</span> --></a>
        <ul id="deliver-menu" class="nav nav-list collapse">
            <li><a href="<?php echo site_url().'adm/entregadores/listar'; ?>">Listar</a></li>
            <li><a href="<?php echo site_url().'adm/entregadores/cadastrar'; ?>">Cadastrar</a></li>
        </ul>

        <a href="help.html" class="nav-header" ><i class="icon-question-sign"></i>Ajuda</a>

    </div>

