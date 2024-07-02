<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>VotoFix - Software VTX</title>
<link rel="icon" href="../favicon.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="../styles/template-default-all.css">
<link rel="stylesheet" type="text/css" href="../styles/template-information.css">
<link rel="stylesheet" type="text/css" href="../scripts/fancybox/jquery.fancybox-1.3.4.css">
<link rel="stylesheet" type="text/css" href="../scripts/jcarousel/votofix/skin.css">
<script type="text/javascript" src="../scripts/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="../scripts/jquery.form.js"></script>
<script type="text/javascript" src="../scripts/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="../scripts/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="../scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="../scripts/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="../scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript">
$(document).ready(function(){
			
	$('a#fancyLoad').fancybox({
		'padding'			: '0',
		'margin'			: '50',
		'titlePosition'		: 'over',
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'transitionIn'		: 'elastic',
		'transitionOut'		: 'elastic',
		'easingIn'      	: 'easeOutBack',
		'easingOut'     	: 'easeInBack',
		'overlayColor'		: '#000',
		'overlayOpacity'	: '0.0'
	});
	
	$('#jcarousel').jcarousel({ 
		visible:1,
		scroll:1,
	});
	
	$('#corpo').disableSelection();
	
	$('.informacoes a').click(function(){
	
		if($('p',this).css('display') == 'block')
		{
			$('p',this).slideUp(300);
		}
		else
		{
			$('p',this).slideDown(300);
		}
		
	});
	
});
</script>
</head>

<body>
<div id="download"></div>
<div id="corpo">
	<div id="cabecalho">
    	<a href="../"><div id="logo"></div></a>
        <div id="slogan">Você sempre perto de seus eleitores</div>
    </div>
    <div id="conteudo">
    	<div id="comprar"></div>
        <div id="texto">
        <ul class="cabecalho">
        	<li><h1>VTX</h1></li>
            <li><b>O software que gerencia todo o atendimento de seu gabinete</b></li>
        </ul>
        <ul class="marcador">
            <li>Gerencia de forma ágil e eficaz todas as ações prestadas aos eleitores</li>
            <li>Suporte a toda sua equipe com vários tipos de alertas a cada duas horas de compromissos pendentes na data.</li>
            <li>Todo o trabalho de seu mandato registrado para o melhor aproveitamento em sua próxima campanha.</li>
        </ul>
        <ul class="download">
        	<li><a id="fancyLoad" href="core.php?action=vtx_form">Baixar Versão de Demonstração</a></li>
        </ul>
        <ul class="informacoes">
            <li><b>Características</b></li>
            <li>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Classificação de Pessoas;
                    	<p>A Classificação tem como objetivo permitir a inclusão, alteração e exclusão das classificações que poderão ser utilizadas para as pessoas.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Módulo de Alerta para Aniversariantes;
                    	<p>O Módulo de Alerta para Aniversariantes tem como objetivo apresentar uma alerta na tela principal do sistema, informando, diariamente se há alguma pessoa, cadastrada no sistema, que está realizando aniversário.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Relatório de Aniversariantes;
                    	<p>Relatório de Aniversariantes. O Sistema deverá permitir a geração de um relatório de aniversariantes dos próximos 10 dias na abertura do programa e em modulo de acordo como o período inicial e final, informado.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Impressão de Etiquetas de Clientes;
                    	<p>O Sistema permite a geração de um relatório em formato de etiquetas com os clientes em varias modalidades. Ex: Aniversariantes, bairro, cidade, rua.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Geração de Arquivo para Mala Direta;
                    	<p>O Sistema permite a geração de um arquivo em formato que possa ser utilizado para a geração de uma mala direta para os clientes selecionados, a critério do usuários conforme os dados cadastrados.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Manutenção de Serviços;
                    	<p>O Sistema permite a inclusão de novas solicitações, atualização dos dados cadastrados, porem exclusões e finalizações somente com senha do administrador.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Gerenciamento de Solicitações de Serviços;
                    	<p>O Sistema permite acesso aos dados de solicitações e serviços com as informações armazenados pelo sistema que poderá ser buscada por: Código, Serviço, Data da Solicitação, Data da Finalização, Cliente;</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Controle de Status das Solicitações- Abertura, Andamento e Conclusão;
                    	<p>O Sistema permite o gerenciamento das solicitações, através dos registros de seu andamento e alertando sempre que necessário, para que o solicitação não seja esquecida.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Histórico de ações tomadas, referente ao andamento da solicitação;
                    	<p>A cada ação tomada, referente a solicitação de um cliente, o sistema deverá permitir seu registro na solicitação que o gerou. Este histórico tem o objetivo de auxiliar no controle andamento e registro das ações tomadas para determinado problema.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Gerenciamento de Status;
                    	<p>O Sistema permite a inclusão, alteração e exclusão dos dados do status, que poderá gerar relatórios com os resultados das solicitações.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Gerenciamento da Agenda de Usuários;
                    	<p>O Sistema deverá permitir a inclusão, alteração e exclusão dos compromissos. Podendo gerar relatório impresso com períodos, semanais, mensais e personalizado.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Agenda de Telefones com consulta pelo numero;
                    	<p>O Sistema permite consultar o cadastro do solicitante pelo numero do telefone cadastrado perfeito para o melhor atendimento por quando por telefone.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Relatório de Compromissos da Agenda, parametrizado por data;
                    	<p>Parametrizado por data, o Sistema permite a geração de um relatório com os compromissos cadastrados, este deverá ser parametrizada por um período inicial e final ou ainda semanal ou mensal.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Módulo de Alerta de Compromissos da Agenda;
                    	<p>O Sistema deverá emitir um alerta diário, para os compromissos da agenda.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Relatório de Solicitações prestadas por bairro e status;
                    	<p>O Sistema permite a geração de um relatório das solicitações criadas, por bairro, finalizadas e pendentes.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Módulo Gerenciador de Acesso;
                    	<p>O Sistema permite a inclusão de usuários, sendo um usuário administrador, o qual possui acesso total, e os outros com acessos simples.</p></a>
                    </li>
                </ul>
            	<ul class="marcador">
                	<li><a href="javascript:void(0);">Conclusão de Solicitações e exclusões somente por usuário administrador.
                    	<p>O Sistema somente permite a baixa das solicitações e exclusão de cadastros apenas pelo usuário administrador.</p></a>
                    </li>
                </ul>
            </li>
        </ul>
        </div>
        <div id="galeria">
       	<ul id="jcarousel" class="jcarousel-skin-votofix">
        	<li><a id="fancyLoad" href="../images/galeria/imagem0001max.jpg"><img src="../images/galeria/imagem0001min.jpg" alt=""></a></li>
            <li><a id="fancyLoad" href="../images/galeria/imagem0002max.jpg"><img src="../images/galeria/imagem0002min.jpg" alt=""></a></li>
            <li><a id="fancyLoad" href="../images/galeria/imagem0003max.jpg"><img src="../images/galeria/imagem0003min.jpg" alt=""></a></li>
        </ul>
        </div>
        <div id="rodape">Desenvolvido por Roque Ribeiro. <a href="http://www.webrocky.com.br">WebRoCkY.com.br</a></div>
    </div>
</div>

</body>
</html>
