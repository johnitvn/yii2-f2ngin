<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>

<section class="content">
  <div class="box box-danger error-page">
    <div class="box-body">
      <div class="error-content">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-warning text-yellow"></i> <?=$name?></h3>
        </div>
        <p>
          <?=nl2br(Html::encode($message)) ?>
        </p>     
        <p>
            The above error occurred while the Web server was processing your request.
            Please contact us if you think this is a server error. Thank you.
            Meanwhile, you may need login for see this page.
        </p>
      </div><!-- /.error-content -->
    </div>
  </div><!-- /.error-page -->
</section>