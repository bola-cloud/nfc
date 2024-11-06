@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.create_new_link') }}</h1>

    <form action="{{ route('admin.profile_links.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="profile_id">{{ __('lang.profile') }}</label>
            <select name="profile_id" class="form-control" required>
                @foreach ($profiles as $profile)
                    <option value="{{ $profile->id }}">{{ $profile->user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type">{{ __('lang.type') }}</label>
            <input type="text" name="type" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="label">{{ __('lang.label') }}</label>
            <input type="text" name="label" class="form-control">
        </div>
        <div class="form-group">
            <label for="url">{{ __('lang.url') }}</label>
            <input type="url" name="url" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
    </form>
@endsection
