<?php $this->layout('layout'); ?>
<div class="clearfix"></div><br />
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Peringatan</div>
        <div class="panel-body">
            Apakah anda yakin ingin menghapus artikel <br />
            <?php echo "<strong>".htmlspecialchars($data->getJudul())."</strong>"; ?>
        </div>
        <div class="panel-footer">
            <form method='post' <?php echo "action='/delete/".$data->getId()."'";?> >
                <input type="hidden" name="hash" value="<?php echo $data->getHash(); ?>" >
                <button type="submit" class="btn btn-default">Ok</button>
                <a href="/" class="btn btn-default" id="confirmCancel">Cancel</a>
            </form>
        </div>
    </div>
</div>