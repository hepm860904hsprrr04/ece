<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\InventarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'inventario_id') ?>

    <?= $form->field($model, 'empresa_id') ?>

    <?= $form->field($model, 'inventario') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'codigo') ?>

    <?php // echo $form->field($model, 'volumen_minimo') ?>

    <?php // echo $form->field($model, 'volumen_maximo') ?>

    <?php // echo $form->field($model, 'unidad_id') ?>

    <?php // echo $form->field($model, 'periodo_id') ?>

    <?php // echo $form->field($model, 'partida_id') ?>

    <?php // echo $form->field($model, 'ubicacion_necesidad_id') ?>

    <?php // echo $form->field($model, 'precio_referencia_min') ?>

    <?php // echo $form->field($model, 'precio_referencia_maximo') ?>

    <?php // echo $form->field($model, 'foto') ?>

    <?php // echo $form->field($model, 'anexo') ?>

    <?php // echo $form->field($model, 'observaciones') ?>

    <?php // echo $form->field($model, 'publicado')->checkbox() ?>

    <?php // echo $form->field($model, 'sector_industrial_id') ?>

    <?php // echo $form->field($model, 'aliado_id') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'fecha_creacion') ?>

    <?php // echo $form->field($model, 'modificado_por') ?>

    <?php // echo $form->field($model, 'fecha_modificacion') ?>

    <?php // echo $form->field($model, 'asignado_a') ?>

    <?php // echo $form->field($model, 'fecha_asignacion') ?>

    <?php // echo $form->field($model, 'total_postulacion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
