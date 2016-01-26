<?php
require "../vendor/autoload.php";

$con = new PDO("mysql:host=localhost;dbname=deliver", "root", "") or print(mysql_error());
print "Conexão Efetuada com Sucesso!\n";

function sendMail($msg, $dataTpl, $data){
	$mail = new PHPMailer();
	echo "" .$msg. "\n";
	echo "" .$destinatario = $data['email'] . "\n";
	echo "" .$assunto = $dataTpl['subject'] . "\n";

	// Define o método de envio
	$mail->Mailer     = "smtp";
	// Define que a mensagem poderá ter formatação HTML
	$mail->IsHTML(true); //
	// Define que a codificação do conteúdo da mensagem será utf-8
	$mail->CharSet    = "utf-8";
	// Define que os emails enviadas utilizarão SMTP Seguro tls
	$mail->SMTPSecure = "tls";
	// Define que o Host que enviará a mensagem é o Gmail
	$mail->Host       = "smtp.gmail.com";
	//Define a porta utilizada pelo Gmail para o envio autenticado
	$mail->Port       = "587";                   
	// Deine que a mensagem utiliza método de envio autenticado
	$mail->SMTPAuth   = "true";
	// Define o usuário do gmail autenticado responsável pelo envio
	$mail->Username   = "username@gmail.com";
	// Define a senha deste usuário citado acima
	$mail->Password   = "password";
	// Defina o email e o nome que aparecerá como remetente no cabeçalho
	$mail->From       = "from@gmail.com";
	$mail->FromName   = "sender";
	// Define o destinatário que receberá a mensagem
	$auxDest = explode(',',$destinatario);
	echo "<pre>";
	print_r($auxDest);
	echo "</pre>";
	foreach($auxDest as $i => $valor){
		$mail->AddAddress($valor);
	}
	/*
	Define o email que receberá resposta desta
	mensagem, quando o destinatário responder
	*/
	// Assunto da mensagem
	$mail->Subject    = $assunto;
	// Toda a estrutura HTML e corpo da mensagem
	$mail->Body       = $msg;
	// Controle de erro ou sucesso no envio
	if (!$mail->Send()){
		echo "Erro de envio: " . $mail->ErrorInfo;
	}else{
		echo "Mensagem enviada com sucesso!";
	}
}

function parse_template($tpl, $data){
    $file = file_get_contents($tpl['path']);

    $regex = preg_replace('(<nome>)', $data['name'], $file);
    $regex = preg_replace('(<message>)', $tpl['message'], $regex);
    return $regex;
}

function get_template($con){
    $sql = "select * from template_email teem, messages mess where teem.messages_idmessage = mess.idmessage and mess.bl_active = 'S' and teem.bl_active = 'S' and teem.cd_template = 'BIRTHDAY'";
    $tpl = $con->prepare($sql);
    $tpl->execute();

    return $tpl->fetch(PDO::FETCH_ASSOC);
}

//Birthday
$sql = "select name, DATE_FORMAT(dt_birthday, '%d/%m/%Y') as dt_birthday, email from user where bl_active = 's'";
$retUser = $con->prepare($sql);
$retUser->execute();
$sysdate = date("d/m/Y");
echo $sysdate . "\n";
while($linha = $retUser->fetch(PDO::FETCH_ASSOC)){
    echo "dt_birthday:[" . $linha['dt_birthday'] . "]\n";
    $split = explode("/",$linha['dt_birthday']);
    if(date("d")==$split[0] && date("m")==$split[1]){
        echo "Happy Birthday name:[" . $linha['name'] . "]\n";                                               
		$dataTpl = get_template($con);
		echo "Template..:" . $dataTpl['path'] . "\n";
		$tplParsed = parse_template($dataTpl, $linha);
		sendMail($tplParsed, $dataTpl, $linha);
    }
}

