<div class="container-fluid" data-aos="fade" data-aos-delay="500">
    <style>
        .container-fluid {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .post-image {
            width: 50%; /* Sesuaikan ukuran gambar sesuai kebutuhan Anda */
        }

        .comments-section {
            margin-top: 20px; /* Beri margin agar formulir komen terpisah dari komen sebelumnya */
        }

        .comment-form {
            margin-top: 10px; /* Beri margin di atas tombol submit */
        }
    </style>

    <div class="post-details text-center">
        <img src="<?= base_url('images/' . $post['fotop']); ?>" alt="Post Image" class="img-fluid post-image">
        <p><?= $post['deskripsi']; ?></p>
    </div>

    <!-- Tampilkan Komentar -->
    <div class="comments-section text-center">
        <p>Komen:</p>
        <?php foreach ($comments as $comment) : ?>
            <div class="comment">
                <p><strong><?= $comment['username']; ?></strong>: <?= $comment['comment']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- HTML Form untuk Komentar -->
    <!-- HTML Form untuk Komentar -->
<form class="comment-form" action="<?= base_url('dashboard/submitComment'); ?>" method="post">
    <input type="hidden" name="post_id" value="<?= $post['id_post']; ?>">
    <textarea name="comment" placeholder="Add a comment"></textarea>
    <br> <!-- Baris baru agar tombol submit berada di bawah kotak komentar -->
    <button type="submit">Submit Comment</button>
</form>

</div>
