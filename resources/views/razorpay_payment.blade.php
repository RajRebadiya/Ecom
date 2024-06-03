<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
</head>
<body>
    {{-- <h1>Complete your payment</h1> --}}
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}"
            , "amount": "{{ $order->amount }}"
            , "currency": "{{ $order->currency }}"
            , "name": "Your Company Name",
            // Add other options as needed
            "handler": function(response) {
                // Handle Razorpay payment response
                console.log(response);
                alert(response);
                // alert(response.razorpay_payment_id);
                // $lata = addtocart::where('user_id', $request - > user_id) - > delete();

                // Redirect user to payment success page
                window.location.href = "{{ url('home') }}";
            }
            , "prefill": {
                "name": "raj"
                , "email": "raj@gmail.com",
                // Add other prefill details as needed
            }
            , "theme": {
                "color": "#3399cc"
            }
        };
        var rzp = new Razorpay(options);
        rzp.open();

    </script>
</body>
</html>
