<style>
    .image-wrap-2 {
        position: relative;
    }

    .image-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 10px; /* Menambahkan padding untuk memisahkan teks dari tepi */
        text-align: center;
    }

    .btn-view-album {
        margin-top: 10px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h2>Account Information</h2>

            <?php if (!empty($userData)) : ?>
                <!-- Tampilkan informasi pengguna -->
                <p>Nama: <?= $userData['nama']; ?></p>
                <p>Username: <?= $userData['username']; ?></p>

                <?php if (!empty($userData['foto'])) : ?>
                    <img src="<?= base_url('images/' . $userData['foto']); ?>" alt="Profile Picture" class="img-fluid">
                <?php else : ?>
                    <p>No profile picture available.</p>
                <?php endif; ?>

               
            <?php endif; ?>
        </div>

        <div class="col-md-8">
            <h2>My Albums</h2>

            <?php if (!empty($albums)) : ?>
                <!-- Tampilkan daftar album pengguna -->
                <div class="row">
                    <?php foreach ($albums as $album) : ?>
                        <div class="col-lg-4">
                            <div class="image-wrap-2">
                                <?php if (!empty($album['cover'])) : ?>
                                    <img src="<?= base_url('images/' . $album['cover']); ?>" alt="Album Cover" class="img-fluid">
                                <?php else : ?>
                                    <img src="<?= base_url('images/default1.jpg'); ?>" alt="Default Image" class="img-fluid">
                                <?php endif; ?>
                                <div class="image-info">
                                    <h2 class="mb-3"><?= $album['nama_album']; ?></h2>
                                    <a href="<?= base_url('dashboard/viewAlbum/' . $album['id_album']); ?>" class="btn btn-outline-white py-2 px-4">More Photos</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>No albums available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>