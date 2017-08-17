<?php
/**
 *------------------------------------------------------
 * Model层基类
 *------------------------------------------------------
 *
 * @author    wangzd
 * @version   V1.0
 *
 */

namespace SimpleShop\Store\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * 维护数据表中 created_at 和 updated_at 字段
     */
    public $timestamps = true;

    /**
     * 多个Where
     * @param Object $query
     * @param array $arr ['status' => 1, 'type' => 2]
     * @return Object $query
     */
    public function multiwhere($query, $arr)
    {
        if ( !is_array($arr) ) {
            return $query;
        }
        foreach ($arr as $key => $value) {
            $query = $query->where($key, $value);
        }
        return $query;
    }

}