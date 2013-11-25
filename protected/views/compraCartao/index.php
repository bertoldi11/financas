<?php
$this->breadcrumbs=array(
	'Compra Cartão de Crédito',
);

?>
<div class="box-content span11">
    <fieldset>
        <legend>Compra Cartão de Crédito</legend>
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
                array('name'=> 'dataCompra', 'header'=>'Data', 'type'=>'data'),
                array('name'=> 'valorTotal', 'header'=>'Valor', 'type'=>'moeda'),
                array(
                    'htmlOptions' => array('nowrap'=>'nowrap'),
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update} {delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("compracartao/alterar", array("id"=>"$data->idCompraCartao"))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("compracartao/delete", array("id"=>"$data->idCompraCartao"))',
                )
            ),
        ));?>
    </fieldset>
</div>
