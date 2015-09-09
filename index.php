<?php
$url = 'http://laudsocialdev.azurewebsites.net/Test/GetBrands';

$json = file_get_contents($url);
$brands = json_decode($json);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Test</title>
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
        <link href="css/style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="col-lg-7 brands">
                <?php foreach ($brands as $brand) : ?>
                    <div class="col-lg-4">
                        <div class="col-lg-12">
                            <a href="/posts.php?brand_id=<?= $brand->Id ?>">
                                <img src="<?= $brand->Logo ?>" name="<?= $brand->Name ?>" alt="<?= $brand->Name ?>"/>
                            </a>
                        </div>
                        <div class="col-lg-12 title">
                            <p><?= $brand->Name ?></p>
                        </div>
                    </div>
                <?php endforeach ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </body>
</html>