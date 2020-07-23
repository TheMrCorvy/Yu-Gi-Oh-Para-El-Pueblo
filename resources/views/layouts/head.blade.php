<!DOCTYPE html>
 <html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Comprá Cartas de Yu-Gi-oh! y accesorios relacionados con Yu-Gi-Oh! Para El Pueblo">

  <title>
    Yu-Gi-Oh! Para El Pueblo
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
{{-- 
  <link href="{{ asset('images') }}/favicon.png" rel="icon" type="image/png"> --}}
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
  <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

  <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{ asset('assets') }}/css/argon-design-system.css?v=1.0.2" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/docsearch.js/2/docsearch.min.css" />
  <link rel="stylesheet" href="{{ asset('assets') }}/assets/demo/docs.min.css">

  <meta name="theme-color" content="#000000" />
  <link rel="apple-touch-icon" href="{{ asset('assets') }}/icono.png" />
  <link rel="manifest" href="{{ asset('assets') }}/manifest.json" />
  <style>
    #loader-wrapper {
      position:fixed;
      top:0;
      left:0;
      width:100%;
      height:100%;
      z-index:1000;
    }
    #loader {
      display:block;
      position: relative;
      top:50%;
      left:50%;
      width:150px;
      height:150px;
      margin:-75px 0 0 -75px;
      border:3px solid transparent;
      border-top-color:white;
      border-radius:100%;
      -webkit-animation: spin 2s linear infinite;
              animation: spin 2s linear infinite;
      z-index:1001;
    }
    #loader:before {
      content:"";
      position: absolute;
      top:5px;
      left:5px;
      right:5px;
      bottom:5px;
      border:3px solid transparent;
      border-top-color: yellow;
      border-radius:100%;
      -webkit-animation: spin 3s linear infinite;
              animation: spin 3s linear infinite;
    }
    #loader:after {
      content:"";
      position: absolute;
      top:12px;
      left:12px;
      right:12px;
      bottom:12px;
      border:3px solid transparent;
      border-top-color:orange;
      border-radius:100%;
      -webkit-animation: spin 1.5s linear infinite;
              animation: spin 1.5s linear infinite;
    }
    @-webkit-keyframes spin {
      0%   { 
        -webkit-transform: rotate(0deg); 
          -ms-transform: rotate(0deg); 
              transform: rotate(0deg);
      }
      100% { 
        -webkit-transform: rotate(360deg); 
          -ms-transform: rotate(360deg); 
              transform: rotate(360deg);
      }
    }
    @keyframes spin {
      0%   { 
        -webkit-transform: rotate(0deg); 
          -ms-transform: rotate(0deg); 
              transform: rotate(0deg);
      }
      100% { 
        -webkit-transform: rotate(360deg); 
          -ms-transform: rotate(360deg); 
              transform: rotate(360deg);
      }
    }

    #loader-wrapper .loader-section {
      position:fixed;
      top:0;
      background:#333;
      width:51%;
      height:100%;
      z-index:1000;
    }

    #loader-wrapper .loader-section.section-left {
      left:0
    }
    #loader-wrapper .loader-section.section-right {
      right:0;
    }

    /* Loaded Styles */
    .loaded #loader-wrapper .loader-section.section-left {
      transform: translateX(-100%);
      transition: all 0.7s 0.3s cubic-bezier(0.645,0.045,0.355,1.000);
    }
    .loaded #loader-wrapper .loader-section.section-right {
      transform: translateX(100%);
      transition: all 0.7s 0.3s cubic-bezier(0.645,0.045,0.355,1.000);
    }
    .loaded #loader {
      opacity: 0;
      transition: all 0.3s ease-out;
    }
    .loaded #loader-wrapper {
      visibility: hidden;
      transform:translateY(-100%);
      transition: all 0.3s 1s ease-out;
    }
  </style>

  <style>
    .hideScroll{
      bottom: -15% !important;
    }

    .scrollTop{
      position: fixed; 
      bottom: 2%; 
      left: 2%; 
      z-index: 40 !important; 
      transition: 0.2s;
    }

    #nuevosProductos::-webkit-scrollbar {
    display: none;
}
  </style>
</head>

