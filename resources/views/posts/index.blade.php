@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Posts</div>

                <div class="card-body">
                    <div class="panel-body table-responsive">
                        <router-view name="postsIndex"></router-view>
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
