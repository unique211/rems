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
                @if(is_null($sidebar))

                @else


                @foreach($sidebar as $val)

                @if($val->menuid==1 && $val->submenuid==0)
            <li class="app-sidebar__heading">Dashboards</li>
            <li>
                <a href="{{ url('dashboard') }}" @if($activemenu=="dashm") class="mm-active" @endif>
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Dashboard
                </a>
            </li>
            @endif

            @if($val->menuid==2 && $val->submenuid==0)
            <li class="app-sidebar__heading">Master</li>
            @endif
            @if(($val->menuid==2  && $val->submenuid==1) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
            <li>
                    <a href="{{ url('customer') }}" @if($activemenu=="customer") class="mm-active" @endif >
                        <i class="metismenu-icon fa fa-user"  ></i>
                        Customer
                    </a>
                </li>
                @endif
                @if(($val->submenuid==2) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
                <li>
                        <a href="{{ url('agent') }}" @if($activemenu=="agenti") class="mm-active" @endif>
                            <i class="metismenu-icon fa fa-user-circle-o" ></i>
                            Agent
                        </a>
                    </li>
                    @endif
                    @if(($val->submenuid==3) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
            <li>
                <a href="{{ url('sitemaster') }}" @if($activemenu=="sitem") class="mm-active" @endif>
                    <i class="metismenu-icon pe-7s-display2"  ></i>
                    Site Master
                </a>
            </li>
            @endif
            @if(($val->submenuid==4) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
            <li>
                    <a href="{{ url('ploatallocation') }}" @if($activemenu=="ploatal") class="mm-active" @endif>
                        <i class="metismenu-icon fa fa-area-chart "></i>
                        Plot Allocation
                    </a>
                </li>
                @endif

                @if(($val->submenuid==5) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
                <li>
                        <a href="{{ url('agentcommission') }}" @if($activemenu=="agentcomm") class="mm-active" @endif>
                            <i class="metismenu-icon  fa fa-dollar" ></i>
                            Agent Commission
                        </a>
                    </li>
                    @endif
                    @if(($val->submenuid==6) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
                    <li>
                            <a href="{{ url('employee') }}"  @if($activemenu=="employd") class="mm-active" @endif>
                                <i class="metismenu-icon  fa fa-user-circle" ></i>
                                Employee
                            </a>
                        </li>
                        @endif
                        @if(($val->submenuid==7) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
                        <li>
                                <a href="{{ url('rolemanagement') }}" @if($activemenu=="rolem") class="mm-active" @endif>
                                    <i class="metismenu-icon fa fa-id-card" ></i>
                                    Rights Management
                                </a>
                            </li>
                            @endif


                            @if($val->menuid==3 && $val->submenuid==0)
                            <li class="app-sidebar__heading">Report</li>
                            @endif
                            @if(($val->submenuid==8) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
                            <li>
                                <a href="{{ url('agentreport') }}" @if($activemenu=="acreport") class="mm-active" @endif>
                                    <i class="metismenu-icon fa fa-file" ></i>
                                   Ac Statement of Agent
                                </a>
                            </li>
                            @endif
                            @if(($val->submenuid==9) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
                            <li>
                                <a href="{{ url('remainplots') }}" @if($activemenu=="remainreport") class="mm-active" @endif>
                                    <i class="metismenu-icon fa fa-file" ></i>
                                   Remain Plots List
                                </a>
                            </li>
                            @endif
                            @if(($val->submenuid==10) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
                            <li>
                                    <a href="{{ url('soldplots') }}" @if($activemenu=="soldreport") class="mm-active" @endif>
                                            <i class="metismenu-icon fa fa-file" ></i>
                                           Sold Plots List
                                        </a>
                                    </li>
                                    @endif
                                    @if(($val->submenuid==11) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
                                    <li>
                                        <a href="{{ url('commissionreport') }}" @if($activemenu=="commssionrep") class="mm-active" @endif>
                                                <i class="metismenu-icon fa fa-file" ></i>
                                              Agent Commission Report
                                            </a>
                                        </li>
                                    @endif
                                    @endforeach
                                    @endif

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
