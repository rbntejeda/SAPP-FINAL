<?php

/**
 * This is the model class for table "carrera".
 *
 * The followings are the available columns in table 'carrera':
 * @property string $CAR_CODIGO
 * @property string $CAR_NOMBRE
 * @property string $CAR_SIGLA
 *
 * The followings are the available model relations:
 * @property Ofrece[] $ofreces
 * @property Persona[] $personas
 */
class Carrera extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'carrera';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CAR_NOMBRE, CAR_SIGLA', 'required'),
			array('CAR_NOMBRE', 'length', 'max'=>100),
			array('CAR_SIGLA', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CAR_CODIGO, CAR_NOMBRE, CAR_SIGLA', 'safe', 'on'=>'search'),
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
			'ofreces' => array(self::HAS_MANY, 'Ofrece', 'CAR_CODIGO'),
			'personas' => array(self::HAS_MANY, 'Persona', 'CAR_CODIGO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CAR_CODIGO' => 'Car Codigo',
			'CAR_NOMBRE' => 'Car Nombre',
			'CAR_SIGLA' => 'Car Sigla',
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

		$criteria->compare('CAR_CODIGO',$this->CAR_CODIGO,true);
		$criteria->compare('CAR_NOMBRE',$this->CAR_NOMBRE,true);
		$criteria->compare('CAR_SIGLA',$this->CAR_SIGLA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Carrera the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
