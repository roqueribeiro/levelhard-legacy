<?php

// Passando os dados obtidos pelo formuláo para as variáis abaixo
$quebra_linha = "\n";
$emailsender='contato@imprimil.com';
$nomeremetente     = "Contato Site";
$emailremetente    = "contato@imprimil.com";
$emaildestinatario = "contato@imprimil.com";
$comcopia          = "";
$comcopiaoculta    = "";
$assunto           = "Contato Website";


$name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
$phone = trim($_POST["phone"]);
$message = trim($_POST["message"]);
        
if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($phone) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
    http_response_code(400);
    echo "Please complete the form and try again.";
    exit;
    }

 # Mail Content
$content = "MIME-Version: 1.1".$quebra_linha;
$content .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
$content = "Nome: $name\n";
$content .= "Email: $email\n\n";
$content .= "Telefone: $phone\n";
$content .= "Mensagem:\n$message\n";

# email headers.
//$headers = "From: $name &lt;$email&gt;";
$headers = "From: website";

$success = mail($emaildestinatario, $assunto, $content, $headers, "-r".$emailsender);
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "<script>alert('Email enviado com Sucesso!');\n";
            echo "javascript:window.location='../index.html';\n</script>";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong, we couldn't send your message.";
        }
?>