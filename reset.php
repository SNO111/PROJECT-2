<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include 'includes/session.php';

    if (isset($_POST['reset'])) {

        $email = $_POST['email'];

        $conn = $pdo->open();

        $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();

        if ($row['numrows'] > 0) {
            // Generate code
            $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = substr(str_shuffle($set), 0, 15);
            try {
                $stmt = $conn->prepare("UPDATE users SET reset_code = :code  WHERE id = :id");
                $stmt->execute(['code' => $code, 'id' => $row['id']]);

                $message = '
                    <h2>Password Reset</h2>
                    <p>Your Account:</p>
                    <p>Email: ' . $email . '</p>
                    <p>Please click the link to reset your password</p>
                    <a href="http://localhost/project2/password_reset.php?code=' . $code .'&user="' . $row['id'] . '>Reset Password</a>
                ';

                // Load PHPMailer 
                require 'vendor/autoload.php';
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'mtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'nafisahosman1@gmail.com';
                    $mail->Password = 'gaqadecwptrnoxir';
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer'       => false,
                            'verify_peer_name'  => false,
                            'allow_self_signed' => true 
                        )
                    );
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom('nafisahosman1@gmail.com');
                    // Recipients
                    $mail->addAddress($mail);
                    $mail->addReplayTo('nafisahosman1@gmail.com');
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = '[ PROJECT 2 ] eCommerce Site Password Reset';
                    $mail->Body = $message;
                    $mail->send();

                    $_SESSION['success'] = 'Password reset link sent';

                } catch (Exception $th) {
                    $_SESSION['error'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
                }

            } catch (PDOThrowable $th) {
                $_SESSION['error'] = $th->getMessage();
            }
            
        } else {
            $_SESSION['error'] = 'Email not found';
        }

        $pdo->close();
        
        
    } else {
        $_SESSION['error'] = 'Input email associated with your account';    
    }

    header('location: password_forgot.php');


