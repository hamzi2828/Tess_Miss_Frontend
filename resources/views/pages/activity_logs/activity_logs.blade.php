@extends('master.master')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y" style="min-height: 100vh;">
    <div class="card shadow-lg mb-5">

        <div class="card-header bg-primary text-white text-center" >
            <h1 style="color: white; font-weight: bold;">Activity Logs</h1>
        </div>
        
        <div class="card-body mt-5">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">URL</th>
                            <th scope="col">Method</th>
                            <th scope="col">IP Address</th>
                            <th scope="col">User Agent</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                        <tr>
                            <td>{{ $log->user->name }}</td>
                            <td>{{ $log->url }}</td>
                            <td><span class="badge bg-info">{{ $log->method }}</span></td>
                            <td>{{ $log->ip_address }}</td>
                            <td>
                                <button class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $log->user_agent }}">
                                    View
                                </button>
                            </td>
                            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $logs->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@endsection
