<div class="container-fluid" data-aos="fade" data-aos-delay="500">
    <h2 align="center">Photos in Album <?= $id_album; ?></h2>
    <div class="row">
        <?php foreach ($photos as $photo) : ?>
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3" data-aos="fade">
                <form action="<?= base_url('dashboard/likePost'); ?>" method="post">
                    <input type="hidden" name="album_id" value="<?= $id_album; ?>">
                    <input type="hidden" name="post_id" value="<?= $photo->id_post; ?>">

                    <a href="<?= base_url('images/' . $photo->fotop); ?>">
                        <img src="<?= base_url('images/' . $photo->fotop); ?>" alt="Image" class="img-fluid">
                    </a>
                    <p><?= $photo->deskripsi; ?></p>

                    <!-- Menampilkan Tombol Like dan Komentar -->
                    <div class="interaction-section">
                        <button type="submit" class="like-button">
                            <?php
                            $likeStatus = $photo->like_status ?? null;
                            echo ($likeStatus == 'Like') ? 'Dislike' : 'Like';
                            ?>
                        </button>
                        <a href="<?= base_url('dashboard/commentForm/' . $photo->id_post); ?>" class="comment-button">Comment</a>

                        <br>
                        <?php if ($photo->user_maker == session()->get('id')) : ?>
                            <!-- Display "Edit" and "Delete" buttons only if the post belongs to the logged-in user -->
                            <a href="<?= base_url('/post/editPost/' . $photo->id_post); ?>" class="edit-button">Edit</a>
                            <a href="<?= base_url('/post/deletePost/' . $photo->id_post); ?>" class="delete-button">Delete</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>