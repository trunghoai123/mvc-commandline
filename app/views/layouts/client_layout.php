<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/client/css/style.css">
    <title><?php echo $pageTitle ?  $pageTitle  : '' ?></title>
</head>

<body>
    <?php $this->loadView('blocks/header') ?>
    <div>
        <?php $this->loadView($page, $data) ?>
    </div>
    <?php $this->loadView('blocks/footer') ?>
    <script src="<?php echo _WEB_ROOT ?>/public/assets/client/js/script.js"></script>
</body>

</html>