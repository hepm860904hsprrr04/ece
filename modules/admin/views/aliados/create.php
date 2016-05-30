<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Aliado */

$this->title = Yii::t('app', 'Create Aliado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sistema'), 'url' => ['/admin/sistema/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aliados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aliado-create">

    <?= $this->render('_form', [
        'model' => $model,
		'title'=>Yii::t('app', 'Aliado'),
    ]) ?>

</div>
