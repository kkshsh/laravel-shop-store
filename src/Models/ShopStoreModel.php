<?php
/**
 *------------------------------------------------------
 * ShopBrandModel.php
 *------------------------------------------------------
 *
 * @author    wangzd
 * @version   V1.0
 *
 */

namespace SimpleShop\Store\Models;

class ShopStoreModel extends BaseModel
{
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
        'store_type',
    ];

}