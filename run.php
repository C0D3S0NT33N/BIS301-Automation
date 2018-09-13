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
    // Please change the following value map to your settings and your database schema.
    $account->username    = $group->unixuser;
    $account->password    = $group->password;
    $account->email       = 'bis301@st.tni.ac.th'; // You can use constant value or use an email of someone in the group.
    $account->package     = 'default';
    $account->firstName   = $group->group_name;
    $account->lastName    = 'BIS-301';

    $web->domain = "bis301-{$group->subdomain}.st.tni.ac.th";

    // VestaCP has default database and username prefix, e.g. groupname_web
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
