<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Production</title>
    <style type="text/css">

        @page {
            margin-top: 1cm;
            margin-bottom: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
        }

        body {
            background: #fff;
            color: #000;
            margin: 0cm;
            font-family: 'Open Sans', sans-serif;
            font-size: 9pt;
            line-height: 100%;
        }

        h1, h2, h3, h4 {
            font-weight: bold;
            margin: 0;
        }

        h1 {
            font-size: 16pt;
            margin: 5mm 0;
        }

        h2 {
            font-size: 14pt;
        }

        h3, h4 {
            font-size: 9pt;
        }

        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        li,
        ul {
            margin-bottom: 0.75em;
        }

        p {
            margin: 0;
            padding: 0;
        }

        p + p {
            margin-top: 1.25em;
        }

        a {
            border-bottom: 1px solid;
            text-decoration: none;
        }

        /* Basic Table Styling */
        table {
            border-collapse: collapse;
            border-spacing: 0;
            page-break-inside: always;
            border: 0;
            margin: 0;
            padding: 0;
        }

        th, td {
            vertical-align: top;
            text-align: left;
        }

        table.container {
            width: 100%;
            border: 0;
        }

        tr.production-row {
            font-size: 14px;

        }

        tr.no-borders,
        td.no-borders {
            border: 0 !important;
            border-top: 0 !important;
            border-bottom: 0 !important;
            padding: 0 !important;
            width: auto;
        }

        /* Header */
        table.head {
            margin-bottom: 12mm;
        }

        td.header img {
            max-height: 3cm;
            width: auto;
        }

        td.header {
            font-size: 16pt;
            font-weight: 700;
        }

        td.shop-info {
            width: 40%;
        }

        .document-type-label {
            text-transform: uppercase;
        }

        table.order-data-addresses {
            width: 100%;
            margin-bottom: 10mm;
        }

        td.order-data {
            width: 40%;
        }

        .text-center {
            text-align: center;
        }

        .packing-slip .billing-address {
            width: 60%;
        }

        td.sixteen {
            width: 6.25%;
        }

        td.order-data table th {
            font-weight: normal;
            padding-right: 2mm;
        }

        table.order-details {
            width: 100%;
            margin-bottom: 8mm;
        }

        .quantity,
        .lite {
            width: 4%;
        }

        .width,
        .height,
        .total {
            width: 8%;
        }

        .unit,
        .amount {
            width: 16%;
        }

        .production-details tr.production-row {
            page-break-inside: always;
            page-break-after: auto;
        }

        .production-details tr.production-row td,
        .production-details tr.production-row th {
            padding: 0.375em;
        }

        .production-details tr.production-row th {
            font-weight: bold;
            text-align: left;
        }

        .production-details thead tr.production-row th {
            border-color: black;
        }

        .order-details tr.bundled-item td.product {
            padding-left: 5mm;
        }

        .order-details tr.product-bundle td,
        .order-details tr.bundled-item td {
            border: 0;
        }

        dl {
            margin: 4px 0;
        }

        dt, dd, dd p {
            display: inline;
            font-size: 7pt;
            line-height: 7pt;
        }

        dd {
            margin-left: 5px;
        }

        dd:after {
            content: "\A";
            white-space: pre;
        }

        .customer-notes {
            margin-top: 5mm;
        }

        table.totals {
            width: 100%;
            margin-top: 5mm;
        }

        table.totals th,
        table.totals td {
            border: 0;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        table.totals th.description,
        table.totals td.price {
            width: 50%;
        }

        table.totals tr:last-child td,
        table.totals tr:last-child th {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            font-weight: bold;
        }

        table.totals tr.payment_method {
            display: none;
        }

        #footer {
            position: absolute;
            bottom: -2cm;
            left: 0;
            right: 0;
            height: 2cm;
            text-align: center;
            border-top: 0.1mm solid gray;
            margin-bottom: 0;
            padding-top: 2mm;
        }

        .pagenum:before {
            content: counter(page);
        }

        .pagenum, .pagecount {
            font-family: sans-serif;
        }

        .slim-border {
            border: 1px solid #000;
        }

        .bold-border {
            border: 2px solid #000;
        }

        .align-center {
            text-align: center;
        }

        .border-right {
            border-right: 2px solid #000;
        }

        .border-bottom {
            border-bottom: 2px solid #000;
        }

        .border-top {
            border-top: 2px solid #000;
        }

        .no-border-left {
            border-left: 0;
        }

        .no-border-right {
            border-right: 0;
        }

        h3.table-title {

            font-size: 15px;
        }

        h3.head-table-title {
            margin-top: 3px;
            font-size: 14px;
        }
        h3.sign-title {
            font-size: 14px;
        }
    </style>
</head>
<body class="invoice">
<table style="width: 100%;">
    <tr>
        <td style="text-align: center; font-size: 16px; height: 20px;">GALAXY DOORS LTD.</td>
    </tr>
    <tr>
        <td style="text-align: center; font-size: 14px;">PRODUCTION FORM</td>
    </tr>
</table>

<table style="width: 100%" class="production-details">
    <tr>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
        <td class="sixteen"></td>
    </tr>
    <tr>
        <td colspan="6" class="slim-border">
            @if (isset($quote->user->customer))
                @if(null !== $quote->user->customer->name)
                    <h3>{{ $quote->user->customer->name }}</h3><br/>
                @endif
                @if (null !== $quote->user->customer->telephone)
                    {{ $quote->user->customer->telephone }}<br/>
                @endif
                @if(null !== $quote->user->customer->fax)
                    {{ $quote->user->customer->fax }}<br/>
                @endif
                @if ( null !== $quote->user->customer->email)
                    {{ $quote->user->customer->email }}<br/>
                @endif
                @if ( null !== $quote->po)
                    PO# {{ $quote->po }}
                @endif

            @else
                @if(null !== $quote->customer->name)
                    <h3>{{ $quote->customer->name }}</h3><br/>
                @endif
                @if (null !== $quote->customer->telephone)
                    {{ $quote->customer->telephone }}<br/>
                @endif
                @if(null !== $quote->customer->fax)
                    {{ $quote->customer->fax }}<br/>
                @endif
                @if ( null !== $quote->customer->email)
                    {{ $quote->customer->email }}<br/>
                @endif
                @if ( null !== $quote->po)
                    PO# {{ $quote->po }}
                @endif
            @endif


        </td>

        <td colspan="3" class="slim-border align-center">
            <h3 class="head-table-title">STYLE</h3><br>
            {{$quote->door_style}}
        </td>
        <td colspan="4" class="slim-border align-center">
            <h3 class="head-table-title">SPECIES</h3><br>
            {{$styles[$quote->style_id]}}

        </td>
        <td colspan="3" class="slim-border align-center">
            <h3 class="head-table-title">PROFILE TYPE</h3><br>
            {{$styles[$quote->style_id]}}
        </td>
    </tr>
    <tr>
        <td colspan="6" class="slim-border">
            Quotation:
            {{$quote->id}}
        </td>
        <td rowspan="2" colspan="3" class="slim-border align-center">
            <h3 class="head-table-title">Panel</h3><br>
            {{$quote->panel}}
        </td>
        <td rowspan="2" colspan="3" class="slim-border align-center">
            <h3 class="head-table-title">LIP </h3><br>
            {{$quote->lip}}
        </td>
        <td rowspan="2" colspan="1" class="slim-border align-center">
            <h3 class="head-table-title">Moulding</h3> <br>
            {{$quote->moulding}}
        </td>
        <td rowspan="2" colspan="3" class="slim-border align-center">
            <h3 class="head-table-title">PROFILE SIZE</h3>
            {{$quote->profile_size}}
        </td>
    </tr>
    <tr>
        <td colspan="6" class="slim-border">Order #:</td>
    </tr>
    <tr>
        <td colspan="9" class="align-center">
            <h3 class="head-table-title">DOOR SIZE</h3>
        </td>
        <td colspan="7" class="align-center">
            <h3 class="head-table-title">
                PANEL SIZE
            </h3>
        </td>
    </tr>
    <tr>
        <td colspan="1" class="border-bottom">
            <h3 class="table-title">Qty</h3>
        </td>
        <td colspan="4" class="border-bottom">
            <h3 class="table-title">Style</h3>
        </td>
        <td colspan="2" class="border-bottom text-center">
            <h3 class="table-title">W</h3>
        </td>
        <td class="border-bottom text-center">
            <h3 class="table-title">in</h3>
        </td>
        <td colspan="2" class="border-bottom text-center">
            <h3 class="table-title">H</h3>
        </td>
        <td class="border-bottom">
            <h3 class="table-title">Qty</h3>
        </td>
        <td colspan="2" class="border-bottom text-center">
            <h3 class="table-title">W</h3>
        </td>
        <td class="border-bottom text-center">
            <h3 class="table-title">in</h3>
        </td>
        <td colspan="2" class="border-bottom text-center">
            <h3 class="table-title">H</h3>
        </td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">
            <h3 class=" head-table-title">
                {{$quote->profile_size}}
            </h3>
        </td>
        <td colspan="6" class="border-right">
            <h3 class="head-table-title">
                PROFILE SIZE
            </h3>
        </td>
        <td colspan="3">
            <h3 class="head-table-title">
                {{$quote->panel}}
            </h3>
        </td>
        <td colspan="2">
            <h3 class="head-table-title">
                PANEL
            </h3>
        </td>
        <td></td>
    </tr>
    @foreach( $groups as $key => $group)
        @if ($key != 0)
            <tr class="production-row">
                <td colspan="10" class="border-right text-center">{{$key}}</td>
                <td colspan="5"></td>
            </tr>
        @endif

        @foreach($group as $product)
            <tr class="production-row">
                <td>{{$product->pivot->quantity}}</td>
                <td colspan="4">{{$product->design}}</td>
                <td colspan="2" class="text-center">
                    @if ($quote->decimal)
                        {{parse_number($product->pivot->width)}}
                    @else
                        {{$product->pivot->width}}
                    @endif
                </td>
                <td class="text-center">X</td>
                <td colspan="2" class="border-right text-center">
                    @if ($quote->decimal)
                        {{parse_number($product->pivot->height)}}
                    @else
                        {{$product->pivot->height}}
                    @endif
                </td>
                <td>
                    @if ($product->frame === 0)
                        {{$product->pivot->quantity}}
                    @endif
                </td>
                <?php
                if ($product->pivot->adjustment == "0") {
                    $profile_size = $product->profile_size;
                } else {
                    $profile_size = $product->pivot->adjustment;
                }
                ?>
                @if ($product->frame === 0)
                    @if ($product->df === 0)
                        <td colspan="2"
                            class="text-center">
                            @if ($quote->decimal)
                                {{parse_number(calculate_width($product->pivot->width, $profile_size, 2, $product->rule))}}
                            @else
                                {{calculate_width($product->pivot->width, $profile_size, 2, $product->rule)}}
                            @endif

                        </td>
                        <td colspan="1" class="text-center">X</td>
                        <td colspan="2"
                            class="text-center">
                            @if ($quote->decimal)
                                {{parse_number(calculate_width($product->pivot->height, $profile_size, 2, $product->rule))}}
                            @else
                                {{calculate_width($product->pivot->height, $profile_size, 2, $product->rule)}}
                            @endif

                        </td>
                    @else
                        <td colspan="2" class="text-center">
                            @if ($quote->decimal)
                                {{parse_number(calculate_width($product->pivot->height, $profile_size, 2, $product->rule))}}
                            @else
                                {{calculate_width($product->pivot->height, $profile_size, 2, $product->rule)}}
                            @endif
                        </td>
                        <td colspan="1" class="text-center">X</td>
                        <td colspan="2"
                            class="text-center">
                            @if ($quote->decimal)
                                {{parse_number(calculate_width($product->pivot->width, $profile_size, 2, $product->rule))}}
                            @else
                                {{calculate_width($product->pivot->width, $profile_size, 2, $product->rule)}}
                            @endif
                        </td>
                    @endif
                @else
                    <td colspan="6"></td>
                @endif
            </tr>
        @endforeach
    @endforeach
    <tr>
        <td colspan="10" style="height: <?php echo (18 - $quote->products->count()) * 30 ?>px"
            class="border-right"></td>
        <td colspan="6" style="height: <?php echo (18 - $quote->products->count()) * 30 ?>px"></td>
    </tr>
    <tr>
        <td class="bold-border no-border-right">
            <h3 class="head-table-title">{{$sum_total}}</h3>
        </td>
        <td class="bold-border no-border-left" colspan="9">
            <h3 class="head-table-title">Total</h3></td>
        <td class="bold-border no-border-right">
            <h3 class="head-table-title">{{$sum_total - $sum_frame}}</h3></td>
        <td class="bold-border no-border-left" colspan="5"><h3 class="head-table-title">Total</h3></td>
    </tr>
    <tr >
        <td colspan="10" style="height: 35px;">
            <h3 class="sign-title">
                ASSEMBLY DATE:
            </h3>
        </td>

        <td colspan="6" style="height: 35px;">
            <h3 class="sign-title">
                Entered by:
            </h3>
        </td>
    </tr>
    <tr>
        <td colspan="10" style="height: 35px;">
            <h3 class="sign-title">
                REQUIRED DATE:
            </h3>
        </td>

        <td colspan="6"><h3 class="sign-title" style="height: 35px;">Reviewd by:</h3></td>
    </tr>
    <tr>
        <td colspan="10"><h3 class="sign-title">Received: </h3></td>
        <td colspan="6"><h3 class="sign-title">Date: </h3></td>
    </tr>
</table>
</body>
</html>