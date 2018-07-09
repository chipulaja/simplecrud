<?php $this->layout('layout') ?>

<div class="clearfix"></div><br />

<div class="container">
     <table class='table table-bordered table-responsive'>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Tanggal</th>
            <th></th>
        </tr>
        <?php 
            $no = 1;
            foreach ($data as $d) : 
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo "<a href='/view/".$d->getId()."'>".htmlspecialchars($d->getJudul())."</a>";?></td>
            <td><?php echo $d->getTanggal()->format("d-M-Y h:i:s"); ?></td>
            <td><?php echo "<a href='/edit/".$d->getId()."'>edit</a>";?>
            <?php echo "<a href='/delete-confirm/".$d->getId()."'>del</a>";?></td>
        </tr>
        <?php
        endforeach;
        ?>
    </table>
</div>