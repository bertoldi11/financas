<?php
$this->breadcrumbs=array(
	'Contas',
);
?>
<div class="box-content span11">
    <fieldset>
        <legend>Contas</legend>
        <?php echo $this->renderPartial('_form', array('model'=>$model,'dataTipoConta'=>$dataTipoConta)); ?>
        <hr>
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'template'=>"{items}",
            'dataProvider'=>$dataProvider,
            'columns'=>array(
                array('name'=> 'idConta', 'header'=>'Cod. Conta'),
                array('name'=> 'idTipoMovimentacao0.descricao', 'header'=>'Tipo'),
                array('name'=> 'descricao', 'header'=>'Conta'),
                array(
                    'htmlOptions' => array('nowrap'=>'nowrap'),
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update} {delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("conta/alterar", array("id"=>"$data->idConta"))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("conta/delete", array("id"=>"$data->idConta"))',
                )
            ),
        ));?>
    </fieldset>
</div>
