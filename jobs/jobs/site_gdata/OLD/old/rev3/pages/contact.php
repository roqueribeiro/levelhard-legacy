<div id="gdata-transit">
    <script type="text/javascript" src="//cdn.sublimevideo.net/js/9upsewll.js"></script>
    <div id="gdata-carousel" class="carousel slide nocarousel" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <div class="img" style="background-image: url('img/contact/bg_contact.jpg');" alt="First slide"></div>
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Global Data Contato</h1>
                        <p>Entre em contato para tirar dúvidas, orçamentos etc.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container marketing">
        <div class="page-header">
            <h1>Global Data <small>Soluções em Internet e Consultoria</small></h1>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <form name="contato" action="core.php?action=sendmail" class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nome</label>
                        <div class="col-sm-9">
                            <input type="text" name="nome" class="form-control" placeholder="Nome Completo" maxlength="150">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Telefone</label>
                        <div class="col-sm-9">
                            <input type="text" name="telefone" class="form-control" placeholder="(99) 9999-9999">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Celular</label>
                        <div class="col-sm-9">
                            <input type="text" name="celular" class="form-control" placeholder="(99) 99999-9999">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-Mail</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" placeholder="nome@email.com.br" maxlength="150">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">O que deseja?</label>
                        <div class="col-sm-9">
                            <textarea name="texto" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-default">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-5">
                <address>
                    <strong>Global Data Solucôes de Internet</strong><br>
                    Rua Cel. Lucio Seabra nº 483<br />
                    Centro, Cep: 18270-240<br />
                    Tatuí - SP<br />
                    <abbr title="Telefone Comercial">Tel.:</abbr>
                    (15) 3259-1247
                </address>
                <address>
                    <strong>Email para contato</strong><br>
                    <a href="mailto:gdata@gdata.com.br">gdata@gdata.com.br</a>
                </address>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3663.0533073156457!2d-47.85061569999997!3d-23.3500832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c5d92f331c68e5%3A0x2f82d5778b9ba35c!2sRua+Coronel+L%C3%BAcio+Seabra%2C+483+-+Centro!5e0!3m2!1spt-BR!2s!4v1400899815628" width="400" height="300" frameborder="0" style="border: 0"></iframe>
            </div>
        </div>
        <hr class="featurette-divider">
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $('input[name=telefone]').mask('(99) 9999-9999', { placeholder: '' });
        $('input[name=celular]').mask('(99) 99999-999?9', { placeholder: '' });

        $('form[name=contato]').ajaxForm({
            beforeSubmit: function () {
                if ($('input[name=nome]').val() == '') {
                    $('input[name=nome]').focus();
                    $('.notification').jnotifyAddMessage({
                        text: 'Digite seu nome completo',
                        type: 'info'
                    });
                    return false;
                }
                else if ($('input[name=nome]').val().length < 3) {
                    $('input[name=nome]').focus();
                    $('.notification').jnotifyAddMessage({
                        text: 'Seu nome tem que possuir mais que três caracteres',
                        type: 'info'
                    });
                    return false;
                }
                else if ($('input[name=telefone]').val() == '') {
                    $('input[name=telefone]').focus();
                    $('.notification').jnotifyAddMessage({
                        text: 'Digite seu telefone para contato',
                        type: 'info'
                    });
                    return false;
                }
                else if ($('input[name=email]').val() == '') {
                    $('input[name=email]').focus();
                    $('.notification').jnotifyAddMessage({
                        text: 'Digite seu email para contato',
                        type: 'info'
                    });
                    return false;
                }
                else if ($('input[name=email]').val().length < 3) {
                    $('input[name=email]').focus();
                    $('.notification').jnotifyAddMessage({
                        text: 'Digite seu email tem que possuir mais que três caracteres',
                        type: 'info'
                    });
                    return false;
                }
                else if ($('textarea[name=texto]').val() == '') {
                    $('textarea[name=texto]').focus();
                    $('.notification').jnotifyAddMessage({
                        text: 'Digite o texto que deseja nos mandar',
                        type: 'info'
                    });
                    return false;
                }
                else if ($('textarea[name=texto]').val().length < 20) {
                    $('textarea[name=texto]').focus();
                    $('.notification').jnotifyAddMessage({
                        text: 'Seu texto tem que possuir mais que vinte caracteres',
                        type: 'info'
                    });
                    return false;
                }
            },
            success: function () {
                $('.notification').jnotifyAddMessage({
                    text: 'Sua mensagem foi encaminhada com sucesso! Obrigado pelo contato, retornaremos o mais breve possível.',
                    type: 'error'
                });
            },
            error: function () {
                $('.notification').jnotifyAddMessage({
                    text: 'Ocorreu um erro ao encaminhar o formulário! Tente novamente mais tarde.',
                    type: 'error'
                });
            }
        });

    });
</script>
