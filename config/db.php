<?php

class Database
{
    public static function connect()
    {
        $db = new mysqli('localhost', 'root', '', 'abnorm_chat');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}
