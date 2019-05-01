<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tbl_hall".
 *
 * @property integer $id
 * @property string $name
 * @property integer $owner
 * @property string $type
 * @property string $price
 * @property integer $people_volume
 * @property string $email
 * @property string $phone
 * @property string $photo
 * @property string $food_beverage_inclusive
 * @property string $decoration_inclusive
 * @property string $location
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblBooking[] $tblBookings
 * @property TblHallAlbum[] $tblHallAlbums
 */
class Hall extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_hall';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'price', 'people_volume', 'phone', 'food_beverage_inclusive', 'decoration_inclusive', 'location'], 'required'],
            [['owner', 'people_volume'], 'integer'],
            [['price'], 'number'],
            [['maker_time'], 'safe'],
            [['name', 'email', 'phone', 'photo', 'location', 'maker_id'], 'string', 'max' => 200],
            [['type', 'food_beverage_inclusive', 'decoration_inclusive', 'status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'owner' => 'Owner',
            'type' => 'Type',
            'price' => 'Price',
            'people_volume' => 'People Volume',
            'email' => 'Email',
            'phone' => 'Phone',
            'photo' => 'Photo',
            'food_beverage_inclusive' => 'Food Beverage Inclusive',
            'decoration_inclusive' => 'Decoration Inclusive',
            'location' => 'Location',
            'status' => 'Status',
            'maker_id' => 'Maker ID',
            'maker_time' => 'Maker Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblBookings()
    {
        return $this->hasMany(TblBooking::className(), ['hall_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblHallAlbums()
    {
        return $this->hasMany(TblHallAlbum::className(), ['hall_id' => 'id']);
    }
}
