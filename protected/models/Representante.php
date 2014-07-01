<?php

/**
 * This is the model class for table "representante".
 *
 * The followings are the available columns in table 'representante':
 * @property string $REP_ID
 * @property string $REP_NOMBRE
 * @property string $REP_RUT
 * @property string $REP_CORREO
 * @property string $REP_FONO
 *
 * The followings are the available model relations:
 * @property Evalua[] $evaluas
 */
class Representante extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'representante';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('REP_NOMBRE, REP_RUT', 'required'),
			array('REP_NOMBRE', 'length', 'max'=>60),
			array('REP_RUT', 'length', 'max'=>12),
			array('REP_CORREO', 'length', 'max'=>50),
			array('REP_FONO', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('REP_ID, REP_NOMBRE, REP_RUT, REP_CORREO, REP_FONO', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'evaluas' => array(self::HAS_MANY, 'Evalua', 'REP_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'REP_ID' => 'Rep',
			'REP_NOMBRE' => 'Rep Nombre',
			'REP_RUT' => 'Rep Rut',
			'REP_CORREO' => 'Rep Correo',
			'REP_FONO' => 'Rep Fono',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('REP_ID',$this->REP_ID,true);
		$criteria->compare('REP_NOMBRE',$this->REP_NOMBRE,true);
		$criteria->compare('REP_RUT',$this->REP_RUT,true);
		$criteria->compare('REP_CORREO',$this->REP_CORREO,true);
		$criteria->compare('REP_FONO',$this->REP_FONO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Representante the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
