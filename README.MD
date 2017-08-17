1. Config your credential includes MySQL database, MySQL username, MySQL password in filename <b>run.php</b>

Replace your database credential in Line 18
```
$pdo = new PDO("mysql:host=st.tni.ac.th;dbname=<b>mydatabasename</b>", '<b>mydatabaseuser</b>', '<b>password</b>');
```

2. Type the command below to run the program.
```
php run.php
```
