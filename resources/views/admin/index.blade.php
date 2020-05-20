@extends ('admin.app')

@section('title', 'Dashboard')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4><a href="{{ route('admin.dashboard.users') }}">Users</a></h4>
                    <p><b>{{ $users }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="widget-small warning coloured-icon">
                <i class="icon fas fa-file-alt fa-3x"></i>
                <div class="info">
                    <h4>Uploades</h4>
                    <p><b>{{ $images }}</b></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="widget-small warning coloured-icon">
                <i class="icon fas fa-store fa-3x"></i>
                <div class="info">
                    <h4><a href="admin/products">Products</a></h4>
                    <p><b>{{ $products }}</b></p>
                </div>
            </div>
        </div>
    </div>
@endsection
