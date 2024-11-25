<!DOCTYPE html>
<html>
<head>
    <title>{{ $profile->user->name }}'s Profile</title>
</head>
<body>
    <h1>{{ $profile->user->name }}</h1>
    <p><strong>Bio:</strong> {{ $profile->bio }}</p>
    <p><strong>Website:</strong> <a href="{{ $profile->website }}">{{ $profile->website }}</a></p>
    <p><strong>Company:</strong> {{ $profile->company }}</p>
    <p><strong>Job Title:</strong> {{ $profile->job_title }}</p>
</body>
</html>
