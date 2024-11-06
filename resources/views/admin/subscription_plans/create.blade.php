@extends('layouts.admin')

@section('content')
    <h1>{{ __('lang.create_new_plan') }}</h1>

    <form action="{{ route('admin.subscription_plans.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('lang.name') }}</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="price">{{ __('lang.price') }}</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="link_limit">{{ __('lang.link_limit') }}</label>
            <input type="number" name="link_limit" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
    </form>
@endsection
