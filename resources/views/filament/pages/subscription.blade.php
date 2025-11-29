<x-filament-panels::page>

    <p>¡Bienvenido a la página de suscripción!</p>

    <div class="flex justify-center my-6">
        <table class="bg-white border border-gray-200 rounded-lg shadow text-sm" style="width: 400px;">
            <tbody>
                <tr>
                    <td class="px-4 py-2 text-gray-700">Mancentión Sistema Mensual</td>
                    <td class="px-4 py-2 text-right font-medium text-gray-900" style="text-align: right;">25.000</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-700">Servidor</td>
                    <td class="px-4 py-2 text-right font-medium text-gray-900" style="text-align: right;">5.000</td>
                </tr>
                <tr>
                    <td colspan="2" class="px-4 py-1 border-t border-gray-200"></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-semibold text-gray-700">Total Mensual</td>
                    <td class="px-4 py-2 text-right font-semibold text-gray-900" style="text-align: right;">30.000</td>
                </tr>
                <tr>
                    <td class="px-4 py-2 text-gray-700">Boleta Honorario (14.5%)</td>
                    <td class="px-4 py-2 text-right font-medium text-gray-900" style="text-align: right;">4.350</td>
                </tr>
                <tr>
                    <td colspan="2" class="px-4 py-1 border-t border-gray-200"></td>
                </tr>
                <tr>
                    <td class="px-4 py-2 font-bold text-gray-700">Total Mensual con Boleta</td>
                    <td class="px-4 py-2 text-right font-bold text-primary-600" style="text-align: right;">34.350</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex justify-center">
        <x-filament::button tag="a"
            href="https://www.mercadopago.cl/subscriptions/checkout?preapproval_plan_id={{ db_config('system.preapproval_plan_id') }}"
            color="primary" icon="heroicon-o-credit-card" class='blue-button'>
            Suscribirme
        </x-filament::button>



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
                const {
                    action,
                    data
                } = JSON.parse(event.data || '{}');

                if (action === 'finalize') {
                    window.location.href = '/admin/thanks?preapproval_id=' + data.preapproval_id;
                }
            }

            window.$MPC_loaded !== true ? (window.addEventListener("message", $MPC_message)) : null;
        </script>

    </div>

</x-filament-panels::page>
