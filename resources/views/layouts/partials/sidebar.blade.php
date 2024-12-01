<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link">
            <!--begin::Brand Image--> <img src="{{ asset('adminlte/assets/img/LOGO1.png') }}" alt="Logo"
                class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span
                class="brand-text fw-light">SI Inventory</span> <!--end::Brand Text--> </a>
        <!--end::Brand Link-->
    </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item"> <a href="{{ url('/dashboard') }}"
                        class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}"> <i
                            class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a> </li>

                <li class="nav-item {{ Request::is('room_types*') || Request::is('rooms*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('room_types*') || Request::is('rooms*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-house-door"></i>
                        <p>
                            Room Management
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('room_types.index') }}"
                                class="nav-link {{ Request::is('room_types*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-door-closed"></i>
                                <p>Room Type</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rooms.index') }}"
                                class="nav-link {{ Request::is('rooms*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-door-open"></i>
                                <p>Room</p>
                            </a>
                        </li>
                    </ul>
                </li>



                <li class="nav-item {{ Request::is('guests*') || Request::is('reservations*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Request::is('guests*') || Request::is('reservations*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-house-door"></i>
                        <p>
                            Reservation
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('guests.index') }}"
                                class="nav-link {{ Request::is('guests*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-door-closed"></i>
                                <p>Guests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reservations.index') }}"
                                class="nav-link {{ Request::is('reservations*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-door-open"></i>
                                <p>Reservations</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ Request::is('inventory_categories*') || Request::is('inventory*') || Request::is('inventory_allocations*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link
        {{ Request::is('inventory_categories*') || Request::is('inventory*') || Request::is('inventory_allocations*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box-seam"></i>
                        <p>
                            Inventory Menu
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="{{ route('inventory_categories.index') }}"
                                class="nav-link
        {{ Request::is('inventory_categories*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-folder2"></i>
                                <p>Inventory Categories</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory.index') }}"
                                class="nav-link {{ Request::is('inventory') ? 'active' : '' }}"> <i
                                    class="nav-icon bi bi-box"></i>
                                <p>Inventories</p>
                            </a> </li>
                        <li class="nav-item"> <a href="{{ route('inventory_allocations.index') }}"
                                class="nav-link {{ Request::is('inventory_allocations*') ? 'active' : '' }}"> <i
                                    class="nav-icon bi bi-arrow-left-right"></i>
                                <p>Inventory Allocations</p>
                            </a> </li>
                    </ul>
                </li>
                <hr>
                <li
                    class="nav-item {{ Request::is('consumable_categories*') || Request::is('consumables*') || Request::is('consumable_allocations*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link
    {{ Request::is('consumable_categories*') || Request::is('consumables*') || Request::is('consumable_allocations*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box-seam"></i>
                        <p>
                            Cons. Amenities
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('consumable_categories.index') }}"
                                class="nav-link
            {{ Request::is('consumable_categories*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-list-task"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('consumables.index') }}"
                                class="nav-link
            {{ Request::is('consumables*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-box"></i>
                                <p>Consumables Items</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('consumable_allocations.index') }}"
                                class="nav-link
            {{ Request::is('consumable_allocations*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-clipboard-check"></i>
                                <p>Allocations</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <hr>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                        class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-layout-text-sidebar"></i>
                        <p>Category</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('suppliers.index') }}"
                        class="nav-link {{ request()->routeIs('suppliers.index') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-truck"></i>
                        <p>Supplier</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('items.index') }}"
                        class="nav-link {{ request()->routeIs('items.index') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box"></i>
                        <p>Items</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('transactions.index') }}"
                        class="nav-link {{ request()->routeIs('transactions.index') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-box"></i>
                        <p>Transactions</p>
                    </a>
                </li>
                <li class="nav-item"> <a href="#" class="nav-link"> <i
                            class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Widgets
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> <a href="./widgets/small-box.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Small Box</p>
                            </a> </li>
                        <li class="nav-item"> <a href="./widgets/info-box.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>info Box</p>
                            </a> </li>
                        <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i
                                    class="nav-icon bi bi-circle"></i>
                                <p>Cards</p>
                            </a> </li>
                    </ul>
                </li>

                <li class="nav-header">DOCUMENTATIONS</li>
                <li class="nav-item"> <a href="./docs/introduction.html" class="nav-link"> <i
                            class="nav-icon bi bi-download"></i>
                        <p>Installation</p>
                    </a> </li>
                <li class="nav-item"> <a href="./docs/layout.html" class="nav-link"> <i
                            class="nav-icon bi bi-grip-horizontal"></i>
                        <p>Layout</p>
                    </a> </li>

            </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
</aside> <!--end::Sidebar-->
