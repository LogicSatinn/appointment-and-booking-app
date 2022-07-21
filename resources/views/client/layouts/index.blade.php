<!doctype html>
<html lang="en">

@include('client.layouts.inc.head')

<body class="bg-white">

<x-client.header/>
{{ $slot }}
<x-client.footer/>

@include('client.layouts.inc.script')
</body>
</html>

