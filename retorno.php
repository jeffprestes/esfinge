<?php

require_once 'lib/PPConfigManager.php';
require_once 'lib/common/PPApiContext.php';
require_once 'lib/common/PPReflectionUtil.php';
require_once 'lib/common/PPArrayUtil.php';
require_once 'lib/common/PPModel.php';
require_once 'lib/PPLoggingManager.php';
require_once 'lib/exceptions/PPConnectionException.php';
require_once 'lib/PPHttpConfig.php';
require_once 'lib/PPHttpConnection.php';
require_once 'lib/PPConstants.php';
require_once 'lib/common/PPUserAgent.php';
require_once 'lib/transport/PPRestCall.php';
require_once 'lib/handlers/IPPHandler.php';
require_once 'lib/handlers/PPOpenIdHandler.php';
require_once 'lib/auth/openid/PPOpenIdTokeninfo.php';
require_once 'lib/auth/openid/PPOpenIdAddress.php';
require_once 'lib/auth/openid/PPOpenIdUserinfo.php';



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

print_r($user);

var_dump($user);

