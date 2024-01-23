<div class="container-fluid" data-aos="fade" data-aos-delay="500">
    <h2 align="center">More Photos in Album</h2>
    <div class="row">
        <?php foreach ($photos as $photo) : ?>
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 item" data-aos="fade">
                <a href="<?= base_url('images/' . $photo['fotop']); ?>"><img src="<?= base_url('images/' . $photo['fotop']); ?>" alt="Image" class="img-fluid"></a>
                <p><?= $photo['deskripsi']; ?></p>

                <!-- Menampilkan Tombol Like dan Komentar -->
                <div class="interaction-section">
                    <button class="like-button" data-post-id="<?= $photo['id_post']; ?>">
                        <?php
                        $likeStatus = $photo['like_status'] ?? null;
                        echo ($likeStatus == 'Like') ? 'Dislike' : 'Like';
                        ?>
                    </button>
                   
                    
                    <a href="<?= base_url('dashboard/commentForm/' . $photo['id_post']); ?>" class="comment-button">Comment</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Saat dokumen siap, tambahkan event listener untuk tombol like
    $(document).ready(function () {
        $('.like-button').click(function () {
            var button = $(this);
            var postId = button.data('post-id');

            // Lakukan AJAX request ke server untuk menangani like
            $.ajax({
                url: '<?= base_url('dashboard/likePost'); ?>',
                type: 'POST',
                data: { post_id: postId },
                success: function (response) {
                    // Perbarui jumlah like pada tampilan
                    $('.like-count[data-post-id="' + postId + '"]').text(response.likes);

                    // Ubah teks tombol like
                    if (response.isLiked) {
                        button.text('Dislike');
                    } else {
                        button.text('Like');
                    }
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>

