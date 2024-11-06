@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.analytics') }}</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>{{ __('lang.tag_id') }}</th>
                <th>{{ __('lang.user') }}</th>
                <th>{{ __('lang.ip_address') }}</th>
                <th>{{ __('lang.location') }}</th>
                <th>{{ __('lang.scanned_at') }}</th>
                <th>{{ __('lang.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($analytics as $log)
                <tr>
                    <td>{{ $log->nfcTag->tag_id }}</td>
                    <td>{{ $log->nfcTag->user->name }}</td>
                    <td>{{ $log->ip_address }}</td>
                    <td>{{ $log->location }}</td>
                    <td>{{ $log->scanned_at }}</td>
                    <td>
                        <a href="{{ route('admin.analytics.show', $log->id) }}" class="btn btn-sm btn-info">{{ __('lang.view') }}</a>
                        <form action="{{ route('admin.analytics.destroy', $log->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('lang.are_you_sure') }}')">{{ __('lang.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
