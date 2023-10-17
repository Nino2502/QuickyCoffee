<!-- COMMON SCRIPTS -->
<script src="<?= base_url() ?>static/publico/js/common_scripts.min.js"></script>
<script src="<?= base_url() ?>static/publico/js/main.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script type="text/javascript">
        function base_url(complement = '') {
            return "<?= base_url() ?>" + complement
        }
    </script>
<script src="<?= base_url() ?>static/publico/js/descripcion.js"></script>
<script  src="<?= base_url() ?>static/publico/js/carousel_with_thumbs.js"></script>
<script src="<?= base_url() ?>static/publico/js/favoritos.js"></script>
<script src="<?= base_url() ?>static/toastr/toastr.min.js"></script>

</body>

</html>