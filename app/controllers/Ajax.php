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

                $return = json_encode($user->errors);
                echo $return;
                break;

            case 'sendToken':
                $_SESSION['TOKEN'] = strval(rand(100000, 999999));

                $fields = json_encode(array(
                    "mobileNumber" => $_POST['phone'],
                    "message" => $_SESSION['TOKEN']
                ));

                $curl_session = curl_init();
                curl_setopt($curl_session, CURLOPT_URL, "https://m183.gibz-informatik.ch/api/sms/message");
                curl_setopt($curl_session, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl_session, CURLOPT_POSTFIELDS, $fields);
                curl_setopt(
                    $curl_session,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'X-Api-Key: NQAxADgAMAA2ADgAMwA2ADgAMgAyADYANAAzADQANgA5ADUA'
                    )
                );
                curl_exec($curl_session);
                curl_close($curl_session);
                break;

            case 2:
                echo "i ist gleich 2";
                break;
        }
    }
}
