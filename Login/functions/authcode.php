<?php
require '../../Dashboard/configer/dbcon.php';
require './myfunctions.php';

if(isset($_POST['reg_btn']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    if ($name == "" || $email == "" || $phone == "" || $password == "" || $cpassword == "")  {
        $_SESSION['message'] = "All Fields are Mandetory";
        header('Location: ../register.php');
        // exit(0);
    } else {

        if (!validateFullName($name)) {
            $_SESSION['message'] = "Please Enter a Valid name.";
            header('Location: ../register.php');

            
        } else {
            if(strlen($password) < 8)
            {
                $_SESSION['message'] = "Password must me in 8 words or more!";
                header('Location: ../register.php');
            }
            else
            {

                if(preg_match('/^\d{10}$/', $phone ))
                {
    //Check email if already exist
    $check_email_query = "SELECT email FROM users WHERE email='$email'";
    $check_email_query_run = mysqli_query($con, $check_email_query);


    if(mysqli_num_rows($check_email_query_run) > 0)
    {
        $_SESSION['message'] = "Email Already Registered";
        header('Location: ../register.php');
    }
    else
    {
    if($password == $cpassword)
    {
        //Insert user data
        $insert_query = "INSERT INTO users (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
        $insert_query_run = mysqli_query($con, $insert_query);

        if($insert_query_run)
        {
            $_SESSION['message'] = "Registration Successful";
            header('Location: ../login.php');
        }
        else
        {
            $_SESSION['message'] = "Something went wrong";
            header('Location: ../register.php');
        }

    }
    else
    {
        $_SESSION['message'] = "Passwords do not matched!";
        header('Location: ../register.php');
    }
    }
}
else
{
    $_SESSION['message'] = "Phone number must have exactly 10 digits.";
    header('Location: ../register.php');
}

}
}
}
}

if(isset($_POST['log_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];

    $login_query = "SELECT * FROM users WHERE email = '$email' AND password= '$password' ";
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) > 0)
    {
        $_SESSION['auth'] = true;

        $userdata = mysqli_fetch_array($login_query_run);
        $userid = $userdata['id'];
        $username = $userdata['name'];
        $useremail = $userdata['email'];
        $role_as = $userdata['role_as'];

        $_SESSION['auth_user'] = [
            'user_id' => $userid,
            'name' => $username,
            'email' => $useremail
        ];

        $_SESSION['role_as'] = $role_as;

        if($role_as == 1)
        {
            redirect("../../Dashboard/main/admin.php", "Welcome to Dashboard");
        }
        else
        {
            redirect("../../Book/Book.php", "Logged In Successfully");
        }
    }
    else
    {
        redirect("../login.php", "Wrong Username or Password");
    }
}

?>