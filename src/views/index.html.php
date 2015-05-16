<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Vanderbilt Facebook Photos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
</head>
<body class="app">
    <div class="container">
        <h1 class="text-center">Vanderbilt Facebook Photos</h1>
        <div class="row">
            <?php foreach ($pictures as $picture): ?>
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2" style="height: 150px">
                    <a href="/details/<?php echo $picture['id']; ?>">
                        <img title="<?php echo $picture['name']; ?>" src="<?php echo $picture['picture']; ?>">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
