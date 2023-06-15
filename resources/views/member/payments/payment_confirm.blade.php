@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reqAmount = {{ $reqAmount }};
            const remainingAmount = 100; // Assuming remaining amount for demonstration

            const confirmPayment = () => {
                Swal.fire({
                    title: 'Confirm Payment',
                    text: 'The amount paid exceeds the pledge amount. Are you sure you want to continue paying?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, store the payment
                        const payment = new Payment();
                        payment.amount = reqAmount;
                        payment.save();

                        Swal.fire('Success', 'Payment stored successfully', 'success');
                        window.location.href = document.referrer;
                    } else {
                        // User canceled, redirect back without storing the payment
                        window.location.href = document.referrer;
                    }
                });
            };

            // Call the confirmPayment function when the page loads
            confirmPayment();
        });
    </script>
@endsection