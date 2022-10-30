@php
    $url_group = '';
    if (Auth::guard('admin')->user()->role_id == 1) {
        $url_group = 'super-admin';
    }
    elseif (Auth::guard('admin')->user()->role_id == 2) {
        $url_group = 'admin';
    }
@endphp
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('all/admin/assets/logo/logo.jpg') }}" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="{{ route('admin.dashboard') }}" class="nav-link" style="font-size: 18px !important;">Name</a>
            </li>
            <li class="nav-item toggle-sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left sidebarCollapse"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </li>
        </ul>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu active">
                <a href="{{ route('admin.dashboard') }}" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>

            <li class="menu menu-heading">
                <div class="heading"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                    <span>Features</span>
                </div>
            </li>
            

            <li class="menu">
                <a href="#chapter-management" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>
                        <span>Chapter Management</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="chapter-management" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route($url_group.'.chapter.create') }}"> Add New </a>
                    </li>
                    <li>
                        <a href="{{ route($url_group.'.chapter-list.index', ['type' => 'all']) }}"> ALl List </a>
                    </li>
                    <li>
                        <a href="{{ route($url_group.'.chapter-list.index', ['type' => 'active']) }}"> Active List </a>
                    </li>
                    <li>
                        <a href="{{ route($url_group.'.chapter-list.index', ['type' => 'inactive']) }}"> Inactive List </a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#lecture-management" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                        <span>Lecture Management</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="lecture-management" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route($url_group.'.lecture.create') }}"> Add New </a>
                    </li>
                    <li>
                        <a href="{{ route($url_group.'.lecture-list.index', ['type' => 'all']) }}"> ALl List </a>
                    </li>
                    <li>
                        <a href="{{ route($url_group.'.lecture-list.index', ['type' => 'active']) }}"> Active List </a>
                    </li>
                    <li>
                        <a href="{{ route($url_group.'.lecture-list.index', ['type' => 'inactive']) }}"> Inactive List </a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#mcq-management" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-minus"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="9" y1="15" x2="15" y2="15"></line></svg>
                        <span>MCQ Management</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="mcq-management" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route($url_group.'.mcq.create') }}"> Add New </a>
                    </li>
                    <li>
                        <a href="{{ route($url_group.'.mcq-list.index', ['type' => 'all']) }}"> ALl List </a>
                    </li>
                    <li>
                        <a href="{{ route($url_group.'.mcq-list.index', ['type' => 'active']) }}"> Active List </a>
                    </li>
                    <li>
                        <a href="{{ route($url_group.'.mcq-list.index', ['type' => 'inactive']) }}"> Inactive List </a>
                    </li>
                </ul>
            </li>


            <li class="menu">
                <a href="#website-management" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                        <span>Website Management</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="website-management" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route($url_group.'.slider-list.index') }}"> Slider </a>
                    </li>
                    <li>
                        <a href="{{ route($url_group.'.about-us.index') }}"> About </a>
                    </li>
                    {{-- <li>
                        <a href=""> Mission & Vission </a>
                    </li> --}}
                    <li>
                        <a href="{{ route($url_group.'.contact.us') }}"> Contact Us </a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#student" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>Student Management</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="student" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route($url_group.'.students.index') }}"> Students </a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#setting" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        <span>Setting Management</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="setting" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route($url_group.'.system.settings') }}"> System Setting </a>
                    </li>
                </ul>
            </li>

        </ul>
        
    </nav>

</div>