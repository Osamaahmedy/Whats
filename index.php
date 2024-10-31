<?php
require 'vendor/autoload.php';
use Twilio\Rest\Client;
require 'DB.php';

if (isset($_POST['name'], $_POST['number'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);

    $insertQuery = "INSERT INTO `send` (name, number) VALUES ('$name','$number')";
    $insert = mysqli_query($conn, $insertQuery);

    if ($insert) {
        $sid = 'AC6fb470da067fe8216047ccc02d798d6d';
        $token = '5f9eb20b20b201540bd0ecb051e45219';
        $twilio = new Client($sid, $token);

        $from = 'whatsapp:+14155238886';
        $to = 'whatsapp:' . $number;
        $message = "مرحبًا، شكرًا لتسجيلك في موقعنا! $name";
        
        try {
            $twilio->messages->create($to, [
                'from' => $from,
                'body' => $message
            ]);
        
            echo "تم إرسال الرسالة بنجاح!";
        } catch (Exception $e) {
            echo "فشل في إرسال الرسالة: " . $e->getMessage();
        }
    } else {
        echo 'Appointment failed';
    }
}

mysqli_close($conn);
?>