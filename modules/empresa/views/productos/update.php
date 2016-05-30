<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $objProducto app\modules\admin\models\Inventario */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Inventario',
]) . ' ' . $objProducto->inventario_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $objProducto->inventario_id, 'url' => ['view', 'id' => $objProducto->inventario_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="inventario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $objProducto,
    ]) ?>

</div>
