<!-- Include the required libraries -->


<!-- JavaScript code -->
<script type="text/javascript">
  showAllPayments();

  /*
    This function will get all the payments records
  */
  function showAllPayments() {
    let url = $('meta[name=app-url]').attr("content") + "/admin/payments";
    $.ajax({
      url: url,
      type: "GET",
      success: function(response) {
        $("#payments-table-body").html("");
        let purposes = response.payments;
        let total = response.total;
        let highest = response.highest;
        let lowest = response.lowest;
        let best = response.best;
        console.log(purposes)

        for (var i = 0; i < purposes.length; i++) {
          let toggleBtn = '<input type="checkbox" class="toggle-payment" data-id="' + purposes[i].id + '" ' +
            (purposes[i].is_active ? 'checked' : '') + ' data-toggle="toggle" ' +
            'data-on="on" data-off="off" data-onstyle="success" data-offstyle="danger" ' +
            'data-size="small" onchange="togglePayment(' + purposes[i].id + ')">';

          let showBtn = '<button ' +
            ' class="btn btn-sm bg-flex text-light" ' +
            ' onclick="showPayment(' + purposes[i].id + ')"><i class="fa fa-eye"></i>' +
            '</button> ';
          let editBtn = '<button ' +
            ' class="btn btn-sm bg-flex text-light" ' +
            ' onclick="editPayment(' + purposes[i].id + ')"><i class="fa fa-edit"></i>' +
            '</button> ';
          let deleteBtn = '<button ' +
            ' class="btn btn-danger btn-sm" ' +
            ' onclick="destroyPayment(' + purposes[i].id + ')"><i class="fa fa-trash"></i>' +
            '</button>';

          let projectRow = '<tr>' +
            '<td>' + (1 + i) + '</td>' +
            '<td>' + purposes[i].formattedDate + '</td>' +
            '<td>' + purposes[i].payer.fname + '&nbsp;' + purposes[i].payer.mname + '&nbsp;' + purposes[i].payer.lname + '</td>' +
            '<td>' + purposes[i].payment.name + '</td>' +
            '<td>' + purposes[i].pledge.name + '</td>' +
            '<td>' + purposes[i].amount + '</td>' +
           
            '<td>' + showBtn   + toggleBtn + '</td>' +
            '</tr>';
          $("#payments-table-body").append(projectRow);
        }
        $('.toggle-payment').bootstrapToggle();
        $("#total").html(total);
        $("#highest").html(highest);
        $("#lowest").html(lowest);
        $("#best").html(best.payer.fname + ' ' + best.payer.mname + ' ' + best.payer.lname);
      },
      error: function(response) {
        console.log(response.responseJSON)
      }
    });
  }

  showAllPaymentsObject();

  /*
    This function will get all the payments records
  */
  function showAllPaymentsObject() {
    let url = $('meta[name=app-url]').attr("content") + "/admin/payments";
    $.ajax({
      url: url,
      type: "GET",
      success: function(response) {
        $("#projects-table-bodyObject").html("");
        let purposes = response.payments_object;
        console.log(purposes);
        let total_payments = response.total_payments;
        let remaining = response.remaining;
        let highest = response.highest;
        let lowest = response.lowest;
        let pledges = response.pledges;

        for (var i = 0; i < purposes.length; i++) {
          let showBtn = '<button ' +
            ' class="btn btn-sm bg-flex text-light" ' +
            ' onclick="showPayment(' + purposes[i].id + ')"><i class="fa fa-eye"></i>' +
            '</button> ';
          let editBtn = '<button ' +
            ' class="btn btn-sm bg-flex text-light" ' +
            ' onclick="editPayment(' + purposes[i].id + ')"><i class="fa fa-edit"></i>' +
            '</button> ';
          let toggleBtns = '<input type="checkbox" class="toggle-payment" style="width:9rem" data-id="' + purposes[i].id + '" ' +
            (purposes[i].is_active ? 'checked' : '') + ' data-toggle="toggle" ' +
            'data-on="on" data-off="off" data-onstyle="success" data-offstyle="danger" ' +
            'data-size="small" onchange="togglePayment(' + purposes[i].id + ')">';
          let deleteBtn = '<button ' +
            ' class="btn btn-danger btn-sm" ' +
            ' onclick="destroyPayment(' + purposes[i].id + ')"><i class="fa fa-trash"></i>' +
            '</button>';

          let projectRows = '<tr>' +
            '<td>' + (1 + i) + '</td>' +
            '<td>' + purposes[i].formattedDate + '</td>' +
            '<td>' + purposes[i].pledge.name + '</td>' +
            '<td>' + purposes[i].pledge.object_name + '</td>' +
            '<td>' + purposes[i].total_Paid_object + purposes[i].pledge.metrics + '</td>' +
            
            '<td class="text-teal">' + (purposes[i].verified == '1' ? 'Verified' : 'Not Verified') + '</td>' +
            '<td>' + showBtn + toggleBtns + '</td>' +
            '</tr>' + '';
          $("#projects-table-bodyObject").append(projectRows);
        }
        $("#total-payments").html(total_payments + ' Tsh');
        $("#remaining-payment").html(remaining + ' Tsh');
        $("#highest").html(highest + ' Tsh');
        $("#lowest").html(lowest + ' Tsh');
        $("#total-pledges").html(pledges + ' Tsh');
      },
      error: function(response) {
        console.log(response.responseJSON)
      }
    });
  }
</script>
