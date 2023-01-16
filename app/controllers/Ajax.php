<?php

use OTPHP\TOTP;

require '../vendor/autoload.php';
/**
 * Ajax class
 */
class Ajax
{
    use Controller;

    public function index()
    {
        switch ($_POST['type']) {
            case 'checkRegister':
                $user = new User;

                $arr['username'] = $_POST['username'];

                $row = $user->first($arr);

                if (!$row) {
                    $user->validate($_POST);
                } else {
                    $user->errors['Username'] = 'Username already exists';
                }

                addToErrorLog($user->errors);

                $return = json_encode($user->errors);
                echo $return;
                break;

            case 'registUser':
                $user = new User;

                $arr['username'] = $_POST['username'];

                $row = $user->first($arr);

                if (!$row) {
                    if ($user->validate($_POST, true)) {
                        $_POST['password'] = password_hash($_POST['password'], PASSWORD_ARGON2I);
                        $_POST['recovery_code'] = generateRandomString(16);
                        $user->insert($_POST);
                        unset($_SESSION['TOKEN']);
                        unset($_SESSION['TOKENEXPIRE']);

                        //Auto Login after Register
                        $user1 = new User;
                        $arr1['username'] = $_POST['username'];

                        $row1 = $user1->first($arr1);
                        $_SESSION['USER'] = $row1;

                        $return = 'Token: ' . $_POST['recovery_code'];

                        addToAccessLog(' User Registered', $_SESSION['USER']->username);
                    } else {
                        $return = json_encode($user->errors);
                    }
                } else {
                    $user->errors['username'] = "Username already exists";
                    $return = json_encode($user->errors);
                }

                addToErrorLog($user->errors);

                echo $return;
                break;

            case 'checkLogin':
                $user = new User;
                $arr['username'] = $_POST['username'];

                $row = $user->first($arr);

                if (!$row || !password_verify($_POST['password'], $row->password)) {
                    $user->errors['Login'] = "Wrong username or password";
                } else {
                    sendToken($row->phone);
                }

                addToErrorLog($user->errors);

                $return = json_encode($user->errors);
                echo $return;
                break;

            case 'sendToken':
                sendToken($_POST['phone']);
                break;

            case 'checkLoginSimple':
                $user = new User;
                $arr['username'] = $_POST['username'];

                $row = $user->first($arr);

                if ($row && password_verify($_POST['password'], $row->password)) {
                    $_SESSION['USER'] = $row;
                    addToAccessLog(' User Loggt in', $_SESSION['USER']->username);
                } else {
                    $user->errors['Login'] = "Wrong username or password";
                    $return = json_encode($user->errors);
                    echo $return;
                }
                addToErrorLog($user->errors);
                break;

            case 'setTotp':
                $user = new User;

                $otp = TOTP::create($_SESSION['SECRET']); // create TOTP object from the secret.
                $check = $otp->verify($_POST['totp']); // Returns true if the input is verified, otherwise false.

                if ($check) {
                    $arr['secret'] = $_SESSION['SECRET'];
                    $user->update($_SESSION['USER']->id, $arr);
                    $_SESSION['USER']->secret = $_SESSION['SECRET'];
                    unset($_SESSION['SECRET']);

                    //redirect('dashboard');
                } else {
                    $user->errors['Totp'] = "TOTP Token not correct";
                }

                addToErrorLog($user->errors, $_SESSION['USER']->username);

                $return = json_encode($user->errors);
                echo $return;
                break;

            case 'setStatusPublished':
                $post = new Post;
                if (!empty($_SESSION['USER']->secret)) {
                    $otp = TOTP::create($_SESSION['USER']->secret); // create TOTP object from the secret.
                    $check = $otp->verify($_POST['totp']); // Returns true if the input is verified, otherwise false.

                    if (!$check) {
                        $post->errors['Totp'] = "TOTP Token not correct";
                    } else {
                        $_POST['status'] = '1';
                        $post->update($_POST['id'], $_POST);

                        $jsonposts = new Post;
                        $arr['status'] = '1';
                        postsToJson($jsonposts->where($arr));
                    }
                }else{
                    $post->errors['Totp'] = "TOTP Authentication not set change in My Account!";
                }

                addToErrorLog($post->errors, $_SESSION['USER']->username);

                $return = json_encode($post->errors);
                echo $return;
                break;
        }
    }
}
