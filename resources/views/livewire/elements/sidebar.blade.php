<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="active">
                    <a href="/"><i class="feather-grid"></i> <span> Dashboard</span>
                </li>
                <li class="menu-title">
                    <span>News, Speeches & Publications</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="teachers.html">Teacher List</a></li>
                        <li><a href="teacher-details.html">Teacher View</a></li>
                        <li><a href="add-teacher.html">Teacher Add</a></li>
                        <li><a href="edit-teacher.html">Teacher Edit</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-building"></i> <span> Departments</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="departments.html">Department List</a></li>
                        <li><a href="add-department.html">Department Add</a></li>
                        <li><a href="edit-department.html">Department Edit</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-book-reader"></i> <span> Subjects</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="subjects.html">Subject List</a></li>
                        <li><a href="add-subject.html">Subject Add</a></li>
                        <li><a href="edit-subject.html">Subject Edit</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard"></i> <span> Invoices</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="invoices.html">Invoices List</a></li>
                        <li><a href="invoice-grid.html">Invoices Grid</a></li>
                        <li><a href="add-invoice.html">Add Invoices</a></li>
                        <li><a href="edit-invoice.html">Edit Invoices</a></li>
                        <li><a href="view-invoice.html">Invoices Details</a></li>
                        <li><a href="invoices-settings.html">Invoices Settings</a></li>
                    </ul>
                </li>
                <li>
                    <a href="holiday.html"><i class="fas fa-holly-berry"></i> <span>Holiday</span></a>
                </li>
                <li>
                    <a href="fees.html"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a>
                </li>
                <li>
                    <a href="exam.html"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-calendar-day"></i> <span> Events</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        @foreach ($eventCategories as $item)
                        <li><a href="{{ route('events.category', ['slug' => $item->slug]) }}"
                                style="text-transform: capitalize" title="{{ $item->name }}">{{ $item->name }}</a></li>
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
                                style="text-transform: capitalize" title="{{ $item->description }}">{{ $item->name
                                }}</a></li>
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
            </ul>
        </div>
    </div>
</div>
