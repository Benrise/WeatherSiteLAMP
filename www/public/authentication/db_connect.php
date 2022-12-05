<?php
$connect = mysqli_connect('database', 'root', 'tiger', 'authDB');

if (!$connect) {
    die('Error connect to DataBase');
}
//------------------------------------------------------------------------------------------//
$redisClient = new Redis();

openRedisConnection( 'redis', 6379);

function redisSet($key, $value): void
{
    global $redisClient;
    try {
        $redisClient->set($key, $value);
    } catch (RedisException $e) {
        echo $e -> getMessage( );
    }
}

function redisClear(): void
{
    global $redisClient;
    try {
        $redisClient->flushAll();
    } catch (RedisException $e) {
        echo $e -> getMessage( );
    }
}

function redisGet($key): string
{
    global $redisClient;
    try {
        return $redisClient->get($key);
    } catch (RedisException $e) {
        return "error";
        echo $e -> getMessage( );
    }
}


function openRedisConnection( $hostName, $port): Redis
{
    global $redisClient;
    // Opening a redis connection
    try {
        $redisClient->connect($hostName, $port);
        $redisClient->auth("1111");
    } catch (RedisException $e) {
        echo $e -> getMessage( );
    }
    return $redisClient;
}
