  <div class="seperate_header"></div>
    <!-- <div class="navbar">
        <ul>
            <li>
                <a href="<?php echo $home_page; ?>"><img class="logo" src="logo/logo.png"></a>
            </li>
            <li class="nav-item">
                <a href="feed.php" style="text-decoration: none">Feed</a>
            </li>
            <li class="nav-item">
                <?php
                    if(!isset($_SESSION['username'])){
                        echo '<a href="account.php" style="text-decoration: none;">Account</a>';
                    }
                    else{
                        echo '<a href="account.php?username='.$_SESSION["username"].'"  style="text-decoration: none;">Account</a>';
                    }
                ?>
            </li>
            <li class="nav-item">
                <?php
                    if(!isset($_SESSION['username'])){
                        echo '<a href="'.$home_page.'" style="text-decoration: none;">Login</a>';
                    }
                    else{
                        echo '<a href="back/logout.php"  style="text-decoration: none;">Logout</a>';
                    }
                ?>
            </li>
        </ul>
    </div> -->

    <div class="message-body">
        <div class="message-window">
            <div class="message-window-head">
                <ul>
                    <li>
                        <a href="account.php?username=<?php if($username[$recp1] != $_SESSION['username']){echo $username[$recp1];} else{echo $username[$recp2];} ?>" style="text-decoration: none;"><img src="img/user.png" alt="profile" class="<?php if($status[$recp2]==1){echo "message-account-profpic-online";} else{echo "message-account-profpic-offline";}?>"></a>
                    </li>
                    <li>
                        <?php if($username[$recp1] != $_SESSION['username']){echo "<b>".$name[$recp1]."</b>";} else{echo "<b>".$name[$recp2]."</b>";} ?>
                        <?php if($status[$recp2]==1){echo "<small><br>online</small>";} else{echo "<small><br>offline</small>";} ?>
                    </li>
                </ul>
            </div>
            <div class="message-window-message-box" id="message-window-message-box">
                    <?php
                        // fetching all the messages for room_id
                        $sql = "SELECT `author`, `message`, `dos` FROM `messages` WHERE `room_id` = ".$room_id.";";

                        $result = mysqli_query($connection, $sql);

                        if(mysqli_num_rows($result) > 0){
                            $rows = mysqli_fetch_all($result);
                            foreach($rows as $row){
                                echo '<div class="message-window-message-display-box">
                                    <div class="message-window-message-display-box-head">
                                        <ul>
                                            <li style="padding-left: 0px; padding-right: 10px;">
                                                <a href="account.php?username='.$username[$row[0]].'" style="text-decoration: none;">'.$name[$row[0]].'</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="message-window-message-display-box-message">
                                        '.str_replace("\n", "<br>", $row[1]).'
                                    </div>
                                </div>';
                            }
                        } else{
                            echo "<center><small>Start new Conversation</small></center>";
                        }
                    ?>
            </div>
            <script>
                document.getElementById("message-window-message-box").scrollTo(0, document.getElementById("message-window-message-box").scrollHeight);
            </script>
            <div class="message-window-input-message">
                <form action="pvtmsg.php" method="POST">
                    <input type="text" name="message" id="message" placeholder="type message..." required>
                    <input type="hidden" name="author" id="author" value="<?php echo $recp1; ?>">
                    <input type="hidden" name="room" id="room" value="<?php echo $room_id; ?>">
                    <input type="hidden" name="recp1" id="recp1" value="<?php echo $recp1; ?>">
                    <input type="hidden" name="recp2" id="recp2" value="<?php echo $recp2; ?>">
                </form>
            </div>
        </div>
    </div>