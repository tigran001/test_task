<?php
mb_internal_encoding("UTF-8");

if (isset($_GET["brand_id"]) && !empty($_GET["brand_id"])) {
    $id = intval($_GET["brand_id"]);
} else {
    header("Location: /");
}

$url = 'http://laudsocialdev.azurewebsites.net/Test/GetPosts?brandId=' . $id;

$json = file_get_contents($url);
$obj = json_decode($json);

$count = count($obj);
$size = ceil($count / 3);
$posts_array = array();
$row_size = 3;
$j = 0;

for ($i = 0; $i < $count; $i++) {
    if (!empty($posts_array[$j])) {
        $posts_count = count($posts_array[$j]);
        if ($size >= $posts_count) {
            $posts_array[$j][] = $obj[$i];
        }
    } else {
        $posts_array[$j][] = $obj[$i];
    };
    $j++;

    if ($j == 3) {
        $j = 0;
    }
}
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
            <div class="col-lg-12 posts">
                <?php for($i = 0; $i < $row_size; $i++) : ?>
                    <div class="col-lg-4">
                        <?php if(!empty($posts_array[$i])) : ?>
                            <?php foreach ($posts_array[$i] as $post) : ?>
                                <div class="col-lg-12">
                                    <a href="<?= $post->Link ?>">
                                        <img src="<?= $post->Image ?>" name="<?= $post->Title ?>" alt="<?= $post->Title ?>"/>
                                    </a>
                                </div>
                                <div class="col-lg-12 title">
                                    <?= $post->Title ?>
                                </div>
                                <div class="col-lg-12 description">
                                    <?= $post->Description; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </body>
</html>