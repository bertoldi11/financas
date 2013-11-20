<?php
$this->breadcrumbs=array(
	'Cartões de Crédito',
);

?>

<div class="box-content span11">
    <fieldset>
        <legend>Cartões de Crédito</legend>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
        <hr>
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'template'=>"{items}",
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                array('name'=> 'nome', 'header'=>'Nome'),
                array('name'=> 'numero', 'header'=>'Numero'),
                array('name'=> 'validade', 'header'=>'Validade'),
                array('name'=> 'limite', 'header'=>'Limite', 'value'=>'number_format($data->limite,2,",",".")'),
                array('name'=> 'diaVencimento', 'header'=>'Dia de Vencimento'),
                array(
                    'htmlOptions' => array('nowrap'=>'nowrap'),
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update} {delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("cartaocredito/alterar", array("id"=>"$data->idCartaoCredito"))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("cartaocredito/delete", array("id"=>"$data->idCartaoCredito"))',
                )
            ),
        ));?>
    </fieldset>
</div>


