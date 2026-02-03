<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pay with Card</title>
</head>
<body>
    <h2>Pay with Card or PayPal</h2>

    <div id="paypal-button-container"></div>

    <!-- PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_LIVE_CLIENT_ID') }}&components=buttons,hosted-fields&enable-funding=card&currency=USD"></script>

    <script>
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'gold',
                layout: 'vertical',
                label: 'paypal'
            },
            // Step 1: Create order on your server
            createOrder: function (data, actions) {
                return fetch('/api/paypal/create-order', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(res => res.json()).then(order => {
                    return order.id;
                });
            },
            // Step 2: Capture payment on approval
            onApprove: function (data, actions) {
                return fetch('/api/paypal/capture-order', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ orderID: data.orderID })
                }).then(res => res.json())
                .then(details => {
                    alert('Payment completed!');
                    console.log(details);
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
