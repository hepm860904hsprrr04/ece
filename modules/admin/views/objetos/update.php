<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $objObjeto app\modules\admin\models\Objeto */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Objeto',
]) . ' ' . $objObjeto->objeto_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sistema'), 'url' => ['/admin/sistema/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $objObjeto->objeto_id, 'url' => ['view', 'id' => $objObjeto->objeto_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="objeto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'objObjeto' => $objObjeto,
    ]) ?>

</div>
