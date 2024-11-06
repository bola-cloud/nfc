@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.create_new_profile') }}</h1>

    <form action="{{ route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="user_id">{{ __('lang.user') }}</label>
            <select name="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="bio">{{ __('lang.bio') }}</label>
            <textarea name="bio" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="website">{{ __('lang.website') }}</label>
            <input type="url" name="website" class="form-control">
        </div>
        <div class="form-group">
            <label for="profile_image">{{ __('lang.profile_image') }}</label>
            <input type="file" name="profile_image" class="form-control">
        </div>
        <div class="form-group">
            <label for="company">{{ __('lang.company') }}</label>
            <input type="text" name="company" class="form-control">
        </div>
        <div class="form-group">
            <label for="job_title">{{ __('lang.job_title') }}</label>
            <input type="text" name="job_title" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
    </form>
@endsection
