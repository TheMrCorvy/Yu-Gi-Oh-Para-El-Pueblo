@extends('layouts.app', ['class' => 'product-page'])

@section('content')

<div class="wraper">
    <div class="page-header page-header-small skew-separator skew-mini">
        
        <div class="page-header-image bg-gradient-primary"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-7 mr-auto text-left">
                        <h1 class="title text-white">Mis Compras</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="section section-item" style="z-index: 12 !important;">
            <div class="container" id="misCompras">
                <div class="alert alert-info d-flex justify-content-between col-lg-12" id="cargando" role="alert">
                    <strong class="pt-1">Obteniendo Compras...</strong>
                    <div class="spinner-border text-white" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="section related-products bg-secondary skew-separator skew-top">
            <div class="container">
                <div class="col-md-8">
                    <h2 class="title text-capitalize">Tal vez te interesen</h2>
                </div>
                <div class="row" id="getRecomendaciones">
                    <div class="alert alert-primary d-flex justify-content-between col-lg-12" id="cargando" role="alert">
                        <strong class="pt-1">Cargando Recomendaciones...</strong>
                        <div class="spinner-border text-white" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    const username = '{{ Auth::user()->username }}'

    async function GetRecomendaciones() {
        await fetch('/api/v1/APIPage/GetRecomendaciones', {
            headers: {
                    'Content-Type': 'application/json',
                },
            method: 'get',
        })
        .then(jsonResponse => jsonResponse.text())
        .then(response => {
            document.getElementById('getRecomendaciones').innerHTML = ''
            document.getElementById('getRecomendaciones').innerHTML = response
        })
    }

    async function GetOrdenesCompra() {
        await fetch('/api/v1/APIPage/MisCompras/' + username, {
            headers: {
                    'Content-Type': 'application/json',
                },
            method: 'get',
        })
        .then(jsonResponse => jsonResponse.text())
        .then(response => {
            document.getElementById('misCompras').innerHTML = ''
            document.getElementById('misCompras').innerHTML = response

            document.querySelectorAll('.detalles').forEach(detalle => {
                
                detalle.addEventListener('click', e => {
                    e.preventDefault()

                    const orden = e.target.getAttribute('id')
                    // console.log(orden)
                    GetCompras(orden)
                })
            })
        })
    }

    async function GetCompras(orden) {
        const footer = document.getElementById('detalle' + orden)
        footer.innerHTML = ''

        footer.innerHTML = '<button class="btn btn-success btn-sm ml-2 mb-2" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span></button>'

        await fetch('/api/v1/APIPage/MisDetalles/' + orden, {
            headers: {
                    'Content-Type': 'application/json',
                },
            method: 'get',
        })
        .then(jsonResponse => jsonResponse.text())
        .then(response => {
            footer.innerHTML = ''
            footer.innerHTML = response
        })
    }


    window.addEventListener('load', async () => {

        await Promise.all([
            GetOrdenesCompra(),
            GetRecomendaciones(),
        ])
        .then(
            document.querySelectorAll('.addAjax').forEach(boton => {

                boton.addEventListener('click', e => {
                    let id = e.target.getAttribute('id')
                    let alert = document.getElementById('alert')
                    alert.classList.toggle('show')
                })//foreach

            })//document.query
        )//.then
    })//window
</script>

@endsection