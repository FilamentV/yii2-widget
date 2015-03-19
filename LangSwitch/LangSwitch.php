<?php

namespace filamentv\widgets;

use filament\multilang\MultiLanguage;
use filament\models\Lang;

/**
 * @package thread\app\widgets\Nav
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c) 2015, Thread
 * @version 19/03/2015
 * 
 * <?= LangSwitch::widget();?>
 * 
 */
class LangSwitch extends \yii\bootstrap\Widget {

    protected $current = null;
    protected $items = null;
    public $view = 'LangSwitch';

    public function init() {
        if (MultiLanguage::MULTI == MultiLanguage::KEY_ON) {
            $this->items = Lang::getList();
            $this->current = Lang::getCurrent();

            unset($this->items[$this->current->alias]);
        }
    }

    public function run() {
        if (MultiLanguage::MULTI == MultiLanguage::KEY_ON) {

            $items = [];
            $url = \Yii::$app->getRequest()->getBaseUrl();

            foreach ($this->items as $lang) {
                if ($lang->default !== '1')
                    $items[] = ['label' => $lang->title, 'url' => $url . "/" . $lang->alias];
                else
                    $items[] = ['label' => $lang->title, 'url' => $url];
            }

            return $this->render($this->view, [
                        'current' => $this->current,
                        'items' => $items,
            ]);
        }
    }

}
