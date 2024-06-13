<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" type="text/css">
    <title>{{ __('purchase_print') }}</title>
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
            <h4>{{ __('purchase_report') }}</h4>
        </div>
        @if (!isset($pdf))
            <div class="hidden-print mt-3 mb-2 text-center">
                <a href="{{ route('purchase.index') }}" class="btn btn-danger">{{ __('back') }}</a>
                <button type="button" class="btn common-btn" onclick="window.print();">{{ __('print') }}</button>
            </div>
        @endif
        <table class="table table-bordered text-center">
            <thead class="table-bg-color">
                <tr>
                    <th class="not-exported">{{ __('sl') }}</th>
                    <th>{{ __('date') }}</th>
                    <th>{{ __('reference') }}</th>
                    <th>{{ __('supplier') }}</th>
                    <th>{{ __('grand_total') }}</th>
                    <th>{{ __('paid') }}</th>
                    <th>{{ __('due') }}</th>
                    <th>{{ __('payment_status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchases as $purchase)
                    @php
                        $due_amount = $purchase->grand_total - $purchase->paid_amount;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ dateFormat($purchase->date) }}</td>
                        <td>{{ $purchase->reference_no }}</td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td>{!! numberFormat($purchase->grand_total) !!}</td>
                        <td>{!! numberFormat($purchase->paid_amount) !!}</td>
                        <td>{!! numberFormat($due_amount) !!}</td>
                        <td>
                            @if (!$purchase->payment_status)
                                <span class="badge badge-danger">{{ __('due') }}</span>
                            @else
                                <span class="badge badge-success">{{ __('paid') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (!isset($pdf))
        <script type="text/javascript">
            function auto_print() {
                window.print()
            }
            setTimeout(auto_print, 1000);
        </script>
    @endif
</body>

</html>
