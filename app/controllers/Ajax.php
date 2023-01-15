<?php

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

                addToErrorLog($user->errors, $_SESSION['USER']->username);

                $return = json_encode($user->errors);
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

                addToErrorLog($user->errors, $_SESSION['USER']->username);

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
                addToErrorLog($user->errors, $_SESSION['USER']->username);
                break;
        }
    }
}
