<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aliado */

$this->title = Yii::t('app', 'Actualizar {modelClass}: ', [
    'modelClass' => 'Aliado',
]) . ' ' . $model->aliado_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aliados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->aliado_id, 'url' => ['view', 'id' => $model->aliado_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar');
?>
<div class="aliado-update">

    <?= $this->render('_form', [
        'model' => $model,
		'title'=>Yii::t('app', 'Aliado'),
    ]) ?>

</div>
