<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$config['socket_type'] = 'tcp'; //`tcp` or `unix`
//$config['socket'] = '/var/run/redis.sock'; // in case of `unix` socket type
//$config['host'] = '127.0.0.1';
//$config['password'] = 'shiyi1993';
//$config['port'] = 6379;
//$config['timeout'] = 60;

$config['wx'] = array(
    'token' => '06HbxA3AaAs547H0DBidB6F1J1hzydn9',
    'appid' => 'wx1ae77f0491111bb1',//wx0cfc2cfe995d1ddb
    'appsecret' => 'f6915adf1a6c2a5090ecf7eac693fbbb',//d4624c36b6795d1d99dcf0547af5443d
);

$config['redism'] = array(
    'quan' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 0),
    ),
    'sms' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 1),
    ),
    'mail' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 2),
    ),
    'wechat' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 3),
    ),
    'stock' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 4),
    ),
    'scaler' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 5),
    ),
    'short' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 6),
    ),
    'user' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 7),
    ),
    'chats' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 8),
    ),
    'system' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 9),
    ),
    'userinfo' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 10),
    ),
    'oauth' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 11),
    ),
    'event' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 12),
    ),
    'cms' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 13),
    ),
    'goods_list' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 14),
    ),
    'goods' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 15),
    ),
    'api' => array(
        array('127.0.0.1', '6379', 4, 'shiyi1993', 3, 16),
    ),
);

