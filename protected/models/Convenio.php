<?php

/**
 * This is the model class for table "convenio".
 *
 * The followings are the available columns in table 'convenio':
 * @property string $CON_ID
 * @property string $EMP_ID
 * @property string $CON_ESTADO
 * @property string $CON_INGRESO
 * @property string $CON_TERMINO
 * @property string $CON_DESCRIPCION
 *
 * The followings are the available model relations:
 * @property Empresa $eMP
 */
class Convenio extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'convenio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('EMP_ID, CON_ESTADO, CON_INGRESO, CON_TERMINO, CON_DESCRIPCION', 'required'),
			array('EMP_ID, CON_ESTADO', 'length', 'max'=>10),
			array('CON_DESCRIPCION', 'length','min'=>5,'tooShort'=>'{attribute} es muy corto.'),
			array(	'CON_DESCRIPCION', 'match', 
					'not' => true, 
					'pattern' => '/[^a-zA-Z0-9 \(\)*-+,@_.´:;ñáéíóúÁÉÍÓÚ\n|\r\n]/',
					'message' => 'En el {attribute} solo se pueden usar letras, numeros, espacios y algunos simbolos como (*,-.+)', 'on' => 'create'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CON_ID, EMP_ID, CON_ESTADO, CON_INGRESO, CON_TERMINO, CON_DESCRIPCION', 'safe', 'on'=>'search'),
			array('CON_TERMINO','compare','compareAttribute'=>'CON_INGRESO','operator'=>'>','message'=>'El campo <b>Fecha de Término</b> debe ser superior a Fecha de inicio'),
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
			'eMP' => array(self::BELONGS_TO, 'Empresa', 'EMP_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CON_ID' => 'Con',
			'EMP_ID' => 'Emp',
			'CON_ESTADO' => 'Estado',
			'CON_INGRESO' => 'Fecha ingreso',
			'CON_TERMINO' => 'Fecha término',
			'CON_DESCRIPCION' => 'Descripción',
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

		$criteria->compare('CON_ID',$this->CON_ID,true);
		$criteria->compare('EMP_ID',$this->EMP_ID,true);
		$criteria->compare('CON_ESTADO',$this->CON_ESTADO,true);
		$criteria->compare('CON_INGRESO',$this->CON_INGRESO,true);
		$criteria->compare('CON_TERMINO',$this->CON_TERMINO,true);
		$criteria->compare('CON_DESCRIPCION',$this->CON_DESCRIPCION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Convenio the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
