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
        var orderId = "{{ $order_id }}";
        var orderAmount = "{{ $order->amount }}";
        var orderCurrency = "{{ $order->currency }}";
        var user_id = "{{ $user_id }}";

        console.log("Order ID:", orderId); // Debugging: log order ID

        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}"
            , "amount": orderAmount
            , "currency": orderCurrency
            , "name": "FastTrack Ecommerce"
            , "order_id": "{{ $order->id }}",
            // Razorpay Order ID
            "user_id": user_id
            , "handler": function(response) {
                console.log("Razorpay Response:", response); // Debugging: log Razorpay response

                fetch("{{ url('payment-success') }}", {
                        method: "POST"
                        , headers: {
                            "Content-Type": "application/json"
                            , "X-CSRF-TOKEN": "{{ csrf_token() }}" // Add CSRF token for security
                        }
                        , body: JSON.stringify({
                            payment_id: response.razorpay_payment_id
                            , order_id: orderId // Ensure order ID is passed correctly
                            , user_id: user_id
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            window.location.href = "{{ url('home') }}";
                        } else {
                            alert("Payment failed: " + data.message); // Show error message from server
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Payment failed: " + error.message); // Show detailed error message
                    });
            }
            , "prefill": {
                "name": "raj"
                , "email": "raj@gmail.com"
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
