<?php

/**
 * This is the model class for table "usu_sinasignar".
 *
 * The followings are the available columns in table 'usu_sinasignar':
 * @property string $PER_ROLE
 * @property string $CAR_CODIGO
 * @property string $Nombre
 * @property string $PER_ID
 */
class UsuSinasignar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usu_sinasignar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PER_ROLE, CAR_CODIGO', 'required'),
			array('PER_ROLE', 'length', 'max'=>12),
			array('CAR_CODIGO, PER_ID', 'length', 'max'=>10),
			array('Nombre', 'length', 'max'=>73),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PER_ROLE, CAR_CODIGO, Nombre, PER_ID', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PER_ROLE' => 'Per Role',
			'CAR_CODIGO' => 'Car Codigo',
			'Nombre' => 'Nombre',
			'PER_ID' => 'Per',
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

		$criteria->compare('PER_ROLE',$this->PER_ROLE,true);
		$criteria->compare('CAR_CODIGO',$this->CAR_CODIGO,true);
		$criteria->compare('Nombre',$this->Nombre,true);
		$criteria->compare('PER_ID',$this->PER_ID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuSinasignar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
