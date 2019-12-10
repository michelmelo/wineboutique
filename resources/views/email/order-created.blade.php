
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
	                                    	Hi {{ $winery->name }},
	                                    </p>
                                    	<p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
	                                    	You have received a new Order <strong>{{ $id }}</strong>.
	                                    </p>
                                        <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                                        	Please find below a summary of what has been purchased.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 0 15px;background-color: #fff;">
									    <div style="margin:0px auto;max-width:600px;">
									      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
									        <tbody>
									          <tr>
									            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
									              <!--[if mso | IE]>
									                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">

									        <tr>

									            <td
									               class="" style="vertical-align:top;width:600px;"
									            >
									          <![endif]-->
									              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
									                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
									                  <tr>
									                    <td align="left" style="font-size:0px;padding:10px 0;word-break:break-word;">
									                      <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color:#000000;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:22px;table-layout:auto;width:100%;border:none;">
									                        <tr style="border-bottom:1px solid #ecedee;text-align:left;padding:15px 0;">
									                          <th style="padding:10px ;">Wines ordered</th>
{{--									                          <th style="padding:10px ;">Wine price/first shipping/each additional</th>--}}
									                        </tr>
                                                              @foreach($orders as $order_wine)
									                        <tr style="border-bottom:1px solid #ecedee;text-align:left;padding:15px 0;">
									                          <td colspan="2" style="padding: 5px 10px">
									                            <div>
									                              <div style="display: inline;"> <span>{{ $order_wine->quantity }}x </span> <a href="{{ url('/') . '/wine/' . $order_wine->slug }}" style="color: #da8599;font-weight: 500;">{{ $order_wine->wine_name }}</a></div>
									                              <div style="display: inline; float:right;">
{{--									                              <strong>${{$order_wine->price}}</strong>--}}
{{--									                              <strong>${{$order_wine->shipping_price}}</strong>--}}
{{--									                              <strong>${{$order_wine->additional_shipping_price}}</strong>--}}
                                                                  </div>
									                            </div>
									                          </td>
									                        </tr>
                                                              @endforeach
									                        <tr style="border-bottom:1px solid #ecedee;text-align:left;padding:15px;background-color:#F2F2F2;">
									                          <td style="padding:10px ;">Total Price</td>
									                          <td align="right" style="padding:10px ;"><strong>${{ number_format(\App\OrderWine::TotalPrice($orders),2) }}</strong></td>
									                        </tr>
									                      </table>
									                    </td>
									                  </tr>
									                </table>
									              </div>
									              <!--[if mso | IE]>
									            </td>

									        </tr>

									                  </table>
									                <![endif]-->
									            </td>
									          </tr>
									        </tbody>
									      </table>
									    </div>
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
