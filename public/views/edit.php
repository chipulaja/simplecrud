<?php $this->layout('layout'); ?>
<div class="clearfix"></div><br />
<div class="container">
    <form method='post'>
        <table class='table table-bordered'>
            <tr>
                <td>
                  <div class="form-group">
                    <label for="name">Judul</label>
                    <input class="form-control" name="judul" value="<?php echo $data->getJudul(); ?>" />
                  </div>
                  <div class="form-group">
                    <label for="phone">Konten</label>
                    <textarea class="form-control" rows="5" name="konten"><?php echo $data->getKonten(); ?></textarea>
                  </div>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-save">
                Simpan
                </button>
            </tr>
        </table>
    </form>
</div>
