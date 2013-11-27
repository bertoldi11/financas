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
                array('name'=> 'status', 'header'=>'Status', 'value'=>'($data->status=="A") ? "Aberto" : ($data->status=="F" ? "Fechado" : "Pago")'),
                array(
                    'htmlOptions' => array('nowrap'=>'nowrap'),
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{pagar} {fechar} {update} {view}',
                    //'deleteButtonUrl'=>'Yii::app()->createUrl("fatura/delete", array("id"=>"$data->idFatura"))',
                    'buttons'=>array(
                        'fechar'=>array(
                            'visible'=>'$data->status == "A"',
                            'icon'=>'key',
                            'label'=>'Fechar Fatura',
                            'click'=>'js: function(){
                                return confirm("Deseja fechar essa fatura?");
                            }',
                            'url'=>'Yii::app()->createUrl("fatura/fechar", array("id"=>"$data->idFatura"))'
                        ),
                        'update'=>array(
                            'visible'=>'$data->status == "A"',
                            'url'=>'Yii::app()->createUrl("fatura/alterar", array("id"=>"$data->idFatura"))'
                        ),
                        'view'=>array(
                            'url'=>'Yii::app()->createUrl("fatura/verparcelas", array("id"=>"$data->idFatura"))'
                        ),
                        'pagar'=>array(
                            'visible'=>'$data->status == "F"',
                            'label'=>'Pagar Fatura',
                            'icon'=>'money',
                            //'visible'=>true,
                            'click'=>'js: function(event){
                                event.preventDefault();
                               $("#modalFatura").dialog("open");
                            }'
                        )
                    )
                )
            ),
        ));?>
    </fieldset>
    <?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
        'id'=>'modalFatura',
        'options'=>array(
            'title'=>'Detalhes da Fatura',
            'autoOpen'=>false,
            'modal'=>true,
            'width'=> 710,
            'buttons' => array(
                array('text'=>'Pagar','class'=>'btn btn-primary','click'=> 'js:function(){$(this).dialog("close");}'),
                array('text'=>'Fechar','class'=>'btn','click'=> 'js:function(){$(this).dialog("close");}'),
            )
        ),
    ));?>
        <?php $box = $this->beginWidget(
            'bootstrap.widgets.TbBox',
            array(
                'title' => 'Parcelas',
                'headerIcon' => 'icon-th-list',
                'htmlOptions' => array('class' => 'bootstrap-widget-table')
            )
        );?>
            <table>
                <thead>
                <tr>
                    <th>Local Compra</th>
                    <th>Data Compra</th>
                    <th>Data Parcela</th>
                    <th>Parcela</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody id="tbodyParcelas">

                </tbody>
            </table>
        <?php $this->endWidget(); ?>
    <?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>
</div>
<script>
    $(function(){
        $('a.view').click(function(event){
            event.preventDefault();
            $("#modalFatura").dialog("open");

            $.ajax({
                url: $(this).attr('href'),
                type: 'post',
                dataType: 'JSON'
            }).done(function(JSON){
                if(JSON.MSG){
                    alert(JSON.MSG)
                }

                if(JSON.PARCELAS && JSON.PARCELAS.length > 0)
                {
                    $('#tbodyParcelas > tr').remove();
                    for(var i=0; i<JSON.PARCELAS.length; i++)
                    {
                        var linha = $('<tr>');
                        $(linha).append('<td>'+JSON.PARCELAS[i].descricao+'</td>');
                        $(linha).append('<td>'+JSON.PARCELAS[i].dataCompra+'</td>');
                        $(linha).append('<td>'+JSON.PARCELAS[i].dataParcela+'</td>');
                        $(linha).append('<td>'+JSON.PARCELAS[i].parcela+'</td>');
                        $(linha).append('<td>'+JSON.PARCELAS[i].valor+'</td>');

                        $('#tbodyParcelas').append(linha);
                    }
                }
            });

        });
    });
</script>
