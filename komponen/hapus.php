<!-- Modal -->
<div class="modal fade" id="HapusData<?php echo $data['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="HapusData<?php echo $data['id'] ?>Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bolder" id="HapusData<?php echo $data['id'] ?>Label">Konfirmasi</h5>
      </div>
      <div class="modal-body">
        <h5>Anda Yakin Menghapus Data ke <?php echo $i-1?>?</h5>
      </div>
      <div class="modal-footer justify-content-center">

        <button type="button" class="btn btn-secondary pe-3" data-bs-dismiss="modal" aria-label="Close">Batal</button>

        <a class="btn btn-danger px-4 text-decoration-none text-danger text-white" href="index.php?id=<?php echo $data['id']?>&opsi=delete">Ya</a>

      </div>
    </div>
  </div>
</div>
