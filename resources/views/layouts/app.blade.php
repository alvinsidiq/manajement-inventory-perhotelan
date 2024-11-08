<!DOCTYPE html>
<html lang="en">


<!--begin::Body-->
@include('layouts.partials.head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->

        <!-- Header -->
        @include('layouts.partials.header')

        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div aria-live="polite" aria-atomic="true" class="position-relative">
                        <div class="toast-container position-fixed" style="top: 50px; right: 10px; z-index: 11;">

                            <!-- Toast Notification -->
                            <div id="toastNotification" class="toast align-items-center text-white border-0"
                                role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                                <div class="d-flex">
                                    <div id="toastBody" class="toast-body">
                                        {{ session('toast_message') }}
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        @yield('content')
                    </div>


                </div>
            </div>

        </main> <!--end::App Main--> <!--begin::Footer-->
        <!-- Footer -->
        @include('layouts.partials.footer')

        @include('layouts.partials.script-footer')
</body><!--end::Body-->

</html>
