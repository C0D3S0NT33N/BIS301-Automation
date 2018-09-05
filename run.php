<?php

require('VestaAPI/WebStackAccount.php');

/**
 * Parameters Declaration
 */

$account    = new stdClass();
$web        = new stdClass();
$database   = new stdClass();

/**
 * Fetch Database Data
 */

// Edit your credential here.
$pdo = new PDO("mysql:host=st.tni.ac.th;dbname=mydatabasename", 'mydatabaseuser', 'password');

$sql = "SELECT * FROM groups";
$sth = $pdo->query($sql);
$sth->setFetchMode(PDO::FETCH_OBJ);

while($group = $sth->fetch()) {
    $account->username    = $group->unixuser;
    $account->password    = $group->password;
    $account->email       = 'bis301@st.tni.ac.th';
    $account->package     = 'default';
    $account->firstName   = $group->group_name;
    $account->lastName    = 'BIS-301';

    $web->domain = "bis301-$group->subdomain.st.tni.ac.th";

    $database->db_name    = 'web';
    $database->db_user    = 'web';
    $database->db_pass    = $group->password;
    $database->db_host    = 'db.st.tni.ac.th' // db.st.tni.ac.th OR 172.16.55.101

    /**
     * Create Web Stack Account
     */

    WebStackAccount::create([
        'account'   => $account,
        'web'       => $web,
        'database'  => $database
    ]);
}
