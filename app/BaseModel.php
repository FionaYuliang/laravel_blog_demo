<?php
/**
 * Created by PhpStorm.
 * User: yaoze
 * Date: 2017/4/11
 * Time: 20:03
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BaseModel extends  Model
{
    protected static $Instance;
    /**
     * @return static
     */
    static public function Instance()
    {
        $class = get_called_class();
        if (empty(self::$Instance[$class])) {
            self::$Instance[$class] = new $class;
        }

        return self::$Instance[$class];
    }
}
