<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/10/23
 * Time: 01:29
 */

namespace Xjtuwangke\LaravelAppPush;


use TencentXinge\Message;
use TencentXinge\MessageIOS;
use TencentXinge\XingeApp;

class Xinge extends PushServiceProvider{


    /**
     * @var object TencentXinge\XingeApp
     */
    protected static $app = null;

    public static function init(){
        parent::init();
        if( ! static::$app ){
            static::$app = new XingeApp( static::$appKey , static::$appSecret );
        }
    }

    public static function pushSingleDeviceMessage( $title , $content , $token ){
        $mess = new Message();
        $mess->setTitle( $title );
        $mess->setContent( $content );
        $mess->setType( Message::TYPE_MESSAGE );
        $ret = static::$app->PushSingleDevice( $token , $mess);
        static::log( $ret );
        return $ret;
    }

    public static function pushSingleAccount( $title , $content , $account ){
        $mess = new Message();
        $mess->setExpireTime(86400);
        $mess->setTitle( $title );
        $mess->setContent( $content );
        $mess->setType(Message::TYPE_MESSAGE);
        $ret = static::$app->PushSingleAccount(0, $account , $mess);
        static::log( $ret );
        return ($ret);
    }



}