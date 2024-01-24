<div class="container">
    <h3>Edit Post</h3>
    <form action="<?= base_url('/post/aksi_edit_post') ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $jojo->id_post ?>">

        <?php if (!empty($jojo->fotop)) : ?>
            <div class="mt-3">
                <label>Foto Lama</label>
                <br>
                <img src="<?= base_url('images/' . $jojo->fotop) ?>" class="img-fluid rounded" width="100">
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Baru</label>
            <input type="file" class="form-control" id="foto" name="foto" onchange="previewImage()">
            <img id="preview" src="" alt="" class="img-fluid mt-2" style="max-width: 100px;">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $jojo->deskripsi ?>">
        </div>

        <div class="mb-3">
            <label for="album" class="form-label">Album</label>
            <select class="form-select" id="album" name="album">
                <?php foreach ($a as $b) : ?>
                    <?php $selected = ($jojo->album == $b->id_album) ? "selected" : ""; ?>
                    <option value="<?= $b->id_album ?>" <?= $selected ?>>
                        <?= $b->nama_album ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-light">Reset</button>
        </div>
    </form>
</div>

<script>
    function previewImage() {
        var preview = document.getElementById('preview');
        var fileInput = document.getElementById('foto');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
