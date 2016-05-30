<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Inventario */

$this->title = Yii::t('app', 'Ver detalles: ').$objProducto->inventario_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-view">

    <h1><?php echo  Html::encode($this->title); ?></h1>

    <p>
        <?php echo  Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $objProducto->inventario_id], ['class' => 'btn btn-primary']); ?>
        <?php /*= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->inventario_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */?>
    </p>

	

    <div class="panel panel-default">
        <div class="panel-heading">
            <?php echo Html::encode(Yii::t('app', 'Detalle de Producto'));?>           
        </div>	
        
    <?php
        $nombre_imagen="";
        if($objProducto->foto!="" && file_exists (Yii::$app->basePath.'/web/imagenes/thumbnail/'.$objProducto->foto)){
            $nombre_imagen="/imagenes/thumbnail/".$objProducto->foto;
        }else{
            $nombre_imagen="/imagenes/foto-no-disponible.jpg";
        }
            
    ?>
        
    <?php echo  DetailView::widget([
        'model' => $objProducto,
        'attributes' => [
            'inventario_id',
            'codigo',            
            'inventario',
            'descripcion',
            'sector_industrial_id',
            'unidad_id',
            'unidad_nombre',
            'periodo_id',
            'periodo_descripcion',
            'partida_id',
            'partida_descripcion',
            'ubicacion_necesidad_id',
            'volumen_minimo',
            'volumen_maximo',			
            'precio_referencia_min',
            'precio_referencia_maximo',
            array('attribute'=>'foto','value'=>"@web".$nombre_imagen."",'format' => ['image',['width'=>'100','height'=>'100']],),
            'anexo',
            'observaciones',
            'publicado:boolean',
            //'aliado_id',
        ],
    ]); ?>
    </div>        

</div>	

</div>
