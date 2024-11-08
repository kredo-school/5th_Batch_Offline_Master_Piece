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
                @for ($i = 0; $i < max(1,count($threads)) / 1.5; $i++)
                    <a href="#" class="text-decoration-none text-white">
                        <div class="thread-adv mb-3 bg-adv w-100 ">
                            <p class="h2">Advertisement</p>
                        </div>
                    </a>
                @endfor
            </div>
        </div>
    </div>
@endsection
