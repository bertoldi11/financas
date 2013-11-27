<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'compra-cartao-form',
	'enableAjaxValidation'=>false,
    'action'=>$model->isNewRecord ? $this->createUrl('compracartao/novo') : $this->createUrl('compracartao/alterar',array('id'=>$model->idCompraCartao))
)); ?>
    <div class="clearfix">
        <p class="help-block">Campos com <span class="required">*</span> são obrigatórios.</p>

        <?php echo $form->errorSummary($model); ?>
        <?php echo $form->textFieldRow($model,'local',array('class'=>'span6','maxlength'=>100)); ?>
    </div>
    <div class="clearfix">
        <div class="span3">
            <?php echo $form->dropdownListRow($model,'idCartaoCredito',$dataCartao,array('class'=>'span12', 'prompt'=>'Selecione')); ?>
        </div>
        <div class="span3">
            <?php echo $form->datepickerRow($model,'dataCompra',array(
                    'options' => array('language' => 'pt','format'=>'dd/mm/yyyy'),
                    'prepend' => '<i class="icon-calendar"></i>',
                )
            ); ?>
        </div>
    </div>
    <div class="clearfix">
        <div class="span2">
            <?php echo $form->textFieldRow($model,'aut',array('class'=>'span12','maxlength'=>15)); ?>
        </div>
        <div class="span2">
            <?php echo $form->textFieldRow($model,'quantParcelas',array('class'=>'span12')); ?>
        </div>
        <div class="span2">
            <?php echo $form->textFieldRow($model,'valorTotal',array('class'=>'span12','maxlength'=>8)); ?>
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
