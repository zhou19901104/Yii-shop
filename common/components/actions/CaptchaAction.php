<?php

namespace common\components\actions;

use yii\captcha\CaptchaAction as BaseCaptchaAction;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchaAction extends BaseCaptchaAction {
    protected function renderImage($code) {
        $builder = new CaptchaBuilder($code);
        $builder->setBackgroundColor(255, 255, 255);
        $builder->build(150, 40, $this->fontFile);
        return $builder->get();
    }
}
