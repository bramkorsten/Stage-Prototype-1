<?php
error_reporting(E_ALL ^ E_WARNING);
set_time_limit(120);
    $cmd = ("cd ../repo && git status 2>&1");
    $output = shell_exec($cmd);
    // $cmd = ("git checkout master");
    // $output += shell_exec($cmd);
    // $cmd = ("git pull");
    // $output += shell_exec($cmd);

// putenv('PHPLOY_PORT=21');
// putenv('PHPLOY_HOST=127.0.0.1');
// putenv('PHPLOY_USER=installer');
// putenv('PHPLOY_PASS=root');
//putenv('PHPLOY_PATH=');
// SetEnv(PHPLOY_HOST,"myftphost.com");
// SetEnv(PHPLOY_USER,"ftp");
// SetEnv(PHPLOY_PASS,"password");
// SetEnv(PHPLOY_PATH,"/home/user/public_html/example.com");

// echo $_ENV['PHPLOY_PORT'];
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Deployment Test</title>
     <link rel="stylesheet" href="/assets/css/styles.css">
   </head>
   <body>
     <form action="deploy.php" method="post">
       <input type="text" name="host" placeholder="host" />
       <input type="text" name="port" placeholder="port" />
       <br>
       <input type="text" name="user" placeholder="username" />
       <br>
       <input type="text" name="pass" placeholder="password" />
       <br><br>
       <input type="text" name="options" placeholder="--options" />
       <br>
       Select what to deploy:
       <br>
       <input type="radio" name="type" value="master" checked>CMS Core<br>
       <input type="radio" name="type" value="klant1">Klant 1 Modules<br>
       <input type="submit" value="deploy">
     </form>

     <?php echo('<pre>'.$output.'</pre>'); ?>
   </body>
 </html>
