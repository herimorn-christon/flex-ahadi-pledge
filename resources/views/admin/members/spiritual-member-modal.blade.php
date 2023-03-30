
<!-- Register User Modal Page -->

<div class="modal fade" id="form-modal1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:1250px;">
      <div class="modal-content">
        <div class="modal-header bg-light">
            <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{--start of displaying errors --}}
            <div id="error-div"></div>
            {{--end of displaying errors --}}

            {{--start of user registration form --}}
            <form action=""id="form2">
            
             <input type="hidden" name="update_id" id="myid">
                <div class="row">
                <div class="mb-2 col-md-6">
                    <label for="marriage_date" class="text-secondary">{{ __('Marriage Date') }}</label>

                    <div class="form-group">
                        <input id="mdate" type="date" placeholder="Enter First Name" class="text-capitalize form-control @error('fname') is-invalid @enderror" name="mdate">

                    </div>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="dname" class="text-secondary">{{ __('Deacon Name') }}</label>

                    <div class="">
                        <input id="dname" type="text" placeholder="Enter the decon name" class="text-capitalize  form-control"name="dname">

                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="dnumber" class="text-secondary">{{ __('Deacon number') }}</label>

                    <div class="form-group">
                        <input id="dphone" type="tel" class="text-capitalize  form-control" name="dphone" >

                     
                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <label for="bdate" class="form-label text-secondary ">{{ __('baptism date') }}</label>

                    <div class="form-group">
                        <input id="bdate" type="date"  class="form-control " name="bdate">

                    </div>
                </div>
                <div class="col-lg-6 mb-2">
                    <label for="cfate" class="text-secondary">{{ __('confirmation date') }}</label>

                    <div class="form-group">
                        <input id="cdate" type="date"class="form-control " name="cdate">

        
                    </div>
                </div>

                <div class="col-lg-6">
                    <label for="card_no" class="text-secondary">fellowship name</label>
                    <div class="form-group form-primary mb-2"> 
                        <input id="fename" type="text" class="form-control" name="fename" placeholder="" > </div>
                </div>
                <div class="col-lg-6">
                    <label for="card_no" class="text-secondary">patner name</label>
                    <div class="form-group form-primary mb-2"> 
                        <input id="pname" type="text" class="form-control" name="pname" placeholder="" > </div>
                </div>
                <div class="col-lg-6">
                    <label for="card_no" class="text-secondary">proffession</label>
                    <div class="form-group form-primary mb-2"> 
                        <input id="proffession" type="text" class="form-control" name="proffesion" placeholder="" > </div>
                </div>

{{-- rstatusselect --}}
                <div class="col-md-3"></div>
                <div class="col-md-3 mb-0 ">
                        <label for="" class="text-white">.</label>
                            <button type="button" id="save" class="btn btn-info">
                                save
                            </button>
                        </div>
             
            </div>
            </form>

            {{--end of user registration form --}}
        </div>
    
      </div>
    </div>
  </div>
    {{-- auto search scripts --}}
    <script>
        $("#save").click(function () { 
            //e.preventDefault();
            var forms=$('#form2')[0];
          var formData =new FormData(forms); 
          console.log(forms)
                //console.log(formData)
                $.ajaxSetup({
                headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                    });
                       
                $.ajax({
                    url:"{{route('store_value')}}",
                    method:'POST',
                    processData:false,
                    contentType:false,
                    data:formData,
                    success:function(response){
                     //console.log(response)
                     $("#exampleModal").modal("hide");
                      swal("weldon!",response.success, "success", {
                          button: "ok",
                           });
                            $("#form-modal1").modal('hide'); 
                     
                    },
                    error:function(error){
                        //console.log(error);
                      /*
                     // console.log(error.responseJSON.errors.categories);
                      $('#names').html(error.responseJSON.errors.name);
                      $('#type').html(error.responseJSON.errors.type);
                      */
                    
                    }
                 })
                //make the ajax call to update the data to the database
            
        });

        </script>

 
    <script type="text/javascript">
        $('#jumuiya').select2({
        dropdownParent: $("#form"),
        theme: 'bootstrap-5',
        placeholder: 'Select Jumuiya',
        ajax: {
            url: '/jumuiya/search',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    </script>
    
    <!-- Script for Modal -->
  