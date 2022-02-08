<?php require_once(__DIR__ . '/../inc/bootstrap/bootstrap.php'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <div class="card">
                <h2 class="card-title">Email Sign up</h2>
                
                <form action="" method="post">
                
                <div class="form-row row-eq-spacing-sm">
                    <div class="col-sm">
                        <label for="first-name" class="required">First name</label>
                        <input type="text" class="form-control" id="first-name" placeholder="First name" required="required">
                    </div>
                    <div class="col-sm">
                        <label for="last-name">Last name</label>
                        <input type="text" class="form-control" id="last-name" placeholder="Last name">
                    </div>     
                </div>
                
                <div class="form-row row-eq-spacing-sm">
                    <div class="col-sm">
                        <label for="username" class="required">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="username" placeholder="Username">
                            <div class="input-group-append">
                                <span class="input-group-text">@<?php echo S4CFG_DOMAIN; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                    
                </form>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>


<!--close header divs-->
</div>
</div>