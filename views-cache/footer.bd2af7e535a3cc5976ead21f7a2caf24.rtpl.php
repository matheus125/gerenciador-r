<?php if(!class_exists('Rain\Tpl')){exit;}?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Via cep -->
<script src="/res/admin/dist/js/main.js"></script>
<!-- jQuery -->
<script src="/res/admin2/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/res/admin2/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- jquery-validation -->
<script src="/res/admin2/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/res/admin2/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/res/admin2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->

<script src="/res/admin2/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/res/admin2/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/res/admin2/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/res/admin2/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/res/admin2/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/res/admin2/plugins/moment/moment.min.js"></script>
<script src="/res/admin2/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/res/admin2/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/res/admin2/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/res/admin2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/res/admin2/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/res/admin2/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/res/admin2/dist/js/pages/dashboard.js"></script>
<!-- InputMask -->
<script src="/res/admin2/plugins/moment/moment.min.js"></script>
<script src="/res/admin2/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/res/admin2/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/res/admin2/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/res/admin2/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/res/admin2/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/res/admin2/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/res/admin2/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/res/admin2/plugins/jszip/jszip.min.js"></script>
<script src="/res/admin2/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/res/admin2/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/res/admin2/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/res/admin2/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/res/admin2/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- dropzonejs -->
<script src="/res/admin2/plugins/dropzone/min/dropzone.min.js"></script>

<script type="text/javascript">

  $('.btnAnexarCert').on('click', function (event) {
    var button = $(event.target) // Button that triggered the modal
    var nomeCliente = button.data('nomecliente') // Extract info from data-* attributes
    var idCliente = button.data('idcliente')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $('#modalAnexarCertificado')
    modal.find('.modal-body input#nomecliente').val(nomeCliente)
    modal.find('.modal-body input#idcliente').val(idCliente)
  })

  $('#closeModalAnexo').on('click', function (e) {
    var modal = $('#modalAnexarCertificado')
    modal.find('.modal-body input#nomecliente').val("")
    modal.find('.modal-body input#idcliente').val("")
    modal.find('.modal-body input#file').val("")
  })

  $(function () {

    $('#quickForm').validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 5
        },
        terms: {
          required: true
        },
      },
      messages: {
        email: {
          required: "Por favor, forneça uma email",
          email: "Por favor insira um endereço de e-mail válido"
        },
        password: {
          required: "Por favor, forneça uma senha",
          minlength: "Sua senha deve ter pelo menos 5 caracteres"
        },
        terms: "Please accept our terms"
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $('[data-mask]').inputmask()

  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  
</script>




</body>

</html>