<?php
//echo '!------------It\'s admin login form page. Here it is<br>';
//die();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Welcome</title>
    <?=$this->displayTemplate('chunks/meta');?>
    <script src="<?= App::siteUrl('assets/plugins/fastMD5/md5.js') ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function (event){
           var form = document.getElementsByClassName('aform')[0];
            form.addEventListener('submit', function (event) {
                var pass = document.getElementById('pswd').value,
                    pass_field = document.getElementById('pswd');
                pass_field.value = md5(pass);
                form.submit();
            });
        });
    </script>
    <style>
        body{
            background: url('<?=App::siteUrl('assets/img/Blurred_Background_9.jpg')?>') no-repeat center center fixed;
            background-size: cover;
        }
        label{
            color: white;
        }
    </style>
    <?  ?>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-md-4 col-lg-6 col-xs-offset-2 col-md-offset-4 col-lg-offset-3">
            <form class="aform" action="<?=App::getLink('admin')?>" method="post" id="autorization">
                <div class="form-group">
<!--                    <label for="lg">Login</label>-->
                    <input type="text" class="form-control" id="lg" name="login" placeholder="login">
                </div>
                <div class="form-group">
<!--                    <label for="pswd">Password</label>-->
                    <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Password">
                </div>
                <button id="sbmt" class="btn btn-large btn-success" style="width: 100%;">Войти в орган управления</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>