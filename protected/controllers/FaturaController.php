<?php

class FaturaController extends Controller
{
    public $_model = null;

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('novo','alterar','index', 'delete'),
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionNovo()
    {
        $model=new Fatura;

        if(isset($_POST['Fatura']))
        {
            $totalFaturaAberta = Fatura::model()->count('idCartaoCredito = :idCartaoCredito AND status="A"',array(':idCartaoCredito'=>$_POST['Fatura']['idCartaoCredito']));
            if($totalFaturaAberta == 0)
            {
                $model->attributes=$_POST['Fatura'];
                $model->status = "A";
                if ($model -> save())
                {
                    $criteriaParcela = new CDbCriteria(array(
                        'condition'=>'dataVenc BETWEEN :dtInicio AND :dtFim',
                        'params'=>array(':dtInicio'=>$model->abertura, ':dtFim'=>$model->prevFechamento)
                    ));
                    Parcela::model()->updateAll(array('idFatura'=>$model->idFatura), $criteriaParcela);

                    Yii::app()->db->createCommand("UPDATE fatura SET totalPagar = (SELECT SUM(valor) FROM parcela WHERE idFatura=:idFatura) WHERE idFatura=:idFatura")
                        ->bindValue(':idFatura',$model->idFatura)->execute();

                    Yii::app()->user->setFlash('success', 'Dados Salvos.');
                }
                else
                {
                    $this->_model = $model;
                    $this->actionIndex();
                    exit;
                }
            }
            else
            {
                Yii::app()->user->setFlash('error', 'Já existe uma fatura aberta para esse cartão.');
            }

        }
        $this->redirect($this->createUrl('fatura/index'));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionAlterar($id)
    {
        $model=$this->loadModel($id);

        if(isset($_POST['Fatura']))
        {
            $model->attributes=$_POST['Fatura'];
            if ($model -> save())
            {
                Yii::app()->user->setFlash('success', 'Dados Alterados.');
                $this->redirect($this->createUrl('fatura/index'));
            }
        }

        $this->_model = $model;
        $this->actionIndex();
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model=(is_null($this->_model)) ? new Fatura : $this->_model;
        $model->abertura = Formatacao::formatData($model->abertura);
        $model->prevFechamento = Formatacao::formatData($model->prevFechamento);

        $dataProvider=new CActiveDataProvider('Fatura');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
            'model'=>$model,
            'dataCartao'=>CHtml::listData(CartaoCredito::model()->findAll(),'idCartaoCredito','nome')
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=Fatura::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='fatura-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
