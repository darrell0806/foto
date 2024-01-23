<!-- Tampilkan formulir edit profil -->
<form action="<?= base_url('acc/updateProfile'); ?>" method="post">
<label for="nama">Nama:</label>
    <input type="text" name="nama" value="<?= $userData['nama']; ?>" required>

    <label for="username">Username:</label>
    <input type="text" name="username" value="<?= $userData['username']; ?>" required>

    <!-- Tampilkan Foto Profil Lama -->
    <?php if (!empty($userData['foto'])) : ?>
        <img src="<?= base_url('images/' . $userData['foto']); ?>" alt="Profile Picture" class="img-fluid">
    <?php else : ?>
        <p>No profile picture available.</p>
    <?php endif; ?>

    <!-- Edit Foto Profil -->
    <label for="foto">Foto Profil Baru:</label>
    <input type="file" name="foto">

    <!-- Tombol Update -->
    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>
