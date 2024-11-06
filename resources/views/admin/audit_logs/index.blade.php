@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.audit_logs') }}</h1>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>{{ __('lang.event') }}</th>
                <th>{{ __('lang.user') }}</th>
                <th>{{ __('lang.model') }}</th>
                <th>{{ __('lang.created_at') }}</th>
                <th>{{ __('lang.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
                <tr>
                    <td>{{ $audit->event }}</td>
                    <td>{{ $audit->user ? $audit->user->name : 'System' }}</td>
                    <td>{{ class_basename($audit->auditable_type) }}</td>
                    <td>{{ $audit->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.audit_logs.show', $audit->id) }}" class="btn btn-sm btn-info">{{ __('lang.view') }}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
