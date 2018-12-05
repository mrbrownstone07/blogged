<style>
    {{--  nav{
        background-color: transparent !important;
    }  --}}
</style>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand mr" href="/">{{ config('app.name', 'Laravel') }}</a>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/about_us">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact_us">Contact Us</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="/faq">FAQ</a>
            </li>
        </ul>
    </div>
</nav>