<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend/includes/head')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('backend/includes/navbar')
            
            <div class="main-sidebar">
                @include('backend/includes/sidebar')
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            <footer class="main-footer">
                @include('backend/includes/footer')
            </footer>

        </div>
    </div>
    @include('backend/includes/script')
</body>

</html>
