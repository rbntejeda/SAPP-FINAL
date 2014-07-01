<?php

/**
 * This is the model class for table "usu_activos".
 *
 * The followings are the available columns in table 'usu_activos':
 * @property string $PER_NOMBRE
 * @property string $PER_RUT
 * @property string $PER_ROLE
 * @property string $USU_CREATE
 * @property string $USU_MODIFIED
 */
class UsuActivos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usu_activos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PER_NOMBRE, PER_RUT, PER_ROLE', 'required'),
			array('PER_NOMBRE', 'length', 'max'=>60),
			array('PER_RUT, PER_ROLE', 'length', 'max'=>12),
			array('USU_CREATE, USU_MODIFIED', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PER_NOMBRE, PER_RUT, PER_ROLE, USU_CREATE, USU_MODIFIED', 'safe', 'on'=>'search'),
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
			'PER_NOMBRE' => 'Per Nombre',
			'PER_RUT' => 'Per Rut',
			'PER_ROLE' => 'Per Role',
			'USU_CREATE' => 'Usu Create',
			'USU_MODIFIED' => 'Usu Modified',
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

		$criteria->compare('PER_NOMBRE',$this->PER_NOMBRE,true);
		$criteria->compare('PER_RUT',$this->PER_RUT,true);
		$criteria->compare('PER_ROLE',$this->PER_ROLE,true);
		$criteria->compare('USU_CREATE',$this->USU_CREATE,true);
		$criteria->compare('USU_MODIFIED',$this->USU_MODIFIED,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuActivos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
