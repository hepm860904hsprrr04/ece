<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Postulacion */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Postulacion',
]) . ' ' . $model->postulacion_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Postulacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->postulacion_id, 'url' => ['view', 'id' => $model->postulacion_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="postulacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
