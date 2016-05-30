<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\chat\models\Config */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Config',
]) . $model->config_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chat'), 'url' => ['/chat/default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configs'), 'url' => ['index']];

$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="config-update">
    <?= $this->render('_form', [
        'model' => $model,
		'title'=>$this->title
    ]) ?>

</div>
