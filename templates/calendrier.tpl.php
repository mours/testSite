<?php include('../fonction.php'); ?>

<!DOCTYPE HTML>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="../css/kalendae.css" type="text/css" charset="utf-8">
    <link rel="stylesheet" href="../css/style.css" type="text/css" charset="utf-8">
    <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
    <script src="../js/kalendae.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="../js/tiny_mce/tiny_mce.js" ></script>
    <script type="text/javascript" src="../js/tiny_mce/tiny_mce_popup.js" ></script>

    <style type="text/css" media="screen">
        .kalendae .k-days span.closed {
            background:red;
        }
    </style>
</head>
<body>

<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){

    window.moment = Kalendae.moment;

    // Mise à jour du calendrier en français
    moment.lang('fr', {
    months : "Janvier_Février_Mars_Avril_Mai_Juin_Juillet_Aout_Septembre_Octobre_Novembre_Décembre".split("_"),
    monthsShort : "Jan_Fev_Mar_Avr_Mai_Juin_Juil_Aou_Sep_Oct_Nov_Dec".split("_"),
    weekdays : "Dimanche_Lundi_Mardi_Mercredi_Jeudi_Vendredi_Samedi".split("_"),
    weekdaysShort : "Dim_Lun_Mar_Mer_Jeu_Ven_Sam".split("_"),
    longDateFormat : {
        L : "DD/MM/YYYY",
        LL : "D MMMM YYYY",
        LLL : "D MMMM YYYY HH:mm",
        LLLL : "dddd, D MMMM YYYY HH:mm"
    },
    meridiem : {
      AM : 'AM',
      am : 'am',
      PM : 'PM',
      pm : 'pm'
    },
    calendar : {
      sameDay: "[Ajourd'hui à] LT",
      nextDay: '[Demain à] LT',
      nextWeek: 'dddd [à] LT',
      lastDay: '[Hier à] LT',
      lastWeek: 'dddd [denier à] LT',
      sameElse: 'L'
    },
    relativeTime : {
      future : "in %s",
      past : "il y a %s",
      s : "secondes",
      m : "une minute",
      mm : "%d minutes",
      h : "une heure",
      hh : "%d heures",
      d : "un jour",
      dd : "%d jours",
      M : "un mois",
      MM : "%d mois",
      y : "une année",
      yy : "%d années"
    },
    ordinal : function (number) {
      return (~~ (number % 100 / 10) === 1) ? 'er' : 'ème';
    }
  });

    new Kalendae.Input('depart', {
      months:1,
      weekStart:1,
      format: 'L',
      blackout: function (date) {
         return [1,0,0,0,0,0,1][Kalendae.moment(date).day()]; //blackout weekends
      }
    });

    new Kalendae.Input('arrivee', {
      months:1,
      weekStart:1,
      format: 'L',
      blackout: function (date) {
        return [1,0,0,0,0,0,1][Kalendae.moment(date).day()]; //blackout weekends
      }
    });
  })

</script>


<div style='color: white;'>
    <?php echo wpguy_initial_cap("Réservation"); ?>

    Vérifier les disponibilités

    Date de départ :<br/>
    <input type="text" id="depart">
    Date d'arrivée :
    <input type="text" id="arrivee" />
</div>

</body>
</html>
