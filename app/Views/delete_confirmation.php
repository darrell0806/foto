<!-- delete_confirmation.php -->
<div class="container">
    <h2>Delete Confirmation</h2>
    <p>Are you sure you want to delete this post?</p>

    <form action="<?= base_url('/post/confirmDelete/' . $post->id_post); ?>" method="post">
        <button type="submit">Yes, Delete</button>
        <a href="<?= base_url('/dashboard/viewAlbum/' . $post->album_id); ?>">No, Cancel</a>
    </form>
</div>
