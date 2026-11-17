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
                            {!! $quillContent !!}
                            </p>
                          
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
