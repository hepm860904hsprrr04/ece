<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sector */

$this->title = 'Update Sector: ' . ' ' . $model->sector_industrial_id;
$this->params['breadcrumbs'][] = ['label' => 'Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sector_industrial_id, 'url' => ['view', 'id' => $model->sector_industrial_id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="sector-update">
    <?php echo $this->render('_form', [
        'model' => $model,
        'title' => Html::encode(Yii::t('app', 'Detalle Sector')),
    ]) ?>
</div>
