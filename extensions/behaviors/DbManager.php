<?php
/**
 * Created by PhpStorm.
 * User: sheng
 * Date: 16/5/6
 * Time: 上午10:49
 */

namespace app\extensions\behaviors;

use Yii;
use yii\db\Connection;
use yii\di\Instance;
use app\extensions\behaviors\BaseManager;
class DbManager extends BaseManager
{
    /**
     * @var string static default for migration
     */
    public static $defaultTableName = '{{%admin_log}}';

    /**
     * @var string tableName
     */
    public $tableName;

    /**
     * @var string DB
     */
    public static $db = 'db';

    /**
     * @inheritdoc
     */
    public function saveField($data)
    {
        $table =  isset($this->tableName) ? $this->tableName : $this::$defaultTableName;

        self::getDB()->createCommand()
            ->insert($table, $data)->execute();
    }

    /**
     * @return object Return database connection
     * @throws \yii\base\InvalidConfigException
     */
    private static function getDB()
    {
        return Instance::ensure(self::$db, Connection::className());
    }


}