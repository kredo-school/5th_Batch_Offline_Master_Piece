@extends('layouts.app')

@section('title', 'Thread Home')

@section('content')
    <div class="container-fluid">
        @include('thread.header')
        <div class="row ms-3">
            <div class="col-10">
                @if ($search_threads->isNotEmpty())

                    @foreach($search_threads as $thread)
                        @include('thread.one-thread')
                    @endforeach

                @elseif($threads->isNotEmpty())

                    @foreach($threads as $thread)
                        @include('thread.one-thread')
                    @endforeach

                @endif

            </div>

            {{-- advertisement --}}
            <div class="col-2">
                @for ($i = 0; $i < 6; $i++)
                    <img src="{{ asset('images/93e1a9cf543ecd9d8bdaf98c51dc65a5.jpg') }}" alt=""
                        class="thread-adv w-100 mb-3">
                @endfor
            </div>
        </div>
    </div>
@endsection
