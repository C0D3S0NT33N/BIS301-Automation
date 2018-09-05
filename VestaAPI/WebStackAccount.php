<?php

require('VestaAPIConnection.php');
require('Abstract/Controller.php');
require('Abstract/Model.php');
require('Models/UserAccount.php');
require('Models/WebSpace.php');
require('Models/Database.php');

class WebStackAccount extends Controller {

    public static function create ($args) {
        
        $sleepTime = 2;

        /**
         * Arguments Extraction
         */
        $account  = $args['account'];
        $web      = $args['web'];
        $database = $args['database'];

        /**
         * Set Username
         */
        $web->username      = $account->username;
        $database->username = $account->username;

        /**
         * Console.log()
         */
        echo "=======================================================\n";
        echo " Creating WebStackAccount For \"$account->username\" \n";
        echo "-------------------------------------------------------\n";
        echo " Username: $account->username\n";
        echo " Domain: $web->domain\n";
        echo "-------------------------------------------------------\n";


        /**
         * Create User Account
         */
        $createAccount = UserAccount::create([
            'username'  => trim($account->username),
            'password'  => $account->password,
            'email'     => $account->email,
            'package'   => $account->package,
            'firstName' => trim($account->firstName),
            'lastName'  => trim($account->lastName)
        ]);
        
        sleep($sleepTime);

        /**
         * Create Web Space
         */
        $createAccount->success(function () use ($web) {
            $createWebSpace = WebSpace::create([
                'username'  => $web->username,
                'domain'    => $web->domain
            ]);
        });
        
        sleep($sleepTime);

        /**
         * Create Database
         */
        $createAccount->success(function () use ($database) {
            $createDatabase = Database::create([
                'username' => $database->username,
                'db_name' => $database->db_name,
                'db_user' => $database->db_user,
                'db_pass' => $database->db_pass,
                'db_host' => $database->db_host
            ]);
        });
        
        sleep($sleepTime);
        
        echo "\n";
    }
}
