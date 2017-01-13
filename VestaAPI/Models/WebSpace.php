<?php

class WebSpace extends Model {
    public static function create($web = [])
    {
        $vesta = new VestaAPIConnection([
            'cmd'  => 'v-add-domain',
            'arg1' => $web['username'],
            'arg2' => $web['domain']
        ]);
        $response = $vesta->execute();

        echo ($response === true)? "[Success] Web space has been successfully created\n" : '[!! ERROR !!] '.$response;

        return new self;
    }
}