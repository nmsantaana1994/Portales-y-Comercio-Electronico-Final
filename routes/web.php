<?php

use App\Http\Controllers\BicicletasTrashedController;
use App\Http\Controllers\BicicletasConsultController;
use App\Http\Controllers\BicicletasController;
use App\Http\Controllers\HomeControler;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UserController;
use App\Cart\Cart;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeControler::class, "home"])
    ->name("home");

Route::get("nosotros", [HomeControler::class, "about"])
    ->name("about");

Route::get("contacto", [HomeControler::class, "contact"])
    ->name("contact");  

// Carrito
Route::get("carrito", [CarritoController::class, "showCarrito"])
    ->name("cart.index")
    ->middleware("auth");
Route::post("carrito/addItem", [CarritoController::class, "processAddItem"])
    ->name("cart.processAddItem")
    ->middleware("auth");
Route::post("carrito/plusItem", [CarritoController::class, "processPlusItem"])
    ->name("cart.processPlusItem")
    ->middleware("auth");
Route::post("carrito/lessItem", [CarritoController::class, "processLessItem"])
    ->name("cart.processLessItem")
    ->middleware("auth");
Route::post("carrito/deleteItem", [CarritoController::class, "deleteItem"])
    ->name("cart.deleteItem")
    ->middleware("auth");

//Usuario
Route::get("perfil", [UserController::class, "showPerfil"])
    ->name("user.index")
    ->middleware("auth");
Route::get("editar-perfil", [UserController::class, "formUpdate"])
    ->name("user.formUpdate")
    ->middleware("auth");
Route::post("editar-perfil", [UserController::class, "processUpdate"])
    ->name("user.processUpdate")
    ->middleware("auth");



// Autenticación
Route::get("iniciar-sesion", [AuthController::class, "formLogin"])
    ->name("auth.formLogin");
Route::post("iniciar-sesion", [AuthController::class, "processLogin"])
    ->name("auth.processLogin");
Route::post("cerrar-sesion", [AuthController::class, "processLogout"])
    ->name("auth.processLogout");
Route::get("registrarse", [AuthController::class, "formRegister"])
    ->name("auth.formRegister");
Route::post("registrarse", [AuthController::class, "processRegister"])
    ->name("auth.processRegister");


//Bicicletas
Route::get("bicicletas/listado", [BicicletasController::class, "bicicletas_index"])
    ->name("bicicletas.index");

Route::get("bicicletas/eliminadas", [BicicletasTrashedController::class, "index"])
    ->name("bicicletas.trashed.index")
    ->middleware("auth");
Route::get("bicicletas/eliminadas/{id}", [BicicletasTrashedController::class, "index"])
    ->name("bicicletas.trashed.view")
    ->middleware("auth");
Route::post("bicicletas/eliminadas/{id}/restaurar", [BicicletasTrashedController::class, "processRestore"])
    ->name("bicicletas.trashed.processRestore")
    ->middleware("auth");

Route::get("bicicletas/nueva", [BicicletasController::class, "formNew"])
    ->name("bicicletas.formNew")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::post("bicicletas/nueva", [BicicletasController::class, "processNew"])
    ->name("bicicletas.processNew")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::get("bicicletas/{id}", [BicicletasController::class, "view"])
    ->name("bicicletas.view");

//Mail, no esta funcional del todo :(
Route::post("bicicletas/{id}/consultar", [BicicletasConsultController::class, "processConsult"])
    ->name("bicicletas.processConsult");

Route::get("bicicletas/{id}/editar", [BicicletasController::class, "formUpdate"])
    ->name("bicicletas.formUpdate")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::post("bicicletas/{id}/editar", [BicicletasController::class, "processUpdate"])
    ->name("bicicletas.processUpdate")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::get("bicicletas/{id}/eliminar", [BicicletasController::class, "confirmDelete"])
    ->name("bicicletas.confirmDelete")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::post("bicicletas/{id}/eliminar", [BicicletasController::class, "processDelete"])
    ->name("bicicletas.processDelete")
    ->middleware("auth")
    ->middleware("user-role:admin");

//Noticias
Route::get("noticias/listado", [NoticiasController::class, "noticias_index"])
    ->name("noticias.index");
Route::get("noticias/nueva", [NoticiasController::class, "formNew"])
    ->name("noticias.formNew")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::post("noticias/nueva", [NoticiasController::class, "processNew"])
    ->name("noticias.processNew")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::get("noticias/{id}", [NoticiasController::class, "view"])
    ->name("noticias.view");
Route::get("noticias/{id}/editar", [NoticiasController::class, "formUpdate"])
    ->name("noticias.formUpdate")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::post("noticias/{id}/editar", [NoticiasController::class, "processUpdate"])
    ->name("noticias.processUpdate")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::get("noticias/{id}/eliminar", [NoticiasController::class, "confirmDelete"])
    ->name("noticias.confirmDelete")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::post("noticias/{id}/eliminar", [NoticiasController::class, "processDelete"])
    ->name("noticias.processDelete")
    ->middleware("auth")
    ->middleware("user-role:admin");

// Administración
Route::get("admin", [AdminController::class, "dashboard"])
    ->name("admin.dashboard")
    ->middleware("auth")
    ->middleware("user-role:admin");

//Bicicletas
Route::get("admin/bicicletas", [AdminController::class, "bicicletas"])
    ->name("admin.bicicletas")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::get("admin/bicicletas/{id}", [AdminController::class, "bicicletas_view"])
    ->name("admin.bicicletas_view")
    ->middleware("auth")
    ->middleware("user-role:admin");

//Noticias
Route::get("admin/noticias", [AdminController::class, "noticias"])
    ->name("admin.noticias")
    ->middleware("auth")
    ->middleware("user-role:admin");
Route::get("admin/noticias/{id}", [AdminController::class, "noticias_view"])
    ->name("admin.noticias_view")
    ->middleware("auth")
    ->middleware("user-role:admin");

//Usuarios
Route::get("admin/users", [AdminController::class, "users"])
    ->name("admin.users")
    ->middleware("auth")
    ->middleware("user-role:admin");


/**
 * |--------------------------------------------------------------------------------
 * | Ejemplo Mercado Pago
 * |--------------------------------------------------------------------------------
 */
Route::get("mp/test", [\App\Http\Controllers\MercadoPagoController::class, "show"])
    ->name("mp.test");
Route::get("mp/test-v2", [\App\Http\Controllers\MercadoPagoController::class, "showV2"])
    ->name("mp.test-v2");
Route::get("mp/test-v3", [\App\Http\Controllers\MercadoPagoController::class, "showV3"])
    ->name("mp.test-v3");
    
Route::get("mp/success", [\App\Http\Controllers\MercadoPagoController::class, "processSuccess"])
    ->name("mp.success");
Route::get("mp/pending", [\App\Http\Controllers\MercadoPagoController::class, "processPending"])
    ->name("mp.pending");
Route::get("mp/failure", [\App\Http\Controllers\MercadoPagoController::class, "processFailure"])
    ->name("mp.failure");
