<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 14/10/23
 * Time: 01:21
 */

namespace Xjtuwangke\LaravelAppPush;


class PushServiceProvider {

    protected static $appKey;

    protected static $appSecret;

    protected static $app = null;

    public static function init(){
        static::$appKey = \Config::get( 'laravel-app-push::config.appkey' );
        static::$appSecret = \Config::get( 'laravel-app-push::config.appsecret' );
    }

    public static function log( $return , $context = array() ){
        if( is_array( $return ) ){
            $return = json_encode( $return , JSON_UNESCAPED_UNICODE );
        }
        \Log::debug( $return , $context );
    }
}