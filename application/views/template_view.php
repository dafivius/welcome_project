<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome page</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/welcome.css">
</head>
<body>
<div id="container">
    <div class="row">
        <div class="col-lg-12">

            <?php include 'application/views/'.$content_view; ?>

        </div>
    </div>
</div>


<script type="text/javascript" src="/assets/js/lib/jquery-3.2.1.js"></script>
<script type="text/javascript" src="/assets/js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<script type="text/javascript" src="/assets/js/welcome.js"></script>
<script type="text/javascript" src="/assets/js/lib/bootstrap.js"></script>
</body>
</html>