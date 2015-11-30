<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <?=$this->displayTemplate('chunks/meta');?>
</head>
<body class="abody">
<div class="container">
    <div class="row">
        <div class="col-xs-8 col-md-4 col-lg-6 col-xs-offset-2 col-md-offset-4 col-lg-offset-3">
            <form class="aform">
                <div class="form-group">
                    <label for="lg">Login</label>
                    <input type="text" class="form-control" id="lg" placeholder="login">
                </div>
                <div class="form-group">
                    <label for="pswd">Password</label>
                    <input type="password" class="form-control" id="pswd" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-large btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>