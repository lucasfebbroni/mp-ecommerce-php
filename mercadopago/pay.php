<?

    $img = $_POST['img'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $cliente_email = "test_user_63274575@testuser.com";
    $cliente_id = 471923173;
    $cliente_nombre = "Lalo";
    $cliente_apellido = "Landa";
    $cliente_phone_area = 11;
    $cliente_phone_numero = 22223333;
    $cliente_direccion = "False";
    $cliente_direccion_numero = 123;
    $cliente_direccion_cp = 1111;


    define('ROOTPATH', 'https://lucasfebbroni-mp-commerce-php.herokuapp.com/');

    $file = pathinfo($img)['basename'];
    $folder = pathinfo(dirname($img))['basename'];
    $imagen = ROOTPATH . $folder."/".$file;

    require_once('../vendor/autoload.php');

    MercadoPago\SDK::setAccessToken("APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398");
    MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");

    # Create a preference object
    $preference = new MercadoPago\Preference();
    # Create an item object
    $item = new MercadoPago\Item();
    $item->id = 1234;
    $item->title = $title;
    $item->description = "Dispositivo móvil de Tienda e-commerce";
    $item->picture_url = "$imagen";
    $item->quantity = $unit;
    $item->currency_id = "ARS";
    $item->unit_price = $price;

    $preference->items = array($item);

    # Create a payer object
    $payer = new MercadoPago\Payer();

    $payer->id = $cliente_id;
    $payer->email = $cliente_email;
    $payer->name = $cliente_nombre;
    $payer->surname = $cliente_apellido;
    $payer->phone = array("area_code"=>$cliente_phone_area,"number"=>$cliente_phone_numero);
    $payer->address = array("street_name"=>$cliente_direccion,"street_number"=>$cliente_direccion_numero,"zip_code"=>$cliente_direccion_cp);

    $preference->payer = $payer;

    $preference->payment_methods = array(
        "excluded_payment_types" => array( array("id" => "atm") ),
        "excluded_payment_methods" => array( array("id" => "amex") ),
        "installments" => 6		
    );

    $preference->notification_url = ROOTPATH."notify.php";
    $preference->back_urls = array(
    "success" => ROOTPATH."success.php",
    "failure" => ROOTPATH."fail.php",
    "pending" => ROOTPATH."pending.php"
    );
    $preference->auto_return = "approved";
    $preference->external_reference = "lucasfebbroni@gmail.com";


    $preference->save();

    $link = $preference->init_point;


    header("Location: $link");
?>