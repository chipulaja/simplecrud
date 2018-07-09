<?php $this->layout('layout'); ?>
<div class="clearfix"></div><br />
<div class="container">
  <div class="panel panel-default">
      <div class="panel-heading">
          <h3 class="panel-title"><?php echo htmlspecialchars($data->getJudul()) ?></h3>
      </div>
      <div class="panel-body">
          <?php echo htmlspecialchars($data->getKonten())?>
      </div>
      <div class="panel-footer">
          <form method='post' <?php echo "action='/add-comment/".$data->getId()."'";?> >
            <textarea class="form-control" rows="5" placeholder="komentar di sini ya" name="konten"></textarea>
            <button type="submit" class="btn btn-primary" name="btn-save">kirim</button>
          </form>
      </div>
  </div>

  <?php 
  $daftarKomentar = $data->getKomentar();
  foreach ($daftarKomentar as $komentar) : 
  ?>
  <div class="panel panel-default">
      <div class="panel-body">
          <?php echo htmlspecialchars($komentar->getKonten())?>
      </div>
  </div>
  <?php endforeach; ?>
</div>