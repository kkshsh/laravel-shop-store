<?php
/**
 *------------------------------------------------------
 * Order.php
 *------------------------------------------------------
 *
 * @author    qqiu@qq.com
 * @version   V1.0
 *
 */

namespace SimpleShop\Store\Repositories\Criteria;


use SimpleShop\Repositories\Contracts\RepositoryInterface as Repository;
use SimpleShop\Repositories\Criteria\Criteria;

class Order extends Criteria
{
    /**
     * @var array
     */
    private $order;

    /**
     * Order constructor.
     *
     * @param array $order
     */
    public function __construct(array $order)
    {
        $this->order = $order;
    }

    /**
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        foreach ($this->order as $field => $sort) {
            $model = $model->orderBy($field, $sort);
        }
        return $model;
    }

}