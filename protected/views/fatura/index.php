<?php
$this->breadcrumbs=array(
	'Faturas',
);

?>
<div class="box-content span11">
    <fieldset>
        <legend>Faturas</legend>
        <?php echo $this->renderPartial('_form', array(
            'model'=>$model,
            'dataCartao'=>$dataCartao
        )); ?>
        <hr>
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'template'=>"{items}",
            'dataProvider'=>$dataProvider,
            'formatter'=>new Formatacao,
            'columns'=>array(
                array('name'=> 'idCartaoCredito0.nome', 'header'=>'Cartão',),
                array('name'=> 'abertura', 'header'=>'Abertura', 'type'=>'data'),
                array('name'=> 'prevFechamento', 'header'=>'Prev. Fechamento', 'type'=>'data'),
                array('name'=> 'totalPagar', 'header'=>'Valor Total', 'type'=>'moeda'),
                array('name'=> 'status', 'header'=>'Status', 'value'=>'$data->status=="A" ? "Aberto" : "Fechado"'),
                array(
                    'htmlOptions' => array('nowrap'=>'nowrap'),
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update} {delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("fatura/alterar", array("id"=>"$data->idFatura"))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("fatura/delete", array("id"=>"$data->idFatura"))',
                )
            ),
        ));?>
    </fieldset>
</div>
