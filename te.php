<?php
require_once 'HTTP/Request2.php';
$request = new HTTP_Request2();
$request->setUrl('https://z34ze6.api.infobip.com/whatsapp/1/message/template');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
    'follow_redirects' => TRUE
));
$request->setHeader(array(
    'Authorization' => 'App 4715b357a386a00ba88ded3788ccbe58-93d25d34-3513-43ef-9c19-b67248a2bb41',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json'
));
$request->setBody('{"messages":[{"from":"447860099299","to":"967771257683","messageId":"5b07b957-0258-49b5-af9c-207c8698ed1f","content":{"templateName":"test_whatsapp_template_en","templateData":{"body":{"placeholders":["Osama"]}},"language":"en"}}]}');
try {
    $response = $request->send();
    if ($response->getStatus() == 200) {
        echo $response->getBody();
    }
    else {
        echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
        $response->getReasonPhrase();
    }
}
catch(HTTP_Request2_Exception $e) {
    echo 'Error: ' . $e->getMessage();
}