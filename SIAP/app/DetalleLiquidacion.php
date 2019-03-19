<?php

namespace siap;

use Jenssegers\Date\Date;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon; //Para la zona fecha horaria

use siap\Cuenta;
use siap\Prestamo;

use Illuminate\Support\Facades\Session;

use DB;

class DetalleLiquidacion extends Model
{
    protected $table = 'detalle_liquidacion';

    
    protected $primaryKey='iddetalleliquidacion';

    protected $fillable = [

        'idcuenta', 'fechadiaria', 'fechaefectiva', 'monto', 'interes', 'cuotacapital', 'totaldiario', 'abonocapital', 'estado', 'contador', 'created_at', 'updated_at'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    //Relacion con tabla Cuenta
    public function cuenta(){
        return $this->belongsTo(Cuenta::class);
    }
    //Relacion con tabla Usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cartera(){
        return $this->belongsTo(Cartera::class);
    }

    public function getFechadiariaAttribute($date)
    {
        if ($date != null) {
            return new Date($date);
        }
    }

    public function getFechaefectivaAttribute($date)
    {
        if ($date != null) {
            return new Date($date);
        }
        
    }

    public function getCreatedAtAttribute($date)
    {
        if ($date != null) {
            return new Date($date);
        }
        
    }

    public function getUpdatedAtAttribute($date)
    {
        if ($date != null) {
            return new Date($date);
        }
        
    }

    /*
    Nombre: calculoModificadoN
    Objetivo: Actualiza los calculos de todas las liquidaciones de un prestamo (cuenta)
    Autor: Steven
    Fecha creación: 11-03-2019, 21:33
    Fecha modificacion: 11-03-2019, 21:33
    Parámetros de entrada: idcuenta
    Parámetros de salida: actualizado: monto, interes, totaldiario y cuotacapital
     */

    #public static function calculoN_modificadoX($idcuenta)
    public static function calculoModificadoN($idcuenta)
    {
        $usuarioactual=\Auth::user();

        try{
            DB::beginTransaction();

            //Encontramos la cuenta con sus repectivas relaciones
            $cuenta = Cuenta::findOrFail($idcuenta);
            $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
            $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

            $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
            ->orderby('iddetalleliquidacion', 'asc')
            ->get();

            $monto_capital = $prestamo->monto;          //  $313.50
            $pivote = 0;                               //   $10


            foreach ($liquidaciones as $liq) {

                if($liq->abonocapital == "NO") {

                  $liq->monto = round($monto_capital, 2);
                  $liq->interes = round($monto_capital * $tipo_credito->interes, 2);    // 3.14
                  $liq->totaldiario = round($liq->totaldiario, 2);                      // 10
                  $liq->cuotacapital = round($liq->totaldiario - $liq->interes,2);      // 6.86
                  $liq->update();

                  $monto_capital = $liq->monto - $liq->cuotacapital;

                }
                elseif($liq->abonocapital == "SI"){

                    $liq->monto = round($monto_capital,2);
                    $liq->update();

                    $monto_capital = $liq->monto - $liq->totaldiario;

                }else{                                              // Modificamos la siguiente tupla

                    if ($monto_capital >= $pivote) {               // Cuando el monto_capital es cero
                        $liq->monto = round($monto_capital,2);
                        $liq->abonocapital = 'pivote';
                        $liq->update();

                        $pivote = 9999999999999999.999; //cualquier valor
                    }
                    else{
                        $liq->monto = null;
                        $liq->abonocapital = null;
                        $liq->update();
                    }
            
                }  

            }

            DB::commit();
            $msj = 'exito';

        } catch(\Exception $e)
        {
            DB::rollback();
            $msj = 'calculoModificadoN';
        }

        return $msj;
    }


    /*
    Nombre: actualizarNoValido
    Objetivo: Calcula el estado de las cuotas, Pendientes, Atrasadas, No Valido
    Autor: Steven
    Fecha creación: 11-03-2019, 21:20
    Fecha modificacion: 14-03-2019, 13:51
    Parámetros de entrada: idcuenta 
    0: actualiza cuotas que no se han cancelado o abonado, en los estados: pendiente, atraso y no valido
    1: actualiza solo las cuotas no valido
    Parámetros de salida: estado de cuotas actualizado
     */

    #public static function estados_cuotas($idcuenta)
    public static function actualizarEstados($idcuenta, $actual)
    {
        //Obtenemos la fecha de hoy
        $fecha_actual = Carbon::now();
        $fecha_actual = $fecha_actual->format('Y-m-d');

        //Obtenemos el detalle_liquidacion a modificar
        $cuenta = Cuenta::findOrFail($idcuenta);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

        $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
        ->orderby('iddetalleliquidacion', 'asc')
        ->get();

        $monto_capital = $prestamo->monto;
        $n=0;

        //Se valida el prestamo y la cuenta

        if ($prestamo->estadodos == 'CERRADO'){
            return "prestamo_cerrado";
        }

        if ($cuenta->estado == 'INACTIVO'){
            return "cuenta_inactiva";
        }

        // Se procede a calular las cuotas "NO VALIDO"

        if ($prestamo->estadodos == 'ACTIVO' || $prestamo->estadodos == 'VENCIDO') {
            
        
                foreach ($liquidaciones as $liq) 
                {
                    if ($liq->abonocapital == "NO") {
                        $monto_capital = $liq->monto - $liq->cuotacapital;
                    
                    }
                    elseif($liq->abonocapital == "SI")
                    {
                        $monto_capital = $liq->monto - $liq->totaldiario;
                    }

                    else 
                    {
                        if($monto_capital > 0)
                        {
                            // Actualiza las cuotas a la fecha actual
                            if ($actual == 0) 
                            {
                                if ($liq->fechadiaria >= $fecha_actual) {
                                    $liq->estado = 'PENDIENTE';
                                    $liq->update();
                                }elseif ($liq->fechadiaria < $fecha_actual) {
                                    $liq->estado = 'ATRASO';
                                    $liq->update();
                                }
                            }
                                

                            $intereses = round($monto_capital * $tipo_credito->interes, 2);
                            $cuotacapital = round($prestamo->cuotadiaria - $intereses, 2);  //podria haberse dejado a cero
                            $monto_capital = $monto_capital - $cuotacapital;
                            $n = $n +1;

                        }else{
                            $liq->estado = 'NO VALIDO';
                            $liq->update();
                        }
                    }


                }
        }
        
        return "exito";

    }


    /*
    Nombre: estadoCuentaRef
    Objetivo: Obtener los saldos de la cuenta anterior, dado un nuevo refinanciamiento
    Autor: Steven
    Fecha creación: 11-03-2019, 21:37
    Fecha modificacion: 11-03-2019, 21:37
    Parámetros de entrada: idcuenta, $tipo
    Parámetros de salida: cuotaatrasada, capitalanterior, mora, estadocuenta
     */
    public static function estadoCuentaRef($idcuenta,$tipo)
    {

        $cuenta = Cuenta::where('idcuenta', $idcuenta)->first();
        $prestamo = Prestamo::where('idprestamo',$cuenta->idprestamo)->first();

        //Obtenemos la fecha de hoy
        $fecha_actual = Carbon::now();

        $cuentaRes = new Cuenta;

        //se pregunta por el estado del prestamo

        if ($prestamo->estadodos=='CERRADO') {
            $cuentaRes->cuotaatrasada = 0;
            $cuentaRes->capitalanterior = 0;
            $cuentaRes->mora = 0; 
        }
        elseif ($prestamo->estadodos=='VENCIDO') {
            $cuotas = DetalleLiquidacion::where('idcuenta', $idcuenta)->where('estado', '=', 'ATRASO')->count();

            // calculo de la mora
            $liqui = DetalleLiquidacion::where('idcuenta',$idcuenta)->where('abonocapital','pivote')->first();

            $fechaActual = Carbon::now();
            $fechaNoPaga = Carbon::parse($liqui->fechadiaria);
            $diasExpirados=$fecha_actual->diffInDays($fechaNoPaga);
            $mora = round($liqui->monto * $cuenta->interes * $diasExpirados,2);

            $cuentaRes->cuotaatrasada = $cuotas;
            $cuentaRes->capitalanterior = $liqui->monto;
            $cuentaRes->mora = $mora;
        }
        elseif ($prestamo->estadodos=='ACTIVO') {

            $fecha_actual = $fecha_actual->format('Y-m-d');

            $cuotasAtrasada = DetalleLiquidacion::where('idcuenta', $idcuenta)->where('estado', '=', 'ATRASO')->count();
            $liquiPivote = DetalleLiquidacion::where('idcuenta',$idcuenta)->where('abonocapital','pivote')->first();
            
            //Se comprueba que la cuota este en el rango de fecha del crédito
            $liqui = DetalleLiquidacion::where('idcuenta',$idcuenta)->where('fechadiaria',$fecha_actual)->first();
            if (is_null($liqui)) {
                return $cuentaRes->estadocuenta = "PRESTAMO_VENCIDO";
            }

            // Se toma de base el estado de la cuota de hoy
            // Se compueba que no haya cuotas atrasadas
            if ($cuotasAtrasada == 0) {
                if ($liqui->estado == "PENDIENTE") {
                    $cuotaHoy = 1;
                    $cuentaRes->cuotaatrasada = $cuotaHoy;
                    $cuentaRes->capitalanterior = $liqui->monto;
                    $cuentaRes->mora = 0;
                    $cuentaRes->estadocuenta = $liqui->estado;
                }elseif ($liqui->estado == "CANCELADO") {
                    $cuentaRes->cuotaatrasada = 0;
                    $cuentaRes->capitalanterior = $liquiPivote->monto;
                    $cuentaRes->mora = 0;
                    $cuentaRes->estadocuenta = $liqui->estado;
                }elseif ($liqui->estado == "NO VALIDO") {
                    $cuentaRes->cuotaatrasada = 0;
                    $cuentaRes->capitalanterior = 0;
                    $cuentaRes->mora = 0;
                    $cuentaRes->estadocuenta = $liqui->estado;
                }
            }
            elseif ($liqui->estado == "ATRASO") {
                $cuentaRes->cuotaatrasada = $cuotasAtrasada;
                $cuentaRes->capitalanterior = $liquiPivote->monto;
                $cuentaRes->mora = 0;
                $cuentaRes->estadocuenta = $liqui->estado;
            }
            elseif ($liqui->estado == "NO VALIDO") {
                $cuentaRes->cuotaatrasada = $cuotasAtrasada;;
                $cuentaRes->capitalanterior = $liquiPivote->monto;
                $cuentaRes->mora = 0;
                $cuentaRes->estadocuenta = $liqui->estado;
            }
            else{
                $cuentaRes->estadocuenta = "Revise los pagos";
            }

        }


        if ($tipo == 1) {
            return $cuentaRes->cuotaatrasada;
        }
        elseif ($tipo == 2) {
            return $cuentaRes->capitalanterior;
        }
        elseif ($tipo == 3) {
            return $cuentaRes->mora;
        }elseif ($tipo == 4) {
            return $cuentaRes->estadocuenta;
        }
        
    }

    /*
    Nombre: cuotasAtrasadas
    Objetivo: Obtiener el total de cuotas atrasadas de un prestamo (cuenta)
    Autor: Steven
    Fecha creación: 11-03-2019, 21:40
    Fecha modificacion: 11-03-2019, 21:40
    Parámetros de entrada: idcuenta
    Parámetros de salida: cuotas
     */
    public static function cuotasAtrasadasX($idcuenta)
    {
        
        $cuotas = DetalleLiquidacion::where('idcuenta', $idcuenta)->where('estado', '=', 'ATRASO')->count();

        if (is_null($cuotas)) {
            return 0;
        } else {
            return $cuotas;
        }
    }

    /*
    Nombre: proyeccionCarteraPago
    Objetivo: Proyecta la cartera de pagos a partir del ultimo saldo capital del préstamo
    Autor: Steven
    Fecha creacion: 11-03-2019, 21:13
    Fecha modificacion: 11-03-2019, 21:13
    parámetros de entrada: idcuenta
    parámetros de salida: Liquidaciones (Real y Proyectada)
     */
    public static function proyeccionCarteraPago($idcuenta)
    {
        //funcion para actualizar la tabla

        $usuarioactual=\Auth::user();

        //Encontramos la cuenta con sus repectivas relaciones
        $cuenta = Cuenta::findOrFail($idcuenta);
        $prestamo = Prestamo::findOrFail($cuenta->idprestamo);
        $tipo_credito = TipoCredito::findOrFail($cuenta->idtipocredito);

        $liquidaciones = DetalleLiquidacion::where('idcuenta','=',$cuenta->idcuenta)
        ->orderby('iddetalleliquidacion', 'asc')
        ->get();

        $monto_capital = $prestamo->monto;          //  $313.50

        foreach ($liquidaciones as $liq) {

            if($liq->abonocapital == "NO") {

              $liq->monto = round($monto_capital, 2);
              $liq->interes = round($monto_capital * $tipo_credito->interes, 2);    // 3.14
              $liq->totaldiario = round($liq->totaldiario, 2);                      // 10
              $liq->cuotacapital = round($liq->totaldiario - $liq->interes,2);      // 6.86

              $monto_capital = $liq->monto - $liq->cuotacapital;

            }
            elseif($liq->abonocapital == "SI"){

                $liq->monto = round($monto_capital,2);

                $monto_capital = $liq->monto - $liq->totaldiario;

            }else{                                                                        // Modificamos la siguiente tupla

                if ($monto_capital > $prestamo->cuotadiaria) {
                    $liq->monto = round($monto_capital, 2);                               // 136.96
                    $liq->interes = round($monto_capital * $tipo_credito->interes, 2);    // 1.37
                    $liq->totaldiario = $prestamo->cuotadiaria;                           // 10
                    $liq->cuotacapital = round($liq->totaldiario - $liq->interes,2);      // 8.63

                    $monto_capital = $liq->monto - $liq->cuotacapital;                     // 128.33
                }
                elseif ($monto_capital <= $prestamo->cuotadiaria && $monto_capital > 0) {
                    $liq->monto = round($monto_capital, 2);                                // 8.00
                    $liq->interes = round($monto_capital * $tipo_credito->interes, 2);     // 0.08
                    $liq->cuotacapital = $liq->monto;                                      // 8.00
                    $liq->totaldiario = round($liq->interes + $liq->cuotacapital,2);       // 8.08

                    $monto_capital = $liq->monto - $liq->cuotacapital;                      // 0.00
                }
            }  

        }

        return $liquidaciones;
    }

    /*
    Nombre: calculoDetalleLiquidacion
    Objetivo: inserta la tuplas correspondientes a cada cuota de pago del credito.
    Autor: Lexan
    parámetros de entrada: monto, cuota, tipo del credito y ID de cliente
    parámetros de salida: ninguno
     */
    public static function calculoDetalleLiquidacion($montoCapital, $tipoCredito, $cuota, $idPrestamo,$Date)
    {
        
        $usuarioactual = \Auth::user();
        $nuevoTipoCredito = TipoCredito::where('idtipocredito', $tipoCredito)->first();
        $fechaDos= Carbon::parse($Date);
        $cuenta = Cuenta::where('idprestamo',$idPrestamo)->first();
        //incluye tupla de fecha de creacion para las carteras de pagos
        
        $fecha = $fechaDos;
        $interesDiario = $montoCapital * $nuevoTipoCredito->interes;
        $cuotaCapital = $montoCapital;
        
        $detalleLiquidacion = new DetalleLiquidacion;
        $count = 1;
        $detalleLiquidacion->idcuenta = $cuenta->idcuenta; 
        $detalleLiquidacion->fechadiaria = $fecha->format('Y-m-d');
        $detalleLiquidacion->estado = "PENDIENTE";
        $detalleLiquidacion->idusuario = $usuarioactual->idusuario;
        $detalleLiquidacion->contador = $count;
        $detalleLiquidacion->save();

        while ($montoCapital > $cuota) {
            $count++;
            $cuotaCapital = $cuota - $interesDiario;

            $montoCapital = $montoCapital - $cuotaCapital;
            $interesDiario = $montoCapital * $nuevoTipoCredito->interes;

            $detalleLiquidacion = new DetalleLiquidacion;

            $detalleLiquidacion->idcuenta = $cuenta->idcuenta;
            $fechadiaria = $fecha->addDay();
            $detalleLiquidacion->fechadiaria = $fechadiaria->format('Y-m-d');
         
            $detalleLiquidacion->estado = "PENDIENTE";
            $detalleLiquidacion->idusuario = $usuarioactual->idusuario;
            $detalleLiquidacion->contador = $count;
           
            $detalleLiquidacion->save();
            
        }

        //guarda la ultima fecha de pago
        $prestamo = Prestamo::where('idprestamo',$idPrestamo)->first();
        $prestamo->fechaultimapago=$detalleLiquidacion->fechadiaria;
        $prestamo->update();

        return $cuenta->idcuenta;
    }

}
