
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


function mailAccountsCreate($email = null) // Returns true if email already exists - returns false otherwise
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



function mailDomainsGet()
{

    $s4_cpanel = new cpanelAPI(S4CFG_CPUSER, S4CFG_CPPASS, S4CFG_CPHOST);

    $s4_data = $s4_cpanel->uapi->Email->list_mail_domains();

    echo '<pre>' . var_dump($s4_data) . '</pre>';
    
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