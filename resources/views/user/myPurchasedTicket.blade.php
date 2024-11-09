@extends('layouts.landing_app')

@section('content')

@foreach($purchasedTickets as $purchasedTicket)
    <div class="ticket-padding">
        <div class="ticket created-by-anniedotexe ">
            @if($purchasedTicket->ticketTypes && $purchasedTicket->ticketTypes->event)
            <div class="left">
                    <div class="image" style="background-image: url('{{ asset('/images/eventPoster/' . $purchasedTicket->ticketTypes->event->poster) }}'); height: 250px; width: 250px; background-size: cover; background-position: center;">
                        <p class="admit-one">
                            <span>{{ $purchasedTicket->ticketTypes->ticket_type }}</span>
                            <span>{{ $purchasedTicket->ticketTypes->ticket_type }}</span>
                            <span>{{ $purchasedTicket->ticketTypes->ticket_type }}</span>
                        </p>
                        <div class="ticket-number">
                            <p>#{{ $purchasedTicket->id }}</p>
                        </div>
                    </div>
                    <div class="ticket-info">
                        <p class="date text-xs">
                            <span>{{ \Carbon\Carbon::parse($purchasedTicket->ticketTypes->event->date)->format('l') }}</span>
                            <span class="june-29">{{ \Carbon\Carbon::parse($purchasedTicket->ticketTypes->event->date)->format('F jS') }}</span>
                            <span>{{ \Carbon\Carbon::parse($purchasedTicket->ticketTypes->event->date)->format('Y') }}</span>
                        </p>
                        <div class="show-name">
                            <h1>{{ $purchasedTicket->ticketTypes->event->event_name }}</h1>
                            <h2>{{ $purchasedTicket->name }}</h2>
                        </div>
                        <div class="time">
                            <p>{{ $purchasedTicket->quantity }} Ticket</p>
                            <p>Rs. {{ $purchasedTicket->total }}</p>
                        </div>
                        <p class="location">
                            <span>{{ $purchasedTicket->ticketTypes->event->venue }}</span>
                            <span class="separator"><i class="far fa-smile"></i></span>
                            <span>{{ $purchasedTicket->ticketTypes->event->location }}</span>
                        </p>
                    </div>

            </div>

            <div class="right">

                    <p class="admit-one">
                        <span>{{ $purchasedTicket->ticketTypes->ticket_type }}</span>
                        <span>{{ $purchasedTicket->ticketTypes->ticket_type }}</span>
                        <span>{{ $purchasedTicket->ticketTypes->ticket_type }}</span>
                    </p>
                    <div class="right-info-container">
                        <div class="show-name">
                            <h1>{{ $purchasedTicket->ticketTypes->event->event_name }}</h1>
                        </div>
                        <div class="time">
                            <p>DOORS <span>@</span> {{ \Carbon\Carbon::parse($purchasedTicket->ticketTypes->event->time)->format('g:i A') }}</p>
                        </div>
                        <div class="barcode">
                            <img src="https://external-preview.redd.it/cg8k976AV52mDvDb5jDVJABPrSZ3tpi1aXhPjgcDTbw.png?auto=webp&s=1c205ba303c1fa0370b813ea83b9e1bddb7215eb" alt="QR code">
                        </div>
                        <p class="ticket-number">#{{ $purchasedTicket->id }}</p>
                    </div>

            </div>
            {{-- @else
            <p class="text-red-500">Event details are unavailable.</p> --}}
        @endif
        </div>
    </div>
@endforeach

@endsection
