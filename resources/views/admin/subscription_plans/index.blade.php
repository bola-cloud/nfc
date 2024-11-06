@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="card p-3">
            <h1>{{ __('lang.subscription_plans') }}</h1>

            <a href="{{ route('admin.subscription_plans.create') }}" class="btn btn-primary">{{ __('lang.create_new_plan') }}</a>
        
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
        
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>{{ __('lang.name') }}</th>
                        <th>{{ __('lang.price') }}</th>
                        <th>{{ __('lang.link_limit') }}</th>
                        <th>{{ __('lang.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>{{ $plan->price }}</td>
                            <td>{{ $plan->link_limit }}</td>
                            <td>
                                <a href="{{ route('admin.subscription_plans.edit', $plan->id) }}" class="btn btn-sm btn-warning">{{ __('lang.edit') }}</a>
                                <form action="{{ route('admin.subscription_plans.destroy', $plan->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('lang.are_you_sure') }}')">{{ __('lang.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    
@endsection
