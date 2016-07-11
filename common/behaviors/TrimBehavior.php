<?php

namespace common\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Event;
use common\components\ActiveRecord;

/**
 * @author suxiaolin <suxiaolin@mail.com>
 * @link https://github.com/su-xiaolin
 */
class TrimBehavior extends Behavior
{
    public $attributes = [];

    public function init() {
        parent::init();
        if (!is_array($this->attributes)) {
            $this->attributes = [$this->attributes];
        }
    }

    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_UPDATE => 'evaluateAttributes',
            ActiveRecord::EVENT_BEFORE_INSERT => 'evaluateAttributes',
        ];
    }

    public function evaluateAttributes($event) {
        foreach($this->attributes as $attribute) {
            $this->owner->$attribute = $this->_trimValue($this->owner->$attribute);
        }
    }

    public function trim($attribute) {
        $this->owner->$attribute = $this->_trimValue($this->owner->$attribute);
    }
    
    protected function _trimValue($value) {
        return trim($value);
    }
}
