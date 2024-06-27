<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active">
                    <a href="/"><i class="feather-grid"></i> <span> Dashboard</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-building"></i> <span> Departments</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li class="text-primary"><a href="{{ route('departments.view') }}">All Department</a></li>
                        @foreach ($departments as $item)
                            <li><a href="{{ route('directory.view', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-holly-berry"></i> <span> Constituencies</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('subCounties.show') }}">All</a></li>
                        @foreach ($subCounties as $item)
                            <li><a
                                    href="{{ route('wards.show', ['subCounty_id' => $item->id]) }}">{{ $item->name }}</a>
                            </li>
                        @endforeach

                    </ul>
                </li>
                <li>
                    <a href="{{ route('projects.show') }}"><i class="fas fa-holly-berry"></i> <span>Projects</span></a>
                </li>
                <li>
                    <a href="{{ route('public.service') }}"><i class="fas fa-holly-berry"></i> <span>Public Service
                            Board</span></a>
                </li>
                <li>
                    <a href="{{ route('crb') }}"><i class="fas fa-comment-dollar"></i> <span>County Revenue
                            Board</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-calendar-day"></i> <span> Events</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        @foreach ($eventCategories as $item)
                            <li><a href="{{ route('events.category', ['slug' => $item->slug]) }}"
                                    style="text-transform: capitalize"
                                    title="{{ $item->name }}">{{ $item->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('events.categories') }}">Categories</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-newspaper"></i> <span> Blogs</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        @foreach ($categories as $item)
                            <li><a href="{{ route('blog.category', ['slug' => $item->slug]) }}"
                                    style="text-transform: capitalize"
                                    title="{{ $item->description }}">{{ $item->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('blog.categories') }}">Categories</a></li>
                    </ul>
                </li>
                <li>
                    <a href="settings.html"><i class="fas fa-cog"></i> <span>Settings</span></a>
                </li>
                <li class="menu-title">
                    <span>Pages</span>
                </li>
                <li>
                    <a href="{{ route('home.sliders') }}"><i class="fas fa-image"></i> <span>Home Slider</span></a>
                </li>
                <li>
                    <a href="{{ route('stats') }}"><i class="fas fa-baseball-ball"></i> <span>Home Stats</span></a>
                </li>
                <li>
                    <a href="{{ route('home.welcome') }}"><i class="fas fa-book"></i> <span>Welcome Note</span></a>
                </li>
                <li>
                    <a href="{{ route('the-governor') }}"><i class="fas fa-user"></i> <span>The Governor</span></a>
                </li>
                <li>
                    <a href="{{ route('deputy-governor') }}"><i class="fas fa-user"></i> <span>Deputy
                            Governor</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
