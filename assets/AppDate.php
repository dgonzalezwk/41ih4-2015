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
    /**
     * @return string
     */
    public static function stringToDate( $stringDate , $formatDate )
    {
        $format = Yii::$app->params['formatDbDate'];
        if ( $formatDate != null ) {
            $format = $formatDate;
        }   
        if ($stringDate!=null && trim($stringDate)!='') {
            return date( $format , strtotime($stringDate) );
        }else{
            return null;
        }
    }
}
