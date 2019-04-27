<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=BASEURL?>asset/css/font-awesome.min.css">


</head>

<body>
    <?= $data['email_err'] ?>
    <?= $data['password_err'] ?>
    <div class="main">


        <div class="container">

            <div class="middle">
                <div id="login">

                    <form method="post" action="<?=BASEURL?>Users/login">

                        <fieldset class="clearfix">

                            <div><span class="ace-icon fa fa-user"></span><input type="text" name="email" id="email" Placeholder="Username"
                                    required></div>
                            <!-- JS because of IE support; better: placeholder="Username" -->
                            <div>
                            <span class="ace-icon fa fa-lock"></span>
                            <input type="password" name="password" id="password" maxlength="20"
                                     Placeholder="Password Anda" required>
                            </div>

                            <div>
                                <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text"
                                        href="#">Forgot
                                        password?</a></span>
                                <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit"
                                        value="Sign In"></span>
                            </div>

                        </fieldset>
                        <div class="clearfix"></div>
                    </form>

                    <div class="clearfix"></div>

                </div> <!-- end login -->
                <div class="logo">LOGO

                    <div class="clearfix"></div>
                </div>

            </div>

        </div>

    </div>
</body>

</html>