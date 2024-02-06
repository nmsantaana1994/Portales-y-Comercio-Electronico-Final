<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use App\Models\Compra;
use App\Models\CompraBicicleta;
use App\Cart\Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MercadoPagoController extends Controller
{
    public function show() {
        /** @var Bicicletra[] $bicicletas */
        $bicicletas = Bicicleta::whereIn("bicicletas_id", [1,2,3])->get();

        // Configuramos el SDK de Mercado Pago con nuestras credenciales de acceso.
        \MercadoPago\SDK::setAccessToken(config("mercadopago.accessToken"));

        // Ahora tenemos que crear la preferencia, que es el cobro que vamos a pedirle al usuario que abone.
        // Para crearla, tenemos como único requisito que asociarle al menos un "item".
        // Los items a cobrar deben ser instancias de la clase \MercadoPago\Item, y deben asignarse como un
        // array a la propiedad "items" de la preferencia.

        // Preparamos los "items".
        $items = [];
        foreach($bicicletas as $bicicleta) {
            $item = new \MercadoPago\Item();

            // Cada Item debe tener al menos un title, unit_price y quantity, con esos nombres.
            $item->title = $bicicleta->modelo;
            $item->unit_price = $bicicleta->precio;
            $item->quantity = 1;

            $items[] = $item;
        }

        // Creamos la preferencia.
        $pref = new \MercadoPago\Preference();
        $pref->items = $items;

        // Registramos en la preferencia cuales son las URLs a las que nos debe retornar cuando el flujo
        // de cobro se complete, dependiendo del resultado del mismo.
        $pref->back_urls = [
            "success" => route("mp.success"),
            "pending" => route("mp.pending"),
            "failure" => route("mp.failure"),
        ];
        // También le podemos indicar que en caso de éxito, redireccione automáticamente luego de 5 segundos.
        $pref->auto_return = "approved";

        // Cuando terminamos de configurar la preferencia, la "guardamos" para que genere el "id" de
        // preferencia, que vamos a necesitar luego.
        $pref->save();
        
        return view("mp.show", [
            "bicicletas" => $bicicletas,
            "pref" => $pref,
            "publicKey" => config("mercadopago.publicKey"),
        ]);
    }

    // public function showV2() {
    //     /** @var Bicicleta[] $bicicletas */
    //     $bicicletas = Bicicleta::whereIn("bicicletas_id", [1,2,3])->get();

    //     $payment = new \App\PaymentProviders\MercadoPagoPayment;

    //     $payment
    //         ->addItems($bicicletas)
    //         ->withBackUrls(
    //             success: route("mp.success"),
    //             pending: route("mp.pending"),
    //             failure: route("mp.failure"),
    //         )
    //         ->withAutoReturn()
    //         ->save();

    //     return view("mp.show-v2", [
    //         "bicicletas" => $bicicletas,
    //         "payment" => $payment,
    //     ]);
    // }

    public function showV3() {
        $cart = new Cart;

        $cart = session("carrito");

        // $cartSession = session("carrito");
        // Log::debug($cartSession);

        // foreach($cartSession as $cartItemSession){
        //     $cart->addItem($cartItemSession);
        //     //Log::debug($cart->getItems());
        // };

        // Log::debug($cart->getItems());

        // $cartItems = $cart->getItems();
        // Log::debug($cartItems);

        // foreach($cart as $cartItem){
        //     /** @var Bicicleta[] $bicicletas */
        //     $bicicletas[] = Bicicleta::whereIn("bicicletas_id", [$cartItem->getProduct()->bicicletas_id])->get();
        //     //Log::debug($bicicletas);
        // }
        Log::debug($cart);
        //$bicicletas = Bicicleta::whereIn("bicicletas_id", [1,2,3])->get();

        $payment = new \App\PaymentProviders\MercadoPagoPayment;

        $payment
            ->addItems($cart)
            ->withBackUrls(
                success: route("mp.success"),
                pending: route("mp.pending"),
                failure: route("mp.failure"),
            )
            ->withAutoReturn()
            ->save();

        return view("mp.show-v3", [
            "cart" => $cart,
            "payment" => $payment,
        ]);
    }

    public function processSuccess(Request $request) {
        // Log::debug("Usuario ID: ", Auth::user()->user_id);
        // dd($request);
        
        // Normalmente acá podriamos guardar los datos de que la compra se realizó correctamente, para
        // habilitar el servicio, marcar como abonado los productos para poder proceder a su envio, etc.
        // A modo de ejemplo, simplemente vamos a imprimir un mensaje de resultado y la data que recibimos
        // de Mercado Pago.


        // Obtener datos relevantes de la respuesta de Mercado Pago
        $preferenceId = $request->input('preference_id');

        // Obtener el carrito almacenado en la sesión
        $cartItems = session('carrito');

        // Calcular el monto total de la compra sumando los montos individuales de cada bicicleta en el carrito
        $montoTotal = 0;
        
        // Crear una nueva instancia de Compra y asignar los datos relevantes
        $compra = new Compra();
        $compra->user_id = Auth::user()->user_id;
        $compra->preference_id = $preferenceId;

        // Guardar la compra en la base de datos
        $compra->save();

        // Guardar la relación entre la compra y las bicicletas en "compra_bicicleta"
        foreach ($cartItems as $cartItem) {
            $bicicleta = $cartItem->getProduct();
            $cantidad = $cartItem->getQuantity();
            $precioUnitario = $bicicleta->precio;
            // Log::debug("Precio: ", [$precioUnitario]);
            $subtotal = $cantidad * $precioUnitario;

            // Calcular el monto total de la compra sumando el subtotal de cada bicicleta
            $montoTotal += $subtotal;

            // Guardar la relación entre la compra y la bicicleta en "compra_bicicleta"
            $compra->bicicletas()->attach($bicicleta->id, [
                'cantidad' => $cantidad,
                // 'precio_unitario' => intval($precioUnitario), // Convertir a entero
            ]);
        }

        // Asignar el monto total calculado a la compra
        $compra->monto_total = intval($montoTotal); // Convertir a entero
        $compra->save();

        // Eliminar los datos del carrito después de que se ha realizado la compra
        session()->forget('carrito');

        return redirect()
            ->route("home")
            ->with("feedback.message", 'La compra se realizó éxito con.');
        // echo "Success!";
        // dd($request);
    }

    public function processPending(Request $request) {
        echo "Pending...";
        dd($request);
    }

    public function processFailure(Request $request) {
        echo "Failure!";
        dd($request);
    }
}
