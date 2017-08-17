<?php

/*
 * This file is part of Commodity Store
 *
 * (c) Wangzd <wangzhoudong@foxmail.com>
 *
 */

namespace  SimpleShop\Commodity;
use SimpleShop\Commodity\Cate\Criteria\BrandCateId;


/**
 * This is the Commodity class.
 *
 * @author Wangzd <wangzhoudong@foxmail.com>
 */
class Brand
{

    /**
     * 品牌基本管理
     * @return \Illuminate\Foundation\Application|mixed
     *
     */
    static function info() {
        return app(Info::class);
    }

    static function search() {
        return app(BrandRepository::class);
    }

    /**
     * 根据分类获取数据
     * @param $cate_id
     */
    static function getListByCateId($cate_id) {
        $obj = app(BrandRepository::class);
        return $obj->pushCriteria(new BrandCateId($cate_id))->all();

    }


}
