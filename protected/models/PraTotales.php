<?php

/**
 * This is the model class for table "pra_totales".
 *
 * The followings are the available columns in table 'pra_totales':
 * @property string $PRA_ID
 * @property string $CAR_CODIGO
 * @property string $PER_RUT
 * @property string $PER_NOMBRE
 * @property string $PRA_ESTPRACTICA
 * @property string $PRA_TIPO
 * @property string $PRA_ESTF1
 * @property integer $PRA_ESTF3
 * @property integer $PRA_ESTINFORME
 * @property string $PRA_EVAEMPRESA
 * @property string $PRA_EVAPROFESOR
 */
class PraTotales extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pra_totales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CAR_CODIGO, PER_RUT, PER_NOMBRE, PRA_ESTPRACTICA, PRA_TIPO, PRA_ESTF1, PRA_ESTF3, PRA_ESTINFORME', 'required'),
			array('PRA_ESTF3, PRA_ESTINFORME', 'numerical', 'integerOnly'=>true),
			array('PRA_ID, CAR_CODIGO', 'length', 'max'=>10),
			array('PER_RUT', 'length', 'max'=>12),
			array('PER_NOMBRE', 'length', 'max'=>60),
			array('PRA_ESTPRACTICA', 'length', 'max'=>9),
			array('PRA_TIPO, PRA_ESTF1, PRA_EVAEMPRESA, PRA_EVAPROFESOR', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PRA_ID, CAR_CODIGO, PER_RUT, PER_NOMBRE, PRA_ESTPRACTICA, PRA_TIPO, PRA_ESTF1, PRA_ESTF3, PRA_ESTINFORME, PRA_EVAEMPRESA, PRA_EVAPROFESOR', 'safe', 'on'=>'search'),
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
			'PRA_ID' => 'Pra',
			'CAR_CODIGO' => 'Car Codigo',
			'PER_RUT' => 'Per Rut',
			'PER_NOMBRE' => 'Per Nombre',
			'PRA_ESTPRACTICA' => 'Pra Estpractica',
			'PRA_TIPO' => 'Pra Tipo',
			'PRA_ESTF1' => 'Pra Estf1',
			'PRA_ESTF3' => 'Pra Estf3',
			'PRA_ESTINFORME' => 'Pra Estinforme',
			'PRA_EVAEMPRESA' => 'Pra Evaempresa',
			'PRA_EVAPROFESOR' => 'Pra Evaprofesor',
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

		$criteria->compare('PRA_ID',$this->PRA_ID,true);
		$criteria->compare('CAR_CODIGO',$this->CAR_CODIGO,true);
		$criteria->compare('PER_RUT',$this->PER_RUT,true);
		$criteria->compare('PER_NOMBRE',$this->PER_NOMBRE,true);
		$criteria->compare('PRA_ESTPRACTICA',$this->PRA_ESTPRACTICA,true);
		$criteria->compare('PRA_TIPO',$this->PRA_TIPO,true);
		$criteria->compare('PRA_ESTF1',$this->PRA_ESTF1,true);
		$criteria->compare('PRA_ESTF3',$this->PRA_ESTF3);
		$criteria->compare('PRA_ESTINFORME',$this->PRA_ESTINFORME);
		$criteria->compare('PRA_EVAEMPRESA',$this->PRA_EVAEMPRESA,true);
		$criteria->compare('PRA_EVAPROFESOR',$this->PRA_EVAPROFESOR,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PraTotales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
