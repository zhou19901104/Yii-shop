<?php
use yii\widgets\Breadcrumbs;
?>
<?php if (isset($this->params['breadcrumbs']) && $this->params['breadcrumbs']): ?>
    <?= Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'],
    ]) ?>
<?php endif; ?>