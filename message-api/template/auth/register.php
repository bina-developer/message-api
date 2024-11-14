<!DOCTYPE html>
<html lang="en">
<head>
    <title>ثبت نام</title>
<?php require_once(BASE_PATH . '/template/auth/layouts/head-tag.php')?>
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="<?= asset('public/auth/assets/images/img-01.png') ?>" alt="IMG">
                </div>

                <form method="post" action="<?= url('register/store') ?>" class="login100-form validate-form">
                    <span class="login100-form-title">
                        ثبت نام
                    </span>

                    <?php
                        $message = flash('register_error');
                        if (!empty($message)) {
                            ?>

                    <div class="mb-2 alert alert-danger"> <small class="form-text text-danger">
                        <?= $message ?>
                    </small> </div>

                    <?php  } ?>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="first_name" placeholder="نام">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="last_name" placeholder="نام خانوادگی">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="ایمیل">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="رمز کاربری">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            ثبت نام
                        </button>
                    </div>
                    <div class="text-center p-t-136">
                        <a class="text-info" href="<?= url('login') ?>">
                            ورود
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <?php require_once(BASE_PATH . '/template/auth/layouts/scripts.php')?>

  

</body>

</html>