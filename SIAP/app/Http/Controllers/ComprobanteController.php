<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;
use siap\Negocio;
use siap\Cartera;
use siap\Cliente;
use siap\Cuenta;
use siap\Prestamo;
use siap\TipoCredito;
use siap\Comprobante;
use siap\DetalleLiquidacion;
use siap\Fecha;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use DB;

use siap\Http\Requests;

class ComprobanteController extends Controller
{

    /*
    Nombre: show
    Objetivo: Mostrar los estados de cuenta de un cliente
    Autor: Oscar
    Fecha creación: 01-02-2018, 00:00
    Fecha modificacion: 28-03-2019, 9:06
    Parámetros de entrada: idcuenta
    Parámetros de salida: Estados de cuenta del cliente
     */

    public function show(Request $request,$id)
    {
        $usuarioactual=\Auth::user();

        $fecha_actual = Fecha::spanish();

        $estados=DB::table('comprobante')->where('idcuenta','=',$id)
        ->orderBy('created_at','asc')
        ->paginate(10);

        $cliente = DB::table('cuenta')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
            ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
            ->join('cartera as cartera','cliente.idcartera','=','cartera.idcartera')
            ->where('cuenta.idcuenta','=',$id)
            ->select(
                'cuenta.idcuenta',
                'cuenta.interes',
                'negocio.nombre as nombreNegocio',
                'cartera.nombre as nombreCartera',
                'cliente.idcliente',
                'cliente.nombre', 
                'cliente.apellido',
                'cliente.dui',
                'cliente.nit',
                'cliente.direccion',
                'cuenta.estado',
                'prestamo.cuotadiaria',
                'prestamo.estadodos')
            ->first();
            
        return view('estadoCuenta.show',["cliente"=>$cliente, "estados"=>$estados, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
    }

    /*
    Nombre: mostrar
    Objetivo: metodo para mostrar el reviews de estados de cuenta
    Autor: Oscar
    Fecha creación: 02-02-2018, 04:00
    Fecha modificacion: 12-04-2019, 12:10
    Parámetros de entrada: idcuenta
    Parámetros de salida: estado de cuenta normal o vencido
     */
    public function mostrar(Request $request,$id)
    {
        $usuarioactual=\Auth::user();

        $cliente = DB::table('cuenta')
            ->join('comprobante as comprobante','cuenta.idcuenta','=','comprobante.idcuenta')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
            ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
            ->join('cartera as cartera','cliente.idcartera','=','cartera.idcartera')
            ->where('comprobante.idcomprobante','=',$id)
            ->select(
                'cuenta.idcuenta',
                'cuenta.interes',
                'negocio.nombre as nombreNegocio',
                'cliente.nombre',
                'cartera.nombre as nombreCartera', 
                'cliente.idcliente',
                'cliente.apellido',
                'cliente.dui',
                'cliente.nit',
                'cliente.direccion',
                'cliente.telefonocel',
                'cuenta.estado',
                'prestamo.cuotadiaria',
                'prestamo.estadodos')
            ->first();

        $estadoc = Comprobante::findOrFail($id);

        // Tratamiento de la fecha del comprobante
        $hoy = Carbon::parse($estadoc->fechacomprobante)->format('d-m-Y');
        $hoi = explode("-", $hoy);
        $aniohoy = strtolower($hoi[2]);
        setlocale(LC_TIME, "spanish");
        $meshoy = $this -> obtenerMes($hoi[1]);
        $diahoy = $hoi[0];

        // tratamiento de la ultima fecha
        $ultimafecha = DetalleLiquidacion::where('idcuenta','=',$cliente->idcuenta)
            ->orderby('iddetalleliquidacion','desc')
            ->first();

        if (!is_null($ultimafecha)){
            $ultima=$ultimafecha->fechadiaria->format('Y-m-d');
        }else{
            $ultima=0;
        }

        $fecfina = explode("-", $ultima);
        $diafe = $fecfina[2];
        $mesfe = $this -> obtenerMes($fecfina[1]);
        $aniofe = $fecfina[0];

        $liquidacion = new DetalleLiquidacion;
        $cont=0;
        $nuvfecha=date("Y-m-d",strtotime("$ultima + ".$cont." days "));
        $liquidacion->fechadiaria=$nuvfecha;

        if ($estadoc->estado=="NORMAL") {

            return view('estadoCuenta.consulta',["cliente"=>$cliente,"estadoc"=>$estadoc, "diahoy"=>$diahoy, "meshoy"=>$meshoy, "aniohoy"=>$aniohoy, "liquidacion"=>$liquidacion, "usuarioactual"=>$usuarioactual]); 
        }
        elseif ($estadoc->estado=="VENCIDO") {
            
             return view('estadoCuenta.vencido.consulta',["cliente"=>$cliente,"estadoc"=>$estadoc, "diahoy"=>$diahoy, "meshoy"=>$meshoy, "aniohoy"=>$aniohoy, "liquidacion"=>$liquidacion, "diafe"=>$diafe, "mesfe"=>$mesfe, "aniofe"=>$aniofe, "usuarioactual"=>$usuarioactual]);
        }
    }
 

    /*
    Nombre: nuevoestado
    Objetivo: Formulario para guardar estado de cuenta
    Autor: Oscar
    Fecha creación: 02-02-2018, 00:00
    Fecha modificacion: 18-03-2019, 10:10
    Parámetros de entrada: idcuenta
    Parámetros de salida: saldo capital, cuotas atrasadas, subtotal
     */
    public function nuevoestado($id){

        $usuarioactual=\Auth::user();

        $cliente = DB::table('cuenta')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
            ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
            ->join('cartera as cartera','cliente.idcartera','=','cartera.idcartera')
            ->where('cuenta.idcuenta','=',$id)
            ->select(
                'cuenta.idcuenta',
                'cuenta.interes',
                'negocio.nombre as nombreNegocio',
                'cliente.idcliente',
                'cliente.nombre',
                'cartera.nombre as nombreCartera', 
                'cliente.apellido',
                'cliente.dui',
                'cliente.nit',
                'cliente.direccion',
                'cuenta.estado',
                'prestamo.cuotadiaria',
                'prestamo.estadodos')
            ->first();
        
        //Se valida el estado -- cerrado -- del prestamo
        while($cliente->estadodos=="CERRADO"){
            Session::flash('error',"El Préstamo esta en el estado -- ". $cliente->estadodos. " -- , no se puede agregar más estados de cuenta");
            return back();
        }
        
        //<-----CALCULOS PARA ESTADOS DE CUENTA NORMALES ------>
        if ($cliente->estadodos == "ACTIVO") {
            
            //SE BUSCA EL SALDO CAPITAL EN QUE QUEDO LA CUENTA
            $saldoLiqui = DetalleLiquidacion::where('idcuenta',$id)->where('abonocapital','pivote')->first();
            
            //SE CUENTA EL NUMERO DE CUOTAS ATRASADAS
            $cuotasatrasadas = DB::table('detalle_liquidacion')->where([
                ['estado', '=', 'ATRASO'],
                ['idcuenta', '=', $id],
                ])->count();         

           //SE CALCULA EL VALOR MONETARIO DE LAS COUTAS ATRASADAS
           $totalcuotas = $cuotasatrasadas * $cliente->cuotadiaria;
           $totalcuotas=round($totalcuotas,2);
        

            $subtotal=$totalcuotas+$saldoLiqui->monto;
            return view('estadoCuenta.create',["cliente"=>$cliente, "saldoLiqui"=>$saldoLiqui,"cuotasatrasadas"=>$cuotasatrasadas,"totalcuotas"=>$totalcuotas,"subtotal"=>$subtotal,"usuarioactual"=>$usuarioactual]);
        }
        //<-------------------FINALIZA CALCULOS ESTADO NORMAL-------->

        //<------CALCULOS PARA ESTADO DE CUENTA VENCIDOS---------->
        elseif ($cliente->estadodos=="VENCIDO") 
        {

            //SE BUSCA SI HAY ABONO EN LA CUENTA
            $abonoLiqui = DetalleLiquidacion::where('idcuenta',$id)->where('estado','ABONO')->first();
            if ($abonoLiqui != null ) {
                $diaspendx = 1;
                $totalpendx = $cliente->cuotadiaria - $abonoLiqui->totaldiario;
            }else{
                $diaspendx = 0;
                $totalpendx = 0;
            }
               
            //Se CALCULAN EL NUMERO DE CUOTAS ATRASADAS Y PENDIENTES 
            $cuotasatrax = DetalleLiquidacion::where('idcuenta',$id)->where('estado','ATRASO')->count();
            $cuotaspendx = DetalleLiquidacion::where('idcuenta',$id)->where('estado','PENDIENTE')->count();

            $cuotadeux = $cuotasatrax + $cuotaspendx;

            // SE RESTA LA ULTIMA CUOTA EN CASO DE APLICAR
            if ($cuotadeux >= 2) {
                $cuotadeux = $cuotadeux - 1;
            }

            // SE CALCULA EL VALOR MONETARIO DE LAS CUOTAS ATRASADAS Y/O PENDIENTES
            $totalcuotadeux = $cuotadeux * $cliente->cuotadiaria;

            // SE OBTIENE EL ULTIMO PAGO EFECTIVO DE LA CARTERA DE PAGOS DEL CLIENTE
            $totalultimacuox = DetalleLiquidacion::ultimaCuotaPago($id);

            // CALCULO DE LA MORA
            $liqui = DetalleLiquidacion::where('idcuenta',$id)->where('abonocapital','pivote')->first();

            $fechaActual = Carbon::now();
            $fechaNoPaga = Carbon::parse($liqui->fechadiaria);
            $diasexpix=$fechaActual->diffInDays($fechaNoPaga);
            $morx = round($liqui->monto * $cliente->interes * $diasexpix,2);

            $totalx = round($totalpendx + $totalcuotadeux + $totalultimacuox + $morx,2);

            return view('estadoCuenta.vencido.create',["cliente"=>$cliente, "diaspendx"=>$diaspendx, "totalpendx"=>$totalpendx, "cuotadeux"=>$cuotadeux, "totalcuotadeux"=>$totalcuotadeux, "totalultimacuox"=>$totalultimacuox,"diasexpix"=>$diasexpix,"morx"=>$morx,"totalx"=>$totalx, "monto"=>$liqui->monto,"usuarioactual"=>$usuarioactual]);
        }

        //<-------------------FINALIZA CALCULO ESTADO DE CUENTA VENCIDO---------->
    }


    /*
    Nombre: agregarestado
    Objetivo: Metodo para guardar los datos del estado de cuenta
    Autor: Oscar
    Fecha creación: 02-02-2018, 04:00
    Fecha modificacion: 11-04-2019, 10:10
    Parámetros de entrada: idcuenta
    Parámetros de salida: saldo capital, cuotas atrasadas, subtotal
     */
    public function agregarestado(Request $request,$id){
        $usuarioactual=\Auth::user();

        $fecha_actual = Fecha::spanish();

        $date = Carbon::now();  
        $date = $date->format('d-m-Y');

        $cliente = DB::table('cuenta')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
            ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
            ->join('cartera as cartera','cliente.idcartera','=','cartera.idcartera')
            ->where('cuenta.idcuenta','=',$id)
            ->select(
                'cuenta.idcuenta',
                'cuenta.interes',
                'negocio.nombre as nombreNegocio',
                'cliente.idcliente',
                'cliente.nombre',
                'cartera.nombre as nombreCartera', 
                'cliente.apellido',
                'cliente.dui',
                'cliente.nit',
                'cliente.direccion',
                'cuenta.estado',
                'prestamo.cuotadiaria',
                'prestamo.estadodos')
            ->first();

        if($cliente->estadodos=="ACTIVO"){

            $estado= new Comprobante;

            $estado->idcuenta = $id;
            $estado->gastosadmon =  $request->get('gastosadmon');
            $estado->gastosnotariales = $request->get('gastosnoti');
            $estado->mora = 0.00;
            $estado->diasatrasados = $request->get('cuotasatrasadas');    // # cuotas atrasadas
            $estado->totalcuotas = $request->get('totalcuotas');          // valor monetario de cuotas atrasadas
            
            $estado->diaspendientes=0;      // aplica solamente para estados vencidos
            $estado->totalpendiente=0;      // aplica solamente para estados vencidos
            $estado->cuotadeuda=0;          // aplica solamente para estados vencidos
            $estado->totalcuotasdeuda=0;    // aplica solamente para estados vencidos
            $estado->ultimacuota=0;         // aplica solamente para estados vencidos
            $estado->diasexpirados=0;       // aplica solamente para estados vencidos

            $estado->montoactual = $request->get('monto');               // saldo capital
            $estado->total = $request->get('total');                    // total
            $estado->fechacomprobante = $request->get('fechaactual'); 
         
            $estado->estado='NORMAL';                                   // estado del comprobante
            $estado->estadodos='--';                                    // otro estado de pago

            $estado->save();

            $estados=DB::table('comprobante')->where('idcuenta','=',$id)
            ->orderBy('created_at','asc')
            ->paginate(10);
        
            Session::flash('create',"El estado de cuenta de tipo -- ". $estado->estado. " -- se ha guardado correctamente");
            return view('estadoCuenta.show',["cliente"=>$cliente, "estados"=>$estados, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
        }
        elseif ($cliente->estadodos=="VENCIDO") {
            
            $estado= new Comprobante;

            $estado->idcuenta = $id;

            $estado->fechacomprobante = $request->get('fechaactual'); 
            
            $estado->diaspendientes = $request->get('diaspendiente');      
            $estado->totalpendiente = $request->get('totalpendiente');

            $estado->cuotadeuda = $request->get('cuotadeuda');         
            $estado->totalcuotasdeuda = $request->get('totalcuotadeuda');

            $estado->ultimacuota = $request->get('ultimacuota'); 

            $estado->diasexpirados = $request->get('diasexpirados');
            $estado->mora = $request->get('mora');        

            $estado->gastosadmon =  $request->get('gastosadmon');
            $estado->gastosnotariales = $request->get('gastosnoti');

            $estado->total = $request->get('total'); 

            $estado->montoactual = $request->get('monto');                

            $estado->diasatrasados = 0;                                     // aplica solo para estado normal
            $estado->totalcuotas = 0;                                       // aplica solo para estado normal
         
            $estado->estado='VENCIDO';                                   
            $estado->estadodos='NO CANCELADO';                                    

            $estado->save();

            $estados=DB::table('comprobante')->where('idcuenta','=',$id)
            ->orderBy('created_at','asc')
            ->paginate(10);
        
            Session::flash('create',"El estado de cuenta de tipo -- ". $estado->estado. " -- se ha guardado correctamente");
            return view('estadoCuenta.show',["cliente"=>$cliente, "estados"=>$estados, "fecha_actual"=>$fecha_actual, "usuarioactual"=>$usuarioactual]);
        }

    }


    /*
    Nombre: edit
    Objetivo: Formulario para actualizar estado de cuenta
    Autor: Oscar
    Fecha creación: 02-02-2018, 00:00
    Fecha modificacion: 13-04-2019, 08:57
    Parámetros de entrada: idcomprobante
    Parámetros de salida: estado de cuenta normal o vencido
     */
    public function edit($id)
    {
        $usuarioactual=\Auth::user();

        $estadoc = Comprobante::findOrFail($id);

        $cliente = DB::table('cuenta')
            ->join('comprobante as comprobante','cuenta.idcuenta','=','comprobante.idcuenta')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
            ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
            ->join('cartera as cartera','cliente.idcartera','=','cartera.idcartera')
            ->where('comprobante.idcomprobante','=',$id)
            ->select(
                'cuenta.idcuenta',
                'cuenta.interes',
                'negocio.nombre as nombreNegocio',
                'cliente.nombre',
                'cartera.nombre as nombreCartera', 
                'cliente.idcliente',
                'cliente.apellido',
                'cliente.dui',
                'cliente.nit',
                'cliente.direccion',
                'cliente.telefonocel',
                'cuenta.estado',
                'prestamo.cuotadiaria',
                'prestamo.estadodos')
            ->first();

        if ($estadoc->estado=="NORMAL") {
            return view('estadoCuenta.edit',["cliente"=>$cliente,"estadoc"=>$estadoc,"usuarioactual"=>$usuarioactual]); 
        }
        elseif ($estadoc->estado=="VENCIDO") {
             return view('estadoCuenta.vencido.edit',["cliente"=>$cliente,"estadoc"=>$estadoc,"usuarioactual"=>$usuarioactual]);
        }
    }

    /*
    Nombre: update
    Objetivo: metodo para guardar estado de cuenta actualizado
    Autor: Oscar
    Fecha creación: 02-02-2018, 00:00
    Fecha modificacion: 13-04-2019, 09:57
    Parámetros de entrada: idcomprobante
    Parámetros de salida: estado de cuenta normal o vencido
     */
    public function update(Request $request, $id)
    {	
        $usuarioactual=\Auth::user();

        $fecha_actual = Fecha::spanish();

        $cliente = DB::table('cuenta')
            ->join('comprobante as comprobante','cuenta.idcuenta','=','comprobante.idcuenta')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
            ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
            ->join('cartera as cartera','cliente.idcartera','=','cartera.idcartera')
            ->where('comprobante.idcomprobante','=',$id)
            ->select(
                'cuenta.idcuenta',
                'cuenta.interes',
                'negocio.nombre as nombreNegocio',
                'cliente.nombre',
                'cartera.nombre as nombreCartera', 
                'cliente.idcliente',
                'cliente.apellido',
                'cliente.dui',
                'cliente.nit',
                'cliente.direccion',
                'cliente.telefonocel',
                'cuenta.estado',
                'prestamo.cuotadiaria',
                'prestamo.estadodos')
            ->first();
        
        $estado = Comprobante::findOrFail($id);

        if($estado->estado=="NORMAL"){

            $estado->gastosadmon =  $request->get('gastosadmon');
            $estado->gastosnotariales = $request->get('gastosnoti');
            $estado->mora = 0.00;
            $estado->diasatrasados = $request->get('cuotasatrasadas');    // # cuotas atrasadas
            $estado->totalcuotas = $request->get('totalcuotas');          // valor monetario de cuotas atrasadas
            
            $estado->diaspendientes=0;      // aplica solamente para estados vencidos
            $estado->totalpendiente=0;      // aplica solamente para estados vencidos
            $estado->cuotadeuda=0;          // aplica solamente para estados vencidos
            $estado->totalcuotasdeuda=0;    // aplica solamente para estados vencidos
            $estado->ultimacuota=0;         // aplica solamente para estados vencidos
            $estado->diasexpirados=0;       // aplica solamente para estados vencidos

            $estado->montoactual = $request->get('monto');               // saldo capital
            $estado->total = $request->get('total');                    // total
            $estado->fechacomprobante = $request->get('fechaactual'); 
         
            $estado->estado='NORMAL';                                   // estado del comprobante

            $estado->update();

            $estados=DB::table('comprobante')->where('idcuenta','=',$estado->idcuenta)
            ->orderBy('created_at','asc')
            ->paginate(10);
        
            Session::flash('update',"El estado de cuenta de tipo -- ". $estado->estado. " -- se ha actualizado correctamente");

            return view('estadoCuenta.show',["cliente"=>$cliente,"estados"=>$estados, "fecha_actual"=>$fecha_actual,"usuarioactual"=>$usuarioactual]);
        }
        elseif ($cliente->estadodos=="VENCIDO") {

            $estado->fechacomprobante = $request->get('fechaactual'); 
            
            $estado->diaspendientes = $request->get('diaspendiente');      
            $estado->totalpendiente = $request->get('totalpendiente');

            $estado->cuotadeuda = $request->get('cuotadeuda');         
            $estado->totalcuotasdeuda = $request->get('totalcuotadeuda');

            $estado->ultimacuota = $request->get('ultimacuota'); 

            $estado->diasexpirados = $request->get('diasexpirados');
            $estado->mora = $request->get('mora');        

            $estado->gastosadmon =  $request->get('gastosadmon');
            $estado->gastosnotariales = $request->get('gastosnoti');

            $estado->total = $request->get('total'); 

            $estado->montoactual = $request->get('monto');                

            $estado->diasatrasados = 0;                                     // aplica solo para estado normal
            $estado->totalcuotas = 0;                                       // aplica solo para estado normal
         
            $estado->estado='VENCIDO';                                    

            $estado->update();

            $estados=DB::table('comprobante')->where('idcuenta','=',$estado->idcuenta)
            ->orderBy('created_at','asc')
            ->paginate(10);

            Session::flash('update',"El estado de cuenta de tipo -- ". $estado->estado. " -- se ha actualizado correctamente");
            return view('estadoCuenta.show',["cliente"=>$cliente,"estados"=>$estados, "fecha_actual"=>$fecha_actual,"usuarioactual"=>$usuarioactual]);
        }


    }

    /*
    Nombre: updateEstado
    Objetivo: metodo para actualizar el estado del pago
    Autor: Steven
    Fecha creación: 02-02-2018, 00:00
    Fecha modificacion: 13-04-2019, 10:55
    Parámetros de entrada: idcomprobante
    Parámetros de salida: estado de pago cancelado o no cancelado
     */
    public function updateEstado(Request $request){
        $usuarioactual=\Auth::user();

        $estado = Comprobante::where('idcomprobante',$request->get('idcomprobante'))->first();
        $estado->estadodos = $request->get('estadodos');
        $estado->update();

        Session::flash('update','Estado de pago -- '.$estado->estadodos.'  --  actualizado correctamente');
        return back();
    }

    /*
    Nombre: destroy
    Objetivo: metodo para eliminar estado de cuenta
    Autor: Oscar
    Fecha creación: 02-02-2018, 00:00
    Fecha modificacion: 13-04-2019, 10:59
    Parámetros de entrada: idcomprobante
    Parámetros de salida: estados de cuenta 
     */
    public function destroy($id)
    {
        $usuarioactual=\Auth::user();

        $estado = Comprobante::findOrFail($id);
        $estado->delete();
         Session::flash('delete',''.$estado->estado.'');
        return back();
    }

    /*
    Nombre: estadoPDF
    Objetivo: Metodo generar pdf de estados normal y vencido
    Autor: Jairo
    Fecha creación: 09-02-2018, 04:00
    Fecha modificacion: 12-04-2019, 18:33
    Parámetros de entrada: idcomprobante
    Parámetros de salida: pdf
     */
    public function estadoPDF($id)
    {
        
        $usuarioactual=\Auth::user();

        $estadoc = Comprobante::findOrFail($id);
        $cuenta = Cuenta::findOrFail($estadoc->idcuenta);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $negocio = Negocio::where('idnegocio',$cuenta->idnegocio)->first();
        $cliente = Cliente::where('idcliente',$negocio->idcliente)->first();

        // Tratamiento de la fecha del comprobante
        $hoy = Carbon::parse($estadoc->fechacomprobante)->format('d-m-Y');
        $hoi = explode("-", $hoy);
        $aniohoy = strtolower($hoi[2]);
        setlocale(LC_TIME, "spanish");
        $meshoy = $this -> obtenerMes($hoi[1]);
        $diahoy = $hoi[0];

        // tratamiento de la ultima fecha
        $ultimafecha = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
            ->orderby('iddetalleliquidacion','desc')
            ->first();

        if (!is_null($ultimafecha)){
            $ultima=$ultimafecha->fechadiaria->format('Y-m-d');
        }else{
            $ultima=0;
        }

        $fecfina = explode("-", $ultima);
        $diafe = $fecfina[2];
        $mesfe = $this -> obtenerMes($fecfina[1]);
        $aniofe = $fecfina[0];

        $liquidacion = new DetalleLiquidacion;
        $cont=0;
        $nuvfecha=date("Y-m-d",strtotime("$ultima + ".$cont." days "));
        $liquidacion->fechadiaria=$nuvfecha;

        if ($estadoc->estado=="NORMAL") {

            $vistaurl="reportes/estadoCuenta";
            $name = "EstadoCuenta".$id.$negocio->nombre.".pdf";
            return $this -> crearPDF1($vistaurl, $name, $diahoy, $meshoy, $aniohoy, $cliente, $negocio, $prestamo, $estadoc, $liquidacion);
        }
        elseif ($estadoc->estado=="VENCIDO") {
            
            $vistaurl="reportes/estadoCuentaVencido";
            $name = "EstadoCuentaVencido".$id.$negocio->nombre.".pdf";
            $subtotal=$estadoc->ultimacuota+$estadoc->totalcuotasdeuda+$estadoc->totalpendiente+$estadoc->mora;
            return $this -> crearPDF2($vistaurl, $name, $diahoy, $meshoy, $aniohoy, $cliente, $negocio, $prestamo, $estadoc, $liquidacion, $subtotal, $diafe, $mesfe, $aniofe);
        }
        
    }

    public function crearPDF1($vistaurl, $name, $diahoy, $meshoy, $aniohoy, $cliente, $negocio, $prestamo, $estadoc, $liquidacion)
    {
        
        $view=\View::make($vistaurl,compact('diahoy','meshoy','aniohoy','cliente','negocio','prestamo','estadoc','liquidacion'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

    public function crearPDF2($vistaurl, $name, $diahoy, $meshoy, $aniohoy, $cliente, $negocio, $prestamo, $estadoc, $liquidacion, $subtotal, $diafe, $mesfe, $aniofe){

        $view=\View::make($vistaurl,compact('diahoy','meshoy','aniohoy','cliente','negocio','prestamo','estadoc','liquidacion','subtotal','diafe','mesfe','aniofe'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);

    }

    public function obtenerMes($mess){
        switch ($mess) {
            case '1':
                $mes = 'Enero';
                break;
            case '2':
                $mes = 'Febrero';
                break;
            case '3':
                $mes = 'Marzo';
                break;
            case '4':
                $mes = 'Abril';
                break;
            case '5':
                $mes = 'Mayo';
                break;
            case '6':
                $mes = 'Junio';
                break;
            case '7':
                $mes = 'Julio';
                break;
            case '8':
                $mes = 'Agosto';
                break;
            case '9':
                $mes = 'Septiembre';
                break;
            case '10':
                $mes = 'Octubre';
                break;
            case '11':
                $mes = 'Noviembre';
                break;
            case '12':
                $mes = 'Diciembre';
                break;
            default:
                $mes = 'Error al obtener el mes';
                break;
        }
        return $mes;
    }
     
}