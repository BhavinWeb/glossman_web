@extends('admin.layouts.app')
@section('title')
    {{ __('faq_list') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title line-height-36">{{ __('faq_list') }}</h3>
           
            @if (userCan('faq.create'))
                <a href="{{ route('module.faq.create') }}"
                    class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                        class="fas fa-plus pr-2"></i>
                    {{ __('create') }}</a>
            @endif
        </div>
      
    <div class="accordion" id="accordionExample">
        @forelse($faqs as $faq)
            <div class="card mb-0">
                <div class="card-header" id="heading{{ $faq->id }}">
                    <h4 class="card-title pt-2">
                        <button class="btn btn-link btn-block text-left" data-toggle="collapse"
                            data-target="#collapse{{ $faq->id }}" aria-expanded="true"
                            aria-controls="collapse{{ $faq->id }}">
                            {{ $loop->iteration }}. {{ $faq->question }}
                        </button>
                    </h4>
                    @if (userCan('faq.delete'))
                        <form action="{{ route('module.faq.destroy', $faq->id) }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button data-toggle="tooltip" data-placement="top" title="{{ __('delete_subcategory') }}"
                                onclick="return confirm('Are you sure you want to delete this item?');"
                                class="btn bg-danger m-2 float-right d-flex align-items-center justify-content-center"><i
                                    class="fas fa-trash"></i></button>
                        </form>
                    @endif
                    @if (userCan('faq.update'))
                        <a href="{{ route('module.faq.edit', $faq->id) }}"
                            class="btn bg-info m-2 float-right d-flex align-items-center justify-content-center"> <i
                                class="fas fa-edit"></i> </a>
                    @endif
                </div>
                <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        {!! $faq->answer !!}
                    </div>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body text-center">
                    <p class="text-center">
                        <x-admin.not-found word="faq" />
                    </p>
                </div>
            </div>
        @endforelse
    </div>
@endsection 
