<style>
    * {
        font-family: 'Roboto', sans-serif;
    }

    div {
        display: inline-block;
        padding: 10px 20px;
        border-left: 7px solid #1E84EE;
        background: #F3F3F3;
    }

    div ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    div ul li {
        line-height: 24px;
    }

    span {
        display: block;
        margin-top: 10px
    }

    .mvh {
        margin-bottom: 5px;
    }
</style>

<h4>Bra jobbat,</h4>
<p>Du sålde precis {{$num + 1}} biljetter till EP-dagen {{date('Y')}}.

<div>
    <ul>
        <li><strong>Namn:</strong> {{$name}}</li>
        <li><strong>E-post:</strong> <a href='mailto:{{$email}}'>{{$email}}</a></li>
        <li><strong>Telefon:</strong> {{$phone}}</li>
    </ul>
</div>

<span><strong>Totalt:</strong> {{$total}} kr</span>
<br>
<p class='mvh'>Med vänliga hälsningar,</p>
<img width='150' src='http://epvanner.se/wp-content/uploads/2016/07/EPV-logo-220px-pos.png'>
