
<head>
    <title>SchedGen</title>
    <!-- Include Bootstrap CSS here if not using CDN -->
</head>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark" style="top:0">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"  style = "color:white;">SchedGen</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto d-flex justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin" style = "color:white;">
                                                @auth('backpack')
                        {{-- User is logged in --}}
                        Welcome, {{ auth('backpack')->user()->name }}!<br> Access Admin Pannel! 
                    @else
                        {{-- User is not logged in --}}
                        Please log in to access this content.
                    @endauth




                            </a>
                        </li>
                        <!-- Add more menu items as needed -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <!-- Include Bootstrap JS and Popper.js if not using CDN -->

