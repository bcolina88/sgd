var config = '';
jQuery(document).ready(function(){
    jQuery.ajax({
        url: "/config.json",
        success: function(data){
            config = data;
            //changeStyles();
            informeUno();
            informeDos();
            informeTres();
            navRemove();
            footer();
            /* Content appear */
            if($('body').hasClass('content-appear')) {
                $('body').addClass('content-appearing')
                setTimeout(function() {
                    $('body').removeClass('content-appear content-appearing');
                }, 800);
            }

            /* Preloader */
            setTimeout(function() {
                $('.preloader').fadeOut();
            }, 500);
        }
    })

})

function changeStyles(){
    if(config.estilos){

        jQuery(".site-sidebar").css({background : config.estilos.sidebar_bg});
        jQuery(".site-sidebar .logo").css({background : config.estilos.sidebar_bg});
        jQuery(".site-header .navbar").css({background : config.estilos.nav_bg});
        jQuery(".nav a").css({color : config.estilos.nav_text});
        jQuery(".bg-primary").css({"background-color" : config.estilos.buttons_bg});
        jQuery(".btn-primary").css({"background-color" : config.estilos.buttons_bg, color :  config.estilos.buttons_text});
        jQuery(".btn-outline-primary").css({"border-color" : config.estilos.buttons_bg, color : config.estilos.buttons_bg});
        jQuery("table a.icon").css({color :  config.estilos.icons_text});

        jQuery(".bg-primary").removeClass("bg-primary");
        jQuery(".btn-primary").removeClass("btn-primary");
        jQuery(".btn-outline-primary").removeClass("btn-outline-primary");
    }

}

function informeUno(){
    if(jQuery("#multiple").length > 0){

      keys = Object.keys(informe1[0]);
      index = keys.indexOf("periodo");
      keys.splice(index, 1)
      Morris.Area({
          element: 'multiple',
          data: informe1,
          xkey: 'periodo',
          ykeys: keys,
          labels: keys,
          pointSize: 3,
          fillOpacity: 0,
          pointStrokeColors:['#f44236', '#43b968', '#20b9ae'],
          behaveLikeLine: true,
          gridLineColor: '#e0e0e0',
          lineWidth: 1,
          hideHover: 'auto',
          lineColors: ['#f44236', '#43b968', '#20b9ae'],
          resize: true
      });
    }
}

function informeDos(){
    var ctx = jQuery("#line");
    if(ctx.length > 0){
        var data = {
            labels: informe2["meses"],
            datasets: [
                {
                    label: "Actividad",
                    fill: false,
                    lineTension: 0.0,
                    backgroundColor: "#f44236",
                    borderColor: "#f44236",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "#f44236",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#f44236",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: informe2["datos"],
                    spanGaps: false,
                }
            ]
        };

        var myChart = new Chart(ctx, {
            type: 'line',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    }
}

function informeTres(){
    var ctx = jQuery("#bar");
    if(ctx.length >0){
        var data = {
            labels: informe3["meses"],
            datasets: [{
                label: 'Documentos',
                data: informe3["datos"],
                backgroundColor: 'rgba(67, 185, 104, 0.2)',
                borderColor: '#43b968',
                borderWidth: 1
            }]
        };

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    }
}

function navRemove(){
    for(var x in config.notNav){
        jQuery("#"+config.notNav[x]).remove();
    }
}

function footer(){
    jQuery("footer > div").html(config.footer);
}