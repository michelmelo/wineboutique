
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; color: #74787E; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">
    <style>
	    #outlook a {
	      padding: 0;
	    }

	    body {
	      margin: 0;
	      padding: 0;
	      -webkit-text-size-adjust: 100%;
	      -ms-text-size-adjust: 100%;
	    }

	    table,
	    td {
	      border-collapse: collapse;
	      mso-table-lspace: 0pt;
	      mso-table-rspace: 0pt;
	    }

	    img {
	      border: 0;
	      height: auto;
	      line-height: 100%;
	      outline: none;
	      text-decoration: none;
	      -ms-interpolation-mode: bicubic;
	    }

	    p {
	      display: block;
	      margin: 13px 0;
	    }
        @media  only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media  only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
        @media only screen and (min-width:480px) {
	      .mj-column-per-100 {
	        width: 100% !important;
	        max-width: 100%;
	      }
	    }
    </style>

    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #f5f8fa; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
        <tr>
            <td align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
                <table class="content" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                    <tr>
                        <td class="header" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 25px 0; text-align: center; background-color: #fff;">
                            <a href="{{ url('/') }}" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #fff; font-size: 19px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
                                <img src="{{asset('img/logo.png')}}" alt="wineBoutique-logo" />
                            </a>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td class="body" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #fff; border-bottom: 1px solid #991338; border-top: 1px solid #991338; margin: 0; padding: 0; width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%;">
                            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #FFFFFF; margin: 0 auto; padding: 0; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                                <!-- Body content -->
                                <tr>
                                    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px 15px 0;background-color: #fff;">
                                    	<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
	                                    	Hi {{ $user->firstName }},
	                                    </p>
                                    	<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
	                                    	Great News!
	                                    </p>
                                        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                            Your Wine{{ count($order_wines)>1 ? 's' : '' }}:</p>
                                        <ul>
                                            @foreach($order_wines as $order_wine)
                                                <li>{{ $order_wine->quantity }}x {{ $order_wine->wine_name }}</li>
                                            @endforeach
                                        </ul>
                                        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                            From Order <strong>{{ $order }}</strong> by <a href="{{ url('/winery/') . '/' . $winery->slug }}">{{ $winery->name }}</a>
                                            ha{{ count($order_wines)>1 ? 've' : 's' }} been dispatched. Please expect to receive your items within <strong>{{ $delivery }}</strong> day{{ $delivery>1 ? 's' : '' }}.
                                        </p>
                                        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                        	Your tracking number is <strong>{{ $tracking }}</strong>, so please keep this email in your inbox for reference.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;  padding: 0 15px 35px;background-color: #fff;">
                                        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">Kind Regards,<br>Wine Boutique</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;background-color: #fff;">
                            <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
                                <tr>
                                    <td class="content-cell" align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
                                        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; line-height: 1.5em; margin-top: 0; color: #AEAEAE; font-size: 12px; text-align: center;">© {{ date("Y") }} Wine Boutique. All rights reserved.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
