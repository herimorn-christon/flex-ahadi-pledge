<!-- // other scripts
// <script>
//   $(function() {
//     var Toast = Swal.mixin({
//       toast: true,
//       position: 'top-end',
//       showConfirmButton: false,
//       timer: 3000
//     });

//     $('.swalDefaultSuccess').click(function() {
//             Swal.fire(
//         'The Internet?',
//         'That thing is still around?',
//         'question'
//       )
//       })
//     });
//     $('.swalDefaultInfo').click(function() {
//       Toast.fire({
//         icon: 'info',
//         title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
//       })
//     });
//     $('.swalDefaultError').click(function() {
//       Toast.fire({
//         icon: 'error',
//         title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
//       })
//     });
//     $('.swalDefaultWarning').click(function() {
//       Toast.fire({
//         icon: 'warning',
//         title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
//       })
//     });
//     $('.swalDefaultQuestion').click(function() {
//       Toast.fire({
//         icon: 'question',
//         title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
//       })
//     });
// </script>

// <script>
//   // for enabling tooltips
// $(function () {
//   $('[data-toggle="tooltip"]').tooltip({
//     'delay': { show: 1200, hide: 500 }
//   })
// })

// $(document).ready( function () {
// $('#modaltable').DataTable(
//   {
//       autoWidth:true,
//       rowReorder: {
//             selector: 'tr'
//         },
//         columnDefs: [
//             { targets: 0, visible: true }
//         ]
//   }
// );
// } );

// </script>
// <script>
//   $(function () {
//     $("#example1").DataTable({
//       "responsive": true, "lengthChange": false, "autoWidth": false,
//       "buttons": ["csv", "excel", "pdf"]
//     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
//     $('#example').DataTable({
//       "paging": true,
//       "lengthChange": false,
//       "searching": false,
//       "ordering": true,
//       "info": true,
//       "autoWidth": false,
//       "responsive": true,
//     });
//   });

//   $(function () {
//     $("#mytable").DataTable({
//       "responsive": true, "lengthChange": false, "autoWidth": false,
//       "buttons": ["csv", "excel", "pdf"]
//     }).buttons().container().appendTo('#mytable_wrapper .col-md-6:eq(0)');
//     $('#table').DataTable({
//       "paging": true,
//       "lengthChange": false,
//       "searching": false,
//       "ordering": true,
//       "info": true,
//       "autoWidth": false,
//       "responsive": true,
//     });
//   });
// </script>
// <!-- jQuery UI 1.11.4 -->
// {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script> --}}
// <!-- jQuery -->
// <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

// <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
// <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
// <script>
//   $.widget.bridge('uibutton', $.ui.button)
// </script>
// <!-- Bootstrap 4 -->
// <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
// {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}

// {{-- datatables --}}
// <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
// <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
// <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
// <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
// <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
// <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
// <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
// <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
// <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }} "></script>
// <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
// <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
// <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
// <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
// <!-- ChartJS -->
// {{-- end --}}
// <script src="{{ asset('dist/js/adminlte.js') }}"></script>
// <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
// <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
// <!-- Page specific script -->
// <script>
//   $(function () {
//     $("#example").DataTable({
//       "responsive": true, "lengthChange": false, "autoWidth": false,
//       "buttons": ["csv", "excel", "pdf", "colvis"]
//     }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
//     $('mytable1').DataTable({
//       "paging": true,
//       "lengthChange": false,
//       "searching": false,
//       "ordering": true,
//       "info": true,
//       "autoWidth": false,
//       "responsive": true,
//     });
//   });
// </script>
// <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
// <!-- Sparkline -->
// <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
// <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
// <!-- JQVMap -->
// <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
// <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

// <!-- jQuery Knob Chart -->
// <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
// <!-- daterangepicker -->
// <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
// <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
// <!-- Tempusdominus Bootstrap 4 -->
// <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
// <!-- Summernote -->
// <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
// <!-- overlayScrollbars -->
// <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

// <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
// <script src="{{ asset('assets/js/datatables.js') }}" ></script>
// <script src="{{ asset('assets/js/datatables-simple-demo.js') }}" ></script>
// <!-- SweetAlert2 -->
// <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
// <!-- AdminLTE App -->
// <script src="{{ asset('dist/js/adminlte.js') }}"></script>
//  @yield('scripts')
 </body>
 </html> -->
