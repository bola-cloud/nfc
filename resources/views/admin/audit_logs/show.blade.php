@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.audit_log_details') }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ __('lang.event') }}: {{ $audit->event }}</h5>
            <p>{{ __('lang.user') }}: {{ $audit->user ? $audit->user->name : 'System' }}</p>
            <p>{{ __('lang.model') }}: {{ class_basename($audit->auditable_type) }}</p>
            <p>{{ __('lang.created_at') }}: {{ $audit->created_at }}</p>

            <h6>{{ __('lang.changes') }}:</h6>
            <ul>
                @foreach ($audit->getModified() as $key => $value)
                    <li>{{ $key }}: {{ json_encode($value) }}</li>
                @endforeach
            </ul>

            <a href="{{ route('admin.audit_logs.index') }}" class="btn btn-primary">{{ __('lang.back') }}</a>
        </div>
    </div>
@endsection
