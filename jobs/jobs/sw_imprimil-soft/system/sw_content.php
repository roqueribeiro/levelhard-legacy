<?php

	//Inicia Sessão no Painel
	session_start();
	
	//Carrega Classes
	require "db_connect.php";
	require "sw_userinfo.php";
	$sw_userinfo = new sw_userinfo;
	
	//Verifica Nivel de Acesso
	if($sw_userinfo->sw_access()>0)
	{
		$sw_action 	= $_GET["sw_action"];
		
		$sw_content = new sw_content;
		
		switch($sw_action)
		{
			case "sw_panel":
			{
				$sw_content->sw_set('usr_name',$sw_userinfo->sw_username());
				$sw_content->sw_set('usr_login',$sw_userinfo->sw_login());
				$sw_content->sw_set('usr_access',$sw_userinfo->sw_access());
				
				print $sw_content->sw_panel();
			}
			break;
		}
	}
	else
	{
		header('location:sw_login.php');
	}

class sw_content
{
	private $usr_name;
	private $usr_login;
	private $usr_access;
	
	function sw_set($prop,$value)
	{//Metodo Seta Variavel da Classe
	 //Roque Ribeiro
	 //06-06-2012
	 
		$this->$prop=$value;
	}
	
	function sw_panel()
	{		
		$jquery = "
		$(document).ready(function(){
			
			$('#panel-control img.main-normal').css('opacity','0');
			$('#loader').animate({scale:[0],opacity:'0'},300,function(){
				$('#panel-control img.main-normal').animate({'opacity':'1'},600);		
				$(this).hide();	
			});
			
			$('#panel-control li, #panel-user li').click(function(){
				
				var url_param = $(this).attr('class') || $(this).attr('alt');
				
				if(url_param)
				{
					var url_param 	= url_param.split('|');
					var url_action 	= url_param[0]
					var url_size	= url_param[1].split('-');
					var url_size_x	= url_size[0]
					var url_size_y	= url_size[1]
					var url_type 	= url_param[2]
					var url_scroll 	= url_param[3]
											
					$.fancybox.open({
						href 		: url_action,
						type 		: url_type,
						width		: url_size_x,
						height		: url_size_y,
						fitToView	: false,
						margin		: 40,
						padding		: 0,
						scrolling	: url_scroll,
						helpers 	: {
							overlay : {
								opacity : '0'
							}
						},
					});
				}
				
			});
						
			$('#panel-control li').hover(function(){
				
				$('#title',this).stop().animate({'height':'35px'},300);
				$('#title p',this).stop().animate({'opacity':'1'},300);
				
				$('img.main-active',!this).stop().animate({'opacity':'1'},600);
				$('img.main-normal',!this).stop().animate({'opacity':'0.3'},600);
				
				$('img.main-active',this).stop().animate({'opacity':'0'},600);
				$('img.main-normal',this).stop().animate({'opacity':'1'},600);
				
			},function(){
				
				$('#title',this).stop().animate({'height':'0px'},300);
				$('#title p',this).stop().animate({'opacity':'0'},300);
				
				$('img.main-active',!this).stop().animate({'opacity':'0'},600);
				$('img.main-normal',!this).stop().animate({'opacity':'1'},600);
				
			});
			
			$('#panel-user img').hover(function(){
				$(this).stop().animate({backgroundColor:'#333'});
			},function(){
				$(this).stop().animate({backgroundColor:'#000'});
			});
			
			$('#panel-user img#logout').click(function(){
				
				$('#panel-control img.main-normal').hide();
				
				$.ajax({
					type		: 'POST',
					url			: 'system/sw_login.php',
					data		: { 'sw_action':'sw_logout' },
					error		: function(){ preWindow('icon-alert',1); },
					beforeSend	: function(){ $('#loader').show().animate({scale:[1],opacity:'1'},0); },
					success		: function(data){ if(!data) preWindow('icon-alert',1); else $('#false-body').html(data); }
				});
								
			});
			
		});
		";
		$html = '
		<script type="text/javascript">'.$jquery.'</script>
		<div id="panel-content">
			<div id="panel-control">
				<ul>				
					<li class="http://webdesktop.levelhard.com|100%-100%|iframe">
						<img class="main-active" src="themes/default/images/main-icon/configuracao-blur.png" alt="">
						<img class="main-normal" src="themes/default/images/main-icon/configuracao.png" alt="">
						<div id="title"><p>Configurações</p></div>
					</li>
					<li class="http://webdesktop.levelhard.com|100%-100%|iframe">
						<img class="main-active" src="themes/default/images/main-icon/estoque-blur.png" alt="">
						<img class="main-normal" src="themes/default/images/main-icon/estoque.png" alt="">
						<div id="title"><p>Estoque</p></div>
					</li>
					<li class="http://webdesktop.levelhard.com|100%-100%|iframe">
						<img class="main-active" src="themes/default/images/main-icon/fornecedor-blur.png" alt="">
						<img class="main-normal" src="themes/default/images/main-icon/fornecedor.png" alt="">
						<div id="title"><p>Fornecedores</p></div>
					</li>
					<li class="http://webdesktop.levelhard.com|100%-100%|iframe">
						<img class="main-active" src="themes/default/images/main-icon/orcamento-blur.png" alt="">
						<img class="main-normal" src="themes/default/images/main-icon/orcamento.png" alt="">
						<div id="title"><p>Orçamento</p></div>
					</li>
					<li class="http://webdesktop.levelhard.com|80-50|iframe">
						<img class="main-active" src="themes/default/images/main-icon/comunicacao-blur.png" alt="">
						<img class="main-normal" src="themes/default/images/main-icon/comunicacao.png" alt="">
						<div id="title"><p>Comunicação</p></div>
					</li>
				</ul>
			</div>
		</div>
		<div id="panel-user">
			<ul>
				<li class="">
					<img id="user" src="themes/default/images/user-icon/user_gray.png" alt="" width="32" height="32">
				</li>
				<li><span>'.$this->usr_name.'</span></li>
			</ul>
			<ul>
				<li class="">
					<img id="config" src="themes/default/images/icon-config.png" alt="" width="32" height="32">
				</li>
				<li class="http://imprimil.com/stats|120-60|iframe">
					<img id="stats" src="themes/default/images/icon-stats.png" alt="" width="32" height="32">
				</li>
				<li><img id="logout" src="themes/default/images/icon-exit.png" alt="" width="32" height="32"></li>
			</ul>
		</div>
		';
		
		return $html;
	}
}

?>