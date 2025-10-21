<?php
namespace app\channel\service\channel;

use app\channel\model\WechatConfig;
use app\channel\model\WechatMpConfig;
use app\channel\model\WechatWorkConfig;
use app\channel\model\DouyinMpConfig;
use think\Exception;

class Channel{
    /**
     * 获取渠道配置信息
     * @return WechatMpConfig|WechatConfig|array
     */
    public function config($channel ,$shopid = 0)
    {

        switch ($channel){
            //微信公众号
            case 'h5':
                $data = (new WechatConfig())->getWechatConfigByShopId($shopid);
                if (empty($data)){
                    throw  new Exception('微信公众号配置文件不存在');
                }
            break;
            case 'weixin_h5':
                $data = (new WechatConfig())->getWechatConfigByShopId($shopid);
                if (empty($data)){
                    throw  new Exception('微信公众号配置文件不存在');
                }
            break;
            case 'pc':
                $data = (new WechatConfig())->getWechatConfigByShopId($shopid);
                if (empty($data)){
                    throw  new Exception('微信公众号配置文件不存在');
                }
            break;
            //微信小程序
            case 'weixin_mp':
                //获取配置信息
                $map = [
                    ['shopid' ,'=' , $shopid],
                ];
                $data = (new WechatMpConfig())->where($map)->find();
                if (empty($data)){
                    throw  new Exception('微信小程序配置信息不存在');
                }
            break;
            //企业微信
            case 'weixin_work':
                //获取配置信息
                $data = (new WechatWorkConfig())->getConfigByShopId($shopid);
                if (empty($data)){
                    throw  new Exception('企业微信配置信息不存在');
                }
            break;
            case 'douyin_mp':
                //获取配置信息
                $map = [
                    ['shopid' ,'=' , $shopid],
                ];
            $data = (new DouyinMpConfig())->where($map)->find();
                if (empty($data)){
                    throw  new Exception('抖音小程序配置信息不存在');
                }
            break;

            default:
                $data = [];
        }
        
        return $data;
    }
}