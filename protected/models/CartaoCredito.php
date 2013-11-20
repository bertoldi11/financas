<?php

/**
 * This is the model class for table "cartaocredito".
 *
 * The followings are the available columns in table 'cartaocredito':
 * @property integer $idCartaoCredito
 * @property integer $idUsuario
 * @property string $numero
 * @property string $nome
 * @property string $validade
 * @property string $limite
 * @property integer $diaVencimento
 *
 * The followings are the available model relations:
 * @property Usuario $idUsuario0
 * @property Compracartao[] $compracartaos
 * @property Fatura[] $faturas
 */
class CartaoCredito extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cartaocredito';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idUsuario, numero, nome, validade, limite, diaVencimento', 'required'),
			array('idUsuario, diaVencimento', 'numerical', 'integerOnly'=>true),
			array('numero', 'length', 'max'=>16),
			array('nome', 'length', 'max'=>45),
			array('validade, limite', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idCartaoCredito, idUsuario, numero, nome, validade, limite, diaVencimento', 'safe', 'on'=>'search'),
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
			'idUsuario0' => array(self::BELONGS_TO, 'Usuario', 'idUsuario'),
			'compracartaos' => array(self::HAS_MANY, 'Compracartao', 'idCartoCredito'),
			'faturas' => array(self::HAS_MANY, 'Fatura', 'idCartoCredito'),
		);
	}

    public function beforeValidate()
    {
        parent::beforeValidate();

        $this->limite = str_replace(',', '.', str_replace('.','',$this->limite));
        $this->numero = str_replace(' ','', $this->numero);
        $this->idUsuario = Yii::app()->user->idUsuario;
        return true;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCartaoCredito' => 'Cod. Cartão Crédito',
			'idUsuario' => 'Id Usuario',
			'numero' => 'Número',
			'nome' => 'Nome',
			'validade' => 'Validade',
			'limite' => 'Limite',
			'diaVencimento' => 'Dia Vencimento',
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

		$criteria->compare('idCartoCredito',$this->idCartoCredito);
		$criteria->compare('idUsuario',$this->idUsuario);
		$criteria->compare('numero',$this->numero,true);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('validade',$this->validade,true);
		$criteria->compare('limite',$this->limite,true);
		$criteria->compare('diaVencimento',$this->diaVencimento);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CartaoCredito the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
