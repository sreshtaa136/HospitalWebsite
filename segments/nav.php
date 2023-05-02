        <nav id="nav">
            <ul>
                <?php 
                    $links = "";
                    switch($pageTitle) {
                        case 'Russel Street Medical':
                            $links = "<li><a href='#about-us'>About Us</a></li>".
                                    "\n<li><a href='#who-we-are'>Who we are</a></li>".
                                    "\n<li><a href='#service-area'>Service Area</a></li>".
                                    "\n<li><a href='booking.php' target='_blank'>Bookings</a></li>";
                            break;
                        case 'Booking':
                            $links = "<li><a href='index.php'>Home</a></li>";
                            break;
                    }
                    echo $links;
                ?>
            </ul>
            <!-- logout form button for Administration page -->
            <?php 
                if((strcmp($pageTitle, "Administration") == 0) and isset($_SESSION['user'])) {
                    $logoutButton = "<form method='post' action='administration.php'>";
                    $logoutButton .= "<button type='submit' value='logout' name='logout' class='logout-submit'>Logout</button></form>";
                    echo $logoutButton;
                }
            ?>
        </nav>