<?php

use yii\helpers\Html;

/**
 * @package filamentv\widgets\Search
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c) 2015, Thread
 */
echo Html::beginTag('form', [
    'class' => 'navbar-form navbar-right',
    'role' => 'search'
]) .
 Html::beginTag('div', ['class' => 'form-group']) .
 Html::input('text', 'search', Yii::$app->getRequest()->get('search'), ['class' => 'form-control', 'placeholder' => Yii::t('widget-search', 'submitButtonSearch')]) .
 Html::endTag('div') .
 Html::button(Yii::t('widget-search', 'submitButtonSearch'), ['class' => 'btn btn-info', 'type' => 'Submit']) .
 Html::endTag('form');
