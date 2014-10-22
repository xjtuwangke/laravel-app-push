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

    public static $devices = [ 'ios' , 'android' ];

    public static function pushAll( $title , $content , $expire = 86400 , $device = null ){
        $mess = new Message();
        $mess->setExpireTime( $expire );
        $mess->setTitle( $title );
        $mess->setContent( $content );
        if( ! $device ){
            $device = static::$devices;
        }
        if( ! is_array( $device ) ){
            $device = [ $device ];
        }
        foreach( $device as $one ){
            $app = new XingeApp( \Config::get( 'laravel-app-push::' . $one . '.accessid' ) , \Config::get( 'laravel-app-push::' . $one . '.appsecret' ) );
            $ret = $app->PushAllDevices(0 , $mess);
            var_dump( $ret );
            static::log( $ret );
        }
    }

    public static function pushSingleByToken( $title , $content , $token , $device ){
        $mess = new Message();
        $mess->setTitle( $title );
        $mess->setContent( $content );
        $mess->setType( Message::TYPE_MESSAGE );
        $app = new XingeApp( \Config::get( 'laravel-app-push::' . $device . '.accessid' ) , \Config::get( 'laravel-app-push::' . $device . '.appsecret' ) );
        $ret = $app->PushSingleDevice( $token , $mess);
        static::log( $ret );
    }

    public static function pushSingleByAccount( $title , $content , $account , $expire = 86400 , $device = null ){
        $mess = new Message();
        $mess->setExpireTime( $expire );
        $mess->setTitle( $title );
        $mess->setContent( $content );
        $mess->setType(Message::TYPE_MESSAGE);
        if( ! $device ){
            $device = static::$devices;
        }
        if( ! is_array( $device ) ){
            $device = [ $device ];
        }
        foreach( $device as $one ){
            $app = new XingeApp( \Config::get( 'laravel-app-push::' . $one . '.accessid' ) , \Config::get( 'laravel-app-push::' . $one . '.appsecret' ) );
            $ret = $app->PushSingleAccount(0, $account , $mess);
            var_dump( $ret );
            static::log( $ret );
        }
    }

    public static function pushSingleByAccountIos( $title , $content , $account , $expire = 86400 , $device = null ){
        $mess = new MessageIOS();
        $mess->setExpireTime( $expire );
        $mess->setTitle( $title );
        $mess->setContent( $content );
        $mess->setType(Message::TYPE_MESSAGE);
        if( ! $device ){
            $device = static::$devices;
        }
        if( ! is_array( $device ) ){
            $device = [ $device ];
        }
        foreach( $device as $one ){
            $app = new XingeApp( \Config::get( 'laravel-app-push::' . $one . '.accessid' ) , \Config::get( 'laravel-app-push::' . $one . '.appsecret' ) );
            $ret = $app->PushSingleAccount(0, $account , $mess);
            var_dump( $ret );
            static::log( $ret );
        }
    }



}