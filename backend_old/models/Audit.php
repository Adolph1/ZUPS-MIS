<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_audit".
 *
 * @property integer $id
 * @property string $activity
 * @property string $module
 * @property string $action
 * @property string $maker
 * @property string $maker_time
 */
class Audit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_audit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity', 'module', 'action', 'maker', 'maker_time'], 'string', 'max' => 200],
            [['old','new'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'activity' => Yii::t('app', 'Activity'),
            'module' => Yii::t('app', 'Module'),
            'action' => Yii::t('app', 'Action'),
            'maker' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * inserts new user activity
     */
    public static function setActivity($activity,$module,$action,$contentBefore,$contentAfter)
    {
        $audit=new Audit();


     //   print_r($contentAfter);
       //print_r($contentBefore);
       // exit;
        $audit->old = '';
        $audit->new = '';
        if($contentBefore != null && $contentAfter != null) {
            foreach ($contentBefore as $name => $value) {
                $tempOne = $name . ': ' . $value . ',  ';
                $before[] = $tempOne;
            }

            foreach ($contentAfter as $name => $value) {
                $tempTwo = $name . ': ' . $value . ',  ';
                $after[] = $tempTwo;
            }


            $length = count($after);
            for ($x = 0; $x < $length; $x++) {
                if ($before[$x] != $after[$x]) {
                    $audit->old = $audit->old . ' ' . $before[$x];
                    $audit->new = $audit->new . ' ' . $after[$x];
                }
            }
        }





        $audit->activity=$activity;
        $audit->module=$module;
        $audit->action=$action;
        $audit->maker=Yii::$app->user->identity->username;
        $audit->maker_time=date('Y-m-d:H:i:s');
        $audit->save();

    }


}
