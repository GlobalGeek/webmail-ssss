<?php
session_status();
define('CHKINCLUDE', true);
require_once(__DIR__ . '/../inc/bootstrap/bootstrap.php');

$s4_p = $_GET['p'] ?? 'index';


// Basic page logic
if($s4_p == 'index'){

}
if($s4_p == 'success'){
    //pagesSuccess();
}
if($s4_p == 'register'){
    include_once('signup.php');
}


function pagesIndex(){

}

function pagesSuccess(){
    echo'
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Success!</h4>
        Your new email address has been created successfully.
    </div>';
}
?>
<body data-dm-shortcut-enabled="true" data-sidebar-shortcut-enabled="true" data-set-preferred-mode-onload="true">
  <!-- Modals go here -->
  <!-- Reference: https://www.gethalfmoon.com/docs/modal -->

  <!-- Page wrapper start -->
  <div class="page-wrapper with-navbar with-sidebar">

    <!-- Sticky alerts (toasts), empty container -->
    <!-- Reference: https://www.gethalfmoon.com/docs/sticky-alerts-toasts -->
    <div class="sticky-alerts"></div>

    <!-- Navbar start -->
    <nav class="navbar">
      <!-- Reference: https://www.gethalfmoon.com/docs/navbar -->
    </nav>
    <!-- Navbar end -->

    <!-- Sidebar start -->
    <div class="sidebar">
      <!-- Reference: https://www.gethalfmoon.com/docs/sidebar -->
      <ul>
          <li>Item 1</li>
          <li>Item 2</li>
          <li>Item 3</li>
          <li>Item 4</li>
      </ul>
    </div>
    <!-- Sidebar end -->

    <!-- Content wrapper start -->
    <div class="content-wrapper">
      <!--
        Add your page's main content here
        Examples:
        1. https://www.gethalfmoon.com/docs/content-and-cards/#building-a-page
        2. https://www.gethalfmoon.com/docs/grid-system/#building-a-dashboard
      -->
      Some random stuff about stuff that nobody gives a stuff about so they just write stuff to fill in the blank stuff on their websites and stuff. Some random stuff about stuff that nobody gives a stuff about so they just write stuff to fill in the blank stuff on their websites and stuff. Some random stuff about stuff that nobody gives a stuff about so they just write stuff to fill in the blank stuff on their websites and stuff. Some random stuff about stuff that nobody gives a stuff about so they just write stuff to fill in the blank stuff on their websites and stuff. Some random stuff about stuff that nobody gives a stuff about so they just write stuff to fill in the blank stuff on their websites and stuff. Some random stuff about stuff that nobody gives a stuff about so they just write stuff to fill in the blank stuff on their websites and stuff. 
    </div>
    <!-- Content wrapper end -->

  </div>
  <!-- Page wrapper end -->

  <!-- Halfmoon JS -->
  <script src="https://cdn.jsdelivr.net/npm/halfmoon@1.1.1/js/halfmoon.min.js"></script>
</body>
</html>
