<?php

namespace filamentv\widgets\Breadcrumbs;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;

/**
 * Class Breadcrumbs
 * Widget implemented in structured data.
 * Tested by https://developers.google.com/structured-data/testing-tool/
 *
 * @package filamentv\widgets\Breadcrumbs
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c) 2014, Thread
 * <?= Breadcrumbs::widget([ 'links' => $breadcrumbs ]); ?>
 *
 */
class Breadcrumbs extends \yii\base\Widget {

    public $homeLink;
    public $homeOpen = '{link}<span class="sep">›</span>';
    public $homeClose = '';
    public $links = [];
    public $itemOpen = '<span itemprop="child" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">{link}<span class="sep">›</span>';
    public $itemOpenFirst = '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">{link}<span class="sep">›</span>';
    public $itemClose = '</span>';
    public $encodeLabels = true;

    /**
     * 
     * @return type
     */
    public function run() {
        if (empty($this->links)) {
            return;
        }

        $lnkF = '';

        if ($this->homeLink === null) {
            $lnkF .= $this->renderItem([ 'label' => Yii::t('app', 'Threads'), 'url' => Yii::$app->getUrlManager()->getBaseUrl()], $this->homeOpen) . $this->homeClose;
        } elseif ($this->homeLink !== false) {
            $lnkF.= $this->renderItem($this->homeLink, $this->homeOpen) . $this->homeClose;
        }

        $links = [];
        foreach ($this->links as $k => $link) {
            if (!is_array($link)) {
                $link = ['label' => $link];
            }

            $links[$k] = $this->renderItem($link, ($k === 0) ? $this->itemOpenFirst : $this->itemOpen);
        }

        $links = array_reverse($links);
        $lnk = '';
        foreach ($links as $l) {
            $lnk = $l . $lnk . $this->itemClose;
        }

        echo Html::tag('div', $lnkF . $lnk, ['class' => 'breadcrumbs']);
    }

    /**
     * 
     * @param type $link
     * @param type $template
     * @return type
     * @throws InvalidConfigException
     */
    protected function renderItem($link, $template) {
        if (isset($link['label'])) {
            $label = $this->encodeLabels ? Html::encode($link['label']) : $link['label'];
            $label = '<span itemprop="title">' . $label . '</span>';
        } else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }
        $issetTemplate = isset($link['template']);
        if (isset($link['url'])) {
            return strtr($issetTemplate ? $link['template'] : $template, ['{link}' => Html::a($label, $link['url'], ['itemprop' => 'url'])]);
        } else {
            return strtr($issetTemplate ? $link['template'] : $template, ['{link}' => $label]);
        }
    }

}
