## Paddle.com API Client PHP library

This library provides convenient way of querying [UCS cards](https://ucscards.ru) API from php code.

## Requirements

PHP 7.2 or later.

## Installation via Composer

```sh
composer require itelmenko/php-ucscards-client
```

## Usage

### Register a payment

```php

$settings = [
    'shop_id' => 111111, // Your shop's ID
    'soap' => [
        'login' => 'your-login',
        'password' => 'your-password',
        'location' => 'https://tws.egopay.ru/',
        'uri' => 'http://yourdomain.com',
        'trace'    => 1,
        'features' => SOAP_SINGLE_ELEMENT_ARRAYS,
        'connection_timeout' => 12
    ]
];

$soapClient = new \UcsCards\Client(null, $settings['soap']);

$order = new \UcsCards\Order\OrderId();
$order->shop_id = $settings['shop_id'];
$order->number = 2323443; // Your shop's order ID

$cost = new \UcsCards\Cost();
$cost->amount = 345.67; // Order price
$cost->currency = 'RUB';

$customer = new \UcsCards\Customer();
$customer->id = 'Customer01'; // Customer's ID
$customer->email = 'customer01@gmail.com'; // Customer's email

$description = new \UcsCards\Order\OrderDescription();
$description->paytype = 'card';

$postData = new \UcsCards\PostData\PostData();
$returnUrlOk = new \UcsCards\PostData\PostEntry();
$returnUrlOk->name = \UcsCards\PostData\PostEntry::ENTRY_NAME_RETURN_URL_OK;
$returnUrlOk->value = 'https://yourdomain.com/return';
$postData->addEntry($returnUrlOk);

$returnUrlFault = new \UcsCards\PostData\PostEntry();
$returnUrlFault->name = \UcsCards\PostData\PostEntry::ENTRY_NAME_RETURN_URL_FAULT;
$returnUrlFault->value = 'https://yourdomain.com/fail';
$postData->addEntry($returnUrlFault);

$request = new \UcsCards\Request\Register();
$request->order = $order;
$request->cost = $cost;
$request->customer = $customer;
$request->description = $description;
$request->postdata = $postData->result();

echo "Data: ".json_encode($request).PHP_EOL;

try {
    $info = $soapClient->register($request);
    echo "Result: ".json_encode($info).PHP_EOL;
    $redirectUrl = "{$info->redirect_url}?session={$info->session}";
    echo "Here we need redirect a customer to ".$redirectUrl.PHP_EOL;
    return $redirectUrl;
} catch (\SoapFault $fault) {
    echo "SOAP error. ".$fault->faultcode.': '.$fault->faultstring.PHP_EOL;
} catch (\Exception $fault) {
    echo "PHP Exception: ".$fault->__toString().PHP_EOL;
}

```


### Get payment's information

```php
$order = new \UcsCards\Order\OrderId();
$order->shop_id = $settings['shop_id'];
$order->number = 2323443; // Your shop's order ID
$request = new \UcsCards\Request\GetByOrder();
$request->order = $order;

try {
    $info = $soapClient->get_by_order($request);
    echo 'Result: '.json_encode($info).PHP_EOL;
} catch (\SoapFault $fault) {
    echo "SOAP error: [{$fault->faultcode}] - {$fault->faultstring}".PHP_EOL;
} catch (\Exception $fault) {
    echo 'PHP Exception: '.$fault->__toString().PHP_EOL;
}

```


### Charge a recurrent payment in subscriptions

```php
$soapClient = new \UcsCards\Client(null, $settings['soap']);
$order = new \UcsCards\Order\OrderId();
$order->shop_id = $settings['shop_id'];
$order->number = 2323443; // ID of initial payment;

$cost = new \UcsCards\Cost();
$cost->amount = '123.45'; // Recurrent payment price
$cost->currency = 'RUB;

$request = new \UcsCards\Request\Charge();

$request->order = $order;
$request->cost = $cost;
$request->token = "9846594309t53ncw"; // Customer's card token (from result of get_by_order query)
$request->txn_id = 2323449; // Recurrent payment ID

echo "Data ".json_encode($request).PHP_EOL;

try {
    $info = $soapClient->charge((object) $request);
    echo "Result: ".json_encode($info).PHP_EOL;
} catch (\SoapFault $fault) {
    echo "SOAP error: [{$fault->faultcode}] - {$fault->faultstring}".PHP_EOL;
} catch (\Exception $fault) {
    echo 'PHP Exception: '.$fault->__toString().PHP_EOL;
}
```
