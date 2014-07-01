<?php

/**
 * This is the model class for table "bit_admin".
 *
 * The followings are the available columns in table 'bit_admin':
 * @property string $BIT_ID
 * @property string $PRA_ID
 * @property string $BIT_INGRESO
 * @property string $BIT_TITULO
 * @property string $BIT_CONTENIDO
 * @property string $BIT_ESTADO
 * @property string $PER_ID
 * @property string $PRA_TIPO
 * @property string $PER_NOMBRE
 * @property string $EMP_NOMBRE
 */
class BitAdmin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bit_admin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BIT_TITULO, BIT_CONTENIDO, PER_NOMBRE', 'required'),
			array('BIT_ID, PRA_ID, PER_ID', 'length', 'max'=>10),
			array('BIT_TITULO', 'length', 'max'=>100),
			array('BIT_ESTADO, PRA_TIPO', 'length', 'max'=>1),
			array('PER_NOMBRE, EMP_NOMBRE', 'length', 'max'=>60),
			array('BIT_TITULO, BIT_CONTENIDO', 'length','min'=>5,'tooShort'=>'{attribute} es muy corto.'),
			array(	'BIT_TITULO', 'match', 
					'not' => true, 
					'pattern' => '/[^a-zA-Z ]/',
					'message' => 'En el {attribute}, solos se pueden usar letras y espacios.'), //, 'on' => 'create'
			array(	'BIT_CONTENIDO', 'match', 
					'not' => true, 
					'pattern' => '/[^a-zA-Z0-9 *-+,.]/',
					'message' => 'En el {attribute} solo se pueden usar letras, numeros, espacios y algunos simbolos como (*,-.+)'),
			array('BIT_INGRESO', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('BIT_ID, PRA_ID, BIT_INGRESO, BIT_TITULO, BIT_CONTENIDO, BIT_ESTADO, PER_ID, PRA_TIPO, PER_NOMBRE, EMP_NOMBRE', 'safe', 'on'=>'search'),
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
			'BIT_ID' => 'ID Bitácora',
			'PRA_ID' => 'ID Práctica',
			'BIT_INGRESO' => 'Fecha de Ingreso',
			'BIT_TITULO' => 'Título',
			'BIT_CONTENIDO' => 'Contenido',
			'BIT_ESTADO' => 'Estado de Bitácora',
			'PER_ID' => 'ID Persona',
			'PRA_TIPO' => 'Tipo de Práctica ',
			'PER_NOMBRE' => 'Nombre del Alumno',
			'EMP_NOMBRE' => 'Nombre de Empresa',
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

		$criteria->compare('BIT_ID',$this->BIT_ID,true);
		$criteria->compare('PRA_ID',$this->PRA_ID,true);
		$criteria->compare('BIT_INGRESO',$this->BIT_INGRESO,true);
		$criteria->compare('BIT_TITULO',$this->BIT_TITULO,true);
		$criteria->compare('BIT_CONTENIDO',$this->BIT_CONTENIDO,true);
		$criteria->compare('BIT_ESTADO',$this->BIT_ESTADO,true);
		$criteria->compare('PER_ID',$this->PER_ID,true);
		$criteria->compare('PRA_TIPO',$this->PRA_TIPO,true);
		$criteria->compare('PER_NOMBRE',$this->PER_NOMBRE,true);
		$criteria->compare('EMP_NOMBRE',$this->EMP_NOMBRE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BitAdmin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
