<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Periodo */

$this->title = $model->periodo_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Periodos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="periodo-view">
    <p>
        <?php echo  Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->periodo_id], ['class' => 'btn btn-primary']) ?>
        <?php /*echo  Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->periodo_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'periodo_id',
            'descripcion',
        ],
    ]) ?>

</div>
