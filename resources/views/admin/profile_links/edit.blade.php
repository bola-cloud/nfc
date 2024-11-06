@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.edit_link') }}</h1>

    <form action="{{ route('admin.profile_links.update', $profileLink->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="profile_id">{{ __('lang.profile') }}</label>
            <select name="profile_id" class="form-control" required>
                @foreach ($profiles as $profile)
                    <option value="{{ $profile->id }}" {{ $profileLink->profile_id == $profile->id ? 'selected' : '' }}>
                        {{ $profile->user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="type">{{ __('lang.type') }}</label>
            <input type="text" name="type" class="form-control" value="{{ $profileLink->type }}" required>
        </div>
        <div class="form-group">
            <label for="label">{{ __('lang.label') }}</label>
            <input type="text" name="label" class="form-control" value="{{ $profileLink->label }}">
        </div>
        <div class="form-group">
            <label for="url">{{ __('lang.url') }}</label>
            <input type="url" name="url" class="form-control" value="{{ $profileLink->url }}" required>
        </div>
        <button type="submit" class="btn btn-success">{{ __('lang.update') }}</button>
    </form>
@endsection
