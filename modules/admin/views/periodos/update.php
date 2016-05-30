<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Periodo */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Periodo',
]) . ' ' . $model->periodo_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Periodos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->periodo_id, 'url' => ['view', 'id' => $model->periodo_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="periodo-update">  
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
