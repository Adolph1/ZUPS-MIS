<?php
/**
 * Created by PhpStorm.
 * User: adotech
 * Date: 5/16/18
 * Time: 3:29 PM
 */

namespace backend\models;


class Reference
{

    public $reference;

    public static function findLast()
    {

        $model = Application::find()->all();

        if ($model != null) {
            $reference ='RQ'.date('y').'/'.sprintf("%04d", count($model) + 1);
            return $reference;
        }
        else {

            $reference ='RQ'.date('y').'/0001';
            return $reference;

        }

    }

}