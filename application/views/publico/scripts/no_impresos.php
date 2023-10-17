<!-- COMMON SCRIPTS -->
<script src="<?= base_url() ?>static/publico/js/common_scripts.min.js"></script>
<script src="<?= base_url() ?>static/publico/js/main.js"></script>

<!-- SPECIFIC SCRIPTS -->
<script type="text/javascript">
        function base_url(complement = '') {
            return "<?= base_url() ?>" + complement
        }
        let id_U = "<?= $this->session->userdata('idusuario') ?>";
        let Tok = "<?= $this->session->userdata('token') ?>";
    </script>
<script src="<?= base_url() ?>static/publico/js/productos_no_impresos.js"></script>
<script src="<?= base_url() ?>static/publico/js/favoritos.js"></script>
	<script src="<?= base_url() ?>static/toastr/toastr.min.js"></script>


</body>

</html>