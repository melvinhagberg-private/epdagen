<!DOCTYPE html>
<html>
    <body style='font-family: "Roboto", sans-serif;'>

        <h4>Bra jobbat,</h4>
        <p>Du sålde precis {{$num + 1}} biljetter till EP-dagen {{date('Y')}}.

        <div style='
            display: inline-block;
            padding: 10px 20px;
            border-left: 7px solid #1E84EE;
            background: #F3F3F3;
        '>
            <ul style='
                list-style: none;
                margin: 0;
                padding: 0;
            '>
                <li style='line-height: 24px'><strong>Namn:</strong> {{$name}}</li>
                <li style='line-height: 24px'><strong>E-post:</strong> <a href='mailto:{{$email}}'>{{$email}}</a></li>
                <li style='line-height: 24px'><strong>Telefon:</strong> {{$phone}}</li>
            </ul>
        </div>

        <span style='display: block; margin-top: 10px'><strong>Totalt:</strong> {{$total}} kr</span>
        <br>

        <p style='margin-bottom: 5px'>Med vänliga hälsningar,</p>
        <img width='150' src='http://epvanner.se/wp-content/uploads/2016/07/EPV-logo-220px-pos.png'>

    </body>
</html>
