<?php

/**
 * This is the model class for table "fatura".
 *
 * The followings are the available columns in table 'fatura':
 * @property integer $idFatura
 * @property integer $idCartaoCredito
 * @property string $abertura
 * @property string $prevFechamento
 * @property string $status
 * @property string $totalPagar
 *
 * The followings are the available model relations:
 * @property Cartaocredito $idCartaoCredito0
 * @property Movimentacao[] $movimentacaos
 * @property Parcela[] $parcelas
 */
class Fatura extends CActiveRecord
{
    public $formataData = true;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fatura';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idCartaoCredito, abertura, prevFechamento, status', 'required'),
			array('idCartaoCredito', 'numerical', 'integerOnly'=>true),
			array('status', 'length', 'max'=>1),
			array('totalPagar', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idFatura, idCartaoCredito, abertura, prevFechamento, status, totalPagar', 'safe', 'on'=>'search'),
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
			'idCartaoCredito0' => array(self::BELONGS_TO, 'Cartaocredito', 'idCartaoCredito'),
			'movimentacaos' => array(self::HAS_MANY, 'Movimentacao', 'idFatura'),
			'parcelas' => array(self::HAS_MANY, 'Parcela', 'idFatura'),
		);
	}

    public function beforeValidate()
    {
        parent::beforeValidate();
        if($this->formataData)
        {
            $this->abertura = Formatacao::formatData($this->abertura,'/','-');
            $this->prevFechamento = Formatacao::formatData($this->prevFechamento,'/','-');
        }

        return true;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idFatura' => 'Id Fatura',
			'idCartaoCredito' => 'Cartão Crédito',
			'abertura' => 'Abertura',
			'prevFechamento' => 'Prev Fechamento',
			'status' => 'Status',
			'totalPagar' => 'Total Pagar',
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

		$criteria->compare('idFatura',$this->idFatura);
		$criteria->compare('idCartaoCredito',$this->idCartaoCredito);
		$criteria->compare('abertura',$this->abertura,true);
		$criteria->compare('prevFechamento',$this->prevFechamento,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('totalPagar',$this->totalPagar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Fatura the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
