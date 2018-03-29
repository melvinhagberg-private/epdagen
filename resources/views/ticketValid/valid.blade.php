@extends('ticketValid.master')

@section('style')

    body {
        background: #16B355;
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
    
    svg {
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
        background: #0F6A33;
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
        background: #118441;
        cursor: pointer;
        color: #FFF;
        text-decoration: none;
    }

@endsection

@section('content')

    <div class='wrapper'>
        <div class='inner'>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.25 8.891l-1.421-1.409-6.105 6.218-3.078-2.937-1.396 1.436 4.5 4.319 7.5-7.627z"/></svg>
            <h3 class='valid'>Giltig biljett</h3>
            <h3 class='checkedin'>Status uppdaterat</h3>
            <a href='{{url('/validera/regret/' . $ticket_id)}}' class='regret'>Ångra</a>
        </div>
        
        <div class='infoSection'>
            <span class='name'>{{$name}}</span>
            <span class='email'>{{$email}}</span>
        </div>
    </div>

@endsection