<!-- Button trigger modal -->
<button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#TambahData" style="font-size: 14px;">
  Tambah Data
</button>

<!-- Modal -->
<div class="modal fade" id="TambahData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="TambahDataTabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">

    <form action="index.php?opsi=input" method="POST">

      <div class="modal-content px-3">
        <div class="modal-header">
          <h5 class="modal-title fw-bolder" id="TambahDataTabel">Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="form-group mb-1 d-flex align-items-center">
            <label for="data_x" class="mb-2 col-3 pt-2 pb-2">Nilai Data x</label>

            <input name="data_x" id="data_x"  class="form-control bg-light" type="number">
          </div>

          <div class="form-group mb-1 d-flex align-items-center">
            <label for="data_y" class="mb-2 col-3 pt-2 pb-2">Nilai Data y</label>

            <input name="data_y" id="data_y"  class="form-control bg-light" type="number">
          </div>

          <div class="form-group mb-1 d-flex align-items-center">
            <label for="kategori" class="mb-2 col-3 pt-2 pb-2">kategori</label>

             <select id="kategori" class="form-control bg-light" name="kategori" required>
                <option value="">- Pilih</option>
                <option value="Terima">Terima</option>
                <option value="Tolak">Tolak</option>
              </select>
          </div>

        </div>
        <div class="modal-footer justify-content-center">

          <input type="submit" name="submit" value="Simpan" class="btn btn-danger text-white col-11 p-2">

        </div>
      </div>

    </form>

  </div>
</div>
