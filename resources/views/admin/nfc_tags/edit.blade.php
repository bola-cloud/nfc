@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.edit_tag') }}</h1>

    <form action="{{ route('admin.nfc_tags.update', $nfcTag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tag_id">{{ __('lang.tag_id') }}</label>
            <div class="input-group">
                <input type="text" name="tag_id" id="tag_id" class="form-control" value="{{ $nfcTag->tag_id }}" required>
                <button type="button" class="btn btn-secondary" id="generate_tag">{{ __('lang.generate') }}</button>
            </div>
        </div>
        <div class="form-group">
            <label for="user_id">{{ __('lang.user') }}</label>
            <select name="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $nfcTag->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">{{ __('lang.update') }}</button>
    </form>

    <script>
        document.getElementById('generate_tag').addEventListener('click', function() {
            generateUniqueTagId();
        });

        function generateUniqueTagId() {
            const tagLength = 12;
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let tagId = '';

            // Generate a random tag ID
            for (let i = 0; i < tagLength; i++) {
                tagId += chars.charAt(Math.floor(Math.random() * chars.length));
            }

            // Check if the generated tag ID is unique
            checkTagIdUnique(tagId);
        }

        function checkTagIdUnique(tagId) {
            const url = '{{ route("admin.nfc_tags.check", ":tag_id") }}'.replace(':tag_id', tagId);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.unique) {
                        // If tag_id is unique, assign it to the input field
                        document.getElementById('tag_id').value = tagId;
                    } else {
                        // If not unique, generate a new one
                        generateUniqueTagId();
                    }
                })
                .catch(error => {
                    console.error('Error checking tag uniqueness:', error);
                });
        }
    </script>
@endsection
