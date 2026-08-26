</div> <footer class="text-center py-4 mt-5 text-muted border-top">
    <small>&copy; <?= date('Y') ?> Sakarya Oto Çekici - Yönetim Paneli</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function confirmDelete(url) {
        if (confirm("Bu içeriği silmek istediğinize emin misiniz? Bu işlem geri alınamaz!")) {
            window.location.href = url;
        }
    }
</script>

</body>
</html>