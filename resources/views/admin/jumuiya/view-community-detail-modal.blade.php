<!-- View a Single Community Details Modal Page -->

<div class="modal fade" id="view-modal" tabindex="-1" >
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- start of Community details --}}
          <table class="table table-bordered">
            <tr>
              <td class="font-weight-bolder text-secondary">{{ __("Community Name") }}</td>
              <td><span id="name-info" class="text-dark"></span></td>
            </tr>
            <tr>
              <td class="font-weight-bolder text-secondary">{{ __("Abbreviation") }}</td>
              <td><span id="description-info" class="text-dark"></span></td>
            </tr>
            <tr>
              <td class="font-weight-bolder text-secondary">{{ __("Location") }}</td>
              <td><span id="location-info" class="text-dark"></span></td>
            </tr>
          </table>
          <h6 class="text-secondary">
           {{__(" Community Members")}}
          </h6>
          <hr>
          {{-- start of community member table --}}
          <table id="mytable"  class="table display responsive table-bordered " width="100%"  >
            <thead>
                <tr class="text-secondary">
                  <th>Member ID</th>
                  <th>{{ __("Member Name") }}</th>
                  <th>{{ __("Phone Number") }}</th>
                  <th>{{ __("Gender") }}</th>
                  <th>{{ __("Status") }} </th>
                </tr>
            </thead>
            <tbody id="members-table-body">
          
            </tbody>
            <tfoot></tfoot>
        </table>
        {{-- end of community member table --}}

        {{-- end of community detail --}}
        </div>
      </div>
    </div>
  </div>
        