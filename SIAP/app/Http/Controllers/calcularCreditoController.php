<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;

use siap\Prestamo;

use Illuminate\Support\Facades\Redirect;
use siap\DetalleLiquidacion;
use siap\TipoCredito;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use DB;


class calcularCreditoController extends Controller
{

    public function create()

    {
       $usuarioactual=\Auth::user();
       $interesList = DB::table('tipo_credito')->orderby('tipo_credito.interes', 'asc')->get();
       return view('calcularCredito.create2',["interesList"=>$interesList, "usuarioactual"=>$usuarioactual]);
    }



   public function store(Request $request)
    {  

      $usuarioactual=\Auth::user();

      // Recolectamos los datos de cada campo
      $fecha = $request->input("fecha");
      $monto_capital = $request->input("monto");
      $cuota = $request->input("cuota");
      $tipo = $request->input("tipo");
      $inicio = $request->input("inicio");
      $idtipocredito = $request->get("idtipocredito");

      //validaciones previas
      if ($monto_capital < 50 ) {
          Session::flash('negativo', ' El << Monto a Otorgar >> debe ser mayor a $50, transacción fallida. ');
          return Redirect::to('calcular-credito/create');
      }

      if($monto_capital > 10000){
          Session::flash('negativo1', ' El << Monto a Otorgar >> debe ser menor  a $10,000, transacción fallida. ');
          return Redirect::to('calcular-credito/create');
      }

      if($cuota < 0){
          Session::flash('negativo2', ' La << Cuota Diaria >> debe de ser mayor a cero, transacción fallida. ');
          return Redirect::to('calcular-credito/create');
      }

      if($cuota >= $monto_capital){
          Session::flash('mayor', ' La << Cuota Diaria >> debe ser menor al << Monto a Otorgar >>, transacción fallida. ');
          return Redirect::to('calcular-credito/create');
      }

      //buscamos el interes
      $tipo_credito = TipoCredito::findOrFail($idtipocredito);
      $tipoCredito = $idtipocredito;

      $tasaInteres = $tipo_credito->interes;

      $nuevo_monto=0;

      // Se obtiene el tipo de comision SI ó NO (cobro de los 2.25 por cada $50)
      switch ($tipo) 
      {
        case 'SI':
          $monto_extra=(floor($monto_capital/50))*2.25;
          $nuevo_monto=$monto_capital+$monto_extra;
        break;

        case 'NO':
            $nuevo_monto=$monto_capital;
        break;
      }

      // Inicio de cartera de pago
      switch ($inicio) 
      {
        case 'NEXT':
          $fecha = $fecha;
        break;

        case 'HOY':
            #$fecha = $fecha;
            $res = 1;
            $fecha= date("Y-m-d", strtotime("$fecha - ". $res ." days"));
        break;
      }


      //validacion para un interes diario menor a la cuota diaria

      $interesDiario=$nuevo_monto*$tasaInteres;
      $interesDiario = round($interesDiario,2);
      $tasa = $tasaInteres*100;

      if($interesDiario>$cuota)
      {
        Session::flash('negativo3', ' Para una tasa de interes de '.$tasa.'% y un monto de $'.$monto_capital.' su cuota debe de ser mayor a $'.($interesDiario+0.01).' , transacción fallida. ');
        return Redirect::to('calcular-credito/create');
      }

       $liquidacion = new DetalleLiquidacion;

     return view('calcularCredito.create3', ["liquidacion"=>$liquidacion,"fecha"=>$fecha, "nuevo_monto"=>$nuevo_monto, "cuota"=>$cuota, "tipoCredito"=>$tipoCredito,"interesDiario"=>$interesDiario, "tasaInteres"=>$tasaInteres, "usuarioactual"=>$usuarioactual]);
    }


    public function generarPDF(Request  $request){
      $fecha = $request->input("fecha");
      $monto_capital = $request->input("monto_capital");
      $pagos_diarios = $request->input("gastos_diarios");
      $tasa_interes = $request->input("tasa_interes");

      $vistaurl = "reportes/liquidacionPrueba";

      $name = "CarteraPagos".$fecha.".pdf";

      $liquidacion = new DetalleLiquidacion;
  
      return $this -> crearPDF($vistaurl,$fecha,$monto_capital,$pagos_diarios,$tasa_interes,$liquidacion,$name);

    }

    public function crearPDF($vistaurl,$fecha,$monto_capital,$pagos_diarios,$tasa_interes,$liquidacion,$name)
    {
        
        $view=\View::make($vistaurl,compact('fecha','monto_capital','pagos_diarios','tasa_interes','liquidacion'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

 
}
