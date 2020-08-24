<?
$id = $_GET['id'];
$topic = $_GET["topic"];

$data = file_get_contents('php://input');

switch($topic) {
    case "payment":
        $data = file_get_contents('https://api.mercadopago.com/v1/payments/'.$id.'?access_token=APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');
        echo $data;
        
        http_response_code(200);
    break;
}

?>