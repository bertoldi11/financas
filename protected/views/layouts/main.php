<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/base.css'); ?>

     <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <script>

        var intervalo;
        $(function(){
            var quant = $('a.close').length;
            if(quant > 0){
                intervalo=self.setInterval(function(){retiraMensagem()},3000);
            }
        });

        function retiraMensagem()
        {
            $('a.close').parent('div.alert').fadeOut(function(){
                $(this).remove();
            });
        }

    </script>
</head>

<body>
    <?php $this->widget('bootstrap.widgets.TbNavbar',array(
            'htmlOptions'=>array('class'=>'navbar-inverse'),
            'brand' => 'Controle de Finanças',
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label'=>'Início', 'url'=>array('/site/index')),
                        array('label'=>'Cadastro', 'items'=>array(
                            array('label'=>'Cartão de Crédito', 'url'=>array('/cartaocredito/index'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>'Conta', 'url'=>array('/conta/index'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>'Forma de Pagamento', 'url'=>array('/formapgto/index'), 'visible'=>!Yii::app()->user->isGuest),
                        )),
                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    ),
                ),
            ),
        )
    ); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div style="z-index: 1031; position: absolute; top: 15px; left:100px; width: 85%">
                <?php
                // Widget para exibir mensagens para o usuário.
                $this->widget('bootstrap.widgets.TbAlert', array(
                    'block'=>false, // display a larger alert block?
                    'fade'=>true, // use transitions?
                    'closeText'=>'×', // close link text - if set to false, no close link is displayed
                ));
                ?>
            </div>
            <div class="container"> <?php echo $content; ?> </div>
        </div>
    </div>
        <footer class="footer">
            <p class="container copy" style="text-align: center">
                Copyright &copy; <?php echo date('Y'); ?> by Vinícius Bertoldi.<br/>
                All Rights Reserved.<br/>
            </p>
        </footer>
</body>
</html>
