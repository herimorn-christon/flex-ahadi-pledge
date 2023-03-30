<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Advanced form elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <form method="POST" action="{{ route('register') }}">
    @csrf
<div class="container my-5">

        <!-- /.row -->
        <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title" style="margin-left:30%;font:bold;font-family:cursive;
                  font-size:3rem">flex registration</h3>
                </div>
                <div class="card-body p-0">
                  <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                      <!-- your steps here -->
                      <div class="step" data-target="#logins-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">personal information</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#details-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="details-part-trigger">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label">communication and work</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#information-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                          <span class="bs-stepper-circle">3</span>
                          <span class="bs-stepper-label">education/profession/work</span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      <!-- your steps content here -->
                             
                           
                          
                      <div id="logins-part" class="content col-md-12" role="tabpanel" aria-labelledby="logins-part-trigger"
                          >
                          
                          

                        <div class="my_form" style="display:grid; flex-direction: row">
                          <div class="form-row">
                            <div class="col">
                            <label for="exampleName1">Name of member</label>
                            <input type="name" class="form-control" id="examplename1" placeholder="Enter name">
                          </div>
                          <div class="col">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          </div>
                          <div class="col">
                            <label for="exampleInputPassword1">confirm password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          </div>
                          </div>
                           
                              <div class="form-row">
                                 <div class="col">
                                  <label for="occupation">Gender</label>
                                  <select name="occupation" class="form-control" id="gender">
                                    <option value="">choose gender</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                  </select>
                                 </div>
                                 <div class="col">
                                  <label for="birth_date">Date of birth</label>
                                  <input type="date" class="form-control" name="birth_date" id="birth_date">
                                 </div>
                                  </div>
                          
                            
                            <div class="form-row">
                              <div class="col">
                                <label for="place_of_birth">Place of Birth</label>
                                <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" placeholder="Place of birth">
                              </div>
                              <div class="col">
                                <label for="marital_status">Maritial Status</label>
                                <select name="marital_status " class="form-control" id="marital_status">
                                  <option value="">choose status</option>
                                  <option value="1">Maried</option>
                                  <option value="2">Single</option>
                                  <option value="3">Widowed</option>
                                  <option value="4">Divorced</option>
                                </select>
                              </div>
  
                            </div>
                                    
                            <div class="form-row">
                              <div class="col">
                                <label for="mariage_type">Mariage Type</label>
                                <select name="mariage_type" class="form-control" id="mariage_type">
                                  <option value="1">Christian</option>
                                  <option value="2">Other</option>
                                </select>
                              </div>
                              <div class="col">
                                <label for="mariage_date">Mariage Date</label>
                                <input type="date" class="form-control" name="mariage_date" id="mariage_date">
                              </div>
                           
                            </div>
                            <div class="form-row">
                              <div class="col">
                                <label for="exampleInputPassword1">Partner Name</label>
                                <input type="text" class="form-control" id="partner_name" name="partner_name" placeholder="Partner Name">
                              </div>
                              <div class="col">
                                <label for="place_of_mariage">Place of Mariage</label>
                                <input type="text" class="form-control" id="place_of_mariage" name="place_of_mariage" placeholder="Place of mariage">
                              </div>
          
                            </div>
  
                        </div>
                       {{-- start of register form --}}
                     
                        {{-- end of register form --}}
                        <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                      </div>
                      <div id="details-part" class="content" role="tabpanel" aria-labelledby="details-part-trigger">
                        <div class="form-row">
                          <div class="col">
                            <label for="deacon_phone">Deacon Phone</label>
                            <input type="text" class="form-control" id="deacon_phone" name="deacon_phone" placeholder="Deacon Phone">
                          </div>
                          <div class="col">
                            <label for="deacon_postal">postal box</label>
                            <input type="text" class="form-control" id="deacon_postal" name="deacon_postal" placeholder="Deacon pobox">
                          </div>
                         </div>
          
                   
                      <div class="form-row">
                        <div class="col">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="col">
                          <label for="exampleInputEmail1">physical address</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your physical address">
                        </div>
                       </div>
                     <div class="form-row">
                      <div class="col">
                        <label for="usharika">old membership</label>
                        <input type="text" class="form-control" id="usharika" name="usharika" placeholder="Usharika">
                      </div>
                      <div class="col">
                        <label for="jina_msharika_jirani">nearest member</label>
                        <input type="text" class="form-control" id="jina_msharika_jirani" name="jina_msharika_jirani" placeholder="Jina Msharika Jirani">
                      </div>
                      </div>
                      <div class="form-row">
                        <div class="col">
                          <label for="simu_msharika_jirani">nearest member phone:no</label>
                          <input type="text" class="form-control" id="simu_msharika_jirani" name="simu_msharika_jirani" placeholder="Simu Msharika Jirani">
                        </div>
                            <div class="col">
                              <label for="simu_msharika_jirani">jina la mzee wakanisa </label>
                              <input type="text" class="form-control" id="mzee_wa_kanisa" name="mzee_wa_kanisa" placeholder="Simu Msharika Jirani">
                            </div>
                      </div>                          
                        <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                      </div>

                      <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                        {{-- start of register form --}}
                        <div class="form-row ">
                          <div class="col">
                            <label for="exampleName1">Occupation</label>
                         <input type="text" class="form-control" id="examplename1" placeholder="Enter occupation">
                          </div>
                          <div class="col">
                            <label for="exampleInputPassword1">education</label>
                            <select name="occupation" class="form-control" id="gender">
                             <option value="">choose education</option>
                             <option value="1">Male</option>
                             <option value="2">Female</option>
                              </select>
                          </div>
                          <div class="col">
                            <label for="exampleName1">place of work</label>
                            <input type="text" class="form-control" id="examplename1" placeholder="Enter place of work">
                          </div>
                         
                       </div>
                        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                        <input type="submit" class="btn btn-primary" value="submit"/>
                </div>
             
         
           
                <!-- /.<card-body -->
                <div class="card-footer">
                  Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a> for more examples and information about the plugin.
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>


 
</div>
</div>
</form>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })
  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
 
</body>
</html>

