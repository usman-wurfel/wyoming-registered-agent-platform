<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            margin: 0;
            padding: 0;
        }

        table.wrapper {
            width: 100%;
            margin: 50px;
            border-spacing: 0;
        }

        table.content {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #acacac;
            border-radius: 4px;
            background-color: #ffffff;
            padding: 20px 50px 100px;
        }

        img {
            display: block;
            margin: 0 auto;
            margin-top: 15px;
            max-width: 100%;
        }

        hr {
            border: none;
            border-top: 1px solid #acacac;
            margin: 20px 0;
        }

        div.highlight {
            background: black;
            color: white;
            padding: 1rem;
            margin: 2rem 0;
            border-radius: 7px;
            font-weight: bold;
            text-align: center;
        }

        table.details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td {
            padding: 10px;
            text-align: left;
        }

        td.bold-label {
            font-weight: bold;
        }

        td.divider {
            text-align: center;
            margin-bottom: 2rem;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <table class="wrapper">
        <tr>
            <td>
                <table class="content">
                    <tr>
                     
                    </tr>
                    <tr>
                        <td>
                            <p style="font-size: 18px; color: #2e2e2e; line-height: 25px; margin: 0; padding-top: 20px;">
                                Hello Dear,
                            </p>
                            <p style="font-size: 16px; color: #2e2e2e; line-height: 25px; margin: 0; padding-top: 20px;">
                                This is a confirmation email from {{ getsettingval('site_title') }}. Please check your order details below:
                            </p>
                            <div class="highlight">Order Details</div>
                            @php
                            $order_type = '';
                            $order_id = '';
                            @endphp
                            <table class="details">
                                @foreach($order_data->chunk(2) as $chunk)
                                    @foreach($chunk as $order)
                                        @if( in_array($order->key_name, ['no_of_manager', 'no_of_owner', 'total_price', 'cash']))
                                            <tr>
                                                <td colspan="2" class="divider">
                                                    <hr>
                                                    <div>
                                                        <span style="border-bottom: 1px solid; font-size: 15px; margin-bottom: 1rem; font-weight: 700;">
                                                            @if($order->key_name == 'no_of_manager')
                                                                Managers
                                                            @elseif( $order->key_name  == 'no_of_owner')
                                                                Owners
                                                            @elseif( $order->key_name  == 'cash')
                                                                Annual Report
                                                            @else
                                                                Purchase Details
                                                            @endif
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif

                                        @if(in_array($order->key_name, ['manager_two_street_address', 'manager_three_street_address', 'manager_one_street_address', 'owner_two_firstname', 'owner_three_firstname', 'owner_one_firstname']))
                                            <tr>
                                                <td colspan="2" class="divider">
                                                    <div>
                                                        <span style="border-bottom: 1px solid; font-weight: 700;">
                                                            @if(strpos($order->key_name, 'manager_') !== false)
                                                                Manager {{ ucfirst(str_replace('manager_', '', $order->key_name)) }}
                                                            @else
                                                                Owner {{ ucfirst(str_replace('owner_', '', $order->key_name)) }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif

                                        @if($order->key_name !== 'company_name' && $order->key_name !== 'changing_agent')
                                            <tr>
                                                <td class="bold-label" width="50%">
                                                    @if($order->key_name == 'buildingsandotherdepreciabletangibleassets')
                                                        Buildings and Other Depreciable Tangible Assets
                                                    @else
                                                        {{ ucfirst(str_replace('_', ' ', $order->key_name)) }}
                                                    @endif
                                                </td>
                                                <td width="50%">
                                                    <div>
                                                        @if($order->key_name == 'total_price')
                                                            ${{ number_format($order->key_value , 2) }}
                                                        @else
                                                            {{ $order->key_value }}
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif

                                        @if($order->key_name == 'company_name')
                                            <tr>
                                                <td class="bold-label" width="50%">
                                                    Company Name
                                                </td>
                                                <td width="50%">
                                                    <div>
                                                        {{ $order->key_value }}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="divider">
                                                    <hr>
                                                    <div>
                                                        <span style="border-bottom: 1px solid; font-weight: 700;">Designated Contact</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @php
                                        $order_type = $order->order_type;
                                        $order_id = $order->order_id;
                                    @endphp
                                @endforeach

                                @php
                                    if($order_type == 'registered_agent_renew_llc') {
                                        $changing_agent = getorderdata('file_annual_report' , $order_type , $order_id);
                                    } else {
                                        $changing_agent = getorderdata('changing_agent' , $order_type , $order_id);
                                    }
                                @endphp

                                <tr>
                                    <td class="bold-label" width="50%">
                                        Changing Agent
                                    </td>
                                    <td width="50%">
                                        <div>
                                            @if($changing_agent == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <p style="text-align: center; margin: 35px auto 0px; font-size: 14px; color: #5d5d5d; width: 500px; line-height: 25px;">
                    © {{ date('Y') }} {{ getsettingval('copy_right') }}
                </p>
            </td>
        </tr>
    </table>
</body>

</html>
