
<?php

function listAccounts()
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