@component('mail::message')
# Bra jobbat,

Du sålde precis {{$num}} biljetter till EP-dagen {{date('Y')}}.

Namn: {{$name}}<br>
E-post: {{$email}}<br>
Telefon: {{$phone}}<br>

Totalt: {{$total}} kr

@endcomponent