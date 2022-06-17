<!doctype html>
<html lang="en">
@include('admin.layouts.inc.head')

<body>

<!-- Page Container -->
<div id="page-container" class="sidebar-o side-scroll page-header-fixed page-header-dark main-content-boxed">

    <x-admin.nav/>

    <x-admin.header/>

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->
        {{ $slot }}
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <x-admin.footer/>
</div>
<!-- END Page Container -->

@include('admin.layouts.inc.scripts')
</body>
</html>
