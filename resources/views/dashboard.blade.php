@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Header Section -->
<div class="container-fluid py-4 bg-light mb-4">
    <div class="row">
        <div class="col-12">
            <h1 class="display-5 fw-bold text-primary mb-2">
                <span class="animated-text">H</span>
                <span class="animated-text">o</span>
                <span class="animated-text">t</span>
                <span class="animated-text">e</span>
                <span class="animated-text">l</span>
                <span class="animated-text"> </span>
                <span class="animated-text">D</span>
                <span class="animated-text">a</span>
                <span class="animated-text">s</span>
                <span class="animated-text">h</span>
                <span class="animated-text">b</span>
                <span class="animated-text">o</span>
                <span class="animated-text">a</span>
                <span class="animated-text">r</span>
                <span class="animated-text">d</span>
            </h1>
            <p class="lead text-muted">Welcome back! Here's your hotel overview</p>
        </div>
    </div>
</div>



<!-- Main Content -->
<div class="container-fluid background-image">
    <!-- Main Stats -->
    <div class="row g-4 mb-5">
        <!-- Room Types -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-lg rounded overflow-hidden">
                <div class="card-body position-relative bg-gradient-primary">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-white-50 mb-2">Room Types</h6>
                            <h2 class="text-white mb-2">{{ $totalRoomTypes }}</h2>
                            <div class="d-flex align-items-center text-white-50">
                                <i class="bi bi-arrow-up-right me-1"></i>
                                <small>12% vs last month</small>
                            </div>
                        </div>
                        <div class="p-3 bg-white bg-opacity-25 rounded-circle">
                            <i class="bi bi-house-door-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 h-1 bg-primary"></div>
                </div>
                <a href="{{ route('room_types.index') }}" class="stretched-link"></a>
            </div>
        </div>

        <!-- Total Rooms -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-lg rounded overflow-hidden">
                <div class="card-body position-relative bg-gradient-success">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-white-50 mb-2">Total Rooms</h6>
                            <h2 class="text-white mb-2">{{ $totalRooms }}</h2>
                            <div class="d-flex align-items-center text-white-50">
                                <i class="bi bi-arrow-down-right me-1"></i>
                                <small>5% vs last month</small>
                            </div>
                        </div>
                        <div class="p-3 bg-white bg-opacity-25 rounded-circle">
                            <i class="bi bi-door-open-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 h-1 bg-success"></div>
                </div>
                <a href="{{ route('rooms.index') }}" class="stretched-link"></a>
            </div>
        </div>

        <!-- Reservations -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-lg rounded overflow-hidden">
                <div class="card-body position-relative bg-gradient-warning">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-white-50 mb-2">Reservations</h6>
                            <h2 class="text-white mb-2">{{ $totalReservations }}</h2>
                            <div class="d-flex align-items-center text-white-50">
                                <i class="bi bi-arrow-up-right me-1"></i>
                                <small>8% vs last month</small>
                            </div>
                        </div>
                        <div class="p-3 bg-white bg-opacity-25 rounded-circle">
                            <i class="bi bi-calendar-check-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 h-1 bg-warning"></div>
                </div>
                <a href="{{ route('reservations.index') }}" class="stretched-link"></a>
            </div>
        </div>

        <!-- Total Guests -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-lg rounded overflow-hidden">
                <div class="card-body position-relative bg-gradient-danger">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-white-50 mb-2">Total Guests</h6>
                            <h2 class="text-white mb-2">{{ $totalGuests }}</h2>
                            <div class="d-flex align-items-center text-white-50">
                                <i class="bi bi-arrow-up-right me-1"></i>
                                <small>15% vs last month</small>
                            </div>
                        </div>
                        <div class="p-3 bg-white bg-opacity-25 rounded-circle">
                            <i class="bi bi-person-fill text-white fs-4"></i>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 h-1 bg-danger"></div>
                </div>
                <a href="{{ route('guests.index') }}" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- Amenities Sections -->
    <div class="row mb-5">
        <!-- Consumable Amenities -->
        <div class="col-12 col-lg-6 mb-4">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="card-title text-primary mb-0">
                        <i class="bi bi-box-seam me-2"></i>Consumable Amenities
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Categories -->
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-3 text-center hover-shadow transition">
                                <i class="bi bi-tags-fill text-primary fs-3 mb-3"></i>
                                <h5 class="fw-bold mb-2">Categories</h5>
                                <h3 class="mb-0">{{ $totalCategories }}</h3>
                                <a href="{{ route('consumable_categories.index') }}" class="stretched-link"></a>
                            </div>
                        </div>

                        <!-- Items -->
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-3 text-center hover-shadow transition">
                                <i class="bi bi-box-fill text-success fs-3 mb-3"></i>
                                <h5 class="fw-bold mb-2">Items</h5>
                                <h3 class="mb-0">{{ $totalItems }}</h3>
                                <a href="{{ route('consumables.index') }}" class="stretched-link"></a>
                            </div>
                        </div>

                        <!-- Allocations -->
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-3 text-center hover-shadow transition">
                                <i class="bi bi-person-fill text-warning fs-3 mb-3"></i>
                                <h5 class="fw-bold mb-2">Allocations</h5>
                                <h3 class="mb-0">{{ $totalAllocations }}</h3>
                                <a href="{{ route('consumable_allocations.index') }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unconsumable Amenities -->
        <div class="col-12 col-lg-6 mb-4">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-white border-0 py-3">
                    <h4 class="card-title text-danger mb-0">
                        <i class="bi bi-tools me-2"></i>Unconsumable Amenities
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Categories -->
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-3 text-center hover-shadow transition">
                                <i class="bi bi-tags-fill text-primary fs-3 mb-3"></i>
                                <h5 class="fw-bold mb-2">Categories</h5>
                                <h3 class="mb-0">{{ $totalUncategories }}</h3>
                                <a href="{{ route('unconsumable_categories.index') }}" class="stretched-link"></a>
                            </div>
                        </div>

                        <!-- Items -->
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-3 text-center hover-shadow transition">
                                <i class="bi bi-box-fill text-success fs-3 mb-3"></i>
                                <h5 class="fw-bold mb-2">Items</h5>
                                <h3 class="mb-0">{{ $totalUnitems }}</h3>
                                <a href="{{ route('unconsumables.index') }}" class="stretched-link"></a>
                            </div>
                        </div>

                        <!-- Allocations -->
                        <div class="col-md-4">
                            <div class="p-4 bg-light rounded-3 text-center hover-shadow transition">
                                <i class="bi bi-person-fill text-warning fs-3 mb-3"></i>
                                <h5 class="fw-bold mb-2">Allocations</h5>
                                <h3 class="mb-0">{{ $totalUnallocations }}</h3>
                                <a href="{{ route('unconsumable_allocations.index') }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Section -->
    <div class="row g-4 mb-5">
        <div class="col-12">
            <h4 class="mb-4 text-warning">
                <i class="bi bi-flag-fill me-2"></i>Reports
            </h4>
        </div>
        <!-- Damaged Items -->
        <div class="col-12 col-md-6">
            <div class="card border-start border-5 border-danger shadow-lg rounded-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-danger mb-2">Damaged Items</h6>
                            <h2 class="mb-0 display-6">{{ $totalRusak }}</h2>
                        </div>
                        <div class="p-3 bg-danger bg-opacity-10 rounded-circle">
                            <i class="bi bi-exclamation-circle text-danger fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lost Items -->
        <div class="col-12 col-md-6">
            <div class="card border-start border-5 border-warning shadow-lg rounded-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-warning mb-2">Lost Items</h6>
                            <h2 class="mb-0 display-6">{{ $totalHilang }}</h2>
                        </div>
                        <div class="p-3 bg-warning bg-opacity-10 rounded-circle">
                            <i class="bi bi-exclamation-triangle text-warning fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}

.bg-gradient-success {
    background: linear-gradient(45deg, #1cc88a, #13855c);
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #f6c23e, #dda20a);
}

.bg-gradient-danger {
    background: linear-gradient(45deg, #e74a3b, #be2617);
}

.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.transition {
    transition: all 0.3s ease;
}
.background-image {
    background-image: url('');
    background-size:content;/* Menjaga ukuran asli gambar */
    background-position: center; /* Menempatkan gambar di tengah */
    background-repeat: no-repeat; /* Tidak mengulang gambar */
    
    width: 100%; /* Lebar elemen 100% */
}
.walking-gif {
    animation: moveUp 5s infinite;
}

.animated-text {
    opacity: 0;
    animation: fadeIn 0.5s forwards;
}

.animated-text:nth-child(1) {
    animation-delay: 0.1s;
}
.animated-text:nth-child(2) {
    animation-delay: 0.2s;
}
.animated-text:nth-child(3) {
    animation-delay: 0.3s;
}
.animated-text:nth-child(4) {
    animation-delay: 0.4s;
}
.animated-text:nth-child(5) {
    animation-delay: 0.5s;
}
.animated-text:nth-child(6) {
    animation-delay: 0.6s;
}
.animated-text:nth-child(7) {
    animation-delay: 0.7s;
}
.animated-text:nth-child(8) {
    animation-delay: 0.8s;
}
.animated-text:nth-child(9) {
    animation-delay: 0.9s;
}
.animated-text:nth-child(10) {
    animation-delay: 1s;
}
.animated-text:nth-child(11) {
    animation-delay: 1.1s;
}
.animated-text:nth-child(12) {
    animation-delay: 1.2s;
}
.animated-text:nth-child(13) {
    animation-delay: 1.3s;
}
.animated-text:nth-child(14) {
    animation-delay: 1.4s;
}
.animated-text:nth-child(15) {
    animation-delay: 1.5s;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}


</style>
@endsection