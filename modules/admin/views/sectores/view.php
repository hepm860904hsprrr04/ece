<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sector */

$this->title = Yii::t('app', 'View Sector');
$this->params['breadcrumbs'][] = ['label' => 'Sectores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->sector_industrial_id;
?>
<div class="sector-view">
    <p>
        <?php  echo  Html::a('Actualizar', ['update', 'id' => $model->sector_industrial_id], ['class' => 'btn btn-primary']) ?>
        <?php /*= Html::a('Delete', ['delete', 'id' => $model->sector_industrial_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo Html::encode(Yii::t('app', 'Detalle Sector'));?>           
        </div>

    <?php  echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sector_industrial_id',
            'nombre_sector',
        ],
    ]) ?>

    </div>        

</div>
