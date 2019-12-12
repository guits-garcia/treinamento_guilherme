<?php
	get_header();
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
   
<?php
if ( isset ( $_POST['sendMail'])){
    require 'php_mailer/PHPMailerAutoload.php';
    include_once "dbc.inc.php";

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $pais = $_POST['pais'];
	$mensagem = $_POST['mensagem'];

/**daqui pra baixo salva os valores como post type mensagens no wordpress */
	$msg = array (
		'post_title'=> $nome,
		'post_content' => $mensagem,
		'post_type' => 'mensagens',
	);

	$msg_id = wp_insert_post($msg);

	//*** ver o porque essa função não funciona!!!! */
	add_post_meta($msg_id, 'telefone', $telefone);
	add_post_meta($msg_id, 'email', $email);
	add_post_meta($msg_id, 'cidade', $cidade);
	add_post_meta($msg_id, 'uf', $uf);
	add_post_meta($msg_id, 'pais', $pais);

	/*daqui pra baixo envia o email */
    $mail = new PHPMailer;


    //$mail->SMTPDebug = 2;
    //config do servidor
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'php.gui67@gmail.com'; //o email deve estar ativado, SE NÁO O GMAIL BLOQUEIA COMO TENTATIVA DE INICIO DE SESSÃO
    $mail->Password = 'flitphp19';
    $mail->SMTPSecure = 'tls'; //tipo de protocolo
    $mail->Port = 587;
    
    // Recipientes
    $mail->setFrom($_POST['email'], $_POST['nome']); //aqui vai o email que a pessoa colocar no form
    $mail->addAddress('guilherme@astrusweb.com', 'Guilherme AstrusWeb');     // Add a recipient, nome opcional, pode adicionar mais adresses
    $mail->addReplyTo($_POST['email'], $_POST['nome']); //aqui vai o email que a pessoa colocar no form
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    
    
    //conteúdo
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML
    
    
    
    $mail->Subject = 'Comentário de .' . $_POST['nome'];
    $mail->Subject = $_POST['assunto'];
    $mail->Body    = '<h2>Dados do usuário: </h2><br><p>Nome: ' . $nome . '</p><br><p>Telefone: ' . $telefone . '</p><br><p>E-mail: ' . $email . '</p><br><p>Cidade: ' . $cidade . '</p><br><p>Estado: ' . $uf . '</p><br><p>País: ' . $pais .'</h3><br><p> ' .    $_POST['mensagem'] . '</p>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    if(!$mail->send()) {
        //echo 'Message could not be sent.';
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
        echo 'Ocorreu um erro no processamento da mensagem. Entraremos em contato com você em até 7 dias através do email: ' . $_POST['email'];
    } 
}
?>




<section id="contato">
	<h1>OSTEA ALIQUANDO PERSECUTI VIX ADMUTAT</h1>
	<p>Lorem ipsum dolor sit amet, ius eu iudico prompta, omnes honestatis qui cu, ex per posse nobis.</p>

	<?php //if ( isset ($_POST['sendMail'])){
			// if (isset($_POST['g-recaptcha-response'])){
			// 	$captcha_data = $_POST['g-recaptcha-response'];
			// } if (!$captcha_data) {
			// 	echo "<h2>Por favor, confirme o captcha.</h2>";
			// } else {
			// 	$resposta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfCxcMUAAAAAEF4pbFxp4FUyL1nPtivnTKyKsAr&response=".$captcha_data."&remoteip=".$_SERVER['REMOTE_ADDR']);
			// 	if ($resposta.success) {
			// 		echo "<h2>Muito obrigado pelo feedback. Entraremos em contato através do e-mail: ". $email ."</h2>";
			// 	} else {
			// 		echo "Usuário mal intencionado detectado. A mensagem não foi enviada.";
			// 		exit;
			// 	}
			// 	echo "<h2>Muito obrigado pelo feedback. Entraremos em contato através do e-mail: ". $email ."</h2>";
	//}
 //}
  ?>
	<div class="mail-sender">
			<form action="<?php get_permalink(); ?>" method="POST" id="sendMailForm">
			<div class="form-wrapper">
					<div class="inputs_valores">
						<div class="organiza-label">
							<input class='inputs' type="text" name="nome" id="nome" placeholder="NOME">
							<label for="nome" generated="true" class="error"></label>
						</div>
						<div class="organiza-label">
							<input class='inputs' type="text" name="cpf_campo" id="cpf_campo" placeholder="CPF">
							<label for="cpf_campo" generated="true" class="error"></label>
						</div>
						<div class="organiza-label">
							<input class='inputs' type="tel" name="telefone" id="telefone" placeholder="TELEFONE">
							<label for="telefone" generated="true" class="error"></label>
						</div>
						<div class="organiza-label">
							<input class='inputs' type="email" name="email" id="email" placeholder="E-MAIL">
							<label for="email" generated="true" class="error"></label>
						</div>
						<div class="organiza-label">
							<input class='inputs' type="text" name="cidade" id="cidade" placeholder="CIDADE">
							<label for="cidade" generated="true" class="error"></label>
						</div>
						<div class="organiza-label">
							<div class="custom-select">
								<select name="uf" id="uf" value="ESTADO">
									<option value="AC">Acre</option>
									<option value="AL">Alagoas</option>
									<option value="AP">Amapá</option>
									<option value="AM">Amazonas</option>
									<option value="BA">Bahia</option>
									<option value="CE">Ceará</option>
									<option value="DF">Distrito Federal</option>
									<option value="ES">Espírito Santo</option>
									<option value="GO">Goiás</option>
									<option value="MA">Maranhão</option>
									<option value="MT">Mato Grosso</option>
									<option value="MS">Mato Grosso do Sul</option>
									<option value="MG">Minas Gerais</option>
									<option value="PA">Pará</option>
									<option value="PB">Paraíba</option>
									<option value="PR">Paraná</option>
									<option value="PE">Pernambuco</option>
									<option value="PI">Piauí</option>
									<option value="RJ">Rio de Janeiro</option>
									<option value="RN">Rio Grande do Norte</option>
									<option value="RS">Rio Grande do Sul</option>
									<option value="RO">Rondônia</option>
									<option value="RR">Roraima</option>
									<option value="SC">Santa Catarina</option>
									<option value="SP">São Paulo</option>
									<option value="SE">Sergipe</option>
									<option value="TO">Tocantins</option>
									<option value="" selected disabled hidden>ESTADO</option>
								</select>
							</div>	
							<label for="uf" generated="true" class="error"></label>
						</div>
						<div class="organiza-label">
							<div class="custom-select">
								<select name="pais" id="pais" class="select-css">
									<option value="argentina">Argentina</option>
									<option value="bolivia">Bolivia</option>
									<option value="brasil">Brasil</option>
									<option value="chile">Chile</option>
									<option value="colombia">Colombia</option>
									<option value="ecuador">Ecuador</option>
									<option value="guiana">Guiana</option>
									<option value="paraguai">Paraguai</option>
									<option value="peru">Peru</option>
									<option value="suriname">Suriname</option>
									<option value="uruguai">Uruguai</option>
									<option value="venezuela">Venezuela</option>
									<option value="" selected disabled hidden>PAÍS</option>
								</select>
							</div>
							<label for="pais" generated="true" class="error"></label>
						</div>
						<div class="organiza-label">
							<textarea rows="15" cols="30" name="mensagem" placeholder="MENSAGEM"></textarea>
							<label for="mensagem" generated="true" class="error"></label>
						</div>
						<div class="recaptcha-wrapper">
							<div class="g-recaptcha" data-sitekey="6LfCxcMUAAAAAFol9Ekxfmq2rHNlvR5zdhckYM_3"></div>
						</div>
						<input type="submit" name="sendMail" value="ENVIAR" class="enviar-btn">
					</div>
				</div>
			</form>
			
		</div>
		<!-- <section id="map">
			<div id="panel">
				<input type="text" placeholder="Digite seu endereço.." id="campo_endereco">
				<button id="btn_pesquisa_endereco">Traçar rota!</button>
				<p id="dist_e_time"></p>
				<div class="locations_info"></div>
			</div>
			<div id="mapContent"></div>
		</section> -->
		<div id="map"></div>

</section>


<?php
	get_footer();
?>