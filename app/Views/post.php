<style>
    .form-container {
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      padding: 20px;
      width: 400px;
      text-align: center;
      margin: auto;
      position: relative;
    }

    .form-container img {
      max-width: 100%;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input, textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    button {
      background-color: #333;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
  <title>Tambah Post</title>
</head>
<body>

  <div class="form-container">
    <form action="/post/aksi_tambah/" method="post" enctype="multipart/form-data">
      <label for="photo">Foto:</label>
      <div class="position-relative">
        <input type="file" class="form-control" placeholder="Foto" name="foto" id="foto" onchange="previewImage()" accept="image/*" required>
        <img id="preview" src="" alt="" style="max-width: 100px; margin-top: 10px;">
      </div>

      <label for="description">Deskripsi:</label>
      <textarea id="description" name="deskripsi" placeholder="Masukkan deskripsi" required></textarea>

      <label for="album">Album:</label>
      <select id="album" name="album" required>
        <option value="" selected disabled>- Pilih Album -</option>
        <?php
          foreach ($c as $d) {
            echo '<option value="' . $d->id_album . '">' . $d->nama_album . '</option>';
          }
        ?>
      </select>
<br>
<br>
      <button type="submit">Tambah Post</button>
    </form>
  </div>

  <script>
    function previewImage() {
      var preview = document.querySelector('#preview');
      var file = document.querySelector('#foto').files[0];
      var reader = new FileReader();

      reader.addEventListener("load", function () {
        preview.src = reader.result;
      }, false);

      if (file) {
        reader.readAsDataURL(file);
      }
    }
  </script>