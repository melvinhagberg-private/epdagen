<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                font-family: 'Open Sans', sans-serif;
            }

            .head > div {
                width: 50%;
                display: inline-block;
                position: relative;
                vertical-align: top !important;
                margin: 0;
            }

            .head > div:nth-child(2) {
                margin-top: -15px;
            }

            .head > div h3 {
                margin: 0;
            }

            .head > div .logo {
                width: 175px;
            }

            .head div > table tr td {
                display: inline-block;
                width: 25%;
            }

            .head div > table tr td:nth-child(2) {
                font-weight: 700;
            }

            .address-box {
                width: 100%;
                padding: 5px 15px;
                border: 1px solid grey;
            }

            .items {
                border: 1px solid #000;
                height: 300px;
            }

            .items > table {
                width: 100%;
                border-collapse: collapse;
            }

            .items > table tr td {
                font-weight: 400;
            }

            .items > table .th-row th {
                border-top: 1px solid #000;
                border-bottom: 1px solid #000;
            }

            .totals, .totals table {
                width: 100%;
            }

            .totals table tr th:nth-child(2) {
                font-weight: 400;
                text-align: right;
            }

            .footer {
                margin: 50px 0 0 0;
            }

            .footer > div {
                display: inline-block;
                vertical-align: top;
            }

            .footer > div span {
                display: block;
                font-size: 13px;
            }

            .footer > div span.title {
                font-weight: 700;
            }
        </style>
    </head>
    <body>
        
        <div class='head'>
            <div>
                <img class='logo' src="{{public_path() . '/epv_logo.png'}}">
                
                <table>
                    <tr>
                        <td>{{$date}}</td>
                        <td>Datum</td>
                    </tr>
                </table>

                @if ($student !== null)
                    <table>
                        <tr>
                            <td>{{$student}}</td>
                            <td>Referens</td>
                        </tr>
                    </table>
                @endif
            </div>

            <div>
                <h3>Kvittens</h3>
                <p><strong>Kundnr:</strong> {{$customer_ref}}</p>

                <div class='address-box'>
                    Simonsland Förvaltning AB<br>
                    Viskastrandsgatan 1<br>
                    506 30 Borås
                </div>
            </div>
        </div>

        <div class='items'>
            <table>
                <tr class='th-row'>
                    <th>Art.nr</th>
                    <th>Benämning</th>
                    <th>Antal</th>
                    <th>Enhet</th>
                    <th>Á-pris</th>
                    <th>Summa</th>
                </tr>
                <tr>
                    <td>{{$order['id']}}</td>
                    <td>{{$order['name']}}</td><!-- Biljett företag, Entreprenörsdagen 8 nov -->
                    <td>{{$order['num']}}</td>
                    <td>st</td>
                    <td>{{$order['price']}}</td>
                    <td>{{$order['totals']}}</td>
                </tr>
            </table>
        </div>

        <div class='totals'>
            <table>
                <tr>
                    <th>Betalningsmetod</th>
                    <th>HEJ</th>
                </tr>
                <tr>
                    <th>Exkl. moms</th>
                    <th>1 000,00 kr</th>
                </tr>
                <tr>
                    <th>Moms (25 %)</th>
                    <th>250,00 kr</th>
                </tr>
                <tr>
                    <th>Totalt</th>
                    <th>1 250,00 kr</th>
                </tr>
            </table>
        </div>

        <div class='footer'>
            <div style='width: 35%'>
                <span class="title">Adress</span>
                <span>Entreprenörsprogrammets Vänner</span>
                <span>c/o Johan Hagberg</span>
                <span>Kummingången 30</span>
                <span>507 53 Borås</span>
            </div>

            <div style='width: 25%'>
                <span class="title">Telefon</span>
                <span>0766181493</span>
                <span class="title" style='margin-top: 10px'>E-post/Webbplats</span>
                <span>ekonomi@epvanner.se</span>
                <span>www.epvanner.se</span>
            </div>

            <div style='width: 20%'>
                <span class="title">Organisationsnr</span>
                <span>802419-1671</span>
                <span>Godkänd för F-skatt</span>
            </div>

            <div style='width: 20%'>
                <span class="title">Momsreg.nr</span>
                <span>SE802419167101</span>
            </div>
        </div>
        
    </body>
</html>