<div class="container-fluid" data-aos="fade" data-aos-delay="500">
    <div class="row">
        <?php foreach ($albums as $album) : ?>
            <div class="col-lg-4">
                <div class="image-wrap-2">
                    <div class="image-info">
                        <h2 class="mb-3"><?= $album['nama_album']; ?></h2>
                        <a href="<?= base_url('dashboard/viewAlbum/' . $album['id_album']); ?>" class="btn btn-outline-white py-2 px-4">More Photos</a>
                    </div>
                    <?php if (!empty($album['cover'])) : ?>
                        <img src="<?= base_url('images/' . $album['cover']); ?>" alt="Album Cover" class="img-fluid">
                    <?php else : ?>
                        <img src="<?= base_url('images/default1.jpg'); ?>" alt="Default Image" class="img-fluid">
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>



    <div class="footer py-4">
      <div class="container-fluid text-center">
        <p>

          Copyright &copy;<script data-cfasync="false" src="#"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart-o" aria-hidden="true"></i> by <a href="# target="_blank" >Da Gallery</a>
        
        </p>
      </div>
    </div>

    

    
    
  </div>