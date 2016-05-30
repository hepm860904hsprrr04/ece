<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Periodo */

$this->title = Yii::t('app', 'Crear Periodo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Periodos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodo-create">


    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>
