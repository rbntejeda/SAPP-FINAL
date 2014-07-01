<?php
/************************************************************************/ 
/* Nombre del archivo	: Usuario.php           
/* Fecha de creación	: 30/03/2014          
/* Descripción			: Modelo de Clase Tipo Tablas de la BD que contiene funciones
/*						de Hashing y reglas de Insersion para evitar tener errores 
/* 						de insersion y de Consultas           
/***********************************************************************/


/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $PER_ID
 * @property string $USU_PASSWORD
 * @property string $USU_CREATE
 * @property string $USU_MODIFIED
 * @property string $USU_ESTADO
 *
 * The followings are the available model relations:
 * @property Persona $pER
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function validatePassword($password)
	{
	return $this->hashPassword($password)===$this->password;
	}
 
	public function hashPassword($password)
	{
		return MD5($password);
	}
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PER_ID, USU_PASSWORD', 'required','message'=>'No puede estar el campo {attribute} vacio.'),
			array('PER_ID', 'length', 'max'=>10),
			array('USU_PASSWORD', 'length', 'max'=>32,'min'=>5,'tooShort'=>'La contraseña es muy corta, se nesesitan al menos 5 caracteres.','tooLong'=>'La contraseña es muy larga'),
			array('USU_ESTADO', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('PER_ID, USU_PASSWORD, USU_CREATE, USU_MODIFIED, USU_ESTADO', 'safe', 'on'=>'search'),
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
			'pER' => array(self::BELONGS_TO, 'Persona', 'PER_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PER_ID' => 'Persona',
			'USU_PASSWORD' => 'Contraseña',
			'USU_CREATE' => 'Fecha de Creación',
			'USU_MODIFIED' => 'Fecha de Modificación',
			'USU_ESTADO' => 'Estado',
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

		$criteria->compare('PER_ID',$this->PER_ID,true);
		$criteria->compare('USU_PASSWORD',$this->USU_PASSWORD,true);
		$criteria->compare('USU_CREATE',$this->USU_CREATE,true);
		$criteria->compare('USU_MODIFIED',$this->USU_MODIFIED,true);
		$criteria->compare('USU_ESTADO',$this->USU_ESTADO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
