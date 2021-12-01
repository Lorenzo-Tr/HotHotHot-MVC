<?php $this->view('template/header', $data)?>
<section>
  <?php if(!empty($error)): ?>
    <p><?= $error?></p>
  <?php endif ?>
<?php

?>
</section>
<?php $this->view('template/tails', $data)?>