<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'fatura-form',
	'enableAjaxValidation'=>false,
    'action'=>$model->isNewRecord ? $this->createUrl('fatura/novo') : $this->createUrl('fatura/alterar',array('id'=>$model->idFatura))
)); ?>
    <div class="clearfix">
        <p class="help-block">Campos com <span class="required">*</span> são obrigatorios.</p>
        <?php echo $form->errorSummary($model); ?>
    </div>
    <div class="clearfix">
        <div class="span3">
            <?php echo $form->dropdownListRow($model,'idCartaoCredito',$dataCartao,array('class'=>'span12', 'prompt'=>'Selecione')); ?>
        </div>
        <div class="span3">
            <?php echo $form->datepickerRow($model,'abertura',array(
                    'options' => array('language' => 'pt','format'=>'dd/mm/yyyy'),
                    'prepend' => '<i class="icon-calendar"></i>',
                )
            ); ?>
        </div>
        <div class="span3">
            <?php echo $form->datepickerRow($model,'prevFechamento',array(
                    'options' => array('language' => 'pt','format'=>'dd/mm/yyyy'),
                    'prepend' => '<i class="icon-calendar"></i>',
                )
            ); ?>
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
