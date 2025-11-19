<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">



    @if(auth()->user()->profilePhoto && auth()->user()->profilePhoto->profile_photo && auth()->user()->profilePhoto->status === 'Approved')

        <div class="image">
            <img src="{{ asset(auth()->user()->profilePhoto->profile_photo) }}" class="img-circle elevation-2" alt="User Image">
        </div>
    @else
        <div class="image">
            <img src="{{ asset(auth()->user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
    @endif


    <div class="info">
        {{--<a href="{{ route('backend.profile.index') }}" class="d-block"></a>--}}
        <small class="d-block text-white">#{{ auth()->user()->id ?? "" }}  {{ auth()->user()->name ?? "" }} {{ auth()->user()->middle_name ?? "" }} {{ auth()->user()->last_name ?? "" }}</small>
    </div>
</div>
