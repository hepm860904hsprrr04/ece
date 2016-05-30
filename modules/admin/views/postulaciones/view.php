<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Postulacion */

$this->title = $model->postulacion_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Postulaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="postulacion-view">

    <!--<h1><?php echo  Html::encode($this->title) ?></h1>-->

    <?php echo  DetailView::widget([
        'model' => $model,
        'attributes' => [
        'postulacion_id',            
        'codigo',
        'inventario',
        'ruc',
        'razon_social',
        'correo_electronico',
        'ip_remota',
        'fecha_creacion',
        ],
    ]) ?>

</div>
