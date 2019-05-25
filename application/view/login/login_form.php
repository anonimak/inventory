<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card card-login" data-background="color" data-color="blue">
                    <div class="card-header">
                        <h3 class="card-title">Login</h3>
                    </div>
                    <form method="post" action="<?=BASEURL?>Users/login" id="login_form" action method novalidate="novalidate">
                        <div class="card-content">
                            <?php 
                                if($data['error']){
                            ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?= $data['msg'] ?>
                            </div>
                            <?php
                                }
                            ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email address <star>*</star></label>
                                    <input type="email" name="email" id="email" placeholder="Enter email" class="form-control" required="required" email="true">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password <star>*</star></label>
                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" required="required" minlength="6" maxlength="8"
                                </div>
                            </div>
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-fill btn-wd ">Login</button>
                            <div class="forgot">
                                <a href="#pablo">Forgot your password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>