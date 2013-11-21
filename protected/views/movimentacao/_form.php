<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'movimentacao-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="clearfix" style="margin-bottom: 20px;">
    <p class="help-block">Campos com <span class="required">*</span> são obrigatórios.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo CHtml::radioButtonList('tipoMovimento','',$dataTipoMovimentacao, array(
        'separator'=>'&nbsp;&nbsp;&nbsp;',
        'labelOptions'=>array('style'=>'display: inline;')
    ));?>
</div>
<div class="clearfix">
    <div class="span3">
	    <?php echo $form->dropdownListRow($model,'idConta',array(),array('class'=>'span12', 'prompt'=>'Selecione o Tipo de Movimentação')); ?>
    </div>
    <div class="span3">
	    <?php echo $form->dropdownListRow($model,'idFormaPgto',$dataFormasPgto,array('class'=>'span12', 'prompt'=>'Selecione')); ?>
    </div>
</div>
<div class="clearfix">
    <div class="span3">
        <?php echo $form->datepickerRow($model,'data',array(
                'options' => array('language' => 'pt','format'=>'dd/mm/yyyy'),
                'prepend' => '<i class="icon-calendar"></i>',
            )
        ); ?>
    </div>
    <div class="span3">
	    <?php echo $form->textFieldRow($model,'valor',array('class'=>'span12')); ?>
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
