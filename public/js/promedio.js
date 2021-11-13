if(jQuery("#promedio").length > 0){
    var fecha = new Date();
    var newDate = new Date(fecha.getFullYear(), fecha.getMonth(), 0);
    var days = [];
    for(var i = 1; i <= newDate.getDate(); i++){
        days.push(i);
    }
    var dateContabilidad = [1, 10, 20, 30, 50, 2, 5, 0, 9, 12, 30, 80, 0, 9, 10];
    var dateRH = [11, 20, 2, 38, 50, 2, 23, 54, 10, 90, 30, 8, 10, 49, 14];

    new Chart(document.getElementById("promedio"),{
        "type":"line",
        "data":
        {        
            "labels":days,
            "datasets":[
                {
                    "label":"CONTABILIDAD",
                    "data":dateContabilidad,
                    "fill":false,"borderColor":"rgb(75, 192, 192)",
                    "lineTension":0.1
                },
                {
                    "label":"RH",
                    "data":dateRH,
                    "fill":false,"borderColor":"rgb(220, 53, 85)",
                    "lineTension":0.1
                }
            ]
        },
        "options":{
            responsive:true,
            maintainAspectRatio: false,
             scales: {
                yAxes: [{
                  stacked: true,
                  gridLines: {
                    display: true
                  }
                }],
                xAxes: [{
                  gridLines: {
                    display: false
                  }
                }]
              }
        }
    });
}
