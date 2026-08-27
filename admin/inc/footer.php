      </div>
      <!-- /.admin-content -->

      <footer class="admin-footer">
        <small>&copy; <?= date('Y') ?> Sakarya Yol Destek - Yönetim Paneli</small>
      </footer>
    </div>
    <!-- /.admin-main -->

  </div>
  <!-- /.admin-shell -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function confirmDelete(url) {
      if (confirm("Bu içeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz!")) {
        window.location.href = url;
      }
    }

    // Mobil sidebar aç/kapa
    (function () {
      const sidebar = document.getElementById('adminSidebar');
      const toggleBtn = document.getElementById('sidebarToggleBtn');
      const backdrop = document.getElementById('sidebarBackdrop');
      if (!sidebar || !toggleBtn || !backdrop) return;

      function closeSidebar() {
        sidebar.classList.remove('open');
        backdrop.classList.remove('show');
      }

      toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('open');
        backdrop.classList.toggle('show');
      });
      backdrop.addEventListener('click', closeSidebar);
    })();
  </script>

</body>
</html>
