<?php $this->view('template/header', $data)?>
<section>
  <?php if(!empty($error)): ?>
    <p><?= $error?></p>
  <?php endif ?>
  <form action="Etudiant/result" method="post" enctype="multipart/form-data">
    <h1>Depose your file</h1>
    <label for="wantedNbGroups">Desired students number by group</label>
    <select name="wantedNbGroups" id="wantedNbGroups">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option selected="selected" value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
    </select>
    <input type="file" accept=".csv, .json" name="file" id="file">
    <input type="submit" value="send">
  </form>
</section>
<?php $this->view('template/tails', $data)?>