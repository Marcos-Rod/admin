<?php

namespace App;

class Functions
{

    //fecha actual
    public static function hoy($format = "Y-m-d H:i:s")
    {
        date_default_timezone_set('America/Mexico_City');
        return date($format, time());
    }

    public static function sumTime($time, $format = "H:i:s")
    {
        $time = new \DateTime($time);
        $time->modify('+30 minute');

        return $time->format($format);
    }

    public static function intervaloHora($hora_inicio, $hora_fin, $intervalo = 20)
    {

        $hora_inicio = new \DateTime($hora_inicio);
        $hora_fin    = new \DateTime($hora_fin);
        $hora_fin->modify('+1 second'); // Añadimos 1 segundo para que nos muestre $hora_fin

        // Si la hora de inicio es superior a la hora fin
        // añadimos un día más a la hora fin
        if ($hora_inicio > $hora_fin) {

            $hora_fin->modify('+1 day');
        }

        // Establecemos el intervalo en minutos        
        $intervalo = new \DateInterval('PT' . $intervalo . 'M');

        // Sacamos los periodos entre las horas
        $periodo   = new \DatePeriod($hora_inicio, $intervalo, $hora_fin);

        foreach ($periodo as $hora) {

            // Guardamos las horas intervalos 
            $horas[] =  $hora->format('H:i:s');
        }

        return $horas;
    }

    public static function fechaFormateada($fecha = "")
    {
        if ($fecha == "")
            return false;

        $arr_fechafull = explode(" ", $fecha);

        $arr_fecha = explode("-", $arr_fechafull[0]);

        $arr_dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
        $arr_meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

        return $arr_dias[$arr_fecha[2]] . " " . $arr_fecha[2] . " de " . $arr_meses[$arr_fecha[1] - 1] . " del " . $arr_fecha[0];
    }

    public static function formatoFecha($fecha, $formato = "Y-m-d")
    {

        $fecha = new \DateTime($fecha);
        $formatoFecha = $fecha->format($formato);

        return $formatoFecha;
    }

    public static function encrypt($string, $key)
    {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }

        return base64_encode($result);
    }

    public static function decrypt($string, $key)
    {
        $result = '';
        $string = base64_decode($string);
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        return $result;
    }

    public static function generatePassword($password)
    {
        return password_hash(trim($password), PASSWORD_DEFAULT);
    }

    public static function uploadFile($file = array(), $dir = "")
    {
        $aleatorio = md5(uniqid(rand(), true));
        $strUnica = substr($aleatorio, 0, 5);
        $name_file = $strUnica . '-' . $file['name'];

        $temp = $file['tmp_name'];

        if (!is_dir($dir))
            mkdir($dir, 0777, true);
        
        //Subir archivo al servidor
        if (!move_uploaded_file($temp, $dir . $name_file))
            return false;

        return $name_file;
    }

    public static function showErrors($status = 0)
    {
        if (intval($status) == 1) {
            ini_set('display_errors', 'on');
            ini_set('log_errors', 'on');
            ini_set('display_startup_errors', 'on');
            ini_set('error_reporting', E_ALL);
        } else {
            error_reporting(0);
        }
        return true;
    }
    
}
