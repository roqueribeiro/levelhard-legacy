<script type="text/javascript" src="sistema/tela_sistema.js"></script>
<div id="sistema_bg">
    <div id="sistema_bg_new" />
    <div id="sistema_bg_default" />
</div>
<!-- Tela Inicial - WebDesk -->
<div id="tela_inicial">
    <div id="navegacao">
        <!-- Menu Superior em Linha -->
        <div id="info">
            <ul id="admin" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_admin"]; ?>','conteudo/admin','1000px','625px',1,1);">
                <li><img src="imagens/icones/windows/businessman_w.png"></li>
                <li>
                    <p><?php print $_SESSION["nome"]; ?></p>
                </li>
            </ul>
            <ul id="botao_aplicativos">
                <li><img src="imagens/icones/windows/download_w.png"></li>
                <li>
                    <p><?php print $linguagem["sis_menu_aplicativos"]; ?></p>
                    <div class="submenu">
                        <ul id="agenda" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_agenda"]; ?>','conteudo/agenda','930px','625px',1,0);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_agenda"]; ?></p>
                            </li>
                        </ul>
                        <ul id="postit" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_postit"]; ?>','http://modernpostit.levelhard.com.br','960px','640px',1,1);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_postit"]; ?></p>
                            </li>
                        </ul>
                        <ul id="editor" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_editor"]; ?>','conteudo/editor','640px','480px',1,1);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_editor"]; ?></p>
                            </li>
                        </ul>
                        <ul id="escritor" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_escritor"]; ?>','conteudo/escritor/?usuario=<?php print $_SESSION["usuario"]; ?>','640px','480px',1,1);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_escritor"]; ?></p>
                            </li>
                        </ul>
                        <ul id="calculadora" onClick="windowOpen(0,$(this).attr('id'),'<?php print $linguagem["sis_menu_calculadora"]; ?>','conteudo/calculadora','280px','410px',1,0);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_calculadora"]; ?></p>
                            </li>
                        </ul>
                        <ul id="desenho" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_desenho"]; ?>','conteudo/desenho','680px','450px',1,0);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_desenho"]; ?></p>
                            </li>
                        </ul>
                        <ul id="navegador" onClick="windowOpen(0,$(this).attr('id'),'<?php print $linguagem["sis_menu_navegador"]; ?>','conteudo/navegador','800px','480px',1,1);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_navegador"]; ?></p>
                            </li>
                        </ul>
                        <ul id="diretorio" onClick="windowOpen(0,$(this).attr('id'),'<?php print $linguagem["sis_menu_diretorio"]; ?>','conteudo/diretorio/?usuario=<?php print $_SESSION["usuario"]; ?>','640px','480px',1,1);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_diretorio"]; ?></p>
                            </li>
                        </ul>
                        <ul id="tocador" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_tocador"]; ?>','conteudo/tocador','800px','580px',1,1);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_tocador"]; ?></p>
                            </li>
                        </ul>
                        <ul id="clinica" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_clinica"]; ?>','https://webclin.iwantproject.com.br','960px','720px',1,1);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_clinica"]; ?></p>
                            </li>
                        </ul>
                        <ul>
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_jogos"]; ?></p>
                                <div class="submenu">
                                    <ul id="rubik" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_jogos_rubik"]; ?>','https://rubik.chatao.com.br','1000px','800px',1,1);">
                                        <li><img src="imagens/icones/windows/right_w.png"></li>
                                        <li>
                                            <p><?php print $linguagem["sis_menu_jogos_rubik"]; ?></p>
                                        </li>
                                    </ul>
                                    <ul id="jbarata" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_jogos_jbarata"]; ?>','conteudo/jogos/jbarata','600px','600px',1,1);">
                                        <li><img src="imagens/icones/windows/right_w.png"></li>
                                        <li>
                                            <p><?php print $linguagem["sis_menu_jogos_jbarata"]; ?></p>
                                        </li>
                                    </ul>
                                    <ul id="fpscss" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_jogos_fpscss"]; ?>','https://keithclark.co.uk/labs/css-fps/','1000px','800px',1,1);">
                                        <li><img src="imagens/icones/windows/right_w.png"></li>
                                        <li>
                                            <p><?php print $linguagem["sis_menu_jogos_fpscss"]; ?></p>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <ul id="portfolio" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_portfolio"]; ?>','http://jobs.levelhard.com.br','960px','720px',1,1);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_portfolio"]; ?></p>
                            </li>
                        </ul>
                        <ul id="codepen" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_codepen"]; ?>','https://codepen.io/roqueribeiro','1280px','720px',1,1);">
                            <li><img src="imagens/icones/windows/right_w.png"></li>
                            <li>
                                <p><?php print $linguagem["sis_menu_codepen"]; ?></p>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul id="mensagem" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_mensagens"]; ?>','conteudo/mensagem/?snd_cod=<?php print $_SESSION["codigo"]; ?>','335px','455px',1,0);">
                <li><img src="imagens/icones/windows/message_w.png"></li>
                <li>
                    <p><?php print $linguagem["sis_menu_mensagens"]; ?></p>
                </li>
            </ul>
            <ul id="chatao" onClick="windowOpen(1,$(this).attr('id'),'<?php print $linguagem["sis_menu_chatao"]; ?>','https://chatao.com.br','480px','720px',1,1);">
                <li><img src="imagens/icones/ubuntu/communicate.png"></li>
                <li>
                    <p><?php print $linguagem["sis_menu_chatao"]; ?></p>
                </li>
            </ul>
            <ul id="botao_sair">
                <li>
                    <p><?php print $linguagem["sis_menu_sair"]; ?></p>
                </li>
                <li><img src="imagens/icones/windows/delete_w.png"></li>
            </ul>
            <ul id="botao_relogio">
                <li><img src="imagens/icones/windows/watch_w.png"></li>
                <li>
                    <p></p>
                </li>
            </ul>
            <ul id="botao_full" onclick="$(document).toggleFullScreen();" title="Visualização em Tela Cheia">
                <li><img src="imagens/icones/windows/monitor_w.png"></li>
            </ul>
        </div>
        <!-- Menu Superior Icones -->
        <div id="menu">
            <ul>
                <li id="admin" onClick="$('#info #admin').click();" title="<?php print $linguagem["sis_menu_amin"]; ?>">
                    <img src="imagens/icones/ubuntu/manager.png" alt="">
                </li>
                <li id="diretorio" onClick="$('#info #diretorio').click();" title="<?php print $linguagem["sis_menu_diretorio"]; ?>">
                    <img src="imagens/icones/ubuntu/kfm.png" alt="">
                </li>
                <li id="desenho" onClick="$('#info #desenho').click();" title="<?php print $linguagem["sis_menu_desenho"]; ?>">
                    <img src="imagens/icones/ubuntu/looknfeel.png" alt="">
                </li>
                <li id="navegador" onClick="$('#info #navegador').click();" title="<?php print $linguagem["sis_menu_navegador"]; ?>">
                    <img src="imagens/icones/ubuntu/globe.png" alt="">
                </li>
                <li id="tocador" onClick="$('#info #tocador').click();" title="<?php print $linguagem["sis_menu_tocador"]; ?>">
                    <img src="imagens/icones/ubuntu/multimedia.png" alt="">
                </li>
                <li id="agenda" onClick="$('#info #agenda').click();" title="<?php print $linguagem["sis_menu_agenda"]; ?>">
                    <img src="imagens/icones/ubuntu/phone.png" alt="">
                </li>
                <li id="calculadora" onClick="$('#info #calculadora').click();" title="<?php print $linguagem["sis_menu_calculadora"]; ?>">
                    <img src="imagens/icones/ubuntu/business.png" alt="">
                </li>
                <li id="editor" onClick="$('#info #editor').click();" title="<?php print $linguagem["sis_menu_editor"]; ?>">
                    <img src="imagens/icones/ubuntu/keyboard.png" alt="">
                </li>
                <li id="escritor" onClick="$('#info #escritor').click();" title="<?php print $linguagem["sis_menu_escritor"]; ?>">
                    <img src="imagens/icones/ubuntu/kedit.png" alt="">
                </li>
                <li id="jbarata" onClick="$('#info #jbarata').click();" title="<?php print $linguagem["sis_menu_jogos_jbarata"]; ?>">
                    <img src="conteudo/jogos/jbarata/images/error.png" alt="">
                </li>
                <li id="mensagem" onClick="$('#info #mensagem').click();" title="<?php print $linguagem["sis_menu_mensagens"]; ?>">
                    <img src="imagens/icones/ubuntu/communicate.png" alt="">
                </li>
            </ul>
        </div>
    </div>
    <!-- Conteudo -->
    <div id="conteudo" class="conteudo-1">
        <!-- Plugin Previsão do Tempo -->
        <div id="weather"></div>
        <!-- Listagem de Icones -->
        <div id="icones">
            <ul>
                <li id="navegador" onClick="$('#info #navegador').click();">
                    <img src="imagens/icones/ubuntu/globe.png">
                    <p><?php print $linguagem["sis_menu_navegador"]; ?></p>
                </li>
                <li id="mensagem" onClick="$('#info #chatao').click();">
                    <img src="imagens/icones/ubuntu/communicate.png">
                    <p><?php print $linguagem["sis_menu_chatao"]; ?></p>
                </li>
                <li id="diretorio" onClick="windowOpen(0,$(this).attr('id'),'<?php print $linguagem["sis_menu_diretorio"]; ?>','conteudo/diretorio/?usuario=<?php print $_SESSION["usuario"]; ?>','640px','480px',1,1);">
                    <img src="imagens/icones/ubuntu/kfm.png">
                    <p><?php print $linguagem["sis_menu_diretorio"]; ?></p>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Plugin Relogio de Parede -->
<div id="wallclock"></div>
<!-- Droppable -->
<div id="drop">
    <ul></ul>
</div>
<!-- MultiDesktop -->
<div id="multi-desk">
    <section class="cube-container">
        <div id="cube">
            <figure class="front">1</figure>
            <figure class="back">2</figure>
            <figure class="right">3</figure>
            <figure class="left">4</figure>
            <figure class="top">5</figure>
            <figure class="bottom">6</figure>
        </div>
    </section>
    <section class="cube-nav">
        <div id="show-front">1</div>
        <div id="show-back">2</div>
        <div id="show-right">3</div>
        <div id="show-left">4</div>
        <div id="show-top">5</div>
        <div id="show-bottom">6</div>
    </section>
</div>