<?php
require 'Zklibrary/Zklibrary.php';
require 'Http/Http.php';
require 'Config.php';


$zk = new ZKLibrary(IP_DEVICE, PORT_DEVICE);
$zk->connect();
$zk->disableDevice();
//$df = $zk->getUserTemplate(2, 6)[4];
var_dump($zk->getDeviceName());
//var_dump(bin2hex($df));
//var_dump($zk->setUser(3, 3, "Test2", "", 0));
//var_dump($zk->getFaceFunctionOn());
$dg = $zk->getUser();
var_dump($dg);
$zk->enableDevice();
$zk->disconnect();

//var_dump(Http::Get("https://lookup.binlist.net/4076775794237572"));
/*
$data = [
    "RequestType" => "AvailabilityRequest",
    "Data" => [
        "SiteId" => 504,
        "Ip" => "189.183.96.4",
        "Parameters" => [
            "Location" => "NE",
            "Tour_code" => "ENCO",
            "Date_tour" => "2021-05-20",
            "Schedule" => "09:30 AM",
            "Adults" => 2,
            "Children" => 1
        ]
    ]
];

$settings = [
    'Content-Type: application/json',
    'ApiKey: EAbFpF4c8fML0RY90XVV7uOvQUxXsLKIwf4lP0c795FfvM2'
];

$json = Http::Post("http://ebgral.dtraveller.com/v1/availability", $data, $settings);
$obj = json_decode($json);
var_dump($obj->Data->Response->Tour_availability);
*/
?>
