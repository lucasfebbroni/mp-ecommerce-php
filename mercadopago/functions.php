<? function link_senia($id,$descripcion,$monto){
	date_default_timezone_set("America/Argentina/Buenos_Aires"); 
	
		
    require_once('pagos/vendor/autoload.php');
    /*produccion*/
    MercadoPago\SDK::setClientId("8569225716078128");
    MercadoPago\SDK::setClientSecret("GOuNKDOmXiHFIqRaIV6Dm3O4MJbp0NCJ");
    /*sandbox
    MercadoPago\SDK::setClientId("6273434275390469");
    MercadoPago\SDK::setClientSecret("mG3bIonUPdptEgdEprR991k0rEY78pib");*/
    /*sandbox
    
    Vendedor
    Nick = TT575379
    Pass = qatest2275
    Email = test_user_34320400@testuser.com


    comprador
    Nick = TESTON66EPUV
    Pass = qatest3678
    Email = test_user_72925236@testuser.com
    
    
    */
    
    //MercadoPago\SDK::setClientId("7129149297291224");
    //MercadoPago\SDK::setClientSecret("EhajXIVlSJ94trcy3zgxt2mBZfapZ49O");

    # Create a preference object
    $preference = new MercadoPago\Preference();
    # Create an item object
    $item = new MercadoPago\Item();
    $item->id = $id_pago;
    $item->title = $descripcion;
    $item->quantity = 1;
    $item->currency_id = "ARS";
    $item->unit_price = $monto;
    # Create a payer object
    $payer = new MercadoPago\Payer();
    $payer->email = $email;

    $payer->name = $nombre;
    /*$payer->phone = array(
    "area_code" => "",
    "number" => $telefono
    );*/

    # Setting preference properties
    $preference->items = array($item);
    $preference->payer = $payer;
    # Save and posting preference

    $preference->back_urls = array(
    "success" => "https://www.elcomedordeiris.online/engine/cuentas_alumnos.php",
    "failure" => "https://www.elcomedordeiris.online/engine/cuentas_alumnos.php",
    "pending" => "https://www.elcomedordeiris.online/engine/cuentas_alumnos.php"
    );
    $preference->auto_return = "approved";
    $preference->external_reference = $id_pago;
    $preference->notification_url = "https://www.elcomedordeiris.online/engine/pagos_registro2.php";

    $preference->save();

    $link = $preference->init_point;

    return $link;
		
}
?>