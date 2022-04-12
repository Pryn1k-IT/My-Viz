<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru', 'phpmailer/language/');
    $mail->IsHTML(true);

    
    //
    $mail->addAddress('capbadpryn1k@gmail.com');
    //
    $mail->Subject = 'Work';

    //


    //
    $body = '<h1>WORK!</h1>';

    if(trim(!empty($_POST['servise']))){
        $body.='<p><strong>Servise:</strong> '.$_POST['servise'].'</p>';
    }
    if(trim(!empty($_POST['deadline']))){
        $body.='<p><strong>Deadline:</strong> '.$_POST['deadline'].'</p>';
    }
    if(trim(!empty($_POST['email']))){
        $body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
    }

    if(trim(!empty($_POST['plusinfo']))){
        $body.='<p><strong>Info:</strong> '.$_POST['plusinfo'].'</p>';
    }

    //
    if (!empty($_FILES['image']['tmp_name'])) {
        //
        $filePath = __DIR__ . "/files/" . $_FILES['image']['name'];
        //
        if (copy($_FILES['image']['tmp_name'], $filePath)){
            $fileAttach = $filePath;
            $body.='<p><strong>Foto</strong></p>';
            $mail->addAttachment($fileAttach);
        }
    }

    $mail->Body = $body;

    //
    if (!$mail->send()) {
        $message = 'Error!';
    } else {
        $message = 'Sent!';
    }

    $response = ['message' => $message];

    header('Content-type: application/json');
    echo json_encode($response);
?>