<?php

require_once('../vendor/autoload.php');

$client = new EzeepBlueApi\Client(new EzeepBlueApi\Config(
    'id8qr7YpSlewExDTuB08n3MQeVOa5vGnlJqKjv80',
    'inQHouizBTnb4qHUy5AVUqvPGJMsMQOQIRnWTPXITq51PS1uyJnDHPfArpThCDkJRGfLRItnai2TkXQsedaPJjZ03RWyUgmNX0S85ZrjgT5mccNhqd1zX1v793oalLz3',
    'http://localhost:3000/code'
));

//print $client->getAuthorizationUrl();

print_r($client->testAuth());
