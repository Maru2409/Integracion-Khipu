<?php
//require __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/khipu/khipu-api-client/lib/Configuration.php';
require_once __DIR__ . '/vendor/khipu/khipu-api-client/lib/ApiClient.php';
require_once __DIR__ . '/vendor/khipu/khipu-api-client/lib/ObjectSerializer.php';
require_once __DIR__ . '/vendor/khipu/khipu-api-client/lib/ApiException.php';
require_once __DIR__ . '/vendor/khipu/khipu-api-client/lib/Api/PaymentsApi.php';
require_once __DIR__ . '/vendor/khipu/khipu-api-client/lib/Model/AuthorizationError.php';
require_once __DIR__ . '/vendor/khipu/khipu-api-client/lib/Model/PaymentsCreateResponse.php';

use Khipu\ApiClient;
use Khipu\Configuration;
use Khipu\Api\PaymentsApi;
use Khipu\ApiException;
use Khipu\ObjectSerializer;

$receiverId = '497857';
$secret = 'fbbda93b1e0ec7b6cbfb5e96b160186ec8cc5737';

$config = new Configuration();
$config->setReceiverId($receiverId);
$config->setSecret($secret);

$client = new ApiClient($config);
$paymentsApi = new PaymentsApi($client);

try {
    $response = $paymentsApi->paymentsPost(
        "Pago en Marutec",
        "CLP",
        5000.0,
        [
            "return_url" => "file:///C:/xampp/htdocs/BigWing/exito.html",
            "cancel_url" => "file:///C:/xampp/htdocs/BigWing/cancelado.html",
            "notify_url" => "https://tusitio.com/notificacion.php",
            "transaction_id" => uniqid("bigwing_")
        ]
    );
    header("Location: " . $response["payment_url"]);
    exit;
} catch (Exception $e) {
    echo "Error al procesar el pago: " . $e->getMessage() . "<br><br>";
    echo "<pre>" . print_r($e, true) . "</pre>";
}
?>
