@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row"> <!--begin::Col-->
                <div class="col-sm-12 text-end">
                    <h3 class="mb-0">Rooms</h3>
                </div>
            </div>
            <div class="row my-4">
                <!-- Total Room Types -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <a href="{{ route('room_types.index') }}" class="info-box-icon text-bg-info shadow-sm">
                            <i class="bi bi-house-fill"></i>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Room Types</span>
                            <span class="info-box-number">{{ $totalRoomTypes }}</span>
                        </div>
                    </div>
                </div>

                <!-- Total Rooms -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <a href="{{ route('rooms.index') }}" class="info-box-icon text-bg-success shadow-sm">
                            <i class="bi bi-door-open-fill"></i>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Rooms</span>
                            <span class="info-box-number">{{ $totalRooms }}</span>
                        </div>
                    </div>
                </div>

                <!-- Total Reservations -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <a href="{{ route('reservations.index') }}" class="info-box-icon text-bg-warning shadow-sm">
                            <i class="bi bi-calendar-check-fill"></i>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Reservations</span>
                            <span class="info-box-number">{{ $totalReservations }}</span>
                        </div>
                    </div>
                </div>

                <!-- Total Guests -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <a href="{{ route('guests.index') }}" class="info-box-icon text-bg-danger shadow-sm">
                            <i class="bi bi-person-fill"></i>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Guests</span>
                            <span class="info-box-number">{{ $totalGuests }}</span>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!--end::Row--> <!--begin::Row-->

    </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
