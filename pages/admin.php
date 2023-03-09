<div class="wrap form-container">
    <h1>EGOSMS MESSAGING PLUGIN</h1>
    <hr>

    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'settings')" id="defaultOpen">Settings</button>
        <button class="tablinks" onclick="openTab(event, 'send')">Send</button>
        <button class="tablinks" onclick="openTab(event, 'history')">History</button>
        <button class="tablinks" onclick="openTab(event, 'notification')">Notification</button>
    </div>

    <div id="settings" class="tabcontent">
        <h3>Enter EgoSMS Acount Details</h3>
        <form method="post" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Account Username<br /><span style="font-size: x-small;">Available after creating egosms account</span></th>
                    <td>
                        <input size="50" type="text" name="username" placeholder="Enter Account Username" class="regular-text" required/>
                        <br />
                        <small>To create an account, visit <a href="https://www.egosms.co/" target="_blank">https://www.egosms.co/</a></small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Password<br /><span style="font-size: x-small;">Your egosms account password</span></th>
                    <td>
                        <input size="50" type="text" name="password" placeholder="Enter Account Password" class="regular-text" required/>
                        <br />
                        <small>To create an account, visit <a href="https://www.egosms.co/" target="_blank">https://www.egosms.co/</a></small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Sender ID<br /><span style="font-size: x-small;">EgoSMS SenderID.</span></th>
                    <td>
                        <input size="50" type="text" name="sender_id" placeholder="Enter Sender ID" class="regular-text" required/>
                        <br />
                        <small>This is your senderID</small>
                    </td>
                </tr>
            </table><br>
            <input type="submit" class="button-primary" name="submitaccount" value="Save Changes" />
        </form><br>
    </div>

    <div id="send" class="tabcontent">
        <h3>Enter Message to Send</h3>
        <form method="post" action="" >
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Receipient Phone<br /><span style="font-size: x-small;">Recipient's Phone Number</span></th>
                    <td>
                        <input size="50" type="text" name="recipient" placeholder="Enter Phone Number" class="regular-text" required/>
                        <br />
                        <small>Enter Phone Number (256#########)</small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Type Message<br /><span style="font-size: x-small;">Type Your Message</span></th>
                    <td>
                        <textarea size="50" type="text" name="message" placeholder="Enter Your Message" class="regular-text" required></textarea>
                        <br />
                        <small>Maximum Characters 160</small>
                    </td>
                </tr>
            </table><br>
            <input type="submit" class="button-primary" name="sendmessage" value="Send Message" />
        </form><br>
    </div>

    <div id="history" class="tabcontent">
        <h2>Sent Messages</h2>
        <table class="wp-list-table widefat striped">
            <thead>
            <tr>
                <th width="25%">Recipient</th>
                <th width="25%">Message</th>
                <th width="25%">Status</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    global $wpdb;
                    $message_table = $wpdb->prefix . "egosms_messages";
                    $result = $wpdb->get_results("SELECT * FROM $message_table");
                    
                    foreach ($result as $print) {
                        echo "
                        <tr>
                            <td width='25%'>$print->recipient</td>
                            <td width='25%'>$print->message</td>
                            <td width='25%'>$print->message_status</td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <div id="notification" class="tabcontent">
        <h3>Notification</h3>
    </div>
</div>

<style>

</style>

<script>
    // JS for handling tab behaviour
    function openTab(evt, menuItem) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(menuItem).style.display = "block";
    evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<?php
    global $wpdb;
    $user_table = $wpdb->prefix . "egosms_user";
    $message_table = $wpdb->prefix . "egosms_messages";
    // Get account user details from table
    $result = $wpdb->get_row ( "SELECT username, password, sender_id FROM $user_table " ); 


    // Enter egosms user details into the database
    if (isset($_POST['submitaccount']))
    {
        $user_username = $_POST['username'];
        $user_password = $_POST['password'];
        $user_sender_id = $_POST['sender_id'];

        // Will come back later  $password = password_hash($user_password, PASSWORD_DEFAULT);

        $password = $user_password;

        // Check if user exists
        if($result->username > 0){

            // update existing user account
            $current_username = $result->username;
            $current_password = $result->password;
            $current_sender_id = $result->sender_id;
     
            $wpdb->query( $wpdb->prepare("UPDATE $user_table
                SET username = %s, password = %s, sender_id = %s 
                WHERE username = %s AND password = %s AND sender_id = %s ",
                $user_username, $password, $user_sender_id, $current_username, $current_password, $current_sender_id)
            );

        }else{
            // insert user account details into the table
            $wpdb->query("INSERT INTO $user_table(username, password, sender_id) VALUES('$user_username', '$user_password', '$user_sender_id')");
        };

        echo "
            <div class='success-message'>
                Details Saved Successfully
            </div>
        ";
    }

  // Sending and saving message
    if (isset($_POST['sendmessage']))
    {
        $recipient = $_POST['recipient'];
        $message = $_POST['message'];

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


        $username = $result->username;
        $password = $result->password;
        // will come back later $password = password_verify(Jeepers02??, $result->password);
        $sender = $result->sender_id;
        $number = $_POST['recipient'];
        $message = $_POST['message'];

        if(SendSMS($username, $password, $sender, $number, $message) == 'OK')
        {
            $message_status = 1;
            $wpdb->query("INSERT INTO $message_table(recipient, message, message_status) VALUES('$recipient', '$message', '$message_status')");
            echo "
                <div class='success-message'>
                    Message Sent Successfully
                </div>
            ";

        }
        else
        {
            $message_status = 0;
            $wpdb->query("INSERT INTO $message_table(recipient, message, message_status) VALUES('$recipient', '$message', '$message_status')");
            echo "
                <div class='failure-message'>
                    Message Not Sent
                </div>
            ";
           
        }
    }