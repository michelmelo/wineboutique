<?php
namespace App\Nuvei;

$terminalId = '33001';
$secret = 'SandboxSecret001';
$receiptPageURL = 'https://misereo.serveo.net/nuvei_receipt_page.php';

function authRequestHash($orderId, $amount, $dateTime) {
	global $terminalId, $secret, $receiptPageURL, $validationURL;
	return md5($terminalId . $orderId . $amount . $dateTime . $receiptPageURL . $validationURL . $secret);
}
 
?>