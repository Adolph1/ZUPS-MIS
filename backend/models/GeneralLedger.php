<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_general_ledger".
 *
 * @property string $gl_code
 * @property string $gl_description
 * @property string $parent_gl
 * @property string $leaf
 * @property integer $type
 * @property integer $customer
 * @property integer $category
 * @property integer $posting_restriction
 * @property string $record_status
 * @property string $maker_id
 * @property string $maker_stamptime
 * @property string $checker_id
 * @property string $checker_stamptime
 * @property integer $mod_no
 * @property integer $zone_id
 */
class GeneralLedger extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const UNGUJAPENCHENI = 'UG0001';
    const UNGUJAWAZEE = 'UG0002';
    const UNGUJAUENDESHAJI = 'UG0003';


    const PEMBAPENCHENI = 'PM0001';
    const PEMBAWAZEE = 'PM0002';
    const PEMBAUENDESHAJI = 'PM0003';

    public static function tableName()
    {
        return 'tbl_general_ledger';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gl_code', 'gl_description', 'posting_restriction', 'leaf', 'type', 'customer', 'category'], 'required'],
            [['type', 'customer', 'category', 'posting_restriction', 'mod_no','zone_id'], 'integer'],
            [['gl_code', 'parent_gl'], 'string', 'max' => 50],
            [['gl_code'], 'unique'],
            [['gl_description', 'maker_id', 'maker_stamptime', 'checker_id', 'checker_stamptime'], 'string', 'max' => 200],
            [['leaf', 'record_status'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gl_code' => 'Gl Code',
            'gl_description' => 'Gl Description',
            'parent_gl' => 'Parent Gl',
            'leaf' => 'GL Nature',
            'type' => 'Type',
            'customer' => 'GL use',
            'category' => 'Category',
            'posting_restriction' => 'Posting Restriction',
            'record_status' => 'Record Status',
            'maker_id' => 'Maker ID',
            'maker_stamptime' => 'Maker Stamptime',
            'checker_id' => 'Checker ID',
            'checker_stamptime' => 'Checker Stamptime',
            'mod_no' => 'Mod No',
        ];
    }
    public function getGlCategory()
    {
        return $this->hasOne(GlCategory::className(), ['cate_id' => 'category']);
    }
    public function getGlType()
    {
        return $this->hasOne(GlType::className(), ['id' => 'type']);
    }

    public static function getAll()
    {
        return ArrayHelper::map(GeneralLedger::find()->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)])->all(),'gl_code','gl_description');
    }

    public function getParentID()
    {
        return $this->hasOne(GeneralLedger::className(), ['gl_code' => 'parent_gl']);
    }

    public static function getDescByGLCODE($gl)
    {
        $gl=GeneralLedger::findOne($gl);
        if($gl!=null){
            return $gl->gl_description;
        }else{
            return '';
        }
    }



}
