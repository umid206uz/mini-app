<?php

/** @var yii\web\View $this */
/** @var common\models\Category $model */

$this->title = Yii::t('app', 'Update Category: {name}', [
    'name' => $model->name_uz,
]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name_uz, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
