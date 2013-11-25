<?php
$this->breadcrumbs=array(
	'Movimentacões',
);

?>
<div class="box-content span11">
    <fieldset>
        <legend>Movimentação</legend>
        <?php echo $this->renderPartial('_form', array(
                'model'=>$model,
                'dataTipoMovimentacao'=>$dataTipoMovimentacao,
                'dataFormasPgto'=>$dataFormasPgto,
                'dataContas'=>$dataContas,
                'promptConta'=>$promptConta
        )); ?>
        <hr>
        <?php $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'template'=>"{items}",
            'dataProvider'=>$dataProvider,
            'formatter'=>new Formatacao,
            'columns'=>array(
                array('name'=> 'idConta0.idTipoMovimentacao0.descricao','header'=>'Tipo'),
                array('name'=> 'idConta0.descricao', 'header'=>'Conta'),
                array('name'=> 'data', 'header'=>'Data', 'type'=>'data'),
                array('name'=> 'valor', 'header'=>'Valor', 'type'=>'moeda'),
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
