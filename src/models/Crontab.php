<?php
/**
 * @link    http://hiqdev.com/hipanel-module-hosting
 * @license http://hiqdev.com/hipanel-module-hosting/license
 * @copyright Copyright (c) 2015 HiQDev
 */

namespace hipanel\modules\hosting\models;

use Yii;

class Crontab extends \hipanel\base\Model
{
    use \hipanel\base\ModelTrait;

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['id', 'account_id', 'server_id', 'client_id'], 'integer'],
            [['crontab', 'account', 'server', 'client'], 'safe'],
            [['state', 'state_label'], 'safe'],
            [['exists'], 'boolean'],
            [['id', 'crontab'], 'safe', 'on' => ['update']],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return $this->mergeAttributeLabels([]);
    }

    /**
     * @return int
     */
    public function getCronRecordCount()
    {
        $count = 0;
        $regex = '/^(\s+)?(#.*)?$/';
        foreach (explode("\n", $this->crontab) as $line) {
            if (!preg_match($regex, trim($line))) $count++;
        }

        return $count;
    }
}