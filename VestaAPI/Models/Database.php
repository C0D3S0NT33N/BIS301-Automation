<?php

class Database extends Model {
    public static function create($database = [])
    {
        $vesta = new VestaAPIConnection([
            'cmd'  => 'v-add-database',
            'arg1' => $database['username'],
            'arg2' => $database['db_name'],
            'arg3' => $database['db_user'],
            'arg4' => $database['db_pass'],
            'arg5' => 'mysql',
            'arg6' => $database['db_host']
        ]);
        $response = $vesta->execute();

        echo ($response === true)? "[Success] Database has been successfully created\n" : '[!! ERROR !!] '.$response;

        return new self;
    }
}
