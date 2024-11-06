@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.nfc_tags') }}</h1>

    <a href="{{ route('admin.nfc_tags.create') }}" class="btn btn-primary">{{ __('lang.create_new_tag') }}</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>{{ __('lang.tag_id') }}</th>
                <th>{{ __('lang.user') }}</th>
                <th>{{ __('lang.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->tag_id }}</td>
                    <td>{{ $tag->user->name }}</td>
                    <td>
                        <a href="{{ route('admin.nfc_tags.edit', $tag->id) }}" class="btn btn-sm btn-warning">{{ __('lang.edit') }}</a>
                        <form action="{{ route('admin.nfc_tags.destroy', $tag->id) }}" method="POST" style="display: inline-block;">
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
