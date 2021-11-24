<?php $this->view('template/header', $data)?>
<section class="group">
  <h1 style="width: 100%; text-align: center;">Random Groups</h1>
  <?php if(!empty($A_groups)): ?>
    <?php foreach ($A_groups as $groups => $students): ?>
      <table style="page-break-inside:avoid"> 
        <thead>
          <tr>
            <th><?= $groups?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($students as $student): ?>
            <tr>
              <td><?=$student->civility . $student->last_name . ' ' . $student->first_name?></td>
            </tr>
          <?php endforeach?>
        </tbody>
      </table>
    <?php endforeach?>
  <?php endif ?>
</section>
<a target="_blank" class="to_pdf_btn" href="<?= WEB_URL . "etudiant/pdf/$id"?>">💾</a>
<?php $this->view('template/tails', $data)?>