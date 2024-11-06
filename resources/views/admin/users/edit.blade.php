@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.edit_user') }}</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">{{ __('lang.name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">{{ __('lang.email') }}</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="phone">{{ __('lang.phone') }}</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
        </div>
        <div class="form-group">
            <label for="category">{{ __('lang.category') }}</label>
            <select name="category" class="form-control" required>
                <option value="admin" {{ $user->category == 'admin' ? 'selected' : '' }}>{{ __('lang.admin') }}</option>
                <option value="user" {{ $user->category == 'user' ? 'selected' : '' }}>{{ __('lang.user') }}</option>
                <option value="technical" {{ $user->category == 'technical' ? 'selected' : '' }}>{{ __('lang.technical') }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="subscription_plan_id">{{ __('lang.subscription_plan') }}</label>
            <select name="subscription_plan_id" class="form-control">
                <option value="">{{ __('lang.no_plan') }}</option>
                @foreach ($plans as $plan)
                    <option value="{{ $plan->id }}" {{ $user->subscription_plan_id == $plan->id ? 'selected' : '' }}>
                        {{ $plan->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="password">{{ __('lang.password') }}</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{ __('lang.password_confirmation') }}</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">{{ __('lang.update') }}</button>
    </form>
@endsection
