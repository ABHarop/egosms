<?php

    global $wpdb;
    $user_table = $wpdb->prefix . "egosms_user";
    $message_table = $wpdb->prefix . "egosms_messages";

    $result = $wpdb->get_row ( "SELECT username, password, sender_id FROM $user_table " ); 
    
    $username = $result->username;
    $password = $result->password;
    $sender = $result->sender_id;


    // EgoSMS API integration starts here
    function SendSMS($username, $password, $sender, $number, $message)
    {

        $url = "www.egosms.co/api/v1/plain/?";

        $parameters = "number=[number]&message=[message]&username=[username]&password=[password]&sender=[sender]";
        $parameters = str_replace("[message]", urlencode($message), $parameters);
        $parameters = str_replace("[sender]", urlencode($sender), $parameters);
        $parameters = str_replace("[number]", urlencode($number), $parameters);
        $parameters = str_replace("[username]", urlencode($username), $parameters);
        $parameters = str_replace("[password]", urlencode($password), $parameters);
        $live_url = "https://" . $url . $parameters;
        $parse_url = file($live_url);
        $response = $parse_url[0];
        return $response;
    }

    function sanitizeData($value)
    {

        $value = htmlspecialchars($value);

        $value = htmlentities($value);

        $value = stripslashes($value);

        $value = strip_tags($value);

        return $value;

    }