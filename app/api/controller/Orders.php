<?php
namespace app\api\controller;

use app\common\controller\Api;
use app\common\logic\Orders as OrdersLogic;
use \app\common\model\Orders as OrdersModel;
use app\channel\facade\bytedance\MiniProgram as DouyinMiniProgramServer;
use think\Exception;
use think\facade\Db;
use think\Request;
use app\common\validate\Orders as OrdersValidate;
use think\exception\ValidateException;

class Orders extends Api
{
    protected $middleware = [
        'app\\common\\middleware\\CheckParam',
        'app\\common\\middleware\\CheckAuth',
    ];

    private $OrdersModel;//订单模型
    private $OrdersLogic;//订单逻辑
    function __construct(Request $request)
    {
        parent::__construct();
        $this->OrdersLogic = new OrdersLogic();
        $this->OrdersModel = new OrdersModel();
    }

    /**
     * @title 下单
     * @return \think\Response|void
     */
    public function create()
    {
        if (request()->isPost()){
            Db::startTrans();
            try {
                //具体业务 分发到相应程序订单类
                $this->params['uid'] = get_uid();
                // 验证数据
                try {
                    validate(OrdersValidate::class)->check($this->params);
                } catch (ValidateException $e) {
                    // 验证失败 输出错误信息
                    return $this->error($e->getError());
                }

                // 交给应用内约定类处理数据
                $order_info_type = $this->params['order_info_type'];
                if($order_info_type == 'vipcard'){
                    $order_namespace = "app\\common\\service\\VipOrders";
                    $appOrdersService = new $order_namespace;
                    $order_data = $appOrdersService->create($this->params);
                }else{
                    $order_namespace = "app\\{$this->params['app']}\\service\\Orders";
                    $appOrdersService = new $order_namespace;
                    $order_data = $appOrdersService->create($this->params);
                }
                
                // 设置表单ID数据
                if(isset($this->params['formId'])){
                    $order_data['form_id'] = $this->params['formId'];
                }

                //写入订单
                $res = $order_id = $this->OrdersModel->edit($order_data);
                if (!$res){
                    throw new Exception('Failed to create order, please try again later');
                }
                //获取订单数据
                $order = $this->OrdersModel->getDataById($order_id);
                $order = $this->OrdersLogic->formatData($order);
                //免费商品或需退费商品后续业务逻辑处理
                if($order['paid_fee'] <= 0 && $order['paid'] == 1){
                    if(method_exists($appOrdersService,'step')){
                        // 免费商品直接处理后续逻辑，约定step方法
                        $appOrdersService->step($order);
                    }
                }
                // 抖音小程序订单同步
                if($order['channel'] == 'douyin_mp'){
                    DouyinMiniProgramServer::ordersPush($order['order_no']);
                }

                Db::commit();

                return $this->success('Order created successfully',$order);
            }catch (Exception $e){
                Db::rollback();
                if (\think\facade\App::isDebug()){
                    return $this->error($e->getMessage().$e->getFile().$e->getLine());
                }else{
                    return $this->error($e->getMessage());
                }
            }
        }
    }

    /**
     * @title 订单列表
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function list()
    {
        
        $uid = request()->uid;
        $status = input('status');
        $rows = input('rows', 15, 'intval');
        $map = [
            ['shopid','=',$this->shopid],
            ['uid','=',$uid],
        ];

        if ($this->params['status']  == 'all'){
            $map[] = ['status' ,'between' ,[0,9999]];
        }else{
            $map[] = ['status' ,'=' ,$status];
        }

        $order_field = input('order_field', 'id', 'text');
        $order_type = input('order_type', 'desc', 'text');
        $order =  $order_field . ' ' . $order_type;
        $fields = '*';
        $lists = $this->OrdersModel->getListByPage($map, $order, $fields, $rows);
        $lists = $lists->toArray();
        foreach($lists['data'] as &$val){
            $val = $this->OrdersLogic->formatData($val);
        }
        unset($val);

        return $this->success('Orders retrieved successfully',$lists);
        
    }

    /**
     * @title 订单详情
     */
    public function detail()
    {
        $order_no = $this->params['order_no'];
        $order_data = $this->OrdersModel->getDataByOrderNo($order_no);
        $order_data = $this->OrdersLogic->formatData($order_data);

        // pc端商品路径
        $return_url = url($order_data['app'] . '/' . $order_data['products']['link']['url'], $order_data['products']['link']['param']);

        return $this->success('success',$order_data, $return_url);
    }

}