@if(Auth::user()->role == 'admin')
    <li class="nav-item">
        <a href="{{ route('users.index') }}"
        class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
            <p>Users</p>
        </a>
    </li>
@endif
<li class="nav-item">
    <a href="{{ route('videos.index') }}"
       class="nav-link {{ Request::is('videos*') ? 'active' : '' }}">
        <p>Videos</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('videoRequests.index') }}"
       class="nav-link {{ Request::is('videoRequests*') ? 'active' : '' }}">
        <p>Video Requests</p>
    </a>
</li>

@if(Auth::user()->role == 'customer')
    <li class="nav-item">
        <a href="{{ route('notifications.index') }}"
        class="nav-link {{ Request::is('notifications*') ? 'active' : '' }}">
            <p>Notifications</p>
        </a>
    </li>
@endif


