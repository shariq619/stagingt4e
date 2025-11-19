<div class="card-body p-0">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item ">
            <a href="{{ route('backend.messages.index') }}" class="nav-link {{ Request::is('backend/messages/index*') ? 'active' : '' }}">
                <i class="fas fa-inbox"></i> Inbox

                @if ( isset($unreadCount) && $unreadCount > 0)
                    <span class="badge bg-primary float-right text-red">{{ $unreadCount ?? "" }}</span> <!-- Show number of unread messages -->
                @endif

                {{--                                    <span class="badge bg-primary float-right">12</span>--}}
            </a>
        </li>
        <li class="nav-item ">
            <a href="{{ route('backend.messages.sent') }}" class="nav-link {{ Request::is('backend/messages/sent*') ? 'active' : '' }}">
                <i class="far fa-envelope"></i> Sent
            </a>
        </li>
        {{--                            <li class="nav-item">--}}
        {{--                                <a href="#" class="nav-link">--}}
        {{--                                    <i class="far fa-trash-alt"></i> Trash--}}
        {{--                                </a>--}}
        {{--                            </li>--}}
    </ul>
</div>
