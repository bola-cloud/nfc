@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.create_new_user') }}</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('lang.name') }}</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">{{ __('lang.email') }}</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">{{ __('lang.phone') }}</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category">{{ __('lang.category') }}</label>
            <select name="category" class="form-control" required>
                <option value="admin">{{ __('lang.admin') }}</option>
                <option value="user">{{ __('lang.user') }}</option>
                <option value="technical">{{ __('lang.technical') }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="subscription_plan_id">{{ __('lang.subscription_plan') }}</label>
            <select name="subscription_plan_id" class="form-control">
                <option value="">{{ __('lang.no_plan') }}</option>
                @foreach ($plans as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="password">{{ __('lang.password') }}</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{ __('lang.password_confirmation') }}</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
    </form>
@endsection
