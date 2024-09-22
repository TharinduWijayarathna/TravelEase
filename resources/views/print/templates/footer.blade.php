<table cellspacing="0" cellpadding="0" border="0" width="100%" class="system-note">
    <tbody>
        <tr class="row-bg">
            <td>
                <span class="note" style=" margin-top: 25%; ">Created at
                    {{ Carbon\Carbon::now()->format('d M, Y h:i A') }} | by <b>E-commerce</b>
                </span>
            </td>
            @if (isset($order) && $order['code'] != null)
                <td align="right">
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($order['code'], 'C39') }}" height="40"
                        width="150" /><br />
                </td>
            @endif
        </tr>
    </tbody>
</table>
<style>
    .note {
        margin-right: 150px;
        text-align: left;
        vertical-align: middle;
    }

    .system-note {
        font-size: 8px;
        width: 100%;
        font-family: Arial, Helvetica, sans-serif;
        position: fixed;
        bottom: 0px;
        margin-bottom: -50px;
        margin-right: 50px;
    }

    .footer-note {
        font-size: 8px;
        width: 100%;
        text-align: left;
        position: fixed;
        text-align: justify;
    }

    .system-note {
        bottom: 20px;
    }
</style>
