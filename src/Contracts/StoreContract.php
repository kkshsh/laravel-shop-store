<?php
/**
 *------------------------------------------------------
 * StoreContract.php
 *------------------------------------------------------
 *
 * @author    qqiu@qq.com
 * @version   V1.0
 *
 */

namespace SimpleShop\Store\Contracts;

interface StoreContract
{
    /**
     * @param array $search
     * @param array $orderBy
     * @param int $page
     * @param int $pageSize
     *
     * @return mixed
     */
    public function search(array $search = [], array $orderBy = [], $page = 1, $pageSize = 10);

    /**
     * @param $id
     * @return mixed
     */
    public function detail($id);

    /**
     * @param $data
     * @return mixed
     */
    public function add($data);

    /**
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($id,$data);

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id);

}