<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MercadoPago - Suscripción</title>
    <style>
        .blue-button {
            background-color: #3483FA;
            color: white;
            padding: 10px 24px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-size: 16px;
            transition: background-color 0.3s;
            font-family: Arial, sans-serif;
        }

        .blue-button:hover {
            background-color: #2a68c8;
        }
    </style>
</head>

<body>

    {{-- 
    <a href="https://www.mercadopago.cl/subscriptions/checkout?preapproval_plan_id=e7bb755e9ebb42198d2bf9d85c13c63a"
        target="_blank">Suscribirme 1.000</a>

    <a href="https://www.mercadopago.cl/subscriptions/checkout?preapproval_plan_id=7b768794b4ea4c8091e521099ea4148c"
        name="MP-payButton" class='blue-button'>Suscribirme 27.000</a>

    <a href="https://www.mercadopago.cl/subscriptions/checkout?preapproval_plan_id=e7bb755e9ebb42198d2bf9d85c13c63a"
        name="MP-payButton" class='blue-button'>Suscribirme 1.000</a> 
    --}}

    <a href="https://www.mercadopago.cl/subscriptions/checkout?preapproval_plan_id=5d1c9a13ef5446478e23ad65d98cb416"
        name="MP-payButton" class='blue-button'>Suscribirme</a>

    <script type="text/javascript">
        (function() {
            function $MPC_load() {
                window.$MPC_loaded !== true && (function() {
                    var s = document.createElement("script");
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";
                    var x = document.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                    window.$MPC_loaded = true;
                })();
            }
            window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window
                .addEventListener('load', $MPC_load, false)) : null;
        })();
        // to receive event with message when closing modal from congrants back to site
        function $MPC_message(event) {
            console.log('MercadoPago modal closed with data:', event.data);
            // onclose modal ->CALLBACK FUNCTION
            // !!!!!!!!FUNCTION_CALLBACK HERE Received message: {event.data} preapproval_id !!!!!!!!
            const preapprovalId = event.data.data.preapproval_id;
            window.location.href = '/suscripcion/' + preapprovalId;
        }
        window.$MPC_loaded !== true ? (window.addEventListener("message", $MPC_message)) : null;
    </script>
</body>

</html>
