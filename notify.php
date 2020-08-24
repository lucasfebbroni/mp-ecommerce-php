<?
$id = $_GET['id'];
$topic = $_GET["topic"];

$message = "action: ".$_POST["action"]." api_version: ".$_POST["api_version"]." data: ".$_POST["data"]." data_created: ".$_POST["date_created"]." id: ".$_POST["id"]." live_mode: ".$_POST["live_mode"]." type: ".$_POST["type"]." user_id: ".$_POST["user_id"]." application_id: ".$_POST["application_id"];
    
mail('damianfe@hotmail.com', 'notificacion mercadopago', $message);

switch($topic) {
    case "payment":
        $data = file_get_contents('https://api.mercadopago.com/v1/payments/'.$id.'?access_token=APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');
        echo $data;
        /*$products = json_decode($data, false);
        var_dump($products);*/
        
        http_response_code(200);
    break;
}

?>