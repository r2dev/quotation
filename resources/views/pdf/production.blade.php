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

        .order-details tr {
            page-break-inside: always;
            page-break-after: auto;
        }

        .order-details td,
        .order-details th {
            border: 1px #ccc solid;
            padding: 0.375em;
        }

        .order-details th {
            font-weight: bold;
            text-align: left;
        }

        .order-details thead th {
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

        .no-border-left {
            border-left: 0;
        }

        .no-border-right {
            border-right: 0;
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

<table style="width: 100%">
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
            @if(null !== $quote->user->customer)
                <h3>{{ $quote->user->customer->name }}</h3>
                {{ $quote->user->customer->address }}
                {{ $quote->user->customer->telephone }}

            @endif</td>
        <td colspan="3" class="slim-border align-center">
            <h3>STYLE</h3>
            @isset($quote->style)
            {{$quote->style}}
            @endif
        </td>
        <td colspan="4" class="slim-border align-center">SPECIES</td>
        <td colspan="3" class="slim-border align-center">
            <h3>PROFILE TYPE</h3>
            @isset($quote->style)
            {{$quote->style}}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="6" class="slim-border">
            Quotation:
            {{$quote->id}}
        </td>
        <td rowspan="2" colspan="3" class="slim-border align-center">
            <h3>Panel</h3>
            {{$quote->pannel}}
        </td>
        <td rowspan="2" colspan="3" class="slim-border align-center">
            <h3>LIP </h3><br>
            {{$quote->lip}}
        </td>
        <td rowspan="2" colspan="1" class="slim-border align-center">
            <h3>Moulding</h3> <br>
            {{$quote->moulding}}
        </td>
        <td rowspan="2" colspan="3" class="slim-border align-center">
            <h3>PROFILE SIZE</h3>
            {{$quote->profile_size}}
        </td>
    </tr>
    <tr>
        <td colspan="6" class="slim-border">Order #:</td>
    </tr>
    <tr>
        <td colspan="9" class="align-center">DOOR SIZE</td>
        <td colspan="7" class="align-center">PANEL SIZE</td>
    </tr>
    <tr>
        <td colspan="1" class="border-bottom">Qty</td>
        <td colspan="3" class="border-bottom">Style</td>
        <td colspan="2" class="border-bottom">W</td>
        <td class="border-bottom">in</td>
        <td colspan="2" class="border-bottom">H</td>
        <td class="border-bottom">Qty</td>
        <td colspan="2" class="border-bottom">W</td>
        <td colspan="2" class="border-bottom">in</td>
        <td colspan="2" class="border-bottom">H</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">{{$quote->profile_size}}</td>
        <td colspan="5" class="border-right">PROFILE SIZE</td>
        <td colspan="4">{{$quote->pannel}}</td>
        <td colspan="2">PANEL</td>
        <td></td>
    </tr>
    @foreach( $quote->products as $product)
        <tr>
            <td>{{$product->pivot->quantity}}</td>
            <td colspan="3">{{$product->design}}</td>
            <td colspan="2">{{$product->pivot->width}}</td>
            <td>X</td>
            <td colspan="2" class="border-right">{{$product->pivot->height}}</td>
            <td>{{$product->pivot->quantity}}</td>
            @if ($product->frame === 0)
                <td colspan="2">{{calculate_width($product->pivot->width, $quote->profile_size, 2, 1)}}</td>
                <td colspan="2">X</td>
                <td colspan="2">{{calculate_width($product->pivot->height, $quote->profile_size, 2, 1)}}</td>
            @else
                <td colspan="6"></td>
            @endif
        </tr>
    @endforeach
    <tr>
        <td colspan="9" style="height: <?php echo (20 - $quote->products->count()) * 30 ?>px" class="border-right"></td>
        <td colspan="7" style="height: <?php echo (20 - $quote->products->count()) * 30 ?>px"></td>
    </tr>
    <tr>
        <td class="bold-border no-border-right">33</td>
        <td class="bold-border no-border-left" colspan="8">Total</td>
        <td class="bold-border no-border-right">31</td>
        <td class="bold-border no-border-left" colspan="6">Total</td>
    </tr>
    <tr>
        <td colspan="3">
            <h3>
                ASSEMBLY DATE:
            </h3>
        </td>
        <td colspan="6"></td>
        <td colspan="3">
            <h3>
                Entered by:
            </h3>
        </td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="3">
            <h3>
                REQUIRED DATE:
            </h3>
        </td>
        <td colspan="6"></td>
        <td colspan="3"><h3>Reviewd by:</h3></td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="9"><h3>Received: </h3></td>
        <td colspan="7"><h3>Date: </h3></td>
    </tr>
</table>
</body>
</html>