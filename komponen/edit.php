<!-- Modal -->
<div class="modal fade" id="EditData<?php echo $data['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditData<?php echo $data['id'] ?>Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">

   <form action="index.php?opsi=edit" method="POST">

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditData<?php echo $data['id'] ?>Label">Edit Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <input name="id" id="id" value="<?php echo $data['id'] ?>" class="form-control bg-light" type="number" hidden>

        <div class="form-group mb-1 d-flex align-items-center">
          <label for="data_x" class="mb-2 col-3 pt-2 pb-2">Nilai Data x</label>
          <input name="data_x" id="data_x" value="<?php echo $data['data_x'] ?>" class="form-control bg-light" type="number">
        </div>

        <div class="form-group mb-1 d-flex align-items-center">
          <label for="data_y" class="mb-2 col-3 pt-2 pb-2">Nilai Data y</label>

          <input name="data_y" id="data_y" value="<?php echo $data['data_y'] ?>" class="form-control bg-light" type="number">
        </div>

        <div class="form-group mb-1 d-flex align-items-center">
          <label for="kategori" class="mb-2 col-3 pt-2 pb-2">Kategori</label>

          <select id="kategori" class="form-control bg-light" name="kategori" required>
            <option value="">- Pilih</option>
            <option value="Terima" <?php echo ($data['kategori'] == "Terima") ? "selected" : "" ?> >Terima</option>
            <option value="Tolak" <?php echo ($data['kategori'] == "Tolak") ? "selected" : "" ?> >Tolak</option>
          </select>
        </div>

      </div>
      <div class="modal-footer justify-content-center">

        <input type="submit" name="submit" value="Edit" class="btn btn-info text-white col-11 p-2">

      </div>
    </div>
  </form>
</div>
</div>
