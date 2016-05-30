<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Aliado */

$this->title = $model->aliado_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aliados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="aliado-view">
    <p>
        <?php echo  Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->aliado_id], ['class' => 'btn btn-primary']) ?>
        <?php /*echo  Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->aliado_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */?>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo Html::encode(Yii::t('app', 'Group'));?>           
        </div>	
    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'aliado_id',
            'nombre_aliado',
        ],
    ]) ?>
	   </div> 

</div>
