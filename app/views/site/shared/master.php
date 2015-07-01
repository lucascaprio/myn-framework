<?php if(!defined('RESTRICTED'))exit('No direct script access.'); ?>

<!DOCTYPE html>
<html lang="pt-BR" prefix="og: http://ogp.me/ns#">
    <head>
        <?php include('app/views/shared/meta-tags.php'); ?>

        <link rel="stylesheet" type="text/css" href="<?=URL_CSS?>vendor/bootstrap.min.css" />

        <?php $this->renderStyles(); ?>
    </head>
    
    <body>
        <div class="container">
            <?php
                $this->addViews('site/shared/header', true);
                $this->addViews('site/shared/footer');
                $this->renderViews();
            ?>
        </div>

        <script type="text/javascript">
            var URL = '<?=URL?>';
        </script>
        <script type="text/javascript" src="<?=URL_JS?>vendor/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="<?=URL_JS?>vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=URL_JS?>app.js"></script>
        
        <?php $this->renderScripts(); ?>
    </body>
</html>