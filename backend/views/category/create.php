<?php

/** @var yii\web\View $this */
/** @var common\models\Category $model */

$this->title = Yii::t('app', 'Create new');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
