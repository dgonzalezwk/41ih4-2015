<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use Yii;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppDate
{
    public static $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    public static $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    public static $mesesCortos = array('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
    public static $mesesIngles = array('January','February','March','April','May','June','July','August','September','October','November','December');

    /**
     * @return string
     */
    public static function date()
    {
        #Se setea el meridiano para generar la fecha y hora actual
        date_default_timezone_set('America/Bogota');
        return date('Y-m-d');
    }

    public static function dateTime()
    {
        #Se setea el meridiano para generar la fecha y hora actual
        date_default_timezone_set('America/Bogota');
        return date('Y-m-d h:i a');
    }

    /**
     * @return string
     */
    public static function stringToDate( $stringDate , $formatDate )
    {
        date_default_timezone_set('America/Bogota');
        setlocale(LC_ALL,"es_CO");

        $format = Yii::$app->params['formatDbDate'];
        if ( $formatDate != null ) {
            $format = $formatDate;
        }
        if ($stringDate!=null && trim($stringDate)!='') {
            if ($format == Yii::$app->params['formatDbDate']) {
                $arrayPartesFecha = explode(' ', $stringDate);
                if ( count($arrayPartesFecha) == 3 ) {

                    if (in_array( $arrayPartesFecha[1] , AppDate::$mesesCortos , true )) {
                        $index = array_search($arrayPartesFecha[1],AppDate::$mesesCortos);
                        if ( $index <=8 ) {
                            return date( $format , strtotime(''.$arrayPartesFecha[2].'-0'.($index+1).'-'.$arrayPartesFecha[0].'') );
                        } else if ( $index >=9 ) {
                            return date( $format , strtotime(''.$arrayPartesFecha[2].'-'.($index+1).'-'.$arrayPartesFecha[0].'') );
                        }
                    } else if (in_array( $arrayPartesFecha[1] , AppDate::$meses , true )) {
                        $index = array_search($arrayPartesFecha[1],AppDate::$meses);
                        if ( $index <=8 ) {
                            return date( $format , strtotime(''.$arrayPartesFecha[2].'-0'.($index+1).'-'.$arrayPartesFecha[0].'') );
                        } else if ( $index >=9 ) {
                            return date( $format , strtotime(''.$arrayPartesFecha[2].'-'.($index+1).'-'.$arrayPartesFecha[0].'') );
                        }
                    }else{
                        if ( is_numeric($arrayPartesFecha[1]) && intval($arrayPartesFecha[1])<=12 ) {
                           if ( intval($arrayPartesFecha[1]) <=9 ) {
                                return date( $format , strtotime(''.$arrayPartesFecha[2].'-0'.(intval($arrayPartesFecha[1])+1).'-'.$arrayPartesFecha[0].'') );
                            } else if ( intval($arrayPartesFecha[1]) >=10 ) {
                                return date( $format , strtotime(''.$arrayPartesFecha[2].'-'.(intval($arrayPartesFecha[1])+1).'-'.$arrayPartesFecha[0].'') );
                            }
                        }
                    }
                }
            } else if ( $format == Yii::$app->params['formatViewDate'] ) {

                $arrayPartesFecha = explode('-', $stringDate );
                if ( count($arrayPartesFecha) == 3 ) {
                    $index = intval( $arrayPartesFecha[1] );
                    $mes = AppDate::$meses[ ( $index - 1 ) ]; 
                    return $arrayPartesFecha[2].' '.$mes.' '.$arrayPartesFecha[0];
                } else {
                    return date( $format , strtotime($stringDate) );
                }
            } else if ($format == Yii::$app->params['formatViewDatePicker']) {

                $arrayPartesFecha = explode('-', $stringDate );
                if ( count($arrayPartesFecha) == 3 ) {
                    if (in_array($arrayPartesFecha[1], AppDate::$mesesIngles)) {
                        $index = array_search($arrayPartesFecha[1],AppDate::$mesesIngles);
                        if ( $index != false ) {
                            $mes = AppDate::$mesesCortos[$index];
                        }
                    }
                    return $arrayPartesFecha[0].'-'.$mes.'-'.$arrayPartesFecha[2];
                } else {
                    return date( $format , strtotime($stringDate) );
                }
            } else {

                return date( $format , strtotime($stringDate) );
            }
        }else{
            return null;
        }
    }

    public static function getTimeMeridanToTime( $stringTimeMeridian )
    {
        return date( Yii::$app->params['formatDbTime'] , strtotime( $stringTimeMeridian ) );
    }

    public static function getTimeToTimeMeridan( $stringTime )
    {
        return date( Yii::$app->params['formatViewTime'] , strtotime( $stringTime ) );
    }
}