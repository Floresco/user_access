<?php


$manage_dashboard = \App\Helpers\Utils::have_access("manage_dashboard");
?>

@if($manage_dashboard != "0_0_0_0" )
    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
           aria-expanded="false" aria-controls="sidebarDashboards">
            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
        </a>
        <div class="collapse menu-dropdown" id="sidebarDashboards">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="dashboard-analytics.html" class="nav-link" data-key="t-analytics">
                        Analytics </a>
                </li>
                <li class="nav-item">
                    <a href="dashboard-job.html" class="nav-link"><span data-key="t-job">Job</span>
                        <span class="badge badge-pill bg-success" data-key="t-new">New</span></a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link menu-link" href="widgets.html" aria-expanded="false">
            <i class="ri-honour-line"></i> <span data-key="t-widgets">Widgets</span>
        </a>
    </li>
    <!-- end Dashboard Menu -->
@endif


