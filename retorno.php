<?php
session_start();

require_once 'vendor/autoload.php';

$apicontext = new PPApiContext(array('mode' => 'sandbox'));
$params = array(
	'client_id'     => 'AZcMTxD6dnqzG_1dugMHqjhhL8fQVUZ-YY11ZyU_MS8f5eltTZGoSskwUToB',
	'client_secret' => 'EJ97MRD1hLoHkAn2GnAEbd0bug-tS7dsZrfqcZIo2cE57tEb-u5IhaE-i04J',
	'code' => $_GET["code"]
);

try {
    $token = PPOpenIdTokeninfo::createFromAuthorizationCode($params,$apicontext); 
} catch (PPConnectionException $pce) {
    // Don't spit out errors or use "exit" like this in production code
    echo '<pre>';print_r(json_decode($pce->getData()));exit;
}

//print_r($token);
//echo "<hr>" . $token->{'access_token'};
//echo "<hr>" . $token->access_token;

$params = array('access_token' => $token->access_token);

$user = PPOpenIdUserinfo::getUserinfo($params,$apicontext);

$_SESSION["usuario"] = $user;
?>
<script>
    window.top.location.href = 'http://ppbrasil.jelasticlw.com.br/resultado.php';
    window.close();
</script>
