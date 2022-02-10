
<?php
if(!defined('CHKINCLUDE')){
    die('Error: File not directly accessible');
}

function tokenGenerate($s4_token_str = 16)
{
    $s4_token = bin2hex(openssl_random_pseudo_bytes($s4_token_str, $isStrong));

    $isStrong;

    return $s4_token;
}



###################### 
## cPanel API funcs ##
######################
function mailAccountsList()
{

    $s4_cpanel = new cpanelAPI(S4CFG_CPUSER, S4CFG_CPPASS, S4CFG_CPHOST);

    $s4_data = $s4_cpanel->uapi->Email->list_pops_with_disk();
    //echo $response->data->maximum_ftp_accounts;
    

    echo "<table>
            <thead>
                <td>User</td>
                <td>Email</td>
                <td>Quota</td>
                <td>Date</td>
                <td>Date</td>
                <td>Status</td>
            </thead>";
    foreach($s4_data['data'] as $record){
        echo'<tr>
                <td>' . $record['user'] . '</td>
            <td>' . $record['email'] . '</td>    
            <td>' . $record['humandiskquota'] . '</td>
            <td>' . $record['humandiskused'] . '</td>
            <td>' . date('H:i:s d-M-Y', $record['mtime']) . '</td>
            <td> Status </td>
        </tr>';
    }

    unset($s4_cpanel);

}


function mailAccountsCheckExists($email = null) // Returns true if email already exists - returns false otherwise
{
    $s4_cpanel = new cpanelAPI(S4CFG_CPUSER, S4CFG_CPPASS, S4CFG_CPHOST);
    $s4_data = $s4_cpanel->uapi->Email->list_pops();
    
    foreach($s4_data['data'] as $record){
        if($record['email'] == $email){
            return true;
            
        }
    }
    return false;
}


function mailAccountsCreate($name = null, $user = null, $domain = S4CFG_DOMAIN, $pass = null, $altmail = null, $quota = null, $fwd = false) // The magical "create email account" function
{   
    // Create new cPanel API object
    $s4_cpanel = new cpanelAPI(S4CFG_CPUSER, S4CFG_CPPASS, S4CFG_CPHOST);
    // Prepare vars if forwarding is set by the user
    if($fwd === true){
        $quota = 25;
        $email = $user . '@' . $domain;
    }
    // Prepare function parameters
    $funcData = array(
        'real_name' => $name,
        'username' => $user, 
        'domain' => $domain, 
        'password'  => $pass,
        'altmail' => $altmail,
        'services.email.enabled' => 1,
        'services.email.quota' => $quota,
        'services.email.send_welcome_email' => 1    
    );
    // Execute user creation
    $s4_data = $s4_cpanel->uapi->UserManager->create_user($funcData);
    
    // Forwards must be set up after account is created
    if($fwd === true){
        $funcData = array(
            'fwdopt' => 'fwd',  
            'domain' => $domain, 
            'email'  => $email,
            'fwdemail' => $altmail 
        );
        // Execute forwarding creation
        $s4_data = $s4_cpanel->uapi->Email->add_forwarder($funcData);        
    }
    // TODO: Check all JSON replies for returned errors
    return true;
}



function mailDomainsGet()
{
    $s4_cpanel = new cpanelAPI(S4CFG_CPUSER, S4CFG_CPPASS, S4CFG_CPHOST);
    $s4_data = $s4_cpanel->uapi->Email->list_mail_domains();
  
    foreach($s4_data['data'] as $record){
        echo $record['domain'] . " . " . $record['select'];
    }
}

function mailSettingsList()
{
    $s4_cpanel = new cpanelAPI(S4CFG_CPUSER, S4CFG_CPPASS, S4CFG_CPHOST);
    $s4_data = $s4_cpanel->uapi->Email->get_webmail_settings();

    echo '<pre>' . var_dump($s4_data) . '</pre>';
}

function mailQuotaList($email = null)
{
    $s4_cpanel = new cpanelAPI(S4CFG_CPUSER, S4CFG_CPPASS, S4CFG_CPHOST);
    $s4_data = $s4_cpanel->uapi->Email->get_pop_quota(array('email' => $email));

    return $s4_data['data'];
}