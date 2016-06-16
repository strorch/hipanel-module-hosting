<?php

/*
 * Hosting Plugin for HiPanel
 *
 * @link      https://github.com/hiqdev/hipanel-module-hosting
 * @package   hipanel-module-hosting
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2016, HiQDev (http://hiqdev.com/)
 */

/**
 * @link    http://hiqdev.com/hipanel-module-hosting
 * @license http://hiqdev.com/hipanel-module-hosting/license
 * @copyright Copyright (c) 2015 HiQDev
 */

namespace hipanel\modules\hosting\validators;

use yii\validators\RegularExpressionValidator;

/**
 * Class EmailLocalPart is used to validate Email local parts
 *
 * @package hipanel\modules\hosting\validators
 */
class EmailLocalPartValidator extends RegularExpressionValidator
{
    /**
     * @var string default validation pattern for the local part
     */
    public $defaultPattern = '/^[0-9a-z_+-]([0-9a-z\._+-]+)?$/i';

    /**
     * @var string the same as [[defaultPattern]], but allows `*` character.
     * Used when [[allowWildCard]] is true.
     */
    public $defaultWildPattern = '/^(\*|([0-9a-z_+-]([0-9a-z\._+-]+)?))$/i';

    /**
     * @var bool Whether to allow `*` char instead of local part. Defaults to false.
     */
    public $allowWildCard = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->message = \Yii::t('app', '{attribute} is not a valid local part of email');

        if ($this->pattern === null) {
            $this->pattern = $this->allowWildCard ? $this->defaultWildPattern : $this->defaultPattern;
        }
    }
}
