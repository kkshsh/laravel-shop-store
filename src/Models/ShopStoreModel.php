<?php
/**
 *------------------------------------------------------
 * ShopStoreModel.php
 *------------------------------------------------------
 *
 * @author    qqiu@qq.com
 * @version   V1.0
 *
 */

namespace SimpleShop\Store\Models;

use Illuminate\Database\Eloquent\Model;

class ShopStoreModel extends Model
{
    /**
     * 维护数据表中 created_at 和 updated_at 字段
     */
    public $timestamps = true;

    /**
     * 数据表名
     */
    protected $table = "shop_store";

    /**
     * 主键
     */
    protected $primaryKey = "id";

    /**
     * 可以被集体附值的表的字段
     */
    protected $fillable = [
        'store_name',
        'store_type'
    ];

}