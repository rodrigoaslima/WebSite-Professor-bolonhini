<?php

//Pega os dados postados pelo formulário HTML e os coloca em variaveis

if (preg_match('/tempsite.ws$|professorbolonhini.com.br$|hospedagemdesites.ws$|websiteseguro.com$/', $_SERVER[HTTP_HOST])) {
//na linha acima inclua seu domínio.
$email_from='contato@professorbolonhini.com.br';	// Substitua essa linha pelo seu e-mail@seudominio
}else {
$email_from = "contato@" . $_SERVER[HTTP_HOST];         
//    Na linha acima estamos forçando que o remetente seja 'webmaster@'

// você pode alterar para que o remetente seja, por exemplo, 'contato@'.
}
 
if( PATH_SEPARATOR ==';'){ $quebra_linha="\r\n";
 
} elseif (PATH_SEPARATOR==':'){ $quebra_linha="\n";
 
} elseif ( PATH_SEPARATOR!=';' and PATH_SEPARATOR!=':' )  {echo ('Esse script não funcionará corretamente neste servidor, a função PATH_SEPARATOR não retornou o parâmetro esperado.');
}

//pego os dados enviados pelo formulário 
$nome = $_POST["nome"]; 
$email = $_POST["email"]; 
$mensagem = $_POST["mensagem"]; 
$assunto = 'MENSAGEM DO SITE DE: ' . $nome . '';
//formato o campo da mensagem 
$msg  = "$mensagem" .  "<br /><br /><br />";


$msg .= "$nome" . "<br />";
$msg .= "$email";

$mensagem = wordwrap( $msg, 70, "<br />", 1); 

//valido os emails 
$headers = "MIME-Version: 1.0" . $quebra_linha . ""; 
$headers .= "Content-type: text/html; charset=UTF-8" . $quebra_linha . ""; 
$headers .= "From: $email_from " . $quebra_linha . ""; 
$headers .= "Reply-To: $email " . $quebra_linha . ""; 
$headers .= "Return-Path: $email_from " . $quebra_linha . ""; 

mail($email_from,$assunto,$mensagem,$headers, "-r".$email_from); 
 
    echo "<script>location.href='../contato-enviado.html'</script>"; 
