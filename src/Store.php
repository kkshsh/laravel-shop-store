<?php
/**
 *------------------------------------------------------
 * Store.php
 *------------------------------------------------------
 *
 * @author    qqiu@qq.com
 * @version   V1.0
 *
 */

namespace  SimpleShop\Store;

use SimpleShop\Commons\Exceptions\DatabaseException;
use SimpleShop\Store\Contracts\StoreContract;
use SimpleShop\Store\Events\ShopStoreEvent;
use SimpleShop\Store\Repositories\Criteria\Order;
use SimpleShop\Store\Repositories\Criteria\Search;
use SimpleShop\Store\Repositories\StoreRepository;

class Store implements StoreContract
{
    /**
     * @var StoreRepository
     */
    protected $StoreRepository;

    /**
     * Store constructor.
     * @param StoreRepository $StoreRepository
     */
    public function __construct(StoreRepository $StoreRepository)
    {
        $this->StoreRepository = $StoreRepository;
    }

    /**
     * 获取列表
     *
     * @param array $search
     * @param array $orderBy
     * @param int $page
     * @param int $pageSize
     * @return mixed
     */
    public function search(array $search = [], array $orderBy = [], $page = 1, $pageSize = 10)
    {
        return $this->StoreRepository
            ->pushCriteria(new Search($search))
            ->pushCriteria(new Order($orderBy))
            ->paginate($pageSize, ['*'], $page);
    }

    /**
     * 获取自营店
     *
     * @return mixed
     */
    public function getSelfStore()
    {
        return $this->StoreRepository->findAllBy('store_type', 1);
    }

    public function getAll() {
        return $this->StoreRepository->all();
    }


    /**
     * 获取详情
     *
     * @param $id
     * @return mixed
     */
    public function detail($id)
    {
        return $this->StoreRepository->find($id);
    }

    /**
     * 添加
     *
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        $this->_checkStoreNameUnique($data['store_name']);

        $resData = $this->StoreRepository->create($data);
        if ( !$resData ) {
            throw new DatabaseException("添加数据失败");
        }

        event(new ShopStoreEvent($resData->id, 'added'));

        return $resData;
    }

    /**
     * 更新
     *
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($id, $data)
    {
        $this->_checkStoreNameUnique($data['store_name'], $id);

        $resData = $this->StoreRepository->update($id, $data);
        if ( $resData === false ) {
            throw new DatabaseException("更新数据失败");
        }

        event(new ShopStoreEvent($id, 'updated'));

        return $resData;
    }

    /**
     * 删除
     *
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        $resData = \DB::transaction(function() use ($id) {
            $resData = $this->StoreRepository->delete($id);
            if ( $resData === false ) {
                throw new DatabaseException("删除数据失败");
            }

            event(new ShopStoreEvent($id, 'destroyed'));
            return $resData;
        });

        return $resData;
    }

    /**
     * 校验店铺名唯一
     *
     * @param $storeName
     * @param null $id
     */
    private function _checkStoreNameUnique($storeName, $id = null)
    {
        if( $id ){
            $resData = $this->StoreRepository
                ->getModel()
                ->where("id", "!=", $id)
                ->where("store_name", $storeName)->first();
        }else{
            $resData = $this->StoreRepository->getModel()->where("store_name", $storeName)->first();
        }
        if( $resData ){
            throw new DatabaseException("店铺名已存在");
        }
    }

}
