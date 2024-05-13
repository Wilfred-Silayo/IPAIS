<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-secondary shadow-lg" style="min-height:89vh;">
            <div class="d-flex flex-column pt-2 text-white">
                <ul class="nav nav-sidebar flex-column" id="menu">
                    <x-nav-link-component route="dashboard" text="Dashboard" icon="fa-solid fa-sharp fa-gauge " />
                    <x-nav-link-component route="reporter.report.lost.items" text="Report Lost Items"
                        icon="fa-solid fa-sharp fa-add " />
                    <x-nav-link-component route="reporter.report.crime" text="Report Crimes"
                        icon="fa-solid fa-sharp fa-exclamation-triangle " />
                    <x-nav-link-component route="reporter.view.most.wanted" text="View Most Wanted"
                        icon="fa-solid fa-sharp fa-binoculars " />
                    <x-nav-link-component route="reporter.view.lost.items" text="View Lost Items"
                        icon="fa-solid fa-sharp fa-tag " />
                    <x-nav-link-component route="reporter.view.found.items" text="View Found Items"
                        icon="fa-solid fa-sharp fa-list " />
                    <x-nav-link-component route="profile.settings" text="Profile"
                        icon="fa-solid fa-sharp fa-user-cog " />
                    <x-nav-link-component route="reporter.notifications" text="Notifications"
                        icon="fa-solid fa-sharp fa-bell" />
                </ul>
            </div>
        </div>
        <div class="col-md-9 col-xl-10 mt-2">
            @yield('content')
        </div>
    </div>
</div>