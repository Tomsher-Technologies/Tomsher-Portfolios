<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <a href="{{ route('admin.dashboard') }}" class="d-block text-left">
                <img class="mw-100" height="100" src="{{ asset('assets/images/logow.png') }}" 
                        alt="{{ env('APP_NAME') }}">
            </a>
        </div>
        <div class="aiz-side-nav-wrap">
            <div class="px-20px mb-3">
                <input class="form-control bg-soft-secondary border-0 form-control-sm text-white" type="text"
                    name="" placeholder="{{  trans('messages.search_in_menu') }}" id="menu-search"
                    onkeyup="menuSearch()">
            </div>
            <ul class="aiz-side-nav-list" id="search-menu">
            </ul>
            <ul class="aiz-side-nav-list" id="main-menu" data-toggle="aiz-side-menu">
                
                <li class="aiz-side-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="aiz-side-nav-link">
                        <i class="las la-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{  trans('messages.dashboard') }}</span>
                    </a>
                </li>
                
                <li class="aiz-side-nav-item">
                    <a href="{{ route('categories.index') }}" class="aiz-side-nav-link">
                        <i class="las la-list aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Categories</span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="{{ route('industries.index') }}" class="aiz-side-nav-link">
                        <i class="las la-industry aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Industries</span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="{{ route('technologies.index') }}" class="aiz-side-nav-link">
                        <i class="las la-tools aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Technologies</span>
                    </a>
                </li>
                
                <li class="aiz-side-nav-item">
                    <a href="{{ route('portfolios.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['portfolios.create','portfolios.edit']) }}">
                        <i class="las la-link  aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Porfolios</span>
                    </a>
                </li>

                <li class="aiz-side-nav-item">
                    <a href="{{ route('portfolios.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['portfolios.create','portfolios.edit']) }}">
                        <i class="las la-link  aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">Users</span>
                    </a>
                </li>

            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div><!-- .aiz-sidebar -->
