<?php

require __DIR__ . '/vendor/autoload.php';

$mollie = new Mollie_API_Client;
$mollie->setApiKey('test_FUStfjwQV6sFp6PjPfC6tt3rppjKCC');

//control


// first payment
$payment = $mollie->payments->create(array(
    'locale' => 'en_US',//en_US de_AT de_CH de_DE fr_BE fr_FR nl_BE nl_NL
    'amount'      => 10.00,
    'description' => 'My first API payment',
    'redirectUrl' => 'https://webshop.example.org/order/12345/',
    'webhookUrl'  => 'https://webshop.example.org/mollie-webhook/',
));

// Echo pay ID
echo 'Pay ID for newly created payment obj: '. $payment->id. '<br>';
echo '<br>';

// sample for getting status of past payment object: tr_FSBkxJzfeaID
$past_pay_id= $payment->id;
$past_payment = $mollie->payments->get($past_pay_id);

echo 'Checking the status of '.$past_pay_id.' if paid: ';
if ($past_payment->isPaid())
{
    echo 'Payment received.';
}
else
{
  echo 'Not yet paid';
}
echo '<br>';
echo '<br>';

$payment1 = $mollie->payments->get($past_pay_id);

echo '<pre>';
echo json_encode($payment1, JSON_PRETTY_PRINT);
echo '</pre>';
echo '<script>console.log('.json_encode($payment1).')</script>';
