//date picker dashboard page
    $(document).ready(function () {
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });


  // Handle Add Payment button click
  $(document).on('click', '.add-payment', function() {
    var userId = $(this).data('user-id');
    $('#userId').val(userId);
    $('#paymentModal').modal('show');
  });

  // Handle Edit Payment button click
  $(document).on('click', '.edit-payment', function() {
    var userId = $(this).data('user-id');
    var status = $(this).data('status');
    var amount = $(this).data('amount');
    $('#editUserId').val(userId);
    $('#editStatus').val(status);
    $('#editAmount').val(amount);
    $('#editPaymentModal').modal('show');
  });

