<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Objeto */

$this->title = Yii::t('app', 'Create Objeto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sistema'), 'url' => ['/admin/sistema/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objeto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
