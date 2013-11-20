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
                        
                    </ul>
                    <a class="brand" href="index.html"><span class="first">Mercurio</span> <span class="second">Delivery	</span></a>
            </div>
        </div>

		<div class="row-fluid">
		    <div class="dialog">
		        <div class="block">
		            <p class="block-heading">Administração</p>
					<div class="block-body">
						<?php echo form_open(site_url().'adm/logar'); ?>
							
							<input type="hidden" name="uri" value="<?php echo $uri;?>" />
								
							<?php if( isset($erro) ){ ?>

								<div class="td">

									<label><p><?php echo $erro; ?></p></label>

								</div>

							<?php } ?>

								<label><?php echo form_error('email'); ?></label>
								<label>E-mail</label>
								<input type="text" name="email" alt='E-mail' class="input-text span12" value="<?php echo set_value('email'); ?>" />

								<label><?php echo form_error('senha'); ?></label>
								<label>Senha</label>
								<input type="password" name="senha" alt='Senha' class="input-text span12" />
							
								<input type="submit" class="btn btn-primary pull-right" value="Entrar" />

							    <label class="remember-me"><input type="checkbox"> Remember me</label>
	                			<div class="clearfix"></div>

						</form>
		        	</div>
					
		        </div>
		    	<p class="pull-right" style=""><a href="http://www.portnine.com" target="blank">Theme by Portnine</a></p>
		    	<p><a href="reset-password.html">Forgot your password?</a></p>
			</div>
		</div>

