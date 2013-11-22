<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'forma-pgto-form',
	'enableAjaxValidation'=>false,
    'action'=>$model->isNewRecord ? $this->createUrl('formapgto/novo') : $this->createUrl('formapgto/alterar',array('id'=>$model->idFormaPgto))
)); ?>

<p class="help-block">Campos com <span class="required">*</span> são obrigatórios.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'descricao',array('class'=>'span5','maxlength'=>25)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Salvar' : 'Alterar',
		)); ?>
</div>

<?php $this->endWidget(); ?>
