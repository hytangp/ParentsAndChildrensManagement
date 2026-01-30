<div class='container'>
    @if(Auth::check())
        <p class="my-3">
            <a href="{{ route('dashboard') }}" class="m-2 link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Dashboard</a>
            <a href="{{ route('parents.index') }}" class="m-2 link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Get Parents</a>
            <a href="{{ route('childrens.index') }}" class="m-2 link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Get Childrens</a>
        </p>
    @endif
</div>