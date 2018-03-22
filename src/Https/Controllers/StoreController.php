<?php
/**
 *------------------------------------------------------
 * StoreController.php
 *------------------------------------------------------
 *
 * @author    qqiu@qq.com
 * @version   V1.0
 *
 */

namespace SimpleShop\Store\Https\Controllers;

use Illuminate\Http\Request;
use SimpleShop\Commons\Https\Controllers\Controller;
use SimpleShop\Commons\Utils\ReturnJson;
use SimpleShop\Store\Store;

class StoreController extends Controller
{
    /**
     * @var Store
     */
    private $_service;

    /**
     * StoreController constructor.
     * @param Store $StoreService
     */
    public function __construct(Store $StoreService)
    {
        $this->_service = $StoreService;
    }

    /**
     * 列表
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $this->getRouteParam($request);
        $data = $this->_service->search($request->all(),
            [$this->routeParam['sort'] => $this->routeParam['order']],
            $this->routeParam['page'],
            $this->routeParam['limit']);
        return ReturnJson::paginate($data);
    }

    /**
     * 获取所有
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        $data = $this->_service->getAll();
        return ReturnJson::success($data);
    }


    /**
     * 获取自营店
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSelfStore()
    {
        $data = $this->_service->getSelfStore();
        return ReturnJson::success($data);
    }

    /**
     * 获取详情
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->_service->detail($id);
        return ReturnJson::success($data);
    }

    /**
     * 更新
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $this->_service->update($id,$request->all());
        return ReturnJson::success();
    }

    /**
     * 增添
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $resData = $this->_service->add($request->all());
        return ReturnJson::success($resData);
    }

    /**
     * 删除
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->_service->remove($id);
        return ReturnJson::success();
    }

}
