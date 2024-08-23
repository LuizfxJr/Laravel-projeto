<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }} sidebar-roma">

    {{-- Sidebar brand logo --}}
    <!-- @if(config('adminlte.logo_img_xl'))
    @include('adminlte::partials.common.brand-logo-xl')
    @else
    @include('adminlte::partials.common.brand-logo-xs')
    @endif -->

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul style="align-items: center;" class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}" data-widget="treeview" role="menu" @if(config('adminlte.sidebar_nav_animation_speed') !=300) data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                {{-- Configured sidebar links --}}
                <div class="row-avatar">
                    <div class="profile-header-container">
                        <div class="profile-header-img">
                            <img class="img-circle" src="{{ asset(config('adminlte.avatar')) }}" />
                        </div>
                        <div class="profile-header-name">
                            <label class="label-name">{{Auth::user()->name}}</label>
                            <label class="label-office">{{Auth::user()->occupation->description}}</label>
                        </div>
                    </div>
                </div>
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>