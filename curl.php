<?php
$url = "https://wapi.wbbox.in/v2/wamessage/send";
$data = array(
    "from" => "919133663334",
    "to" => "919515744884",
    "type" => "template",
    "message" => array(
        "templateid" => "300849",
        "url"=>"https://victoryschools.in/Victory/Images/building.jpg"
    )
);
$data_string = json_encode($data);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'apikey: 1aa0a6ca-2ef7-11ef-ad4f-92672d2d0c2d'
));
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

$response = curl_exec($ch);

if (!$response) {
    echo 0;
} else {
    echo $response;
}

curl_close($ch);
?>
