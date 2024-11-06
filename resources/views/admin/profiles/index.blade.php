@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.profiles') }}</h1>

    <a href="{{ route('admin.profiles.create') }}" class="btn btn-primary">{{ __('lang.create_new_profile') }}</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>{{ __('lang.user') }}</th>
                <th>{{ __('lang.company') }}</th>
                <th>{{ __('lang.job_title') }}</th>
                <th>{{ __('lang.website') }}</th>
                <th>{{ __('lang.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as $profile)
                <tr>
                    <td>{{ $profile->user->name }}</td>
                    <td>{{ $profile->company }}</td>
                    <td>{{ $profile->job_title }}</td>
                    <td>{{ $profile->website }}</td>
                    <td>
                        <a href="{{ route('admin.profiles.edit', $profile->id) }}" class="btn btn-sm btn-warning">{{ __('lang.edit') }}</a>
                        <form action="{{ route('admin.profiles.destroy', $profile->id) }}" method="POST" style="display: inline-block;">
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
