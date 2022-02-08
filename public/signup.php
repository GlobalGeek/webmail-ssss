<?php 
session_status();
define('CHKINCLUDE', true);
require_once(__DIR__ . '/../inc/bootstrap/bootstrap.php'); 

function signupChecking()
{
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Session array to store error information
        $_SESSION['errors'] = array();
        
        // Sanitize user input
        $fname = filter_var(stripslashes(trim($_POST['first-name'])), FILTER_SANITIZE_STRING);
        $lname = filter_var(stripslashes(trim($_POST['last-name'])), FILTER_SANITIZE_STRING);
        $uname = filter_var(stripslashes(trim($_POST['username'])), FILTER_SANITIZE_STRING);
        $altmail = filter_var(stripslashes(trim($_POST['alt-email'])), FILTER_SANITIZE_EMAIL);
        $pass1 = $_POST['password'];
        $pass2 = $_POST['confirm-password'];
        // Check & sanitize forwarding option
        if(isset($_POST['forwarding'])){
            $forward = (bool)$_POST['forwarding'];
        }
        else{
            $forward = false;
        }

        // Check firstname & username are set
        if(!$fname){
            array_push($_SESSION['errors'], 'Invalid or missing name.');
        }
        if(!$uname){
            array_push($_SESSION['errors'], 'Invalid or missing username.');
        }
        // Check passwords match
        if($pass1 !== $pass2){
            array_push($_SESSION['errors'], 'Both passwords must match.');
        }
        // Ensure alt-email is set if forwarding is enabled
        if($forward === true && filter_var($altmail, FILTER_VALIDATE_EMAIL) === false){
            array_push($_SESSION['errors'], 'Please enter alternate email address if you want to enable forwarding.');
        }
        // Ensure alt-email is valid
        if(!empty($altmail) && filter_var($altmail, FILTER_VALIDATE_EMAIL) === false){
            array_push($_SESSION['errors'], 'Invalid alternate email address.');    
        }
        print_r($forward);

        
        if(!$_SESSION['errors']){
            $emailNew = $uname . '@' . S4CFG_DOMAIN;
            if(mailAccountsCheckExists($emailNew) === false){
                echo $emailNew . ' does not exist.';
                
            }
            else{
                echo $emailNew . ' exists.';
            }
            return true; // return true if validation happened
        }
    }
    return false; // return false if no validation happened
}

if(signupChecking() === true){
    //header('Location: success.php');
}

function errorsDisplay() // Displays any errors stored in session
{
    if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
        // Set up alert display div
        echo '<div class="alert alert-danger" role="alert">';
        // Set text at the top of the alert
        echo '<h4 class="alert-heading">Error: </h4>';
        // Multiple errors can be displayed at once in a list
        echo '<ul>'; 

        // Loop out errors
        foreach($_SESSION['errors'] as $s4_error){
            echo '<li>' . $s4_error . '</li>';
        }

        // Close list & error display div
        echo '</ul>';
        echo '</div>';
        //print_r($altmail);

        // Clears stored errors vars so they won't be displayed again
        unset($_SESSION['errors']);
    }
}
?>


<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <div class="card">
                <h2 class="card-title">Email Sign up</h2>
                <div class="row">
                    <div class="col">
                        <?php errorsDisplay(); ?>
                    </div>
                </div>
                
                
                <form action="signup.php" method="POST">
                
                <div class="form-row row-eq-spacing-sm">
                    <div class="col-sm">
                        <label for="first-name" class="required">First name</label>
                        <input type="text" class="form-control" id="first-name" name="first-name" placeholder="First name" required="required">
                    </div>
                    <div class="col-sm">
                        <label for="last-name">Last name</label>
                        <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Last name">
                    </div>     
                </div>
                
                <div class="form-row row-eq-spacing-sm">
                    <div class="col-sm">
                        <label for="username" class="required">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                            <div class="input-group-append">
                                <span class="input-group-text">@<?php echo S4CFG_DOMAIN; ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row row-eq-spacing-sm">
                    <div class="col-sm">
                        <label for="password" class="required">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
                    </div>
                    <div class="col-sm">
                        <label for="confirm-password" class="required">Confirm password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required="required">
                    </div>     
                </div>

                <div class="form-row row-eq-spacing-sm">
                    <div class="col-sm">
                        <label for="alt-email">Alternate Email Address</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="alt-email" name="alt-email" placeholder="Alternate email address">
                        </div>
                    </div>
                </div>

                <div class="form-row row-eq-spacing-sm">
                    <div class="col-sm">
                        
                        <div class="input-group">
                            <div class="custom-switch">
                                <input type="checkbox" id="forwarding" name="forwarding">
                                <label for="forwarding">Forwarding account only</label>
                                <div class="form-text">
                                    Forward all emails to your alternate email address instead of creating a separate inbox
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="key" value="<?php echo tokenGenerate(); ?>" />
                <input class="btn btn-primary btn-block" type="submit" name="submit" value="Sign up">



                    
                </form>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>


<!--close header divs-->
</div>
</div>