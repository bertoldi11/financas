<?php
$this->breadcrumbs=array(
	'Movimentacaos',
);

?>
<div class="box-content span11">
    <fieldset>
        <legend>Movimentação</legend>
        <?php echo $this->renderPartial('_form', array('model'=>$model,'dataTipoMovimentacao'=>$dataTipoMovimentacao,'dataFormasPgto'=>$dataFormasPgto)); ?>
        <hr>
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'template'=>"{items}",
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                array('name'=> 'data', 'header'=>'Data'),
                array('name'=> 'valor', 'header'=>'Valor'),
                array(
                    'htmlOptions' => array('nowrap'=>'nowrap'),
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update} {delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("movimentacao/alterar", array("id"=>"$data->idMovimentacao"))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("movimentacao/delete", array("id"=>"$data->idMovimentacao"))',
                )
            ),
        ));?>
    </fieldset>
</div>
