<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use filamentv\widgets\LangSwitch\LangSwitch;
use filamentv\widgets\Search\Search;

/**
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c) 2015, Thread
 * @version 19/03/2015
 */
NavBar::begin([
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
/**
 * LangSwitch::widget()
 */
echo LangSwitch::widget();

if (Yii::$app->user->isGuest) {
    $menuItems1[] = ['label' => 'Login', 'url' => ['/user/user/login']];
} else {
    $menuItems1[] = [
        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
        'url' => ['/user/user/logout'],
        'linkOptions' => ['data-method' => 'post']
    ];
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems1,
]);
/**
 * Search::widget()
 */
echo Search::widget();

$menuItems = [
    ['label' => 'Home', 'url' => ['/']],
];

echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);

NavBar::end();
