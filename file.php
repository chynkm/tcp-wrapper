<?php

// echo exec("whoami");
$filename = "/etc/hosts.allow";
$file     = fopen($filename, "w+");
// $contents = fread($file, filesize($filename));
// echo $contents;
// fclose($file);

if ($file)
{
    while($line = fgets($file))
        echo $line."<br/>";

    $result = fwrite($file, "test 44\n");
    var_dump($result);
    fclose($file);
}
else
    die("error opening file");