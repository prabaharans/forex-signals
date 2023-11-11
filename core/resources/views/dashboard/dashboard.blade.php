@extends('layouts.dashboard')

@section('content')


        <div class="col-md-12">

            <div class="col-md-3">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-list"></i>
                    </div>
                    <div class="details">
                        <div class="number">{{ $total_user }}</div>
                        <div class="desc">Total User</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="dashboard-stat yellow">
                    <div class="visual">
                        <i class="fa fa-folder"></i>
                    </div>
                    <div class="details">
                        <div class="number">{{ $total_plan }}</div>
                        <div class="desc">Total Plan</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-list"></i>
                    </div>
                    <div class="details">
                        <div class="number">{{ $total_article }}</div>
                        <div class="desc">Total Article</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-stat green">
                    <div class="visual">
                        <i class="fa fa-list"></i>
                    </div>
                    <div class="details">
                        <div class="number">{{ $total_signal }}</div>
                        <div class="desc">Total Signal</div>
                    </div>
                </div>
            </div>
        </div>


@endsection