<!DOCTYPE HTML>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../css/kalendae.css" type="text/css" charset="utf-8">
    <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
    <script src="../js/kalendae.min.js" type="text/javascript" charset="utf-8"></script>
    <style type="text/css" media="screen">
        .kalendae .k-days span.closed {
            background:red;
        }
    </style>
</head>
<body>

<hr>
<p>Blackout and Direction Tests</p>

<script type="text/javascript" charset="utf-8">

    $('#arrivee')   .kalendae();
    //blackout AND direction
    new Kalendae(document.body, {
        months:1,
        blackout: function (date) {
            return [1,0,0,0,0,0,1][Kalendae.moment(date).day()]; //blackout weekends
        }
    });

</script>


<hr>
So is the one on this input.
<input type="text" id="arrivee" />

</body>
</html>
