<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sale Order</title>
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
        table.customer-table {
            border: 1px solid #000;
            width: 60%;
        }
        tr.product-row {
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
            margin-bottom: 8mm;
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
            font-size: 14px;
            line-height: 16px;
        }

        .packing-slip .billing-address {
            width: 60%;

        }
        .address {
            font-size: 14px;
            line-height: 16px;
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
            text-align: center;
        }

        .width,
        .height,
        .total {
            width: 8%;
        }
        .italia {
            font-family: "Times New Roman", Times, serif;
            font-style: italic;
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
            font-size: 15px;
        }

        table.totals {
            width: 100%;
            margin-top: 5mm;
            font-size: 14px;
        }

        table.totals th,
        table.totals td {
            border: 0;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }
        table.totals th.title {
            width: 50%;
        }
        table.totals th.description {
            width: 20%
        }
        table.totals td.price {
            width: 30%;
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
<table class="head container">
    <tr>
        <td class="header">

        </td>
        <td class="shop-info">
            <div class="shop-name">
                <h2>Sales Order</h2>
            </div>

        </td>
    </tr>
</table>
<h1 class="document-type-label"></h1>
<table class="order-data-addresses">
    <tr>
        <td class="address billing-address">
            <br/>
            <br/>
            <br/>
            <br/>
            @if (isset($quote->user->customer))
                <table class="customer-table">
                    <tr>
                        <th>Customer</th>
                    </tr>
                    <tr>
                        <td>
                            @if(null !== $quote->user->customer->name)
                                {{ $quote->user->customer->name }}<br/>
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
                        </td>



                    </tr>
                </table>
            @else
                <table class="customer-table">
                    <tr>
                        <th>Customer</th>
                    </tr>
                    <tr>
                        <td>
                            @if(null !== $quote->customer->name)
                                {{ $quote->customer->name }}<br/>
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
                        </td>
                    </tr>
                </table>
            @endif

        </td>
        <td class="order-data">
            <table>
                <tr class="order-number">
                    <th>Order #:</th>
                    <td>{{ $quote->order_id }}</td>
                </tr>
                <tr class="order-number">
                    <th>Date:</th>
                    <td>{{ $quote->confirmed_on }}</td>
                </tr>
                <tr class="order-number">
                    <th>Quotation #:</th>
                    <td>{{ $quote->id }}</td>
                </tr>
                <tr class="order-style">
                    <th>Door Style:</th>
                    <td>{{ $quote->door_style }}</td>
                </tr>
                <tr>
                    <th>Material & Grade:</th>
                    <td>{{$styles[$quote->style_id]}}</td>
                </tr>
                <tr>
                    <th>Lip:</th>
                    <td>{{$quote->lip}}</td>
                </tr>
                <tr>
                    <th>
                        Moulding:
                    </th>
                    <td>{{$quote->moulding}}</td>
                </tr>
                <tr>
                    <th>Total Sqf:</th>
                    <td>{{$sum}}</td>
                </tr>
                <tr>
                    <th>TERMS:</th>
                    <td>{{$quote->terms}}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table class="order-details">
    <thead>
    <tr>
        <th class="quantity" style="text-align: center;">Quantity</th>
        <th class="description" style="text-align: center;">Description</th>
        <th class="lite"  style="text-align: center;">Lite</th>
        <th class="width" style="text-align: center;">Width</th>
        <th class="height" style="text-align: center;">Height</th>
        <th class="total" style="text-align: center;">Total Sqf</th>
        <th class="unit" style="text-align: center;">Unit Price</th>
        <th class="amount" style="text-align: center;">Amount</th>
    </tr>
    </thead>
    <tbody>

    @foreach( $quote->products as $product)
        <tr class="product-row">
            <td>{{$product->pivot->quantity}}</td>
            <td>{{$product->design}}</td>
            <td>
                @if($product->pivot->lite != 0)
                    {{$product->pivot->lite}}
                @endif
            </td>
            <td>{{$product->pivot->width}}</td>
            <td>{{$product->pivot->height}}</td>
            <td>
                {{ $product->total_area}}
            </td>
            <td>
                ${{number_format($product->unit_price, 2)}}
            </td>
            <td>
                ${{number_format($product->amount, 2)}}
            </td>
        </tr>
    @endforeach
    <?php $alignment = 11 ?>
    @if ($quote->products->count() < $alignment)
        <tr>
            <td style="height: <?php echo ($alignment - $quote->products->count()) * 30 ?>px" ></td>
            <td style="height: <?php echo ($alignment - $quote->products->count()) * 30 ?>px" ></td>
            <td style="height: <?php echo ($alignment - $quote->products->count()) * 30 ?>px" ></td>
            <td style="height: <?php echo ($alignment - $quote->products->count()) * 30 ?>px" ></td>
            <td style="height: <?php echo ($alignment - $quote->products->count()) * 30 ?>px" ></td>
            <td style="height: <?php echo ($alignment - $quote->products->count()) * 30 ?>px" ></td>
            <td style="height: <?php echo ($alignment - $quote->products->count()) * 30 ?>px" ></td>
            <td style="height: <?php echo ($alignment - $quote->products->count()) * 30 ?>px" ></td>

        </tr>
    @endif
    <tr>
        <td colspan="5">{{$total_quantity}}</td>
        <td colspan="2">{{$sum_sqf}}</td>
        <td colspan="1">${{$sum}}</td>

    </tr>
    </tbody>
    <tfoot>
    <tr class="no-borders">
        <td class="no-borders" colspan="5">
            <div class="customer-notes">
                <br>
                <span class="italia"></span> <br/>
                <span class="italia">Deposits are non-refundable.</span> <br />
                <span class="italia"></span>
            </div>
        </td>

        <td class="no-borders" colspan="3">
            <table class="totals">
                <tfoot>
                <tr >
                    <th class="title">Discount</th>
                    <?php $discount = $quote->cash ?>
                    <th class="description">{{ $discount }}%</th>
                    <td class="price">${{round($sum / 100 * $discount, 2)}}</td>

                </tr>
                <tr>
                    <th class="title">Other Charges</th>
                    <th class="description"></th>
                    <td class="price"><span class="totals-price"><span class="amount">$0</span></span></td>
                </tr>
                <tr>
                    <th class="title">Total</th>
                    <th class="description"></th>
                    <td class="price"><span class="totals-price"><span class="amount">${{round($sum, 2)}}</span></span></td>
                </tr>

                <tr class="order_total">
                    <th class="title">Deposit</th>
                    <th class="description"></th>
                    <td class="price"><span class="totals-price"><span class="amount">${{round($quote->deposit, 2)}}</span></span></td>
                </tr>
                <tr class="order_total">
                    <th class="title">Balance Due</th>
                    <th class="description"></th>
                    <td class="price"><span class="totals-price"><span class="amount">${{round($sum - $quote->deposit, 2)}}</span></span></td>
                </tr>

                </tfoot>
            </table>
        </td>
    </tr>
    </tfoot>
</table>
</body>
</html>