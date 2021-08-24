            <div style="display:flex;">
            <!-- Friends -->
                <div style="flex:1;min-height:400px;">
                    <div id="friends_area">
                        Friends<br />
                        <?php
                            if($friends) {
                                foreach($friends as $friend) {
                                    // print_r($row)."<br>";
                                    // print_r($one_user);

                                    include("user.php");
                                }
                            }
                            
                        ?>
                    </div>
                </div>
                <!-- Post area -->
                <div style="flex:2.5;min-height:400px;padding: 20px;padding-right: 0px;">
                    <div style="border: none; paddding: 10px;background-color:white;">
                    
                        <form action="" method='post' enctype="multipart/form-data">
                            <textarea name="post" placeholder="Whats on your mind?"></textarea><br />
                            <input type="file" name="file">
                            <input type="submit" id="post" value="post"><br />
                        <br />
                        </form>
                    </div>
                    <!-- Post views -->
                    <div id="post_area">
                        <?php
                            if($posts) {
                                foreach($posts as $row) {
                                    // print_r($row)."<br>";
                                    $user = new User();
                                    $one_user = $user->get_user($row['userid']);
                                    // print_r($one_user);

                                    include("post.php");
                                }
                            }
                            
                        ?>
                        
                    </div>
                </div>
            </div>