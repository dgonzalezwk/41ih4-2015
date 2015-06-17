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
class AppHandlingErrors
{
    /**
     * @return string
     */
    public static function getStringErrorModel( $arrayErrors )
    {
        $stringError = ' - ' ;
        foreach ($arrayErrors as $key => $error) {
            if ( is_array( $error ) ) {
                $stringError .=  implode(",", $error ) . ' - ';
            } else if ( is_string( $error ) ) {
                $stringError .=  $error . ' - ';
            }
        }
    }

    public static function setFlash( $stringType , $stringMenssage )
    {
        
        if ( $stringType == 'success' ) {
            Yii::$app->session->removeFlash( 'danger' );
        }
        Yii::$app->session->setFlash( $stringType , $stringMenssage );
    }


}
