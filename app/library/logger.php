<?php
// echo __DIR__; // /var/www/html/library
// echo dirname(__DIR__); // /var/www/html
function writeLog(string $message): void
{

    $now = date("Y/m/d H:i:s");

    if(!is_null(Session::get("name"))) {
        $name = Session::get('name');
        $log = "{$now} {$name} {$message}\n";
    } else {
        $log = "{$now} {$message}\n"; 
    }

    $fileName = dirname(__DIR__) . "/log/app.log";

    if(!file_exists($fileName)) {
        file_put_contents($fileName, '');
    } 
    $handle = fopen($fileName, "a");
        fwrite($handle, $log);
        fclose($handle);
    
}

function startWriteLog(string $message): void
{

    $now = date("Y/m/d H:i:s");

    if(!is_null(Session::get("name"))) {
        $name = Session::get('name');
        $log = "{$now} {$name} {$message}\n";
    } else {
        $log = "{$now} {$message}\n"; 
    }

    $fileName = dirname(__DIR__) . "/log/app.log";

    if(file_exists($fileName)) {
        unlink($fileName);
    }
    file_put_contents($fileName, '');

    $handle = fopen($fileName, "a");
    fwrite($handle, $log);
    fclose($handle);
}

?>