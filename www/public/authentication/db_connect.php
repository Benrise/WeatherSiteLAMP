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

function redisRpush($id, $save_path): void{
    global $redisClient;
    try {
        $redisClient->rPush('pics:' . $id, $save_path);
    } catch (RedisException $e) {
        echo $e -> getMessage( );
    }
}

function redislRange($id){
    global $redisClient;
    try {
        $pics = $redisClient->lRange('pics:' . $id, 0, -1);
    } catch (RedisException $e) {
        echo $e -> getMessage( );
    }


}

function redislIndex($id) : string{
    global $redisClient;
    try {
        $path = $redisClient->lIndex("pics:" . $id, '0');
    } catch (RedisException $e) {
        echo $e -> getMessage( );
    }
    return ($path);
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
