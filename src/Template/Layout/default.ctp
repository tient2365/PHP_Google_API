<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <meta name="description" content="">
    <link href="/img/icon.png" type="image/x-icon" rel="icon"/><link href="/img/icon.png" type="image/x-icon" rel="shortcut icon"/>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.js" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />

    <?= $this->Html->css([
        '/plugin/bootstrap-5.2.0-beta1/css/bootstrap.min',
        '/plugin/fullcalendar/main.min',
        '/plugin/uploader/image-uploader.min',
        '/plugin/datetimepicker/jquery.datetimepicker.min',
        '/plugin/select2-4.1.0-rc.0/css/select2.min',
        '/css/style.css?v='. time(),
        '/css/common.css?v='. time(),
    ]) ?>
    <?= $this->Html->script([
        '/plugin/bootstrap-5.2.0-beta1/js/bootstrap.bundle.min',
        '/plugin/jquery/jquery-3.6.0.min',
        '/plugin/jquery-validation-1.19.4/dist/jquery.validate.js?v=1.0',
        '/plugin/fullcalendar/main.min',
        '/plugin/chart/chart.min',
        '/plugin/datetimepicker/jquery.datetimepicker.full.min',
        '/plugin/select2-4.1.0-rc.0/js/select2.full.min',
        '/plugin/uploader/image-uploader.min',
        '/plugin/chart.js-3.9.1/package/dist/chart.js',
    ]) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <meta name="description" content="">
    <link href="/img/icon.png" type="image/x-icon" rel="icon"/><link href="/img/icon.png" type="image/x-icon" rel="shortcut icon"/>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.js" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <link type="text/css" rel="stylesheet" href="http://example.com/image-uploader.min.css">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <?= $this->Html->css([
        '/plugin/bootstrap-5.2.0-beta1/css/bootstrap.min',
        '/plugin/fullcalendar/main.min',
        '/plugin/uploader/image-uploader.min',
        '/plugin/datetimepicker/jquery.datetimepicker.min',
        '/plugin/select2-4.1.0-rc.0/css/select2.min',
        '/css/style.css?v='. time(),
        '/css/common.css?v='. time(),
    ]) ?>
    <?= $this->Html->script([
        '/plugin/bootstrap-5.2.0-beta1/js/bootstrap.bundle.min',
        '/plugin/jquery/jquery-3.6.0.min',
        '/plugin/jquery-validation-1.19.4/dist/jquery.validate.js?v=1.0',
        '/plugin/fullcalendar/main.min',
        '/plugin/chart/chart.min',
        '/plugin/datetimepicker/jquery.datetimepicker.full.min',
        '/plugin/select2-4.1.0-rc.0/js/select2.full.min',
        '/plugin/uploader/image-uploader.min',
        '/plugin/chart.js-3.9.1/package/dist/chart.js',
    ]) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
</head>
<body>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    
<script>
    $(document).ready(function() {
        $.validator.setDefaults({
            focusInvalid: true,
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            },
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) {
                if (element.parent().length) {
                    element.parent().append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
        jQuery.validator.addMethod("greaterThan",
            function (value, element, params) {

                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) > new Date($(params).val());
                }

                return isNaN(value) && isNaN($(params).val())
                    || (Number(value) > Number($(params).val()));
            }, 'Must be greater than {0}.');
    });
</script>
</body>
</html>
