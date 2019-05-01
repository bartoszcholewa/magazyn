Użytkownik {{ $user->name }} stworzył nowe zlecenie: <a href='http://magazyn/orders/{{ $order->order_ID }}'> PW-{{ $order->order_NAME}} </a>
<br>
<!--Button-->
<center>
    <table align="center" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td align="left" style="padding: 10px;">
          <table border="0" class="mobile-button" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" bgcolor="#0ea949" style="background-color: #0ea949; margin: auto; max-width: 600px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; padding: 15px 20px; " width="100%">
              <!--[if mso]>&nbsp;<![endif]-->
                  <a href="http://magazyn/orders/{{ $order->order_ID }}/verified" target="_blank" style="16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; text-align:center; background-color: #0ea949; text-decoration: none; border: none; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; display: inline-block;">
                      <span style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-weight:normal; line-height:1.5em; text-align:center;">Potwierdź zlecenie</span>
                </a>
              <!--[if mso]>&nbsp;<![endif]-->
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
   </center>