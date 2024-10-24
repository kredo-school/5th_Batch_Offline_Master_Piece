  <!-- jQuery（必要な場合） -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="quantityErrorModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header bg-danger">
              <h3 class="modal-title text-white">Attention</h3>
          </div>
          <div class="modal-body">
            <h3 id="modalMessage">More input than INVENTORY.</h3>
            <h3 class="text-danger">Can you give us 3 days to prepare?</h3>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger w-25 fw-bold" data-bs-dismiss="modal">No</button>
              <button type="button" class="btn btn-primary w-25 fw-bold" id="acceptButton">Accept</button>
          </div>
      </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      // Acceptボタンが押されたときの処理
      document.getElementById('acceptButton').addEventListener('click', function () {
          const form = document.getElementById('bookInventoryForm'); // 修正
          if (form) {
              form.submit(); // フォームが存在する場合のみ送信
          }
      });
  });
</script>

  

  

  