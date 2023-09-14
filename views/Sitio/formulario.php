<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;



?>

<?php

if($mensaje){

    echo Html::tag('div',Html::encode($mensaje),['class'=>'alert alert-danger']);

}

?>

Welcome to your diploma

<?php $formulario=ActiveForm::begin(); ?>

<?= $formulario->field($model,'nombre') ?>
<?= $formulario->field($model,'apellido1') ?>
<?= $formulario->field($model,'apellido2') ?>

<div class="form-group">

<?=Html::submitButton('Enviar',['class'=>'btn btn-primary']) ?>

</div>
<?php ActiveForm::end(); ?>

<div>
    <figure>
        <img class="saturate rounded float-start rounded-pill border border-3 shadow" alt="..." src="http://localhost/diplomanco/web/img/rata.jpg">
    </figure>
    
</div>