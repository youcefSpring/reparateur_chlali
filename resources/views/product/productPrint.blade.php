<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css">
    <title>{{ __('product_print') }}</title>
    <style>
        .table-bg-color {
            background: #29aae1;
            color: #fff;
        }

        .main-content {
            max-width: 1060px;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        @media print {

            .hidden-print {
                display: none !important;
            }

            @page {
                margin: 1.5cm 0.5cm 0.5cm;
            }

            @page: first {
                margin-top: 0.5cm;
            }

            tbody::after {
                content: '';
                display: block;
                page-break-after: avoid;
                page-break-inside: avoid;
                page-break-before: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="main-content m-auto">
        <div class="centered mt-5">
            <img src="{{ $generalsettings->logo->file ?? asset('logo/logo.svg') }}" height="42"
                style="margin-top: -10px; margin-bottom: 0px;filter: brightness(100%);">
            <p style="margin-top: 0; font-size: 10px; line-height: 20px;">
                {{ $generalsettings?->address }}<br>
                <i class="fas fa-phone-alt" style="font-size:10px"></i> {{ $generalsettings?->phone }} <br>
                <i class="fas fa-globe" style="font-size:10px"></i> {{ $generalsettings?->email }}
            </p>
            <h4>{{ __('product_report') }}</h4>
        </div>
        <div class="hidden-print mt-3 mb-2 text-center">
            <a href="{{ route('product.index') }}" class="btn btn-danger">{{ __('back') }}</a>
            <button type="button" class="btn common-btn"
                onclick="window.print();">{{ __('print') }}</button>
        </div>
        <table class="table table-bordered text-center">
            <thead class="table-bg-color">
                <tr>
                    <th>{{ __('sl') }}</th>
                    <th>{{ __('image') }}</th>
                    <th width="300px">{{ __('name') }}</th>
                    <th>{{ __('code') }}</th>
                    <th>{{ __('brand') }}</th>
                    <th>{{ __('category') }}</th>
                    <th>{{ __('quantity') }}</th>
                    <th>{{ __('unit') }}</th>
                    <th>{{ __('price') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ $product->thumbnail?->file }}" height="30" width="30"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->brand?->title }}</td>
                        <td>{{ $product->category?->name ?? 'N/A' }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>{{ ucfirst($product->unit?->name) ?? 'N/A' }}</td>
                        <td>{{ numberFormat($product->price) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        function auto_print() {
            window.print()
        }
        setTimeout(auto_print, 1000);
    </script>
</body>

</html>
