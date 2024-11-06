@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.edit_profile') }}</h1>

    <form action="{{ route('admin.profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="bio">{{ __('lang.bio') }}</label>
            <textarea name="bio" class="form-control" rows="3">{{ $profile->bio }}</textarea>
        </div>
        <div class="form-group">
            <label for="website">{{ __('lang.website') }}</label>
            <input type="url" name="website" class="form-control" value="{{ $profile->website }}">
        </div>
        <div class="form-group">
            <label for="profile_image">{{ __('lang.profile_image') }}</label>
            <input type="file" name="profile_image" class="form-control">
        </div>
        <div class="form-group">
            <label for="company">{{ __('lang.company') }}</label>
            <input type="text" name="company" class="form-control" value="{{ $profile->company }}">
        </div>
        <div class="form-group">
            <label for="job_title">{{ __('lang.job_title') }}</label>
            <input type="text" name="job_title" class="form-control" value="{{ $profile->job_title }}">
        </div>
        <button type="submit" class="btn btn-success">{{ __('lang.update') }}</button>
    </form>
@endsection
