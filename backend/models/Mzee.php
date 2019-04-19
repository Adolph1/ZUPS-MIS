<?php

namespace backend\models;

use DateTime;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_mzee".
 *
 * @property int $id
 * @property string $fomu_namba
 * @property resource $picha
 * @property string $majina_mwanzo
 * @property string $jina_babu
 * @property string $jina_maarufu
 * @property string $jinsia
 * @property string $tarehe_kuzaliwa
 * @property int $umri_kusajiliwa
 * @property int $umri_sasa
 * @property string $blood_group_id
 * @property int $kazi_id
 * @property string $mzawa_zanzibar
 * @property int $aina_ya_kitambulisho
 * @property string $nambar
 * @property string $tarehe_kuingia_zanzibar
 * @property string $simu
 * @property int $mkoa_id
 * @property int $wilaya_id
 * @property int $shehia_id
 * @property int $kituo_id
 * @property int $zups_pension_type
 * @property string $mtaa
 * @property string $namba_nyumba
 * @property string $anuani_kamili_mtaa
 * @property string $anuani_ya_posta
 * @property int $posho_wilaya
 * @property int $njia_upokeaji
 * @property int $jina_bank
 * @property string $jina_account
 * @property string $nambari_account
 * @property string $simu_kupokelea
 * @property int $wanaomtegemea
 * @property string $pension_nyingine
 * @property int $aina_ya_pension
 * @property string $tarehe_ya_usajili
 * @property string $aliyeweka
 * @property string $muda
 * @property string $anaishi
 * @property int $status
 * @property string $tarehe_kufariki
 * @property string $aliyeleta_taarifa_kifo
 * @property string $mchukua_taarifa_kufariki
 * @property string $mchukua_taarifa_id
 * @property string $muda_kufariki_save
 * @property string $death_reported_date
 * @property int $msaidizi_id
 * @property int $aina_ya_msaidizi
 * @property string $maoni_ofisi_wilaya
 * @property string $mzee_finger_print
 * @property string $kidole_code
 * @property string $aliyechukua_finger
 * @property string $tarehe_ya_finger
 * @property string $zups_mzee_id
 */
class Mzee extends \yii\db\ActiveRecord
{
    const ELIGIBLE = 1;
    const SUSPENDED = -1;
    const VETTED = 2;
    const PENDING = 0;
    const REJECTED = -10;
    const DIED = 0;



    public $magonjwa;
    public $vipato;
    public $ulemavu;
    public $zanzibar_id;
    public $viambatanisho;
    public $mzee_picha;
    public $wazee;
    private $_statusLabel;
    public $tafuta_mzee;
    public $extension;
    public $mzee_details;
    public $from;
    public $to;
    public $mtu_wa_karibu;





    public static function tableName()
    {
        return 'tbl_mzee';
    }

    public static function getWazeeByKituoCount($id)
    {
        $counts = Mzee::find()->where(['kituo_id' => $id])->count();
        if($counts != null){
            return $counts;
        }else{
            return 0;
        }
    }

    public static function getCountPerShehiaWithFinger($shehia_id)
    {
        $count = Mzee::find()->where(['shehia_id'=>$shehia_id])->andWhere(['!=','mzee_finger_print',''])->count();
        return $count;
    }

    public static function getCountPerShehiaNoFinger($shehia_id)
    {
        $count = Mzee::find()->where(['shehia_id'=>$shehia_id,'mzee_finger_print'=>''])->count();
        return $count;
    }

    public static function getCountPerShehiaMsaidiziFinger($shehia_id)
    {
        //$wazee = Mzee::find()->select('id')->where(['shehia_id' => $shehia_id]);
        // $count = MsaidiziMzee::find()->where(['in','mzee_id',$wazee])->andWhere(['!=','finger_print',''])->count();

        $wazee = Mzee::find()->where(['shehia_id' => $shehia_id])->all();
        $count = 0;
        foreach ($wazee as $mzee){

            if($mzee->aina_ya_msaidizi == 1) {
                $msaidizi = MsaidiziMzee::find()->where(['id' => $mzee->msaidizi_id])->andWhere(['!=', 'finger_print', ''])->one();
                if($msaidizi != null){
                    $count = $count + 1;
                }
            }elseif ($mzee->aina_ya_msaidizi == 2){
                $mz = Mzee::find()->where(['id' => $mzee->msaidizi_id])->andWhere(['!=', 'mzee_finger_print', ''])->one();
                if($mz != null){
                    $count = $count + 1;
                }
            }

        }
        return $count;
    }

    public static function getCountPerShehiaEitherFinger($shehia_id)
    {
        $wazee = Mzee::find()->where(['shehia_id' => $shehia_id])->all();
        $count = 0;
        foreach ($wazee as $mzee){
            if($mzee->mzee_finger_print != ''){
                $count = $count + 1;
            }else{
                if($mzee->aina_ya_msaidizi == 1) {
                    $msaidizi = MsaidiziMzee::find()->where(['id' => $mzee->msaidizi_id])->andWhere(['!=', 'finger_print', ''])->one();
                    if($msaidizi != null){
                        $count = $count + 1;
                    }
                }elseif ($mzee->aina_ya_msaidizi == 2){
                    $mz = Mzee::find()->where(['id' => $mzee->msaidizi_id])->andWhere(['!=', 'mzee_finger_print', ''])->one();
                    if($mz != null){
                        $count = $count + 1;
                    }
                }
            }
        }

        return $count;
    }


    public static function getAllByMkoa($mkoa_id,$mzee_id)
    {
        return ArrayHelper::map(Mzee::find()->where(['mkoa_id' => $mkoa_id])->andWhere(['not in','id',$mzee_id])->all(),'id',function($model){
            return $model->majina_mwanzo .' '. $model->jina_babu;
        });
    }

    public static function getAllExcept($id,$ms_wly)
    {

        if(Yii::$app->user->can('DataClerk')) {
            return ArrayHelper::map(Mzee::find()->where(['not in', 'id', $id])->andWhere(['wilaya_id' => Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id)])->all(), 'id', function ($model) {
                return $model->majina_mwanzo . ' ' . $model->jina_babu.' '."( kitambulisho-".$model->nambar.")"."( shehia-".$model->shehia->jina.")";
            });
        }else{
            return ArrayHelper::map(Mzee::find()->where(['not in', 'id', $id])->andWhere(['wilaya_id' => $ms_wly])->all(), 'id', function ($model) {
                return $model->majina_mwanzo . ' ' . $model->jina_babu.' '."( kitambulisho-".$model->nambar.")"."( shehia-".$model->shehia->jina.")";
            });
        }
    }


    public static function getRegisteredCountPerKiwilaya($wilaya_id)
    {

        $pending = Mzee::find()->where(['in','wilaya_id',$wilaya_id])->andWhere(['between','tarehe_ya_usajili',date('Y-m-01'),date('Y-m-31')])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }

    public static function getDeadCountPerKiwilaya($wilaya_id)
    {

        $pending = Mzee::find()->where(['in','wilaya_id',$wilaya_id])->andWhere(['anaishi' => Mzee::DIED])->andWhere(['between','tarehe_kufariki',date('Y-m-01'),date('Y-m-31')])->count();
        if($pending != null) {
            return $pending;
        }else{
            return 0;
        }
    }

    public static function getFullname($mzee_mwingine_id)
    {
        $mzee = Mzee::findOne($mzee_mwingine_id);
        if($mzee != null){
            return $mzee->majina_mwanzo .' '. $mzee->jina_babu;
        }else{
            return null;
        }
    }

    public static function getVetted()
    {
        if(Yii::$app->user->can('DataClerk')) {
            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $wazee = Mzee::find()->where(['status' => Mzee::VETTED, 'wilaya_id' => Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id)])->andWhere(['in', 'mkoa_id', $subquery])->count();
            if ($wazee > 0) {
                return $wazee;
            } else {
                return 0;
            }
        }else{
            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $wazee = Mzee::find()->where(['status' => Mzee::VETTED])->andWhere(['in', 'mkoa_id', $subquery])->count();
            if ($wazee > 0) {
                return $wazee;
            } else {
                return 0;
            }
        }
    }

    public static function getWithSeventy()
    {
        if(Yii::$app->user->can('DataClerk')) {
            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $wazee = Mzee::find()->where(['status' => Mzee::VETTED, 'wilaya_id' => Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id)])->andWhere(['>=','umri_sasa',70])->andWhere(['in', 'mkoa_id', $subquery])->count();
            if ($wazee > 0) {
                return $wazee;
            } else {
                return 0;
            }
        }else{
            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $wazee = Mzee::find()->where(['status' => Mzee::VETTED])->andWhere(['>=','umri_sasa',70])->andWhere(['in', 'mkoa_id', $subquery])->count();
            if ($wazee > 0) {
                return $wazee;
            } else {
                return 0;
            }
        }
    }

    public static function getWazee()
    {

    }

    public static function getWanaumePerDistrict($id)
    {
        $men = Mzee::find()->where(['in','wilaya_id',$id])->andWhere(['status' => Mzee::ELIGIBLE])->andWhere(['jinsia' => 'M'])->count();
        if($men != null) {
            return $men;
        }else{
            return 0;
        }
    }


    public static function getWanawakePerDistrict($id)
    {
        $women = Mzee::find()->where(['in','wilaya_id',$id])->andWhere(['status' => Mzee::ELIGIBLE])->andWhere(['jinsia' => 'F'])->count();
        if($women != null) {
            return $women;
        }else{
            return 0;
        }
    }

    public static function getWazeeInSheiaCount($id)
    {

        $shehia = MzeeSearch::find()->where(['shehia_id' => $id])->count();
        if($shehia != null){
            return $shehia;
        }else{
            return 0;
        }

    }

    public static function getWazeeInWilayaCount($id)
    {

        $shehia = MzeeSearch::find()->where(['wilaya_id' => $id])->count();
        if($shehia != null){
            return $shehia;
        }else{
            return 0;
        }

    }

    public static function getWazeeInMkoaCount($id)
    {

        $shehia = MzeeSearch::find()->where(['mkoa_id' => $id])->count();
        if($shehia != null){
            return $shehia;
        }else{
            return 0;
        }

    }

    public function getStatusLabel()
    {
        if ($this->_statusLabel === null) {
            $statuses = self::getStatuses();
            $this->_statusLabel = $statuses[$this->status];
        }
        return $this->_statusLabel;
    }

    public static function getStatuses()
    {
        return [

            self::ELIGIBLE => Yii::t('app', 'Amekubaliwa'),
            self::SUSPENDED => Yii::t('app', 'Amesitishwa'),
            self::PENDING => Yii::t('app', 'Amesajiliwa'),
            self::REJECTED => Yii::t('app', 'Amekataliwa'),
            self::VETTED => Yii::t('app', 'Amehakikiwa'),
        ];
    }


    public static function getReportStatuses()
    {
        return [

            self::ELIGIBLE => Yii::t('app', 'Waliokubaliwa'),
            self::SUSPENDED => Yii::t('app', 'Waliositishwa'),
            self::PENDING => Yii::t('app', 'Waliosajaliwa'),
            self::REJECTED => Yii::t('app', 'Waliokatiliwa'),
            self::VETTED => Yii::t('app', 'Waliohakikiwa'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mzee_picha'], 'file'],
            [['mzee_picha'], 'file', 'extensions' => 'png,jpg,jepg','maxSize' => 512000, 'tooBig' => 'Limit is 500KB', 'skipOnEmpty' => true,
                'checkExtensionByMimeType' => false],
            [['nambar'], 'unique','message'=>'Namba ya kitambulisho imekwisha tumika'],

            [['fomu_namba', 'majina_mwanzo', 'jina_babu', 'jinsia','mchukua_taarifa_id', 'tarehe_kuzaliwa', 'mzawa_zanzibar', 'aina_ya_kitambulisho', 'nambar', 'mkoa_id', 'wilaya_id', 'shehia_id',  'njia_upokeaji','zups_pension_type'], 'required'],
            [['picha', 'mzee_finger_print'], 'string'],
            [['nambar',], 'unique','message'=>'Namba ya kitambulisho imekwisha tumika'],
            [['tarehe_kuzaliwa', 'tarehe_kuingia_zanzibar', 'muda', 'tarehe_kufariki','magonjwa','ulemavu','vipato','mzee_picha','tarehe_ya_usajili','death_reported_date'], 'safe'],
            [['umri_kusajiliwa', 'umri_sasa', 'kazi_id', 'aina_ya_kitambulisho', 'mkoa_id', 'wilaya_id', 'msaidizi_id','aina_ya_msaidizi','shehia_id', 'posho_wilaya', 'njia_upokeaji', 'jina_bank', 'wanaomtegemea', 'aina_ya_pension', 'status', 'kituo_id','zups_pension_type','blood_group_id','mchukua_taarifa_id'], 'integer'],
            [['fomu_namba', 'majina_mwanzo', 'jina_babu', 'jina_maarufu', 'nambar', 'simu', 'mtaa', 'namba_nyumba', 'anuani_kamili_mtaa', 'anuani_ya_posta', 'jina_account', 'nambari_account', 'simu_kupokelea', 'aliyeweka', 'mchukua_taarifa_id' , 'maoni_ofisi_wilaya','picha'], 'string', 'max' => 200],
            [['jinsia', 'mzawa_zanzibar', 'pension_nyingine', 'anaishi',], 'string', 'max' => 1],
            [['aina_ya_pension'], 'exist', 'skipOnError' => true, 'targetClass' => PensionNyingine::className(), 'targetAttribute' => ['aina_ya_pension' => 'id']],
            [['kazi_id'], 'exist', 'skipOnError' => true, 'targetClass' => KaziMzee::className(), 'targetAttribute' => ['kazi_id' => 'id']],
            [['shehia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shehia::className(), 'targetAttribute' => ['shehia_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fomu_namba' => Yii::t('app', 'Namba ya Fomu'),
            'picha' => Yii::t('app', 'Picha'),
            'death_reported_date' => Yii::t('app', 'Tarehe ya kupokea taarifa'),
            'majina_mwanzo' => Yii::t('app', 'Majina ya Mwanzo'),
            'jina_babu' => Yii::t('app', 'Jina la Babu'),
            'jina_maarufu' => Yii::t('app', 'Jina Maarufu'),
            'jinsia' => Yii::t('app', 'Jinsia'),
            'blood_group_id' => Yii::t('app', 'Blood Group'),
            'tarehe_kuzaliwa' => Yii::t('app', 'Tarehe ya Kuzaliwa'),
            'umri_kusajiliwa' => Yii::t('app', 'Umri wakati wa usajili'),
            'umri_sasa' => Yii::t('app', 'Umri wa Sasa'),
            'kazi_id' => Yii::t('app', 'Kazi'),
            'mzawa_zanzibar' => Yii::t('app', 'Mzawa wa Zanzibar'),
            'aina_ya_kitambulisho' => Yii::t('app', 'Aina Ya Kitambulisho'),
            'nambar' => Yii::t('app', 'Nambari ya kitambulisho'),
            'tarehe_kuingia_zanzibar' => Yii::t('app', 'Tarehe Kuingia Zanzibar'),
            'simu' => Yii::t('app', 'Simu'),
            'mkoa_id' => Yii::t('app', 'Mkoa '),
            'wilaya_id' => Yii::t('app', 'Wilaya '),
            'shehia_id' => Yii::t('app', 'Shehia '),
            'kituo_id' => Yii::t('app', 'Kituo '),
            'mtaa' => Yii::t('app', 'Mtaa'),
            'zups_pension_type' => Yii::t('app', 'Aina ya Zups Pencheni'),
            'namba_nyumba' => Yii::t('app', 'Namba ya Nyumba'),
            'anuani_kamili_mtaa' => Yii::t('app', 'Anuani Kamili Mtaa'),
            'anuani_ya_posta' => Yii::t('app', 'Anuani Ya Posta'),
            'posho_wilaya' => Yii::t('app', 'Posho ya Wilaya'),
            'njia_upokeaji' => Yii::t('app', 'Njia ya Upokeaji'),
            'jina_bank' => Yii::t('app', 'Jina ya Bank'),
            'jina_account' => Yii::t('app', 'Jina la Account'),
            'nambari_account' => Yii::t('app', 'Nambari ya Account'),
            'simu_kupokelea' => Yii::t('app', 'Simu ya Kupokelea'),
            'wanaomtegemea' => Yii::t('app', 'Wanaomtegemea'),
            'pension_nyingine' => Yii::t('app', 'Pension Nyingine'),
            'aina_ya_pension' => Yii::t('app', 'Aina Ya Pension'),
            'tarehe_ya_usajili' => Yii::t('app', 'Tarehe ya usajili'),
            'aliyeweka' => Yii::t('app', 'Aliyemuingiza'),
            'muda' => Yii::t('app', 'Muda'),
            'anaishi' => Yii::t('app', 'Anaishi'),
            'status' => Yii::t('app', 'Status'),
            'tarehe_kufariki' => Yii::t('app', 'Tarehe ya Kufariki'),
            'mchukua_taarifa_id' => Yii::t('app', 'Mchukua taarifa'),
            'maoni_ofisi_wilaya' => Yii::t('app', 'Maoni ya Ofisa Wilaya'),
            'mzee_finger_print' => Yii::t('app', 'Mzee Finger Print'),
            'zups_mzee_id' => Yii::t('app', 'Zups Mzee ID'),
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPension()
    {
        return $this->hasOne(PensionNyingine::className(), ['id' => 'aina_ya_pension']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKazi()
    {
        return $this->hasOne(KaziMzee::className(), ['id' => 'kazi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKituo()
    {
        return $this->hasOne(Vituo::className(), ['id' => 'kituo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMsaidizi()
    {
        return $this->hasOne(MsaidiziMzee::className(), ['id' => 'msaidizi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKitambulisho()
    {
        return $this->hasOne(AinaYaKitambulisho::className(), ['id' => 'aina_ya_kitambulisho']);
    }

    public function getUpokeaji()
    {
        return $this->hasOne(NjiaMalipo::className(), ['id' => 'njia_upokeaji']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShehia()
    {
        return $this->hasOne(Shehia::className(), ['id' => 'shehia_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWilaya()
    {
        return $this->hasOne(Wilaya::className(), ['id' => 'wilaya_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMkoa()
    {
        return $this->hasOne(Mkoa::className(), ['id' => 'mkoa_id']);
    }
    public function getSheha()
    {
        return $this->hasOne(Sheha::className(), ['id' => 'mchukua_taarifa_id']);
    }

    public function getBlood()
    {
        return $this->hasOne(BloodGroup::className(), ['id' => 'blood_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZupspencheni()
    {
        return $this->hasOne(ZupsProduct::className(), ['id' => 'zups_pension_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzeeMagonjwa()
    {
        return $this->hasMany(MzeeMagonjwa::className(), ['mzee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzeeUlemavu()
    {
        return $this->hasMany(MzeeUlemavu::className(), ['mzee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMzeeVipato()
    {
        return $this->hasMany(MzeeVipato::className(), ['mzee_id' => 'id']);
    }


    //get eligible with respect to zone

    public static function getEligible($zoneid)
    {
        $subquery = Mkoa::find()
            ->select('id')
            ->where(['zone_id'=>$zoneid]);
        return Mzee::find()->where(['status' => Mzee::ELIGIBLE])->andWhere(['in','mkoa_id',$subquery])->all();
    }

    public static function getEligibleCount()
    {
        $subquery = Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wazee = Mzee::find()->where(['status' => Mzee::ELIGIBLE])->andWhere(['in','mkoa_id',$subquery])->all();
        return count($wazee);
    }


    public static function getPending()
    {
        $wazee = Mzee::findAll(['status' => Mzee::PENDING]);
        if($wazee !=null){
            return $wazee;
        }else{
            return null;
        }
    }




    public static function getHai()
    {
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wazee = Mzee::find()->where(['anaishi' => 1])->andWhere((['in','mkoa_id',$subquery]))->all();
        if($wazee !=null){
            return count($wazee);
        }else{
            return 0;
        }
    }
    public static function getWaliofariki()
    {
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wazee = Mzee::find()->where(['anaishi' => Mzee::DIED])->andWhere((['in','mkoa_id',$subquery]))->all();
        if($wazee !=null){
            return count($wazee);
        }else{
            return 0;
        }
    }

    public static function getWanaume()
    {
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wazee = Mzee::find()->where(['jinsia' => 'M'])->andWhere((['in','mkoa_id',$subquery]))->all();
        if($wazee !=null){
            return count($wazee);
        }else{
            return 0;
        }
    }

    public static function getWanawake()
    {
        $subquery=Mkoa::find()
            ->select('id')
            ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        $wazee = Mzee::find()->where(['jinsia' => 'F'])->andWhere((['in','mkoa_id',$subquery]))->all();
        if($wazee !=null){
            return count($wazee);
        }else{
            return 0;
        }
    }

    public static function getUmri($tarehe_kuzaliwa)
    {
        $date = $tarehe_kuzaliwa;
        $date_1 = new DateTime($date);
        $date_2 = new DateTime( date( 'Y-m-d' ) );

        $difference = $date_2->diff($date_1);

// Echo the as string to display in browser for testing
        return $difference->y;
        // return array ( 'years' => $diff->y, 'months' => $diff->m );
    }


    public static function getApplied()
    {
        if(Yii::$app->user->can('DataClerk')) {

            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $wazee = Mzee::find()->where(['status' => Mzee::PENDING,'wilaya_id' => Wafanyakazi::getDistrictID(Yii::$app->user->identity->user_id)])->andWhere(['in', 'mkoa_id', $subquery])->count();
            if ($wazee > 0) {
                return $wazee;
            } else {
                return 0;
            }
        }else{
            $subquery = Mkoa::find()
                ->select('id')
                ->where(['zone_id' => Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
            $wazee = Mzee::find()->where(['status' => Mzee::PENDING])->andWhere(['in', 'mkoa_id', $subquery])->count();
            if ($wazee > 0) {
                return $wazee;
            } else {
                return 0;
            }
        }

    }

    public static function getCountPerShehia($shehia_id)
    {
        $count = Mzee::find()->where(['shehia_id'=>$shehia_id,'anaishi' => '1','status' => Mzee::ELIGIBLE])->count();
        return $count;
    }

    public static function getAll()
    {
        $subquery = Mkoa::find()
            ->select('id')
            ->where(['zone_id'=>Wafanyakazi::getZoneByID(Yii::$app->user->identity->user_id)]);
        return ArrayHelper::map(Mzee::find()->where(['!=','anaishi', Mzee::DIED])->andWhere(['in','mkoa_id',$subquery])->all(),'id',function ($model){


            return $model->majina_mwanzo . ' ' . $model->jina_babu . ' (Shehia: ' . Shehia::getNameByID($model->shehia_id) . ')';
        });
    }


}

