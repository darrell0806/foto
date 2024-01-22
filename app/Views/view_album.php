<div class="container-fluid" data-aos="fade" data-aos-delay="500">
    <h2 align="center">More Photos in Album</h2>
    <div class="row">
        <?php foreach ($photos as $photo) : ?>
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 item" data-aos="fade">
                <a href="<?= base_url('images/' . $photo['fotop']); ?>"><img src="<?= base_url('images/' . $photo['fotop']); ?>" alt="Image" class="img-fluid"></a>
                <p><?= $photo['deskripsi']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
