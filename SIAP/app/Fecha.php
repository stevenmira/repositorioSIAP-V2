<?php

namespace siap;
use Carbon\Carbon; //Para la zona fecha horaria

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    public static function spanish()
    {
    	$fecha_actual = Carbon::now();
        $fecha_actual = $fecha_actual->format('d-m-Y');

    	$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        
        $fecha_actual =  $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');

        return $fecha_actual;
    }

    public static function calcularEdad($fechanacimiento){
        $final = $fechanacimiento; //Fecha base de datos
        $hoy = \Carbon\Carbon::now(); //fecha actual
        $fecha_ingreso = \Carbon\Carbon::createFromFormat('Y-m-d', $final);

        $diff = $hoy->diffInYears($fecha_ingreso); //diferencia en años

        return $diff;

    }

    /*public static function calcularEdad1($fechanacimiento){
        $hoy = date('Y-m-d');
        $diff = abs(strtotime($hoy) - strtotime($fechanacimiento));
        $years = floor($diff / (365*60*60*24));
        #$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        #$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        return $years;
    }

    public static function calcularEdad2($fecha){
        $fecha = \Carbon\Carbon::parse($fecha);
        $fecha = strtotime($fecha);
        $anio = date("Y", $fecha);
        $mes = date("m", $fecha);
        $dia = date("d", $fecha);

        $edad = Carbon::createFromDate($anio,$dia,$mes)->age;

        return $edad;
    }*/

}
