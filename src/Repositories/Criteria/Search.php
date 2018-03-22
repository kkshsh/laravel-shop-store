<?php
/**
 *------------------------------------------------------
 * Search.php
 *------------------------------------------------------
 *
 * @author    qqiu@qq.com
 * @version   V1.0
 *
 */

namespace SimpleShop\Store\Repositories\Criteria;

use SimpleShop\Repositories\Contracts\RepositoryInterface as Repository;
use SimpleShop\Repositories\Criteria\Criteria;

class Search extends Criteria
{
    /**
     * @var array
     */
    private $search;

    /**
     * Search constructor.
     *
     * @param array $search
     */
    public function __construct(array $search)
    {
        $this->search = $search;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        if ( isset($this->search['store_name']) ) {
            $model = $model->where('store_name', 'like', "%{$this->search['store_name']}%");
        }

        if ( isset($this->search['store_type']) ) {
            $model = $model->where('store_type', $this->search['store_type']);
        }

        return $model;
    }
}