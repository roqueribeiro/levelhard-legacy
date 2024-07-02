<script type="text/javascript" src="sistema/tela_login.js"></script>
<!-- Tela de Login - Formulario -->
<div id="tela_login">
    <div id="logo">
        <p><?php print $linguagem["sis_nome"]; ?></p>
        <span><?php print $linguagem["sis_ver"]; ?></span>
    </div>
    <div id="cobertor_login"></div>
    <div id="login_menu">
        <div id="ativa"><?php print $linguagem["sis_login_titulo"]; ?></div>
        <div id="autentica">
            <form name="autentica">
                <ul>
                    <li class="titulo">
                        <p><?php print $linguagem["sis_login_f_titulo"]; ?></p>
                    </li>
                    <li>
                        <input type="text" name="usuario" maxlength="155" placeholder="<?php print $linguagem["sis_login_f_usuario"]; ?>">
                    </li>
                    <li>
                        <input type="password" name="senha" maxlength="20" placeholder="<?php print $linguagem["sis_login_f_senha"]; ?>">
                    </li>
                    <li>
                        <input type="submit" value="<?php print $linguagem["sis_login_f_entrar"]; ?>">
                    </li>
                </ul>
            </form>
        </div>
        <hr>
        <div id="cadastro">
            <form name="cadastro">
                <ul>
                    <li class="titulo">
                        <p><?php print $linguagem["sis_login_f_cadastrese"]; ?></p>
                    </li>
                    <li>
                        <input type="text" name="usr_nome" maxlength="55" placeholder="<?php print $linguagem["sis_login_f_n_nome"]; ?>" title="Este será o seu nome real no WebDesk. <br /> Máximo de 55 caracteres.">
                    </li>
                    <li>
                        <input type="text" name="usr_usuario" maxlength="20" placeholder="<?php print $linguagem["sis_login_f_n_usuario"]; ?>" title="Este é o apelido que você usará para entrar. <br /> Mínimo de 6 caracteres. <br /> Máximo de 12 caracteres.">
                    </li>
                    <li>
                        <input type="password" name="usr_senha" maxlength="8" placeholder="<?php print $linguagem["sis_login_f_n_senha"]; ?>" title="Esta é sua senha, digite corretamente. <br /> Mínimo de 6 caracteres.  <br /> Máximo de 8 caracteres.">
                    </li>
                    <li>
                        <input type="password" name="usr_senha_ver" maxlength="8" placeholder="<?php print $linguagem["sis_login_f_n_senha_ver"]; ?>" title="Validação da senha digitada no campo anterior.">
                    </li>
                    <li>
                        <input type="text" name="usr_email" maxlength="255" placeholder="<?php print $linguagem["sis_login_f_n_email"]; ?>" title="Email para recuperação de senhas e notificações do WebDesk.">
                    </li>
                    <li>
                        <input type="submit" value="<?php print $linguagem["sis_login_f_n_cadastrar"]; ?>">
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
