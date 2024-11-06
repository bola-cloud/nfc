@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.profile_links') }}</h1>

    <a href="{{ route('admin.profile_links.create') }}" class="btn btn-primary">{{ __('lang.create_new_link') }}</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>{{ __('lang.profile') }}</th>
                <th>{{ __('lang.user') }}</th>
                <th>{{ __('lang.type') }}</th>
                <th>{{ __('lang.label') }}</th>
                <th>{{ __('lang.url') }}</th>
                <th>{{ __('lang.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($links as $link)
                <tr>
                    <td>{{ $link->profile->user->name }}</td>
                    <td>{{ $link->type }}</td>
                    <td>{{ $link->label ?? '-' }}</td>
                    <td>{{ $link->url }}</td>
                    <td>
                        <a href="{{ route('admin.profile_links.edit', $link->id) }}" class="btn btn-sm btn-warning">{{ __('lang.edit') }}</a>
                        <form action="{{ route('admin.profile_links.destroy', $link->id) }}" method="POST" style="display: inline-block;">
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
