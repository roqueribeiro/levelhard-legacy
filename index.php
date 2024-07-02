<!DOCTYPE HTML>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="robots" content="index,follow" />
  <meta name="revisit-after" content="5 days">
  <meta name="title" content="LevelHard Web Solutions">
  <meta name="author" content="Roque Ribeiro">
  <meta name="description" content="Portfólio com desenvolvimentos de sistemas, sites e estudos. Desde 2002 desenvolvendo com o que há de mais atual passando por diversas tecnologias, metodologias e conceitos." />
  <meta name="keywords" content="levelhard,pesquisa,tecnologia,internet,site,software,web,webdesign,design,html5,jquery,css3,php,php5,mysql,contato,desenvolvimento,vue,react,angular,js,less,saas,next,nuxt,vuex,redux,ssr">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
  <meta name="copyright" content="Roque Ribeiro" />
  <meta name="language" content="pt-br">
  <meta name="theme-color" content="#111111">
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <title>LevelHard Web Solutions</title>
  <!-- Favicon -->
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="styles/reset.css">
  <link rel="stylesheet" type="text/css" href="styles/default-html.css">
  <link rel="stylesheet" type="text/css" href="styles/default-theme.css">
  <link rel="stylesheet" type="text/css" href="scripts/jquery-ui-1.12.1/jquery-ui.theme.min.css">
  <link rel="stylesheet" type="text/css" href="styles/jquery.fancybox.css">
  <link rel="stylesheet" type="text/css" href="styles/jquery.mCustomScrollbar.css">
  <link rel="stylesheet" type="text/css" href="styles/box-slider.css">
  <!-- jQuery -->
  <script type="text/javascript" src="scripts/jquery-3.4.1.min.js"></script>
  <script type="text/javascript">
    jQuery.browser = {};
    (function() {
      jQuery.browser.msie = false;
      jQuery.browser.version = 0;
      if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
      }
    })();
  </script>
  <script type="text/javascript" src="scripts/jquery.fancybox.js"></script>
  <script type="text/javascript" src="scripts/jquery.transform-0.9.3.min.js"></script>
  <script type="text/javascript" src="scripts/jquery.animate-shadow-min.js"></script>
  <script type="text/javascript" src="scripts/jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="scripts/jquery.mCustomScrollbar.min.js"></script>
  <script type="text/javascript" src="scripts/jquery.mousewheel.min.js"></script>
  <script type="text/javascript" src="scripts/filters.min.js"></script>
  <script type="text/javascript" src="scripts/jquery.queryloader2.js"></script>
  <!-- Functions -->
  <script type="text/javascript">
    $(document).ready(function() {
      //Loader LevelHard QueryLoader2  
      $("#menu, #logo, #info, #foot, #portfolio").disableSelection();
      $('#menu, #foot, #social-face').css('opacity', '0');
      $('#logo img:nth-child(1)').css('opacity', '0');
      $("body").queryLoader2({
        barColor: "#DDD",
        percentage: true,
        barHeight: 1,
        completeAnimation: "grow",
        minimumTime: 100,
        onComplete: function() {
          $('#logo img:nth-child(1)').animate({
            'opacity': '1'
          }, 500);
          $('#logo img:nth-child(2)').animate({
            'opacity': '0'
          }, 600);
          $('#wrap').fadeOut(300, function() {
            $('#menu').animate({
              'left': '0px',
              'opacity': '1'
            }, 600, function() {
              $('ul[class!=submenu]', this).fadeIn(300, function() {
                $('#menu, #foot, #social-face').animate({
                  'opacity': '1'
                }, 600);
              });
            });
          });
        }
      });

      //Funções do Menu
      $('#menu li').hover(function() {
        $('p', this).stop().animate({
          'padding-left': '20px',
          'color': '#ED1C24'
        }, 300);
        $(this).stop().animate({
          backgroundColor: '#222'
        }, 300);
        $(this).find('ul').stop().show().animate({
          'width': '160px',
          'margin-left': '230px'
        }, 600, 'easeOutBack');
      }, function() {
        $('p', this).stop().animate({
          'padding-left': '0px',
          'color': '#FFF'
        }, 300);
        $(this).stop().animate({
          backgroundColor: '#000'
        }, 300);
        $(this).find('ul').stop().animate({
          'width': '0px'
        }, 300, function() {
          $(this).css('margin-left', '180px').hide();
        });
      });

      //Tela de Portfolio
      $('#portfolio #port-header, #portfolio #port-container, #portfolio #port-foot').hide();
      $('#menu li').click(function() {
        if ($(this).attr('class') == 'portifolio-site' || $(this).attr('class') == 'portifolio-soft') {
          $('#portfolio').animate({
            'bottom': '0%'
          }, 600);
          $('#container').fadeOut(600);
          $('#portfolio #port-loading').delay(600).fadeIn(300);
          $.get('core.php', {
            'action': $(this).attr('class')
          }, function(data) {
            $('#portfolio #port-container').html(data);
            $('#portfolio #port-header, #portfolio #port-foot').fadeIn(600);
            $('#portfolio #port-container').delay(900).fadeIn(600, function() {
              $('#portfolio #port-loading').fadeOut(300);
              //Ativa Scroll
              $("#port-container").mCustomScrollbar({
                scrollInertia: 1000,
                scrollEasing: "easeOutQuint",
                scrollButtons: {
                  enable: true
                },
                advanced: {
                  updateOnContentResize: true
                },
              });
              //Ativa Filtros de Sites
              $('.filters.demo3').filters({
                move: {
                  duration: 400
                },
                css3: {
                  init: false
                },
                fade: {
                  opacity: [0, 1],
                  duration: [600, 600]
                }
              });
              //Portfolio Lista Hover
              $('.filters .container ul li').hover(function() {
                if ($(this).css('opacity') == 1) {
                  $('div a', this).animate({
                    'opacity': '1'
                  }, {
                    queue: false,
                    duration: 300
                  });
                  $('div', this).animate({
                    'height': '95px',
                    'opacity': '1'
                  }, {
                    queue: false,
                    duration: 600
                  });
                  $('img', this).css({
                    'opacity': '1',
                    '-webkit-filter': 'grayscale(0%)'
                  });
                }
              }, function() {
                $('div', this).animate({
                  'height': '0px',
                  'opacity': '0'
                }, {
                  queue: false,
                  duration: 600
                });
                $('div a', this).animate({
                  'opacity': '0'
                }, {
                  queue: false,
                  duration: 300
                });
                $('img', this).css({
                  'opacity': '0.4',
                  '-webkit-filter': 'grayscale(100%)'
                });
              });
              //Portfolio Abre iFrame
              $('#portfolio #port-loader #port-iframe').hide();
              $('.filters .container ul li a').click(function() {
                url = $(this).attr('id');
                if (url) {
                  $('#portfolio #port-header, #portfolio #port-container, #portfolio #port-foot').fadeOut(600, function() {
                    $('#portfolio #port-loader').animate({
                      'left': '0%'
                    });
                  });
                  $('#portfolio #port-loader #port-iframe').html('<iframe src="' + url + '"></iframe>').delay(600).fadeIn(600);
                  $('#portfolio #port-loader #port-go').click(function() {
                    window.open(url);
                  });
                }
              });
              //Portfolio Sair
              $('#portfolio #port-logo #port-exit').click(function() {
                $('#portfolio #port-container').hide();
                $('#portfolio #port-header, #portfolio #port-foot').hide();
                $('#portfolio').animate({
                  'bottom': '100%'
                }, 600, function() {
                  $('#portfolio #port-container #port-all').remove();
                  $('#portfolio #port-logo #port-exit, #portfolio #port-loader #port-exit').unbind('click');
                });
                $('#container').fadeIn(600);
              });
              //Portfolio iFrame Sair
              $('#portfolio #port-loader #port-exit').click(function() {
                $('#portfolio #port-loader #port-iframe').hide();
                $('#portfolio #port-header, #portfolio #port-container, #portfolio #port-foot').fadeIn(600);
                $('#portfolio #port-loader').animate({
                  'left': '-100%'
                });
                $('#portfolio #port-loader #port-iframe iframe').remove();
                $('#portfolio #port-loader #port-go').unbind('click');
              });
            });
          });
        }
      });
      //Portfolio Sair Botao
      $('#portfolio #port-exit').hover(function() {
        $(this).animate({
          'top': '-30px'
        }, {
          queue: false,
          duration: 600
        });
      }, function() {
        $(this).animate({
          'top': '-50px'
        }, {
          queue: false,
          duration: 600
        });
      });

      //Executa Links do Menu
      $('#menu li, #social img').click(function() {
        let url_param = $(this).attr('class') || $(this).attr('alt');
        if (url_param) {
          url_param = url_param.split('|');
          const url_action = url_param[0]
          const url_size = url_param[1].split('-');
          const url_size_x = url_size[0]
          const url_size_y = url_size[1]
          const url_type = url_param[2]
          const url_scroll = url_param[3]
          if (url_param[1] == 'href') {
            window.open(url_param[0]);
          } else {
            $.fancybox.open({
              href: url_action,
              type: url_type,
              width: url_size_x,
              height: url_size_y,
              openEffect: 'elastic',
              openSpeed: 400,
              closeEffect: 'elastic',
              closeSpeed: 400,
              margin: 20,
              padding: 0,
              scrolling: url_scroll,
              helpers: {
                overlay: {
                  opacity: '1',
                  css: {
                    'background': 'url(images/close-wrap.png)'
                  }
                }
              },
              beforeLoad: function() {
                $('#logo img:nth-child(1)').animate({
                  'opacity': '0'
                }, 500);
                $('#logo img:nth-child(2)').animate({
                  'opacity': '1'
                }, 600);
                $('#menu, #foot, #social-face').animate({
                  'opacity': '0'
                }, 600);
              },
              beforeShow: function() {
                $('.fancybox-inner iframe, .fancybox-inner div').css('opacity', '0');
              },
              afterShow: function() {
                $('.fancybox-inner iframe, .fancybox-inner div').animate({
                  'opacity': '1'
                }, 600);
              },
              beforeClose: function() {
                $('.fancybox-inner iframe, .fancybox-inner div').css('opacity', '0');
              },
              afterClose: function() {
                $('#logo img:nth-child(1)').animate({
                  'opacity': '1'
                }, 500);
                $('#logo img:nth-child(2)').animate({
                  'opacity': '0'
                }, 600);
                $('#menu, #foot, #social-face').animate({
                  'opacity': '1'
                }, 600);
              },
              onCancel: function() {
                $('#logo img:nth-child(1)').animate({
                  'opacity': '1'
                }, 500);
                $('#logo img:nth-child(2)').animate({
                  'opacity': '0'
                }, 600);
                $('#menu, #foot, #social-face').animate({
                  'opacity': '1'
                }, 600);
              }
            });
          }
        }

      });

    });
  </script>
</head>

<body>
  <div id="loading"><img src="images/preloader-48.gif" alt=""></div>
  <div id="wrap" class="0"></div>
  <div id="ajax"></div>
  <div id="portfolio">
    <div id="port-loader">
      <div id="port-loader-cont">
        <div id="port-exit"><img src="images/close-port.png" alt=""></div>
        <div id="port-iframe"></div>
        <div id="port-go">Ver Completo</div>
      </div>
    </div>
    <div id="port-header">
      <div id="port-logo">
        <div id="port-img"></div>
        <div id="port-exit"><img src="images/close-port.png" alt=""></div>
        <div id="port-text">Portfolio de Desenvolvimentos</div>
      </div>
    </div>
    <div id="port-loading"><img src="images/loading-contato.gif" alt=""></div>
    <div id="port-container"></div>
    <div id="port-foot">
      <span>Portfólio com Desenvolvimentos LevelHard - Email: <a href="mailto:roque.ribeiro@levelhard.com.br">roque.ribeiro@levelhard.com.br</a></span>
    </div>
  </div>
  <div id="container">
    <div id="gradient"></div>
    <div id="logo">
      <img src="images/logo.png" alt="LevelHard Web Solutions">
      <img src="images/logo-blur.png" alt="LevelHard Web Solutions">
      <div id="logo-shadow"></div>
    </div>
    <div id="menu">
      <span>M E N U</span>
      <ul>
        <li>
          <p>Portfólio</p>
          <ul class="submenu">
            <li class="portifolio-site">Sites</li>
            <li class="portifolio-soft">Softwares</li>
            <li class="https://codepen.io/roqueribeiro|href">Estudos</li>
            <li class="http://jobs.levelhard.com.br|95%-95%|iframe">Histórico</li>
          </ul>
        </li>
        <li class="">
          <p>Parceiros</p>
          <ul class="submenu">
            <li class="http://mysolver.com.br|href">MySolver</li>
            <li class="http://Kdsystems.com.br|href">KD Systems</li>
            <li class="http://imprimil.com|href">Imprimil</li>
          </ul>
        </li>
        <li class="https://www.linkedin.com/in/roqueribeirosilva|href">
          <p>Contato</p>
        </li>
      </ul>
    </div>
    <div id="foot">
      <p>Portfólio com desenvolvimentos e estudos de tecnologias - Email: <a href="mailto:roque.ribeiro@levelhard.com.br">roque.ribeiro@levelhard.com.br</a></p>
    </div>
  </div>
</body>

</html>