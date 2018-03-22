<?php
/**
 *------------------------------------------------------
 * StoreRepository.php
 *------------------------------------------------------
 *
 * @author    qqiu@qq.com
 * @version   V1.0
 *
 */

namespace SimpleShop\Store\Repositories;

use Illuminate\Database\Eloquent\Model;
use SimpleShop\Store\Models\ShopStoreModel;
use SimpleShop\Repositories\Eloquent\Repository;

/**
 * Class StoreRepository
 * @package SimpleShop\Store\Repositories
 */
class StoreRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return ShopStoreModel::class;
    }

    /**
     * Get Model
     *
     * @return \Illuminate\Database\Eloquent\Builder|Model
     */
    public function getModel()
    {
        if ($this->model instanceof Model) {
            return $this->model;
        }
        return $this->makeModel();
    }

}
