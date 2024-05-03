<html>
<head>

</head>
<body>
<p> Trade: <span id="trade-data"></span></p>

<script src="{{ asset('js/app.js') }}"></script>
<script>
    Echo.channel('trades').listen('NewTrade', (e) => {
        document.getElementById('trade-data').innerHTML = e.trade;
    });
</script>
</body>
</html>
