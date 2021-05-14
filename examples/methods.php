<?php

require_once('../vendor/autoload.php');

$client = new EzeepBlueApi\Client(new EzeepBlueApi\Config(
    'id8qr7YpSlewExDTuB08n3MQeVOa5vGnlJqKjv80',
    'inQHouizBTnb4qHUy5AVUqvPGJMsMQOQIRnWTPXITq51PS1uyJnDHPfArpThCDkJRGfLRItnai2TkXQsedaPJjZ03RWyUgmNX0S85ZrjgT5mccNhqd1zX1v793oalLz3',
    'http://localhost:3000/code',
    'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpc3MiOiJodHRwczovL2FjY291bnQuZXplZXAuY29tIiwiZXhwIjoxNjIwODI5MDUxLCJpYXQiOjE2MjA4MjU0NTEsInNjb3BlcyI6IiIsInN1YiI6Ijk5MDM0NTIxLTdlZGQtNDVkYi04YjZlLWYxMzI1NzEwMzI3YiIsIm9yZyI6IjJiZjBiNzI2LTRmZTAtNDQ0Mi04NDk4LWY3NTFiZDY5NmVmOSIsInJvbCI6ImFkbWluIn0.AXGl7cDjbzTO-doNXIJdA1UsbSkkG64k6shzRyioTaBqhW4I8PcL__jisvPojiMCxG0Eh5s4d2mn-jGxgvTrKiUISiyJzzwuFGhojZt1ec37U-4RX68TyU6G8iiJ9bgQGJXczdXsh2MT-uKnXvHIYoSTvh0rK8XzZ3-ej3kfvFb89oAek7VJr9Gjb_X55lBcSBCDswRi59xyAcC_OR4S3W1WDOQFIKLPihm5BT13uG-SmNrNGIvWHTIlMiStY1jHSNuzobZbDsbSkvDRh9hRQPDhbEZ-HCedENLikK-EFq6THF9R3O7KRn4WapOMZs6-i2ekg83ppwSGH3aBzW7krw',
    'H9CttTZAUcVz6f4wIa3SKbOmx5gjBxP3'
));

print '<pre>';
//print_r($client->print->getConfiguration());
//print_r($client->print->getPrinter());
//print_r($client->print->getPrinterProperties());
//print_r($client->print->prepareUpload());
//print_r($client->print->printUrl('http://www.africau.edu/images/default/sample.pdf', 'pdf', '123'));
//print_r($client->print->getStatus('1123'));