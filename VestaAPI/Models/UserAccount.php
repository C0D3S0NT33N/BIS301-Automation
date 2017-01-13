<?php

class UserAccount extends Model {

    public static function create ($account = []) {

        $vesta = new VestaAPIConnection([
                    'cmd'  => 'v-add-user',
                    'arg1' => $account['username'],
                    'arg2' => $account['password'],
                    'arg3' => $account['email'],
                    'arg4' => $account['package'],
                    'arg5' => $account['firstName'],
                    'arg6' => $account['lastName']
                ]);
        $response = $vesta->execute();

        echo ($response === true)? "[Success] User account has been successfully created\n" : '[!! ERROR !!] '.$response;

        return new self;
    }

    public function success ($function) {
        $function();
    }
}

