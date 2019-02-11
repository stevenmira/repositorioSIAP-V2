<?php

namespace siap\Http\Controllers;

use Illuminate\Http\Request;

use siap\Http\Requests;

use siap\Negocio;
use siap\Cartera;
use siap\Cliente;
use siap\Cuenta;
use siap\Prestamo;
use siap\TipoCredito;
use siap\Recibo;
use siap\DetalleLiquidacion;
use siap\Fecha;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use DB;

class RecordClienteController extends Controller
{
    public function index(Request $request)
    {
        

    	if($request)
    	{
            $usuarioactual=\Auth::user();

            //Obtenemos la fecha de hoy en español usando carbon y array
            $fecha_actual = Fecha::spanish();

    		$clientes = DB::table('cliente')->orderby('cliente.apellido','asc')->get();

    		$query = 0;
    		$query = $request->get('idcliente');
    		if ($query=="") {
    			$query = 0;
    		}

    		$cuentas = DB::table('cuenta as cuenta')
            ->select('cuenta.idcuenta', 'prestamo.idprestamo', 'tipo_credito.idtipocredito', 'cliente.idcliente', 'cliente.nombre', 'cliente.apellido','cliente.dui', 'cuenta.estado', 'prestamo.fecha', 'prestamo.monto', 'prestamo.cuotadiaria', 'prestamo.estado as estadoPrestamo', 'negocio.nombre as nombreNegocio', 'negocio.actividadeconomica')
            ->join('negocio as negocio','cuenta.idnegocio','=','negocio.idnegocio')
            ->join('prestamo as prestamo','cuenta.idprestamo','=','prestamo.idprestamo')
            ->join('tipo_credito as tipo_credito','cuenta.idtipocredito','=','tipo_credito.idtipocredito')
            ->join('cliente as cliente','negocio.idcliente','=','cliente.idcliente')
            ->where('negocio.idcliente','=',$query)
            ->orderBy('cuenta.idcuenta','desc')
    		->get();

    		return view('record.index',["clientes"=>$clientes, "fecha_actual"=>$fecha_actual, "query"=>$query, "cuentas"=>$cuentas])->with('usuarioactual',  $usuarioactual);

    	}

    }

    public function pagare($id)
    {

        $cuenta = Cuenta::findOrFail($id);
        $negocio = Negocio::where('idnegocio',$cuenta->idnegocio)->first();
        $nombre = Cliente::where('idcliente',$negocio->idcliente)->first();
        $prestamo = Prestamo::where('idprestamo',$cuenta->idprestamo)->first();
        $tipo = TipoCredito::where('idtipocredito',$cuenta->idtipocredito)->first();

        $entero = (string)$prestamo->monto+0.00001;

        $separ = explode(".", $entero);
        $monto = \NumeroALetras::convertir($separ[0]);

        $unaux = $separ[1];
        $sepa = substr($separ[1],-5,2);

        $sepa1 = \NumeroALetras::convertir($sepa);


        //Calculo de decimales
        $montoS = $prestamo->monto;
        $decimales=$montoS*100;
        $cadena = (string)$decimales;
        $dos = \NumeroALetras::convertir(substr($cadena, -2));

        $cuota = $prestamo->cuotadiaria;

        $monto_capital = $montoS; 
        $tasa_interes = $tipo->interes;
        $pagos_diarios = 10.0;
        $n=0;

        while($monto_capital>$cuota)
        {
            $n++;
            $interes_diario=round($monto_capital*$tasa_interes,2);
            $cuota_capital=round($cuota-$interes_diario,2);
            $monto_capital=$monto_capital-$cuota_capital;
        }


        $interes_diario=$monto_capital*$tasa_interes;
        $total=$monto_capital+ $interes_diario;


        $ultima = $prestamo->fechaultimapago;
        $auxfecha = explode("-",$ultima);

        $anioaux = $auxfecha[0];
        $mesaux = $auxfecha[1];
        $diaaux = $auxfecha[2];

        $mess = (string)$mesaux;

        $nuevomes = $this -> obtenerMes($mess);

        $fechanac = '1969-09-03';
        $anios = $this -> CalculaEdad($fechanac);
        $edad = strtolower(\NumeroALetras::convertir((int)$anios));

        $hoy = date("d-MM-Y");

        $hoi = explode("-", $hoy);

        $aniohoy = strtolower(\NumeroALetras::convertir($hoi[2]));
        
        setlocale(LC_TIME, "spanish");
        $meshoy = ucfirst(strftime("%B"));
        $diahoy = \NumeroALetras::convertir($hoi[0]);

        $expe = explode("-", $nombre->fechaexpedicion);
        $fechaex = $expe[2]."/".$expe[1]."/".$expe[0];

        $vistaurl = "reportes/pagare";
        $name = "Pagare".$negocio->nombre.$nombre->nombre.".pdf";

        $dui = $nombre->dui;
        $newdui = explode("-", $dui);
        $du1 = \NumeroALetras::convertir($newdui[0]);
        $du2 = \NumeroALetras::convertir($newdui[1]);

        $nit = $nombre->nit;
        $newnit = explode("-", $nit);
        $ni1 = \NumeroALetras::convertir($newnit[0]);
        $ni2 = \NumeroALetras::convertir($newnit[1]);
        $ni3 = \NumeroALetras::convertir($newnit[2]);
        $ni4 = \NumeroALetras::convertir($newnit[3]);

        $rest = substr($dui, -10, 1);

        $cent = explode(".",  (string) $entero);
        try {
            $soncen = $cent[1];
        } catch (\Exception $e) {
            $soncen = 0;   
        }

        $porce = ($tipo->interes)*100;
        $pornew = explode(".", (string)$porce);

        $porcenta1 = \NumeroALetras::convertir($pornew[0]);

        $porcenta2 = "";

        try {
            $por = $pornew[1];
            $porcenta2 = \NumeroALetras::convertir($pornew[1]);
        }catch (\Exception $e) {
            $por = 0;   
        }

        if ($total>$prestamo->cuotadiaria) {
            $n++;
            $total=$total-$prestamo->cuotadiaria;
        }

        if($total!=0)
        {
            $n1 = \NumeroALetras::convertir($n+1);
        }
        else{
            $n1 = \NumeroALetras::convertir($n); 
        }
        
        $n2 = \NumeroALetras::convertir($n); 

        $otronue = (float)$cuota/100;
        $excuota = explode(".", (string)$otronue*100);
        $exculet = \NumeroALetras::convertir($cuota);
        $excuota1 = \NumeroALetras::convertir($excuota[0]);
        $longi = sizeof($excuota);

        if ($longi==2) {
            $excuota2 = \NumeroALetras::convertir($excuota[1]);
        }else{
            $excuota2 = "";
        }

        $extota = explode(".", round($total,2));

        $extoe = \NumeroALetras::convertir(round($total,2));

        $extota1=\NumeroALetras::convertir((string)$extota[0]);

        $logto = sizeof($extota);

        if ($logto==2) {
            $extota2 = \NumeroALetras::convertir((string)$extota[1]);
        }else{
            $extota2 = "";
        }

        $diaaus = \NumeroALetras::convertir($diaaux);
        $nuevomess = \NumeroALetras::convertir($nuevomes);
        $anius = \NumeroALetras::convertir($anioaux);

        $aummile = $cuota+0.00001;
        $explo = explode(".",(string)$aummile);

        $cuo1 = \NumeroALetras::convertir($explo[0]);

        $exxxx = substr($explo[1],-5,2);
        $cuo2 = \NumeroALetras::convertir($exxxx);


        return $this -> crearPDF($vistaurl,$name,$nombre,$monto,$decimales,$dos,$cuenta,$n,$prestamo,$total,$anioaux,$mesaux,$diaaux,$nuevomes,$edad,$aniohoy,$meshoy,$diahoy,$tipo,$fechaex,$du1,$du2,$ni1,$ni2,$ni3,$ni4,$newdui,$newnit,$rest,$dui,$nit,$soncen,$cent,$porcenta1,$porcenta2,$por,$n1,$n2,$exculet,$longi,$excuota2,$extoe,$logto,$extota2,$diaaus,$nuevomess,$anius,$extota1,$sepa1,$sepa,$explo,$cuo2,$exxxx,$cuo1);
    }

    public function crearPDF($vistaurl,$name,$nombre,$monto,$decimales,$dos,$cuenta,$n,$prestamo,$total,$anioaux,$mesaux,$diaaux,$nuevomes,$edad,$aniohoy,$meshoy,$diahoy,$tipo,$fechaex,$du1,$du2,$ni1,$ni2,$ni3,$ni4,$newdui,$newnit,$rest,$dui,$nit,$soncen,$cent,$porcenta1,$porcenta2,$por,$n1,$n2,$exculet,$longi,$excuota2,$extoe,$logto,$extota2,$diaaus,$nuevomess,$anius,$extota1,$sepa1,$sepa,$explo,$cuo2,$exxxx,$cuo1)
    {

        $view=\View::make($vistaurl,compact('nombre','monto','decimales','dos','cuenta','n','prestamo','total','anioaux','mesaux','diaaux','nuevomes','edad','aniohoy','meshoy','diahoy','tipo','fechaex','du1','du2','ni1','ni2','ni3','ni4','newdui','newnit','rest','dui','nit','soncen','cent','porcenta1','porcenta2','por','n1','n2','excu2','excuota2','exculet','longi','excuota2','extoe','logto','extota2','diaaus','nuevomess','anius','extota1','sepa1','sepa','explo','cuo2','exxxx','cuo1'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($name);
    }

    public function recibo ($id){
    
        $usuarioactual=\Auth::user();
        $cuenta = Cuenta::findOrFail($id);
        $negocio = Negocio::where('idnegocio',$cuenta->idnegocio)->first();
        $cliente = Cliente::where('idcliente',$negocio->idcliente)->first();
        $reciboAct = Recibo::where('estado','ACTIVO')->first();

        try {
            $saldoact = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
            ->orderby('iddetalleliquidacion','asc')
            ->where('estado','=','PENDIENTE')->orwhere('estado','=','ATRASO')->first();
            if ($saldoact->monto==NULL) {
                $salmon=0;
            }else{
                $salmon=$saldoact->monto;}
        } catch (\Exception $e) {
            $salmon = 0;
        }


        $cuotasatrasadas = DB::table('detalle_liquidacion')->where([
                ['estado', '=', 'ATRASO'],
                ['idcuenta', '=', $id],
                ])->count();

        return view('reportes.menuRecibo',["cuenta"=>$cuenta,"negocio"=>$negocio,"cliente"=>$cliente,'reciboAct'=>$reciboAct,"cuotasatrasadas"=>$cuotasatrasadas,"salmon"=>$salmon])->with('usuarioactual',  $usuarioactual);
    }

    public function show (Request $request){

        $idcuenta = $request->get('idcuenta');
        $cobro = (float) $request->get('cobro');
        $recargo = (float) $request->get('recargo');
        $abonoA = $request->get('abonoA');
        $abonoB = (float) $request->get('abonoB');
        $compleA = $request->get('compleA');
        $compleB = (float) $request->get('compleB');
        $cuotaA = $request->get('cuotaA');
        $cuotaB = (float) $request->get('cuotaB');
        $gastos = (float) $request->get('gastos');
        $desc = $request->get('desc');

        $numeri = $request->get('recibo');
        $idrecibo = $request->get('idrecibo');
        $recibo = Recibo::where('idrecibo',$idrecibo)->first();

        $cuotasatrasadas = $request->get('cuotasatrasadas');

        $cuenta = Cuenta::findOrFail($idcuenta);
        $negocio = Negocio::where('idnegocio',$cuenta->idnegocio)->first();
        $cliente = Cliente::where('idcliente',$negocio->idcliente)->first();
        $prestamo = Prestamo::where('idprestamo',$cuenta->idprestamo)->first();
        $tipo = TipoCredito::where('idtipocredito',$cuenta->idtipocredito)->first();


        $pretotal = (float)$cobro + (float)$recargo  + (float)$abonoB  + (float)$compleB + (float)$cuotaB + (float)$gastos;

        $hoy = date('d/m/y');

        try{
            DB::beginTransaction();

            $reciboAnt = Recibo::where('estado','ACTIVO')->first();

            $reciboAnt->numerico = $numeri+1;
            $reciboAnt->estado = 'ACTIVO'; 
            $reciboAnt->update();

            Session::flash('update', ' '.$reciboAnt->numerico.' '.$reciboAnt->estado.' ');
                            
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('error', ''.' No se pudo actualizar el recibo, algo salió mal');

        }       

        $vistaurl = "reportes.recibo";

        $nombre = "Recibo".$numeri.$cliente->nombre.$cliente->apellido.$negocio->nombre;

        $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
        ->orderby('iddetalleliquidacion', 'asc');

        $atraso = 0;

        foreach ($liquidaciones as $liq) {

            if ($liq->estado == 'ATRASO') {
                $atraso = $atraso + 1;
            }

        }

        try {
            $saldoact = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
            ->orderby('iddetalleliquidacion','asc')
            ->where('estado','=','PENDIENTE')->orwhere('estado','=','ATRASO')->first();
            if ($saldoact->monto==NULL) {
                $salmon=0;
            }else{
                $salmon=$saldoact->monto;}
        } catch (\Exception $e) {
            $salmon = 0;
        }

        $salmon = $request->get('salmon');

        return $this -> crearPDFRecibo($vistaurl,$cliente,$tipo,$cuenta,$prestamo,$negocio,$cobro,$recargo,$abonoA,$abonoB,$compleA,$compleB,$cuotaA,$cuotaB,$gastos,$pretotal,$desc,$numeri,$hoy,$idrecibo,$atraso,$salmon,$cuotasatrasadas,$nombre);
    }

    public function crearPDFRecibo ($vistaurl,$cliente,$tipo,$cuenta,$prestamo,$negocio,$cobro,$recargo,$abonoA,$abonoB,$compleA,$compleB,$cuotaA,$cuotaB,$gastos,$pretotal,$desc,$numeri,$hoy,$idrecibo,$atraso,$salmon,$cuotasatrasadas,$nombre) {

        $view=\View::make($vistaurl,compact('cliente','tipo','cuenta','prestamo','negocio','cobro','recargo','abonoA','abonoB','compleA','compleB','cuotaA','cuotaB','gastos','pretotal','desc','numeri','hoy','idrecibo','atraso','salmon','cuotasatrasadas'))->render();
        $pdf =\App::make('dompdf.wrapper');

        $pdf->loadHTML($view);
        return $pdf->stream($nombre.".pdf");

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

    public function CalculaEdad( $fecha ) {
        list($Y,$m,$d) = explode("-",$fecha);
        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }

}