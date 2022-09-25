@if (session('status')=='PENDIENTE')
    <div>
            @php
                $orden = session('order');
                $referencia = $orden['referencia'];
                $cadena = $referencia.((int)$total*100).'COPtest_integrity_spBS1QGSOzkcoy6uHtdSGITRonSVAsS4';
                $integrity = hash ("sha256", $cadena);
            @endphp
            <script
                src="https://checkout.wompi.co/widget.js"
                data-render="button"
                data-public-key="pub_test_G0Ml3OesqEPi5gB2kLsejyS1s45VHvkb"
                data-currency="COP"
                data-amount-in-cents="{{ (int)$total*100 }}"
                data-reference="{{ $referencia }}"
                data-signature:integrity="{{ $integrity }}"
                data-redirect-url="http://novaplus14.com/tienda/checkout/orden/{{ $orden['id'] }}"
                data-customer-data:email="{{ $orden['email'] }}"
                data-customer-data:full-name="{{ $currentUser->nombre }} {{ $currentUser->apellido }}"
                data-customer-data:phone-number="{{ $orden['telefono'] }}"
                data-customer-data:phone-number-prefix="+57"
                data-customer-data:legal-id="{{ $currentUser->documento }}"
                data-customer-data:legal-id-type="{{ $currentUser->tipo_doc }}"
                data-shipping-address:address-line-1="{{ $orden['direccion'] }}"
                data-shipping-address:country="CO"
                data-shipping-address:city="{{ $orden['ciudad'] }}"
                data-shipping-address:phone-number="{{ $orden['telefono'] }}"
                data-shipping-address:region="Depto"
                data-shipping-address:name="{{ $currentUser->nombre }} {{ $currentUser->apellido }}"
            >
            </script>
            {{-- <button class="btn btn-outline-secondary w-100">Agregar Producto</button>     --}}
    </div>
@endif