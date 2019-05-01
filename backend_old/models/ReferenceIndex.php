<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_reference_index".
 *
 * @property integer $id
 * @property string $index_no
 * @property string $product
 * @property string $full_reference
 * @property string $status
 */
class ReferenceIndex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_reference_index';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['index_no', 'product', 'full_reference', 'status'], 'required'],
            [['product', 'full_reference'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'index_no' => 'Index No',
            'product' => 'Product',
            'full_reference' => 'Full Reference',
            'status' => 'Status',
        ];
    }

    public static function getIDByRef($id)
    {
        $index=ReferenceIndex::find()->where(['full_reference'=>$id])->one();
        return $index->id;

    }

    public static function updateReference($id)
    {
        ReferenceIndex::updateAll(['status'=>'Y'],['id'=>$id]);
        ReferenceIndex::generateReference($id);

    }

    public static function generateReference($id)
    {
        $model=ReferenceIndex::find()->where(['id'=>$id])->one();
        if($model!=null){
            $end_date = SystemDate::getCurrentDate();
            $end_date=date('y-m-d',strtotime($end_date));
            $thedate = explode("-", $end_date);
            $year = $thedate[0];
            $month = $thedate[1];
            $day = $thedate[2];
            $newmodel=new ReferenceIndex();
            $newmodel->index_no = sprintf("%04d", $model->index_no + 1);
            $newmodel->product = $model->product;
            $newmodel->full_reference =  $model->product .$year.$month.$day.$newmodel->index_no;
            $newmodel->status = 'N';
            $newmodel->save();
        }

    }
}
