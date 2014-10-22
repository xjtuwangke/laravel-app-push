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
use TencentXinge\TimeInterval;
use TencentXinge\XingeApp;

class Xinge extends PushServiceProvider{


    /**
     * @var object TencentXinge\XingeApp
     */
    protected static $app = null;

    public static $devices = [ 'ios' , 'android' ];

    public static function pushAll( $title , $content , $expire = 86400 ){
        static::pushAllIos( $title , $content , $expire );
        static::pushAllAndroid( $title , $content , $expire );
    }

    public static function pushAllAndroid( $title , $content , $expire = 86400 ){
        $mess = new Message();
        $mess->setExpireTime( $expire );
        $mess->setTitle( $title );
        $mess->setContent( $content );
        $mess->setType(Message::TYPE_MESSAGE);
        $app = new XingeApp( \Config::get( 'laravel-app-push::' . 'android' . '.accessid' ) , \Config::get( 'laravel-app-push::' . 'android' . '.appsecret' ) );
        $ret = $app->PushAllDevices( 3 , $mess );
        static::log( $ret );
    }

    public static function pushAllIos( $title , $content , $expire = 86400 ){
        $mess = new MessageIOS();
        $mess->setExpireTime( $expire );
        $mess->setAlert( $content );
        $mess->setBadge(1);
        $mess->setSound("beep.wav");
        $custom = array('title'=>$title, 'content'=>$content);
        $mess->setCustom($custom);
        $acceptTime1 = new TimeInterval(0, 0, 23, 59);
        $mess->addAcceptTime($acceptTime1);
        $app = new XingeApp( \Config::get( 'laravel-app-push::' . 'ios' . '.accessid' ) , \Config::get( 'laravel-app-push::' . 'ios' . '.appsecret' ) );
        $ret = $app->PushAllDevices( 4, $mess , XingeApp::IOSENV_PROD );
        static::log( $ret );
    }

    public static function pushSingleByToken( $title , $content , $token , $expire = 86400 ){
        static::pushSingleByAccountIos($title , $content , $token );
        static::pushSingleByAccountAndroid($title , $content , $token );
    }

    public static function pushSingleByTokenAndroid( $title , $content , $token , $expire = 86400){
        $mess = new Message();
        $mess->setTitle( $title );
        $mess->setExpireTime( $expire );
        $mess->setContent( $content );
        $mess->setType( Message::TYPE_MESSAGE );
        $app = new XingeApp( \Config::get( 'laravel-app-push::' . 'android' . '.accessid' ) , \Config::get( 'laravel-app-push::' . 'android' . '.appsecret' ) );
        $ret = $app->PushSingleDevice( $token , $mess);
        static::log( $ret );
    }

    public static function pushSingleByTokenIos( $title , $content , $token , $expire = 86400 ){
        $mess = new MessageIOS();
        $mess->setExpireTime( $expire );
        $mess->setAlert( $content );
        $mess->setBadge(1);
        $mess->setSound("beep.wav");
        $custom = array('title'=>$title, 'content'=>$content);
        $mess->setCustom($custom);
        $acceptTime1 = new TimeInterval(0, 0, 23, 59);
        $mess->addAcceptTime($acceptTime1);
        $app = new XingeApp( \Config::get( 'laravel-app-push::' . 'ios' . '.accessid' ) , \Config::get( 'laravel-app-push::' . 'ios' . '.appsecret' ) );
        $ret = $app->PushSingleDevice( $token , $mess , XingeApp::IOSENV_PROD);
        static::log( $ret );
    }


    public static function pushSingleByAccount( $title , $content , $account , $expire = 86400 ){
        static::pushSingleByAccountIos( $title , $content , $account , $expire );
        static::pushSingleByAccountAndroid( $title , $content , $account , $expire );
    }

    public static function pushSingleByAccountAndroid( $title , $content , $account , $expire = 86400 ){
        $mess = new Message();
        $mess->setExpireTime( $expire );
        $mess->setTitle( $title );
        $mess->setContent( $content );
        $mess->setType(Message::TYPE_MESSAGE);
        $app = new XingeApp( \Config::get( 'laravel-app-push::' . 'android' . '.accessid' ) , \Config::get( 'laravel-app-push::' . 'android' . '.appsecret' ) );
        $ret = $app->PushSingleAccount(0, $account , $mess);
        static::log( $ret );
    }

    public static function pushSingleByAccountIos( $title , $content , $account , $expire = 86400 ){
        $mess = new MessageIOS();
        $mess->setExpireTime( $expire );
        $mess->setAlert( $content );
        $mess->setBadge(1);
        $mess->setSound("beep.wav");
        $custom = array('title'=>$title, 'content'=>$content);
        $mess->setCustom($custom);
        $acceptTime1 = new TimeInterval(0, 0, 23, 59);
        $mess->addAcceptTime($acceptTime1);
        $app = new XingeApp( \Config::get( 'laravel-app-push::' . 'ios' . '.accessid' ) , \Config::get( 'laravel-app-push::' . 'ios' . '.appsecret' ) );
        $ret = $app->PushSingleAccount(0, $account , $mess , XingeApp::IOSENV_PROD);
        static::log( $ret );
    }



}