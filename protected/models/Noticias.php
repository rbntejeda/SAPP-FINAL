<?php

/**
 * This is the model class for table "noticias".
 *
 * The followings are the available columns in table 'noticias':
 * @property string $NOT_ID
 * @property string $NOT_TITULO
 * @property string $NOT_CONTENIDO
 *
 * The followings are the available model relations:
 * @property Ofrece[] $ofreces
 */
class Noticias extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'noticias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOT_TITULO, NOT_CONTENIDO', 'required','message'=>'{attribute} no puede estar vacio.'),
			array('NOT_TITULO', 'length', 'max'=>100),
			array('NOT_TITULO,NOT_CONTENIDO', 'length','min'=>5,'tooShort'=>'{attribute} es muy corto.'),
			array(	'NOT_TITULO', 'match', 
					'not' => true, 
					'pattern' => '/[^a-zA-Z0-9áéíóúÁÉÍÓÚ.,:; ]/',
					'message' => 'En el {attribute}, solos se pueden usar numero, letras y espacios.'),
			array(	'NOT_CONTENIDO', 'match', 
					'not' => true, 
					'pattern' => '/[^a-zA-Z0-9 \(\)*-+,@_.´:;ñáéíóúÁÉÍÓÚ\n|\r\n]/',
					'message' => 'En el {attribute} solo se pueden usar letras, numeros, espacios y algunos simbolos como (*,-.+)', 'on' => 'create'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('NOT_ID, NOT_TITULO, NOT_CONTENIDO', 'safe', 'on'=>'search'),
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
			'ofreces' => array(self::HAS_MANY, 'Ofrece', 'NOT_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'NOT_ID' => 'Noticia',
			'NOT_TITULO' => 'Titulo',
			'NOT_CONTENIDO' => 'Contenido',
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

		$criteria->compare('NOT_ID',$this->NOT_ID,true);
		$criteria->compare('NOT_TITULO',$this->NOT_TITULO,true);
		$criteria->compare('NOT_CONTENIDO',$this->NOT_CONTENIDO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Noticias the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
