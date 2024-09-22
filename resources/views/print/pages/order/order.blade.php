@extends('print.layouts.template')
@section('content')
    <div class="table-responsive">
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
            <tbody>
                <tr>
                    <td style="padding-left: 0;">
                        <div class="text-head" style="margin-bottom: 10px; color: {{ $config->color_code }};"><b>ORDER
                                #{{ $order->code }} </b></div>
                    </td>
                </tr>
                <tr>
                    <td align="left" class="td-customer-style " style="vertical-align:text-top;padding-left: 0;">
                        <div style="opacity: 0.5;padding-left: 0;">BILLED TO</div>
                        <div style="margin-bottom: 4px;margin-top: 4px;">
                            {{ $order->customer ? $order->customer_name : 'Walking Customer' }}</div>
                        @isset($order->customer_mobile)
                            <div style="margin-bottom: 4px;margin-top: 4px;">{{ $order->customer_mobile }}</div>
                        @endisset
                        @isset($order->customer_email)
                            <div style="margin-bottom: 4px;margin-top: 4px;">{{ $order->customer_email }}</div>
                        @endisset
                        @isset($order->customer_address)
                            <div style="margin-bottom: 4px;margin-top: 4px;">{{ $order->customer_address }}</div>
                        @endisset
                        @isset($order->ref_no)
                            <div style="margin-bottom: 4px;margin-top: 10px;">PROJECT / REF: {{ $order->ref_no }}</div>
                        @endisset

                    </td>
                    <td align="right" width="30%" class="td-customer-style customer-section-name">
                                <div>ORDER NO<div>
                                <div style="margin-bottom: 3px;margin-top: 3px;">DATE OF ISSUE</div>
                                <div style="margin-bottom: 3px;margin-top: 3px;">INVOICE DATE</div>
                    </td>
                    <td align="right" width="22%" class="td-customer-style "
                        style="padding-right: 10;vertical-align:text-top;">
                        <div> {{ $order->code }} </div>
                        <div style="margin-bottom: 3px;margin-top: 3px;">
                            {{ Carbon\Carbon::now()->format('d M, Y') }}</div>
                        <div style="margin-bottom: 3px;margin-top: 3px;">
                            {{ \Carbon\Carbon::parse($order->date)->format('d M, Y') }}</div>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <table cellspacing="0" cellpadding="0" border="0" width="100%" class="invoice_table">
        <thead class="invoice_table_head" style="">
            <tr class="row-bg-head"
                style="line-height:1; white-space:nowrap; color: {{ $config->color_code }}; background-color: {{ $config->color_code }}20;">
                <th width="2%">#</th>
                <th width="45%" align="left" class="table_head_data" style="font-size: 11px;">
                    PRODUCT
                </th>
                <th width="15%" align="right" class="table_head_data " style="font-size: 11px;">
                    PRICE
                </th>
                <th width="5%" align="right" class="table_head_data " style="font-size: 11px;">
                    QTY
                </th>
                <th width="22%" align="right" class="table_head_data" style="font-size: 11px;">
                    LINE TOTAL
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->order_items as $key => $item)
                <tr class="row-bg">
                    <td align="center" class="td-style">
                        {{ $key + 1 }}
                    </td>
                    <td align="left" class="td-style">
                        <p style="margin: 0px">
                            <span style="margin: 0px;">
                                {!! nl2br(e($item->product_code)) !!}&nbsp;-
                            </span>
                            @php
                                $name = $item->product_name;
                                $lines = [];
                                $maxLength = 40;

                                while (strlen($name) > $maxLength) {
                                    $lastSpace = strrpos(substr($name, 0, $maxLength), ' ');
                                    
                                    if ($lastSpace !== false) {
                                        $line = substr($name, 0, $lastSpace);
                                        $name = substr($name, $lastSpace + 1);
                                    } else {
                                        $line = substr($name, 0, $maxLength);
                                        $name = substr($name, $maxLength);
                                    }
                                    $lines[] = $line;
                                }
                                if (strlen($name) > 0) {
                                    $lines[] = $name;
                                }
                            @endphp
                            @foreach ($lines as $line)
                                {{ $line }}<br>
                            @endforeach
                        </p>
                    </td>
                    <td align="right" class="td-style right-text">
                        {{ number_format($item->unit_price, 2) }}
                    </td>
                    <td width="10%" align="right" class="td-style right-text">
                        {{ number_format($item->quantity, 0, '.', ',') }}
                    </td>
                    <td width="22%" align="right" class="td-style right-text">
                        {{ $order->currency_name }}
                        {{ number_format($item->sub_total, 2) }}
                    </td>
                </tr>
            @endforeach
            <tr class="row-bg " style="border-top: 2px dotted #eee;">
                <td width="10%" class="right-text" style="padding-bottom: 0px; padding-top: 5px;"></td>
                <td width="10%" class="right-text" style="padding-bottom: 0px; padding-top: 5px;"></td>
                <td colspan="2" align="right" class="td-style left-text"
                    style="color: #808080; padding-bottom: 0px; padding-top: 5px;">SUB
                    TOTAL</td>
                <td class="td-style right-text" style="white-space:nowrap; padding-bottom: 0px; padding-top: 5px;">
                    {{ $order->currency_name }}
                    {{ number_format($order->sub_total, 2) }}
                </td>
            </tr>
        </tbody>
    </table>
    <style>
        .page_break {
            page-break-before: always;
        }

        .ql-cursor {
            display: none;
        }

        .right-text {
            text-align: right;
            padding-right: 5px;
        }

        .row-style {
            padding-left: 0px;
            padding-right: 0px;
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .row-bg-head {
            background-color: #f5f5f5;
        }

        .row-bg {
            background-color: transparent;
        }

        .invoice_table th,
        td {
            padding: 10px;
        }

        .parameter-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .parameter-td-style-head {
            font-size: 11px;
            opacity: 0.5;
            width: 25%;
            padding: 0.4%;
        }

        .parameter-td-customer-style {
            font-size: 11px;
            word-wrap: break-word;
            width: 80%;
            margin-left: 10%;
            margin-top: -35px;
            padding: 0.4%;
        }

        ..invoice_table td {
            padding: 5px;
        }

        .invoice_table {
            margin-top: 1rem;
            border-collapse: collapse;
        }

        .row-bg-subtotal {
            background-color: #e8e8e8c4;
        }

        .row-white {
            background-color: #ffffff;
        }

        .td-style {
            font-size: 11px;
            line-height: 1;
            margin: 10px;
            padding: 10px;
            white-space: normal;
            vertical-align: top;
        }

        .td-style-head {
            font-size: 11px;
            opacity: 0.5;
        }

        .td-customer-style {
            font-size: 11px;
            line-height: 1;
            padding-bottom: 3px;
            padding-top: 3px;
        }

        .company_data {
            font-size: 0.8rem;
            font-weight: 400;
        }

        .td-style-gt {
            font-family: arial;
            font-size: 14px;
            font-weight: 400;
            line-height: 17px;
            padding-left: 10px;
            padding-bottom: 6px;
            padding-top: 6px;
        }

        .signature {
            text-align: center;
            line-height: 10px;
        }

        .signature-section {
            margin-top: 50px;
        }

        .material-img {
            height: 120px;
            position: fixed;
            right: 150px;
            top: 160px;
            z-index: 999999;
            padding: 5px 0px 5px 0px;
        }

        .border-mb {
            border-bottom: #000000 solid 1px;
        }

        .border-mt {
            border-top: #000000 solid 1px;
        }

        .border-b {
            border-bottom: #000000 solid 2px;
        }

        .border-t {
            border-top: #000000 solid 2px;
        }

        .border-l {
            border-left: #000000 solid 2px;
        }

        .border-r {
            border-right: #000000 solid 2px;
        }

        .brand-logo {
            width: 150px;
            padding-bottom: 20px;
            padding-top: 2px;
        }

        .heading-bg {
            background-color: #e8e8e8c4;
        }

        .heading-bg-po {
            background-color: #ffffff7d;
            color: #2b2b2b;
        }

        .total-bg {
            background-color: #e8e8e8c4;
            padding-right: 10px;
            font-family: arial;
            font-size: 10px;
            font-weight: 400;
            line-height: 20px;
            padding-left: 10px;
            padding-bottom: 5px;
        }

        .total-txt {
            text-align: left;
            padding-left: 10px;
            font-family: arial;
            font-size: 10px;
            font-weight: 400;
            line-height: 20px;
            font-weight: bold;
        }

        .total-value {
            text-align: right;
            font-family: arial;
            font-size: 10px;
            font-weight: 400;
            line-height: 20px;
            font-weight: bold;
        }

        .table-heading {
            padding-left: 15px;
            font-size: 12px;
        }

        .remark-content {
            text-align: left;
            font-size: 11px;
            text-align: justify;

            p {
                line-height: 1px;
                margin-bottom: 0px;
            }

        }

        .remark-content p {
            line-height: 1;
            margin-bottom: 0px;
            margin-top: 0px
        }

        .remark-note {
            text-align: center
        }

        .section-table {
            margin-bottom: 20px;
        }

        .section-footer {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .section-table {
            margin-bottom: 20px;
        }

        .note-area {
            border-bottom: #c8c8c8ab solid 1px;
            border-top: #c8c8c8ab solid 1px;
            border-left: #c8c8c8ab solid 1px;
            border-right: #c8c8c8ab solid 1px;
            border-radius: 5px;
            margin-top: 50px;
        }

        .text {
            text-align: left;
            margin-top: 20px;
            padding-bottom: 20px;
            margin-left: 20px;
        }

        .text-head {
            font-size: 17px;
        }

        .text-body {
            font-family: Cambria;
            font-size: 15px;
        }

        .text-tc {
            font-size: 12px;
            line-height: 20px;
        }

        .vendor-info {
            font-size: 0.8rem;
            line-height: 5px;
        }

        .signature-row {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 3rem;
            padding: 10px 0;
            text-align: center;
        }

        .signature-label {
            margin-left: 10px;
            font-size: 11px;
        }

        .signature-dots {
            font-size: 14px;
            margin: 0 10px;
            flex-grow: 1;
        }

        .customer-section-name {
            opacity: 0.5; 
            vertical-align:text-top;
        }

        .customer-section-description {
            padding-right:10;
            vertical-align:text-top;
        }
    </style>
@endsection
