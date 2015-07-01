<?php if(!defined('RESTRICTED'))exit('No direct script access.'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('app/views/shared/meta-tags.php'); ?>
        
        <title><?php echo $this->getTitle() !== null ? $this->getTitle() : 'Myn Framework'; ?></title>

        <link rel="stylesheet" type="text/css" href="<?=URL_CSS?>vendor/bootstrap.min.css" />

        <?php
            $this->renderStyles();
        ?>
    </head>
    
    <body>
        <div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true" style="z-index:1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="text-center">Sign in</h1>
                    </div>
                    <div class="modal-body">
                        <form class="form col-md-12 center-block">
                            <div class="form-group">
                                <input type="email" class="form-control input-lg" placeholder="Email" maxlength="55">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control input-lg" placeholder="Password" maxlength="128">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Sign in">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="border-top:0">
                    </div>
                </div>
            </div>
        </div>

        <div id="myModalInfo" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 id="titleModalInfo" class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <p id="txtModalInfo"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            var URL = '<?=URL?>';
        </script>
        <script type="text/javascript" src="<?=URL_JS?>vendor/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="<?=URL_JS?>vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=URL_JS?>app.js"></script>

        <?php
            $this->renderScripts();
        ?>
    </body>
</html>