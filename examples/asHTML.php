<?php
ini_set('display_errors', 1);

require_once("../vendor/autoload.php");

use Kuran\SLogger\{Logger, Managers\FileManager, Formaters\LineFormater, Formaters\HTMLLineFormater, ErrorLevel};

$HTMLManager = new FileManager('logs/html.log',
                                ErrorLevel::fromName('Debug'),
                                new LineFormater(format: "<div class='error'><span>{:date} | </span> <span class='error-{:errorLevel}'>[ {:errorLevel} ]</span> <span> | {:message} </span> <span> | (Context: {:context})</span></div>\n")
);

$log = new Logger();
$log->addManager($HTMLManager);

$array = array(
    ":file" => basename(__FILE__),
    ":extras" => array(
        ["name" => "Admin", "username" => "admin"],
        ["name" => "Root", "username" => "root"]
        )
    );

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *, *::before, *::after{box-sizing: border-box; margin: 0; padding: 0;}
        .error-DEBUG{color: #6B7280; font-weight: 700;}
        .error-INFO{color: #3B82F6; font-weight: 700;}
        .error-NOTICE{color: #06B6D4; font-weight: 700;}
        .error-WARNING{color: #FBBF24; font-weight: 700;}
        .error-ERROR{color: #F97316; font-weight: 700;}
        .error-ALERT{color: #EF4444; font-weight: 700;}
        .error-CRITICAL{color: #B91C1C; font-weight: 700;}
        .error-EMERGENCY{color:rgb(255, 152, 165); font-weight: 700;}
        .error{display: grid; grid-template-columns: 1fr 1fr 3fr 5fr;}
        .error-head{display: grid; grid-template-columns: 1fr 1fr 3fr 5fr; background-color: #333; color: #f4f4f4;}
        .error:hover{background-color: #e9ecef;}
        .error:has(.error-EMERGENCY){background-color:rgb(255, 0, 0); color:white}
        .error > span{min-width: 125px;}
        body{font-family: Arial, sans-serif; background-color: #f4f4f4; color: #333;}
        pre{display: flex; flex-direction: column; width: 100dvw;}
    </style>
</head>
<body>

<?php

$log->debug(
    "Test message for the file {:file}",
    $array
);
$log->info(
    "Test message for the file {:file}",
    $array
);
$log->notice(
    "Test message for the file {:file}",
    $array
);
$log->warning(
    "Test message for the file {:file}",
    $array
);
$log->error(
    "Test message for the file {:file}",
    $array
);
$log->alert(
    "Test message for the file {:file}",
    $array
);
$log->critical(
    "Test message for the file {:file}",
    $array
);
$log->emergency(
    "Test message for the file {:file}",
    $array
);
?>

<pre>
<div class='error-head'><span>DATE</span><span>| Error Level</span><span> | Error Message </span><span> | Context</span></div>

<?php include_once("logs/html.log"); ?>

</pre>

    
</body>
</html>