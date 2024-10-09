<!DOCTYPE html>
<html>

<head>
    <title>Payment Page</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.midtrans.client_key') }}"></script>
</head>

<body>

    <h2>Complete Your Payment</h2>
    <button id="pay-button">Pay Now</button>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Payment successful!");
                    window.location.href = "/success-payment";
                },
                onPending: function(result) {
                    alert("Payment pending!");
                    window.location.href = "/pending-payment";
                },
                onError: function(result) {
                    alert("Payment failed!");
                    window.location.href = "/failed-payment";
                }
            });
        };
    </script>

</body>

</html>
