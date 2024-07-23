<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-secondary shadow-lg" style="min-height:89vh;">
            <div class="d-flex flex-column pt-2 text-white">
                <ul class="nav nav-sidebar flex-column" id="menu">
                    <x-nav-link-component route="dashboard" text="Dashboard" icon="fa-solid fa-sharp fa-gauge " />
                    <x-nav-link-component route="officer.reports.lost.items" text="Lost Items Reports"
                        icon="fa-solid fa-sharp fa-book " />
                    <x-nav-link-component route="officer.reports.crime" text="Coincidences Reports"
                        icon="fa-solid fa-sharp fa-exclamation-triangle " />
                    <x-nav-link-component route="officer.reports.most.wanted" text="Most Wanted Reports"
                        icon="fa-solid fa-sharp fa-binoculars " />
                    <x-nav-link-component route="manage.users" text="Manage Users" icon="fa-solid fa-sharp fa-user-plus " />
                    <x-nav-link-component route="profile.settings" text="Profile"
                        icon="fa-solid fa-sharp fa-user-cog " />
                    <x-nav-link-component route="notifications" text="Notifications"
                        icon="fa-solid fa-sharp fa-bell " />
                </ul>
            </div>
        </div>
        <div class="col-md-9 col-xl-10 mt-2 overflow-auto" style="height: 88vh;">
            @yield('content')
        </div>
    </div>
</div>