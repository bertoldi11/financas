<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'conta-form',
	'enableAjaxValidation'=>false,
    'action'=>$model->isNewRecord ? $this->createUrl('conta/novo') : $this->createUrl('conta/alterar',array('id'=>$model->idCartaoCredito))
)); ?>
    <div class="clearfix">
        <p class="help-block">Campos com <span class="required">*</span> são obrigatórios.</p>
        <?php echo $form->errorSummary($model); ?>
    </div>
    <div class="clearfix">
        <div class="span6">
            <?php echo $form->dropdownListRow($model,'idTipoMovimentacao',$dataTipoConta,array('class'=>'span12', 'prompt'=>'Selecione')); ?>
        </div>
        <div class="span6">
            <?php echo $form->textFieldRow($model,'descricao',array('class'=>'span12','maxlength'=>45)); ?>
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
