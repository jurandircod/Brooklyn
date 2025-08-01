<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrativo - @yield('titulo')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminLte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('adminLte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('adminLte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('adminLte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminLte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminLte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminLte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('adminLte/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminLte/plugins/toastr/toastr.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminLte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminLte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminLte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('adminLte/dist/img/favicon.ico') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
         crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous">
    </script>

</head>
<style>
    :root {
        --primary-color: #7520DD;
        --primary-hover: #5a1a9b;
        --primary-light: rgba(117, 32, 221, 0.1);
        --success-color: #10b981;
        --danger-color: #ef4444;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-500: #6b7280;
        --gray-700: #374151;
        --gray-900: #111827;
    }

    body {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .content-header h1 {
        color: var(--primary-color) !important;
        font-weight: 700;
        font-size: 2rem;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        transition: all 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: var(--primary-hover);
        text-decoration: underline !important;
    }

    /* Card Styles */
    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color), #9333ea) !important;
        border: none;
        padding: 1.5rem 2rem;
        border-radius: 20px 20px 0 0 !important;
    }

    .card-header h3 {
        margin: 0;
        font-weight: 600;
        font-size: 1.25rem;
        letter-spacing: -0.025em;
    }

    .card-body {
        padding: 2rem;
    }

    .card-body h4 {
        color: var(--gray-700);
        font-weight: 600;
        margin-bottom: 2rem;
        font-size: 1.5rem;
    }

    /* Form Styles */
    .form-label {
        color: var(--gray-700);
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control, .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 0.875rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: var(--gray-50);
        color: var(--gray-700);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 3px var(--primary-light) !important;
        background: #fff;
        outline: none;
    }

    .form-control:hover, .form-select:hover {
        border-color: #cbd5e0;
        background: #fff;
    }

    .input-group-text {
        background: var(--gray-100);
        border: 2px solid #e5e7eb;
        color: var(--gray-700);
        font-weight: 600;
        border-radius: 12px 0 0 12px;
        border-right: none;
    }

    /* Button Styles */
    .btn {
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), #9333ea);
        color: white;
        box-shadow: 0 4px 15px rgba(117, 32, 221, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--primary-hover), #7c3aed);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(117, 32, 221, 0.4);
    }

    .btn-outline-secondary {
        border: 2px solid #e5e7eb;
        color: var(--gray-700);
        background: white;
        width: 50px;
        height: 100%;
        border-radius: 0 12px 12px 0;
        border-left: none;
        font-size: 1.25rem;
        font-weight: bold;
    }

    .btn-outline-secondary:hover {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    /* Size Options */
    .size-option {
        width: 60px;
        height: 60px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 8px;
        font-size: 16px;
        font-weight: 700;
        border: 3px solid #e5e7eb;
        cursor: pointer;
        border-radius: 16px;
        user-select: none;
        transition: all 0.3s ease;
        background: white;
        color: var(--gray-700);
    }

    .size-option:hover {
        border-color: var(--primary-color);
        background: var(--primary-light);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(117, 32, 221, 0.2);
    }

    .size-option.selected {
        background: linear-gradient(135deg, var(--primary-color), #9333ea);
        color: white;
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(117, 32, 221, 0.3);
    }

    .size-checkbox {
        display: none;
    }

    /* Error Messages */
    .invalid-feedback {
        color: var(--danger-color) !important;
        font-size: 0.8125rem;
        font-weight: 500;
        margin-top: 0.375rem;
        display: block !important;
    }

    /* Required Asterisk */
    span[style*="color: red"] {
        color: var(--danger-color) !important;
        font-weight: bold;
    }

    /* Image Preview */
    #imagePreviewContainer {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
        padding: 1rem;
        background: var(--gray-50);
        border-radius: 12px;
        border: 2px dashed #d1d5db;
    }

    #imagePreviewContainer img {
        width: 120px !important;
        height: 120px !important;
        object-fit: cover !important;
        border-radius: 12px !important;
        border: 3px solid white !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        margin: 0 !important;
        transition: all 0.3s ease;
    }

    #imagePreviewContainer img:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    /* File Input */
    .form-control[type="file"] {
        padding: 1rem;
        background: var(--gray-50);
        border: 2px dashed #d1d5db;
        cursor: pointer;
    }
    .form-control{
        height: auto !important;
    }

    .form-control[type="file"]:hover {
        border-color: var(--primary-color);
        background: var(--primary-light);
    }

    /* Textarea */
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    /* Modal Styles */
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.6) !important;
        z-index: 10000 !important;
        backdrop-filter: blur(4px);
        position: relative !important;
    }

    .modal-dialog {
        margin: 1.75rem auto;
        
    }

    .modal-dialog-centered {
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .modal-content {
        border: none !important;
        border-radius: 20px !important;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15) !important;
        overflow: hidden;
        position: relative;
        z-index: 1055;
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary-color), #9333ea) !important;
        color: white !important;
        border: none !important;
        padding: 1.5rem 2rem !important;
        position: relative;
    }

    .modal-title {
        font-weight: 600 !important;
        font-size: 1.25rem !important;
        margin: 0 !important;
    }

    .btn-close {
        filter: brightness(0) invert(1) !important;
        opacity: 0.8 !important;
        font-size: 1.2rem !important;
        padding: 0.5rem !important;
        margin: -0.5rem -0.5rem -0.5rem auto !important;
    }

    .btn-close:hover {
        opacity: 1 !important;
        transform: scale(1.1);
    }

    .modal-body {
        padding: 2rem !important;
        background: white;
        
    }

    .modal-footer {
        padding: 1.5rem 2rem !important;
        border: none !important;
        background: var(--gray-50) !important;
        gap: 12px;
    }

    .btn-secondary {
        background: #6b7280 !important;
        border: none !important;
        color: white !important;
    }

    .btn-secondary:hover {
        background: #4b5563 !important;
        transform: translateY(-2px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }
        
        .content-header h1 {
            font-size: 1.5rem;
        }
        
        .size-option {
            width: 50px;
            height: 50px;
            margin: 5px;
            font-size: 14px;
        }
        
        #imagePreviewContainer img {
            width: 80px !important;
            height: 80px !important;
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--gray-100);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-hover);
    }

    /* Section Titles */
    .size-section-title {
        font-weight: 700;
        color: var(--gray-700);
        font-size: 1.1rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary-light);
    }

    /* Loading State */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }

    /* Focus Indicators */
    .form-control:focus,
    .btn:focus,
    .size-option:focus {
        outline: 2px solid var(--primary-color);
        outline-offset: 2px;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">

    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('adminLte/dist/img/bartLoader.gif') }}" alt="AdminLTELogo"
            height="120" width="120">
        <h6 class="text-center">Aguarde enquanto carregamos o painel de administração</h6>
    </div>

    <div class="wrapper">


        @include('administrativo.layouts._partials.topo')
        @include('administrativo.layouts._partials.sidebar')
        <div class="content-wrapper">
            @yield('conteudo')
        </div>
        @include('administrativo.layouts._partials.footer')


    </div>



    <!-- DataTables -->
    <!-- jQuery -->
    <script src="{{ asset('adminLte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminLte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('adminLte/plugins/datatables/jquery.dataTables.min.js ') }}"></script>
    <script src="{{ asset('adminLte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->



    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminLte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('adminLte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('adminLte/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('adminLte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('adminLte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('adminLte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminLte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('adminLte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('adminLte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('adminLte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminLte/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminLte/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('adminLte/dist/js/pages/dashboard.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>
