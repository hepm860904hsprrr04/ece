<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Postulacion */

$this->title = Yii::t('app', 'Create Postulacion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Postulacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postulacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
