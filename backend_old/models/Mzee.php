<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_mzee".
 *
 * @property integer $id
 * @property string $fomu_namba
 * @property string $picha
 * @property string $majina_mwanzo
 * @property string $jina_babu
 * @property string $jina_maarufu
 * @property string $jinsia
 * @property string $tarehe_kuzaliwa
 * @property integer $umri_kusajiliwa
 * @property integer $umri_sasa
 * @property integer $kazi_id
 * @property string $mzawa_zanzibar
 * @property integer $aina_ya_kitambulisho
 * @property string $nambar
 * @property string $tarehe_kuingia_zanzibar
 * @property string $simu
 * @property integer $mkoa_id
 * @property integer $wilaya_id
 * @property integer $shehia_id
 * @property string $mtaa
 * @property string $namba_nyumba
 * @property string $anuani_kamili_mtaa
 * @property string $anuani_ya_posta
 * @property integer $posho_wilaya
 * @property integer $njia_upokeaji
 * @property integer $jina_bank
 * @property string $jina_account
 * @property string $nambari_account
 * @property string $simu_kupokelea
 * @property integer $wanaomtegemea
 * @property string $pension_nyingine
 * @property integer $aina_ya_pension
 * @property string $aliyeweka
 * @property string $muda
 * @property string $anaishi
 * @property integer $status
 * @property string $tarehe_kufariki
 * @property string $mtu_karibu
 * @property string $jinsia_mtu_karibu
 * @property string $tarehe_kuzaliwa_mtu_karibu
 * @property integer $umri_mtu_karibu
 * @property string $namba_simu
 * @property string $picha_mtu_karibu
 * @property string $anuani_kamili_mtu_karibu
 * @property integer $aina_ya_kitambulisho_mtu_karibu
 * @property string $nambari_ya_kitambulisho
 * @property string $uhasiano
 * @property integer $mchukua_taarifa_id
 * @property string $maoni_ofisi_wilaya
 * @property string $mzee_finger_print
 * @property string $mtu_karibu_finger_print
 *
 * @property TblPensionNyingine $ainaYaPension
 * @property TblKaziMzee $kazi
 * @property TblShehia $shehia
 * @property TblMzeeMagonjwa[] $tblMzeeMagonjwas
 * @property TblMzeeUlemavu[] $tblMzeeUlemavus
 * @property TblMzeeVipato[] $tblMzeeVipatos
 */
class Mzee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $magonjwa;
    public $vipato;
    public $ulemavu;
    public $zanzibar_id;
    public $viambatanisho;
    public $picha;
    public $picha_mtu_karibu;

    public static function tableName()
    {
        return 'tbl_mzee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fomu_namba', 'majina_mwanzo', 'jina_babu', 'jinsia', 'tarehe_kuzaliwa', 'kazi_id', 'mzawa_zanzibar', 'aina_ya_kitambulisho', 'nambar', 'mkoa_id', 'wilaya_id', 'shehia_id', 'mtaa',  'posho_wilaya', 'njia_upokeaji', 'pension_nyingine','mtu_karibu', 'anuani_kamili_mtu_karibu', 'aina_ya_kitambulisho_mtu_karibu', 'nambari_ya_kitambulisho','maoni_ofisi_wilaya', 'uhasiano',], 'required'],
            [['tarehe_kuzaliwa', 'tarehe_kuingia_zanzibar', 'muda', 'tarehe_kufariki', 'tarehe_kuzaliwa_mtu_karibu','magonjwa','ulemavu','vipato','viambatanisho'], 'safe'],
            [['umri_kusajiliwa', 'umri_sasa', 'kazi_id', 'aina_ya_kitambulisho', 'mkoa_id', 'wilaya_id', 'shehia_id', 'posho_wilaya', 'njia_upokeaji', 'jina_bank', 'wanaomtegemea', 'aina_ya_pension', 'status', 'umri_mtu_karibu', 'aina_ya_kitambulisho_mtu_karibu', 'mchukua_taarifa_id'], 'integer'],
            [['mzee_finger_print', 'mtu_karibu_finger_print'], 'string'],
            [['fomu_namba', 'majina_mwanzo', 'jina_babu', 'jina_maarufu', 'nambar', 'simu', 'mtaa', 'namba_nyumba', 'anuani_kamili_mtaa', 'anuani_ya_posta', 'jina_account', 'nambari_account', 'simu_kupokelea', 'aliyeweka', 'mtu_karibu', 'namba_simu', 'anuani_kamili_mtu_karibu', 'nambari_ya_kitambulisho', 'uhasiano', 'maoni_ofisi_wilaya'], 'string', 'max' => 200],
            [['jinsia', 'mzawa_zanzibar', 'pension_nyingine', 'anaishi', 'jinsia_mtu_karibu'], 'string', 'max' => 1],
            [['picha_mtu_karibu','picha'],'file', 'skipOnEmpty' => false,'extensions' => 'jpeg,jpg, gif, png'],
            [['fomu_namba'], 'unique'],
            [['aina_ya_pension'], 'exist', 'skipOnError' => true, 'targetClass' => PensionNyingine::className(), 'targetAttribute' => ['aina_ya_pension' => 'id']],
            [['kazi_id'], 'exist', 'skipOnError' => true, 'targetClass' => KaziMzee::className(), 'targetAttribute' => ['kazi_id' => 'id']],
            [['shehia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shehia::className(), 'targetAttribute' => ['shehia_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fomu_namba' => Yii::t('app', 'Namba ya Fomu'),
            'picha' => Yii::t('app', 'Picha'),
            'majina_mwanzo' => Yii::t('app', 'Majina ya Mwanzo'),
            'jina_babu' => Yii::t('app', 'Jina la Babu'),
            'jina_maarufu' => Yii::t('app', 'Jina Maarufu'),
            'jinsia' => Yii::t('app', 'Jinsia'),
            'tarehe_kuzaliwa' => Yii::t('app', 'Tarehe ya Kuzaliwa'),
            'umri_kusajiliwa' => Yii::t('app', 'Umri wakati wa usajili'),
            'umri_sasa' => Yii::t('app', 'Umri Sasa'),
            'kazi_id' => Yii::t('app', 'Kazi'),
            'mzawa_zanzibar' => Yii::t('app', 'Mzawa wa Zanzibar'),
            'aina_ya_kitambulisho' => Yii::t('app', 'Aina Ya Kitambulisho'),
            'nambar' => Yii::t('app', 'Nambari ya kitambulisho'),
            'tarehe_kuingia_zanzibar' => Yii::t('app', 'Tarehe Kuingia Zanzibar'),
            'simu' => Yii::t('app', 'Simu'),
            'mkoa_id' => Yii::t('app', 'Mkoa '),
            'wilaya_id' => Yii::t('app', 'Wilaya '),
            'shehia_id' => Yii::t('app', 'Shehia '),
            'mtaa' => Yii::t('app', 'Mtaa'),
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
            'aliyeweka' => Yii::t('app', 'Aliyeweka'),
            'muda' => Yii::t('app', 'Muda'),
            'anaishi' => Yii::t('app', 'Anaishi'),
            'status' => Yii::t('app', 'Status'),
            'tarehe_kufariki' => Yii::t('app', 'Tarehe ya Kufariki'),
            'mtu_karibu' => Yii::t('app', 'Mtu wa Karibu'),
            'jinsia_mtu_karibu' => Yii::t('app', 'Jinsia ya Mtu wa Karibu'),
            'tarehe_kuzaliwa_mtu_karibu' => Yii::t('app', 'Tarehe Kuzaliwa ya Mtu wa Karibu'),
            'umri_mtu_karibu' => Yii::t('app', 'Umri wa Mtu wa Karibu'),
            'namba_simu' => Yii::t('app', 'Namba ya Simu'),
            'picha_mtu_karibu' => Yii::t('app', 'Picha ya Mtu wa Karibu'),
            'anuani_kamili_mtu_karibu' => Yii::t('app', 'Anuani Kamili ya Mtu wa Karibu'),
            'aina_ya_kitambulisho_mtu_karibu' => Yii::t('app', 'Aina Ya Kitambulisho Mtu Karibu'),
            'nambari_ya_kitambulisho' => Yii::t('app', 'Nambari Ya Kitambulisho'),
            'uhasiano' => Yii::t('app', 'Uhasiano'),
            'mchukua_taarifa_id' => Yii::t('app', 'Mchukua Taarifa ID'),
            'maoni_ofisi_wilaya' => Yii::t('app', 'Maoni Ofisi Wilaya'),
            'mzee_finger_print' => Yii::t('app', 'Mzee Finger Print'),
            'mtu_karibu_finger_print' => Yii::t('app', 'Mtu Karibu Finger Print'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAinaYaPension()
    {
        return $this->hasOne(TblPensionNyingine::className(), ['id' => 'aina_ya_pension']);
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
    public function getShehia()
    {
        return $this->hasOne(Shehia::className(), ['id' => 'shehia_id']);
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
}
