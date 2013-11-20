<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cartao-credito-form',
	'enableAjaxValidation'=>false,
    'action'=>$model->isNewRecord ? $this->createUrl('cartaocredito/novo') : $this->createUrl('cartaocredito/alterar',array('id'=>$model->idCartaoCredito))
)); ?>
    <div class="clearfix">
        <p class="help-block">Campos com <span class="required">*</span> são obrigatórios.</p>
        <?php echo $form->errorSummary($model); ?>
    </div>
    <div class="clearfix">
        <div class="span7">
            <?php echo $form->textFieldRow($model,'nome',array('class'=>'span12','maxlength'=>45)); ?>
        </div>
        <div class="span5">
            <?php echo $form->labelEx($model,'numero');?>
            <?php $this->widget('CMaskedTextField', array(
                'model' => $model,
                'attribute' => 'numero',
                'mask' => '9999 9999 9999 9999',
                'htmlOptions' => array('class'=>'span12','maxlength'=>16)
            ));?>
        </div>
    </div>
    <div class="clearfix">
        <div class="span4">
            <?php echo $form->labelEx($model,'validade');?>
            <?php $this->widget('CMaskedTextField', array(
                'model' => $model,
                'attribute' => 'validade',
                'mask' => '99/9999',
                'htmlOptions' => array('class'=>'span12','maxlength'=>16)
            ));?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'limite',array('class'=>'span12','maxlength'=>10)); ?>
        </div>
        <div class="span4">
            <?php echo $form->textFieldRow($model,'diaVencimento',array('class'=>'span12')); ?>
        </div>
    </div>
    <div class="clearfix">
        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'submit',
                    'type'=>'primary',
                    'label'=>$model->isNewRecord ? 'Salvar' : 'Alterar',
                )); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>
