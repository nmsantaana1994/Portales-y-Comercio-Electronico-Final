<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use Illuminate\Http\Request;
use App\Cart\Cart;
use App\Cart\CartItem;
use Error;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class CarritoController extends Controller
{
    public function carrito_index() {
        $cart = new Cart;

        $cart = session("carrito");

        //Log::debug($cart);

        //$cartItems = $cart->getItems();

        return view("cart.index", [
            "cart" => $cart,
            //"cartItems"=>$cartItems, 
        ]);
    }

    public function showCarrito() {
        $cartItems = session("carrito") ?? [];

        $cart = new Cart($cartItems);

        // Verificar si el carrito está vacío
        if (empty($cartItems)) {
            $payment = new \App\PaymentProviders\MercadoPagoPayment;
        }
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
          

        return view("cart.index", [
            "cart" => $cart,
            "payment" => $payment,
        ]);
    }

    public function processAddItem(Request $request) {
        try {
            $id = $request->get("id");
            $bicicleta = Bicicleta::findOrFail($id);
            $cartItem = new CartItem($bicicleta, $request->input("q"));

            session()->push("carrito", $cartItem);

            return redirect()
                ->route("bicicletas.view", ["id" => $id])
                ->with("feedback.message", 'La bicicleta <b>' . e($bicicleta['marca']) . ' ' . e($bicicleta['modelo']) . '</b> se agregó al carrito con éxito.');
        } catch (\Exception $e) {
            return redirect()
            ->route("bicicletas.view", ["id" => $id])
            ->with('feedback.message', "Ocurrió un error al tratar de agregar la bicicleta al carrito. Por favor, probá de nuevo en un rato. Y si el problema persiste, comunicate con nosotros.")
            ->with('feedback.type', 'danger');
        }
    }

    public function processPlusItem(Request $request) {
        try {
            $id = $request->get("id");

            $cartItems = session("carrito");

            $cart = new Cart($cartItems);

            //dd($cart);
    
            // Buscar el item en el carrito
            $cartItem = $cart->getItem($id);

            //dd($cartItem);
    
            if ($cartItem) {
                // Incrementar la cantidad del item en 1
                $cartItem->increaseQuantity();
    
                // Actualizar el carrito en la sesión
                session()->put("carrito", $cart->getItems());
            }
    
            return redirect()
                ->route("cart.index")
                ->with("feedback.message", 'Se sumó uno en cantidad.');
        } catch (\Exception $e) {
            return redirect()
                ->route("cart.index")
                ->with('feedback.message', "Ocurrió un error al tratar de incrementar la cantidad.")
                ->with('feedback.type', 'danger');
        }
    }

    public function processLessItem(Request $request) {
        try {
            $id = $request->get("id");

            $cartItems = session("carrito");

            $cart = new Cart($cartItems);
    
            // Buscar el item en el carrito
            $cartItem = $cart->getItem($id);
    
            if ($cartItem) {
                // Incrementar la cantidad del item en 1
                $cartItem->decreaseQuantity();
    
                // Actualizar el carrito en la sesión
                session()->put("carrito", $cart->getItems());
            }
    
            return redirect()
                ->route("cart.index")
                ->with("feedback.message", 'Se restó uno en cantidad.');
        } catch (\Exception $e) {
            return redirect()
                ->route("cart.index")
                ->with('feedback.message', "Ocurrió un error al tratar de incrementar la cantidad.")
                ->with('feedback.type', 'danger');
        }
    }

    public function deleteItem(Request $request) {
        try {
            $id = $request->get("id");
    
            $cartItems = session("carrito");
    
            $cart = new Cart($cartItems);
            
            // Buscar el item en el carrito
            $cartItem = $cart->getItem($id);
    
            if ($cartItem) {
                // Eliminar el item del carrito
                $cart->removeItem($id);
    
                // Actualizar el carrito en la sesión
                session()->put("carrito", $cart->getItems());
            }
    
            return redirect()
                ->route("cart.index")
                ->with("feedback.message", 'El ítem se eliminó del carrito correctamente.');
        } catch (\Exception $e) {
            return redirect()
                ->route("cart.index")
                ->with('feedback.message', "Ocurrió un error al tratar de eliminar el ítem del carrito.")
                ->with('feedback.type', 'danger');
        }
    }
}
