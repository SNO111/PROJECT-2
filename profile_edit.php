<?php include 'includes/session.php';

    $conn = $pdo->open();

    if (isset($_POST['edit'])) {

        $firstname  = $_POST['firstname'];
        $lastname   = $_POST['lastname'];
        $email      = $_POST['email'];
        $passowrd   = $_POST['passowrd'];
        $contact    = $_POST['contact'];
        $address    = $_POST['address'];
        $photo      = $_POST['photo'];
        $curr_passowrd   = $_POST['carr_passowrd'];

        if (password_verify($curr_passowrd, $user['password'])) {
            if (!empty($photo)) {
                move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo);
                $filename = $photo;
            } else {
                $filename = $user['photo'];
            }

            if ($passowrd == $user['passowrd']) {
                $passowrd = $user['passowrd'];
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
            
            try {
                $stmt = $conn->prepare("UPDATE users SET email = :email, password = :password, firstname = :firstname, lastname = :lastname, contact_info = :contact, address = :address, photo = :photo WHERE id = :id");
                $stmt->execute([
                    'email'     => $email,
                    'password'  => $passowrd,
                    'firstname' => $firstname,
                    'lastname'  => $lastname,
                    'contact'   => $contact,
                    'address'   => $address,
                    'photo'     => $filename,
                    'id'        => $user['id']
                ]);

                $_SESSION['success'] = 'Account updated successfully';

            } catch (PDOThrowable $th) {
                $_SESSION['error'] = $th->getMessage();
            }

        } else {
            $_SESSION['error'] = 'Incorrect password';
        }
       
        

    } else {
        $_SESSION['error'] = 'Fill up edit form first';
    }
    $pdo->close();
    
    header('location: profile.php');