<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice</title>
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
    </style>
</head>
<body class="invoice">
<table style="width: 100%;">
    <tr>
        <td style="text-align: center;">GALAXY DOORS LTD.</td>
    </tr>
    <tr>
        <td style="text-align: center;">PRODUCTION FORM</td>
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
        <td colspan="6">
            @if(null !== $quote->user->customer->name)
                {{ $quote->user->customer->name }}
            @endif</td>
        <td colspan="3">
            STYLE
            @isset($quote->style)
            {{$quote->style}}
            @endif
        </td>
        <td colspan="4">SPECIES</td>
        <td colspan="3">
            PROFILE TYPE
            @isset($quote->style)
            {{$quote->style}}
            @endif
        </td>
    </tr>
    <tr>
        <td colspan="6">
            Quotation:
            {{$quote->id}}
        </td>
        <td rowspan="2" colspan="3">
            Panel
            {{$quote->pannel}}
        </td>
        <td rowspan="2" colspan="3">
            LIP <br>
            {{$quote->lip}}
        </td>
        <td rowspan="2" colspan="1">
            Moulding <br>
            {{$quote->moulding}}
        </td>
        <td rowspan="2" colspan="3">
            PROFILE SIZE
            {{$quote->profile_size}}
        </td>
    </tr>
    <tr>
        <td colspan="6">Order #:</td>
    </tr>
    <tr>
        <td colspan="9">DOOR SIZE</td>
        <td colspan="7">PANEL SIZE</td>
    </tr>
    <tr>
        <td colspan="1">Qty</td>
        <td colspan="3">Style</td>
        <td colspan="2">W</td>
        <td>in</td>
        <td colspan="2">H</td>
        <td>Qty</td>
        <td colspan="2">W</td>
        <td colspan="2">in</td>
        <td colspan="2">H</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">PROFILE SIZE</td>
        <td colspan="5">PROFILE SIZE</td>
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
            <td colspan="2">{{$product->pivot->height}}</td>
            <td>{{$product->pivot->quantity}}</td>
            <td colspan="2">{{calculate_width($product->pivot->width, $quote->profile_size, 0.25, 1)}}</td>
            <td colspan="2">X</td>
            <td colspan="2">{{calculate_width($product->pivot->height, $quote->profile_size, 0.25, 1)}}</td>
        </tr>
    @endforeach
    <tr>
        <td>33</td>
        <td colspan="8">Total</td>
        <td>31</td>
        <td colspan="6">Total</td>
    </tr>
    <tr>
        <td colspan="3">ASSEMBLY DATE:</td>
        <td colspan="6"></td>
        <td colspan="3">Entered by:</td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="3">REQUIRED DATE:</td>
        <td colspan="6"></td>
        <td colspan="3">Reviewd by:</td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="9">Received: </td>
        <td colspan="7">Date: </td>
    </tr>
</table>
</body>
</html>