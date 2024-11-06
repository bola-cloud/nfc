@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.analytics_details') }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ __('lang.tag_id') }}: {{ $analytics->nfcTag->tag_id }}</h5>
            <p>{{ __('lang.user') }}: {{ $analytics->nfcTag->user->name }}</p>
            <p>{{ __('lang.ip_address') }}: {{ $analytics->ip_address }}</p>
            <p>{{ __('lang.location') }}: {{ $analytics->location }}</p>
            <p>{{ __('lang.scanned_at') }}: {{ $analytics->scanned_at }}</p>
            <a href="{{ route('admin.analytics.index') }}" class="btn btn-primary">{{ __('lang.back') }}</a>
        </div>
    </div>
@endsection
