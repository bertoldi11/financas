<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'movimentacao-form',
	'enableAjaxValidation'=>false,
    'action'=>$model->isNewRecord ? $this->createUrl('movimentacao/novo') : $this->createUrl('movimentacao/alterar',array('id'=>$model->idMovimentacao))
)); ?>
<div class="clearfix" style="margin-bottom: 20px;">
    <p class="help-block">Campos com <span class="required">*</span> são obrigatórios.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo CHtml::radioButtonList('tipoMovimento',isset($_POST['tipoMovimento']) ? $_POST['tipoMovimento'] : '',$dataTipoMovimentacao, array(
        'separator'=>'&nbsp;&nbsp;&nbsp;',
        'labelOptions'=>array('style'=>'display: inline;')
    ));?>
</div>
<div class="clearfix">
    <div class="span3">
	    <?php echo $form->dropdownListRow($model,'idConta',$dataContas,array('class'=>'span12', 'prompt'=>$promptConta)); ?>
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
<script>
    $(function(){
        $('input[name="tipoMovimento"]').click(function(event){
            var idTipoMovimentacao = $(this).val();
            if(idTipoMovimentacao > 0)
            {
                $.ajax({
                    url: '<?php echo $this->createUrl('conta/listar');?>',
                    data: { idTipoMovimentacao: idTipoMovimentacao},
                    type: 'post',
                    dataType: 'json'
                }).done(function(JSON){
                    if(JSON.MSG){
                        alert(JSON.MSH);
                    }

                    if(JSON.CONTAS && JSON.CONTAS.length > 0)
                    {
                        $('#Movimentacao_idConta').empty();
                        $('#Movimentacao_idConta').append('<option value="">Selecione</option>');

                        for(var i=0; i < JSON.CONTAS.length; i++ )
                        {
                            $('#Movimentacao_idConta').append('<option value="'+JSON.CONTAS[i].idConta+'">'+JSON.CONTAS[i].descricao+'</option>');
                        }
                    }
                });
            }
        });
    });
</script>