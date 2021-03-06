<?php


use siap\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



//Cliente



//Formatos de reportes vacios
Route::get('imprimir','ImprimirController@index');
Route::get('imprimir/licitacionPDF','ImprimirController@licitacionPDF');
Route::get('imprimir/carteraPDF','ImprimirController@carteraPDF');
Route::get('imprimir/desembolsoPDF','ImprimirController@desembolsoPDF');
Route::get('imprimir/desembolsoRefinanciamientoPDF','ImprimirController@desembolsoRefinanciamientoPDF');
Route::get('imprimir/estadoCuentaPDF','ImprimirController@estadoCuentaPDF');
Route::get('imprimir/estadoCuentaVencidoPDF','ImprimirController@estadoCuentaVencidoPDF');
Route::get('imprimir/pagarePDF','ImprimirController@pagarePDF');
Route::get('imprimir/reciboPDF','ImprimirController@reciboPDF');

//Reportes
Route::get('record/pagare/{id}','RecordClienteController@pagare');
Route::get('record/recibo/{id}','RecordClienteController@recibo');
Route::get('record/imprimir','RecordClienteController@show');

Route::get('cuenta/carteraPagosPDF/{id}', 'LiquidacionController@carteraPDF');

Route::get('calcular-credito/imprimir','calcularCreditoController@generarPDF');

Route::get('cuenta/desembolsoPDF/{idcuenta}','CuentaController@desembolsoPDF');
Route::post('cuenta/desembolsoPDF/refinanciamiento', 'CuentaController@desembolsoRefinanciamientoPDF');

Route::get('agregarestado/estadoPDf/{id}','ComprobanteController@estadoPDF');

Route::get('cuenta/carteraRealPDF/{id}','LiquidacionController@carteraRealPDF');



// Reportes adicionales
Route::get('reportes/lista','ReportesController@lista');

//Cartera de Pagos
Route::get('reportes/cartera/pagos','ReportesController@carteraPagos');
Route::post('reportes/cartera/pagos/review','ReportesController@carteraPagosReview');

//Control de Creditos
Route::get('reportes/control/creditos','ReportesController@controlCreditos');
Route::post('reportes/control/creditos/review','ReportesController@controlCreditosReview');
Route::post('reportes/control/creditos/pdf','ReportesController@controlCreditosPDF');

//Estado de Creditos
Route::get('reportes/estado/creditos','ReportesController@estadoCreditos');
Route::post('reportes/estado/creditos/review','ReportesController@estadoCreditosReview');

//Graficos de carteras
Route::get('reportes/grafico/efectivo','ReportesController@grafico');
Route::post('reportes/grafico/efectivo/review','ReportesController@graficoReview');


Route::get('clientes/perfilClientePDF/{id}','ClienteController@perfilClientePDF');


//consulta a la base por jquery
Route::get('search/{id}','TipoCreditoController@autoComplete');
Route::get('search2/{id}','TipoCreditoController@autoCompleteCodeudor');
Route::get('search3/{id}','RefinanciamientoController@autoCompleteSaldos');
//ERRORES 

Route::get('error', function(){ 
    abort(500);
    abort(503);
    abort(404);
});


//Prestamos
Route::resource('prestamo','PrestamoController');


//VIstas para usuarios sin logearse
Route::group(['middleware' => 'guest'], function () {
    Route::get('/','Auth\AuthController@getLogin');
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', ['as' =>'login', 'uses' => 'Auth\AuthController@postLogin']); 
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::get('register', 'Auth\AuthController@tregistro'); 
    Route::post('register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);

});



//Vistas comunes para los dos tipos de usuarios
Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index');
    Route::get('home', 'HomeController@index');
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
    Route::resource('usuario','UsuarioController');

    Route::get('estadodecuenta/{id}', ['as' => 'idcuenta', 'uses' => 'ComprobanteController@nuevoestado']);
    Route::post('agregarestado/{id}',  'ComprobanteController@agregarestado');
    Route::resource('agregarestado',  'ComprobanteController');
   Route::get('estadodecuentas/{id}', 'ComprobanteController@mostrar');
   Route::post('estadodecuentas/estado/update', 'ComprobanteController@updateEstado');
   
   //Calcular credito
   Route::resource('calcular-credito','calcularCreditoController');

   //Tasa de interes
   Route::resource('tasa-interes','TasaInteresController');

   //Record
   Route::resource('record','RecordClienteController');

   
});

//VIstas para usuarios tipo ADMINISTRADOR
Route::group(['middleware' => 'usuarioAdmin'], function () {
 
//cartera de pagos
Route::get('cuenta/carteraPagos/{id}', ['as' => 'idcuenta', 'uses' => 'LiquidacionController@cuenta']);
Route::resource('ingresarPago', 'LiquidacionController');  //edit
Route::post('cuenta/carteraPagos/estados', 'LiquidacionController@updateEstado');

//Refinanciamiento de credito
Route::resource('refinanciamiento','RefinanciamientoController');
Route::resource('refinanciamiento/nuevo','RefinanciamientoController@create');

//Cliente
Route::resource('cliente','ClienteController');
Route::resource('cliente/nuevo','ClienteController@create');
Route::get('clientes/inactivos', 'ClienteController@inactivos');

//Negocios
Route::resource('negocio','NegocioController');
Route::get('negocios/list/{id}', ['as' => 'idcliente', 'uses' => 'NegocioController@getNegocios']);
Route::get('negocios/nuevo/{id}', ['as' => 'idcliente', 'uses' => 'NegocioController@newNegocio']);

//Comentarios
Route::resource('comentario','ObservacionController');
Route::get('comentarios/list/{id}', ['as' => 'idcliente', 'uses' => 'ObservacionController@getObservaciones']);
Route::get('comentarios/nuevo/{id}', ['as' => 'idcliente', 'uses' => 'ObservacionController@newObservacion']);

//Codeudor
Route::resource('codeudor','CodeudorController');
Route::get('codeudores/list/{id}', ['as' => 'idcliente', 'uses' => 'CodeudorController@getCodeudores']);
Route::get('codeudores/nuevo/{id}', ['as' => 'idcliente', 'uses' => 'CodeudorController@newCodeudor']);

//Grarantias
Route::resource('garantia','GarantiaController');
Route::get('cliente/creditos/{id}', ['as' => 'idcliente', 'uses' => 'GarantiaController@getCreditos']);
Route::get('cliente/credito/garantias/{id}', ['as' => 'idcuenta', 'uses' => 'GarantiaController@getGarantias']);
Route::get('cliente/credito/garantias/nuevo/{idprestamo}', ['as' => 'lista', 'uses' => 'GarantiaController@newGarantia']);

//Record
Route::resource('record','RecordClienteController');

//cartera de pagos
Route::get('cuenta/carteraPagos/{id}', ['as' => 'idcuenta', 'uses' => 'LiquidacionController@cuenta']);
Route::resource('ingresarPago', 'LiquidacionController');  //edit

#Route::get('cuenta/ingresarPago/{id}', ['as' => 'iddetalleliquidacion', 'uses' => 'LiquidacionController@ingresarPago']);

//Gestionar Carteras
Route::resource('carteras','CarteraController');
Route::get('cartera/inactiva', 'CarteraController@inactivos');

//Cuenta
Route::get('record','RecordClienteController@index');
Route::resource('cuenta','CuentaController');
Route::get('cuenta/desembolso/{idcuenta}', ['as' => 'idcuenta', 'uses' => 'CuentaController@desembolso']);
Route::post('cuenta/credito/update', 'CuentaController@updateCredito');

//Nuevo Financiamiento
Route::resource('credito','TipoCreditoController');
Route::resource('credito/nuevo','TipoCreditoController@create');

//Gestionar Personal
Route::get('personal','EmpleadoController@indexPersonal');

//Empleado
Route::resource('empleado','EmpleadoController');

//Supervisor
Route::resource('supervisor','SupervisorController');
Route::get('supervisores/inactivos', 'SupervisorController@inactivos');

//Ejecutivo
Route::resource('ejecutivo','EjecutivoController');
Route::get('ejecutivos/inactivos', 'EjecutivoController@inactivos');

//Categoria
Route::resource('categoria','CategoriaController');



	
});


//VIstas para usuarios tipo EMPLEADO
Route::group(['middleware' => 'usuarioEmpleado'], function () { 
         //Credito nuevo



});