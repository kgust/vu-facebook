<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Photo Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
</head>
<body>
    <div class="container">
    <h1 class="text-center">Photo Details</h1>
    <hr>
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <img src="<?php echo $row['source']; ?>" style="width: 100%">
        </div>

        <div class="col-xs-12 col-md-4">
            <div class="row">
                <div class="col-xs-offset-1">
                    <div style="height: 30px">&nbsp;</div>
                    <h4><?php echo $row['name']; ?></h4>
                    <p>Image ID: <strong><?php echo $row['id']; ?></strong></p>
                    <p>Image Source URL: <a href="<?php echo $row['source']; ?>"><strong><?php echo $row['source']; ?></strong></a></p>
                    <p>Created Time: <strong><?php echo $row['created_time']; ?></strong></p>
                    <p>Likes: <strong><?php echo $row['likes']; ?></strong></p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
