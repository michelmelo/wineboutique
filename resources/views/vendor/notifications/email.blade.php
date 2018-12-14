@component('mail::message')
<body style="margin: 0; padding: 0;font-family:Avenir,Helvetica,sans-serif;">
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td>
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
     <tr>
      <td align="center" bgcolor="#ffffff" style="padding: 40px 0 0;">
        <a href="http://stage.wineboutique.execdigi.com/" target="_blank">
         <img src="http://stage.wineboutique.execdigi.com/img/logo.png" alt="wine boutique logo" style="display: block;" />
       </a>
      </td>
     </tr>
     <tr>
      <td bgcolor="#ffffff" style="padding: 10px 0 40px 0;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tr>
           <td align="center" style="padding: 20px 0 20px 0;">
            <h1 style="text-align:center"> WELCOME TO WINE BOUTIQUE</h1>
            <h3 style="box-sizing:border-box;color:#74787e;font-size:16px;text-align:center">Your winery is almost set!</h3>
            <p style="box-sizing:border-box;color:#74787e;font-size:16px;text-align:center">Please click the button below to verify your email address.</p>
           </td>
          </tr>
          <tr>
           <td align="center" style="padding: 0;">
            {{-- Action Button --}}
            @isset($actionText)
            <?php
                switch ($level) {
                    case 'success':
                    case 'error':
                        $color = $level;
                        break;
                    default:
                        $color = 'primary';
                }
            ?>
            @component('mail::button', ['url' => $actionUrl, 'color' => $color])
            {{ $actionText }}
            @endcomponent
            @endisset
          </td>
         </tr>
         <tr>
          <td align="center" style="padding: 30px 0 0 0;">
            If you did not create an account, no further action is required.
          </td>
         </tr>
        </table>
      </td>
     </tr>
     <tr>
      <td align="center" bgcolor="#F5F8FA" style="padding: 30px 0 30px 0;">
        <p>© 2018 Wine Boutique. All rights reserved.</p>
      </td>
     </tr>
    </table>
   </td>
  </tr>
 </table>
</body>

@endcomponent