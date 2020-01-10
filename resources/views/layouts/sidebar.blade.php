<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
        </button>
        </span>
    </div>

<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Dashboards</li>
            <li>
                <a href="{{ url('dashboard') }}" class="mm-active">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Dashboard
                </a>
            </li>
            <li class="app-sidebar__heading">Master</li>
            <li>
                    <a href="{{ url('customer') }}" >
                        <i class="metismenu-icon fa fa-user"  ></i>
                        Customer
                    </a>
                </li>
                <li>
                        <a href="{{ url('agent') }}" >
                            <i class="metismenu-icon fa fa-user-circle-o" ></i>
                            Agent
                        </a>
                    </li>


            <li>
                <a href="{{ url('sitemaster') }}">
                    <i class="metismenu-icon pe-7s-display2"  ></i>
                    Site Master
                </a>
            </li>
            <li>
                    <a href="{{ url('ploatallocation') }}">
                        <i class="metismenu-icon fa fa-area-chart "></i>
                        Plot Allocation
                    </a>
                </li>
                <li>
                        <a href="{{ url('agentcommission') }}">
                            <i class="metismenu-icon  fa fa-dollar" ></i>
                            Agent Commission
                        </a>
                    </li>
                    <li>
                            <a href="{{ url('employ') }}">
                                <i class="metismenu-icon  fa fa-user-circle" ></i>
                                Employee
                            </a>
                        </li>
                        <li>
                                <a href="{{ url('rolemanagement') }}">
                                    <i class="metismenu-icon fa fa-id-card" ></i>
                                    Rights Management
                                </a>
                            </li>
            {{-- <li class="app-sidebar__heading">Widgets</li>
            <li>
                <a href="dashboard-boxes.html">
                    <i class="metismenu-icon pe-7s-display2"></i>
                    Dashboard Boxes
                </a>
            </li>
            <li class="app-sidebar__heading">Forms</li>
            <li>
                <a href="forms-controls.html">
                    <i class="metismenu-icon pe-7s-mouse">
                    </i>Forms Controls
                </a>
            </li>
            <li>
                <a href="forms-layouts.html">
                    <i class="metismenu-icon pe-7s-eyedropper">
                    </i>Forms Layouts
                </a>
            </li>
            <li>
                <a href="forms-validation.html">
                    <i class="metismenu-icon pe-7s-pendrive">
                    </i>Forms Validation
                </a>
            </li>
            <li class="app-sidebar__heading">Charts</li>
            <li>
                <a href="charts-chartjs.html">
                    <i class="metismenu-icon pe-7s-graph2">
                    </i>ChartJS
                </a>
            </li>
            <li class="app-sidebar__heading">PRO Version</li>
            <li>
                <a href="https://dashboardpack.com/theme-details/architectui-dashboard-html-pro/"
                    target="_blank">
                    <i class="metismenu-icon pe-7s-graph2">
                    </i>
                    Upgrade to PRO
                </a>
            </li> --}}
        </ul>
    </div>
</div>
</div><!-- End of Side bar -->
