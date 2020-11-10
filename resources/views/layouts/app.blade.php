@include('layouts.head')
@include('sections.layouts.navbar')
<body class="{{ $class ?? '' }}">
    <!-- preloader -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left bg-info"></div>
        <div class="loader-section section-right bg-info"></div>
    </div>
    <script>
        window.addEventListener('load', () => {

            document.querySelectorAll('.add').forEach(boton => {
              boton.addEventListener('click', e => {

                let id = e.target.getAttribute('id')
                let alert = document.getElementById('alert')

                alert.classList.toggle('show')
              })
            })

            document.querySelector('body').classList.add("loaded")  
            
            document.addEventListener('scroll', () => {
                document.getElementById('volverArriba').addEventListener('click', () => {
                    window.scrollTo({
                        top: 0,
                        left: 0,
                        behavior: 'smooth'
                    })
                })
                if (window.scrollY >= 1000) {
                    document.getElementById('volverArriba').classList.remove('hideScroll')
                } else {
                    document.getElementById('volverArriba').classList.add('hideScroll')
                }
            })

            getCategories()
        });
        
        async function getCategories()
        {
            await fetch('/api/v1/APIPage/ObtainCategories', {
                headers: {
                        'Content-Type': 'application/json',
                    },
                method: 'get',
            })
            .then(jsonResponse => jsonResponse.text())
            .then(response => {
                // console.log(response)
                document.getElementById('categorias').innerHTML = ''
                document.getElementById('categorias').innerHTML = response
            })
        }
    </script>

<script>
    
</script>
    <div id="app">
        <button id="volverArriba" type="button" class="btn btn-warning scrollTop hideScroll">
            <span class="btn-inner--icon"><i class="fas fa-2x fa-angle-double-up"></i></span>
        </button>
            <div class="alert alert-dismissible bg-gradient-danger col-lg-5 fade" role="alert" id="alert" style="position: fixed; left: 2%; top: 10%; z-index: 40; width: 30rem; max-width: 96vw !important;" id="alert">
                <span class="alert-inner--text">
                    <div class="spinner-grow" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Cargando, por favor espere...
                </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @yield('content')
    </div>
@include('sections.layouts.footer')
@include('layouts.foot')