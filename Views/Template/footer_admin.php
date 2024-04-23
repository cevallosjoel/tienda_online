<!-- Este script asigna la URL base de la aplicación PHP a una constante JavaScript llamada base_url.
     Esto es útil para construir URLs absolutas en JavaScript dentro de la aplicación web. -->
<script>
  const base_url = "<?= base_url(); ?>";
</script>

<!-- Essential javascripts for application to work-->
<script src="<?= media(); ?>/js/plugins/jquery-3.7.1.min.js"></script>
<script src="<?= media(); ?>/js/plugins/select2.js"></script>
<script src="<?= media(); ?>/js/plugins/bootstrap.bundle.min.js"></script>
<script src="<?= media(); ?>/js/plugins/main.js"></script>
<script src="<?= media(); ?>/js/plugins/fontawesome.js"></script>
<script src="<?= media(); ?>/js/plugins/all.min.js"></script>
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="<?= media(); ?>/js/plugins/jquery.dataTables.min.js"></script>
<script src="<?= media(); ?>/js/plugins/sweetalert2.all.min.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>


<script src="<?= media(); ?>/js/functions_admin.js"></script>
<script type="text/javascript" src="<?= media(); ?>/js/functions_admin.js"></script>
<script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
<!-- Page specific javascripts-->
<!-- Google analytics script-->

</body>

</html>