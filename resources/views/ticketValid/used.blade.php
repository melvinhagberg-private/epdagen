@extends('ticketValid.master')

@section('style')

    body {
        background: #ECDE00;
        margin: 0;
        padding: 0;
    }
    
    .wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        height: calc(100vh - 88px);
    }
    
    img {
        fill: #fff;
        width: 110px;
        height: 110px;
    }
    
    .inner {
        text-align: center;
    }
    
    h3 {
        text-transform: uppercase;
    }
    
    .valid {
        font-size: 28px;
        letter-spacing: 2px;
    }
    
    .checkedin {
        font-size: 18px;
        font-weight: 300;
        letter-spacing: 1px;
        color: #F0F5F6;
    }
    
    .infoSection {
        background: #A99F00;
        width: calc(100vw - 40px);
        padding: 20px 20px;
        position: absolute;
        bottom: 0;
        left: 0;
    }
    
    .infoSection span {
        display: block;
    }
    
    .name {
        font-size: 20px;
        font-weight: 400;
        letter-spacing: 0.3px;
        margin-bottom: 5px;
    }
    
    .email {
        font-size: 16px;
        font-weight: 300;
        letter-spacing: 0.3px;
    }
    
    .regret {
        display: inline-block;
        padding: 10px 50px;
        background: #A99E01;
        cursor: pointer;
        color: #FFF;
        text-decoration: none;
    }

@endsection

@section('content')

    <div class='wrapper'>
        <div class='inner'>
            <h3 class='valid'>Redan registrerad</h3>
            <a href='{{url('/validera/regret/' . $ticket_id)}}' class='regret'>Återställ</a>
        </div>
        
        <div class='infoSection'>
            <span class='name'>{{$name}}</span>
            <span class='email'>{{$email}}</span>
        </div>
    </div>

@endsection