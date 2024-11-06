@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.users') }}</h1>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">{{ __('lang.create_new_user') }}</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>{{ __('lang.name') }}</th>
                <th>{{ __('lang.email') }}</th>
                <th>{{ __('lang.phone') }}</th>
                <th>{{ __('lang.category') }}</th>
                <th>{{ __('lang.subscription_plan') }}</th>
                <th>{{ __('lang.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->category }}</td>
                    <td>{{ $user->subscriptionPlan ? $user->subscriptionPlan->name : __('lang.no_plan') }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">{{ __('lang.edit') }}</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
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
