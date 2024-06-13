<!DOCTYPE html>
<html>

<head>
    <title>{{ __('print_barcode') }}</title>
</head>

<body>
    @php
        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
    @endphp
    <div style="display: flex;flex-wrap: wrap">
        @if ($barcodeDetails)
            @foreach ($barcodeDetails as $details)
                @for ($i = 0; $i < $details['qty']; $i++)
                    <div style="padding: 20px">
                        <img
                            src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($details['code'], $generatorPNG::TYPE_CODE_128)) }}">
                        <div style="text-align: center">{{ $details['code'] }}</div>
                        <div style="display: flex">
                            @if ($details['name'])
                                <div style="text-align: center; padding:0 10px">{{ Str::limit($details['name'], 10) }}</div>
                            @endif
                            @if ($details['price'])
                                <div style="text-align: center; padding:0 10px">{{ numberFormat($details['price']) }}</div>
                            @endif
                            @if ($details['promotional_price'])
                                <div style="text-align: center; padding:0 10px">{{ numberFormat($details['promotional_price']) }}</div>
                            @endif
                        </div>

                    </div>
                @endfor
            @endforeach

        @endif
    </div>


    <script type="text/javascript">
        function auto_print() {
            window.print()
        }
        setTimeout(auto_print, 1000);
    </script>
</body>

</html>
