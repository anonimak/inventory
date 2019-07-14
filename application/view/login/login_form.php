<div class="content background-login">
    <!-- <img src="<?= BASEURL.'asset/img/logo-small.png'; ?>" alt="" srcset=""> -->
        <div class="row mt-5" style="height: 500px;">
            <div class="col-md-6 m-auto m-top-5">
                <h3 class="card-title">Login</h3>
                    <form method="post" action="<?=BASEURL?>Users/login" id="login_form" action method novalidate="novalidate">
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
                                    <input type="email" name="email" id="email" placeholder="Enter email" class="form-control input-transparant" required="required" email="true">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password <star>*</star></label>
                                    <input type="password" name="password" id="password" placeholder="Password" class="form-control input-transparant" required="required" minlength="6" maxlength="8"
                                </div>
                            </div>
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-fill btn-wd ">Login</button>
                            <div class="forgot">
                                <!-- <a href="#pablo">Forgot your password?</a> -->
                            </div>
                    </form>
            </div>
        </div>
    </div>
</div>