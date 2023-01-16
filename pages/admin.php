<div class="wrap form-container">
    <h1>EGOSMS MESSAGING PLUGIN</h1>
    <hr>

    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'settings')" id="defaultOpen">Settings</button>
        <button class="tablinks" onclick="openCity(event, 'history')">History</button>
        <button class="tablinks" onclick="openCity(event, 'send')">Send</button>
        <button class="tablinks" onclick="openCity(event, 'notification')">Notification</button>
    </div>

    <div id="settings" class="tabcontent">
        <form method="post" action="options.php">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Account Username<br /><span style="font-size: x-small;">Available after creating egosms account</span></th>
                    <td>
                        <input size="50" type="text" name="[username]" placeholder="Enter Account Username" value="<?php echo esc_html( $options['username'] ); ?>" class="regular-text" required/>
                        <br />
                        <small>To create an account, visit <a href="https://www.egosms.co/" target="_blank">https://www.egosms.co/</a></small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Password<br /><span style="font-size: x-small;">Your egosms account password</span></th>
                    <td>
                        <input size="50" type="text" name="[password]" placeholder="Enter Account Password" value="<?php echo esc_html( $options['password'] ); ?>" class="regular-text" required/>
                        <br />
                        <small>To create an account, visit <a href="https://www.egosms.co/" target="_blank">https://www.egosms.co/</a></small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Sender ID<br /><span style="font-size: x-small;">This is optional.</span></th>
                    <td>
                        <input size="50" type="text" name="[sender_id]" placeholder="Enter Sender ID" value="<?php echo esc_html( $options['Sender ID'] ); ?>" class="regular-text" required/>
                        <br />
                        <small>You can leave this blank</small>
                    </td>
                </tr>
            </table><br>
            <?php // settings_fields( TWL_CORE_SETTING ); ?>
            <input type="submit" class="button-primary" value="Save Changes" />
        </form><br>
    </div>

    <div id="history" class="tabcontent">
    <h3>History</h3>
    </div>

    <div id="send" class="tabcontent">
    <h3>Send</h3>
    </div>

    <div id="notification" class="tabcontent">
    <h3>Notification</h3>
    </div>
</div>

<style>
    /* Style the tab */
    .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    font-size: 18px;
    }

    /* Style the buttons inside the tab */
    .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 10px 15px;
    transition: 0.3s;
    font-size: 16px;
    font-weight: 500
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
    background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
    background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
    }
</style>

<script>
    function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
