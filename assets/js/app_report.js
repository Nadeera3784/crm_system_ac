$(document).ready(function() {
    if($('#weekchart').length > 0){
      $.ajax({
        url: AppHelper.baseUrl+"api/get_estimates_week_report",
        method: "GET",
        dataType: "json",
        success: function(response) {
          Morris.Bar({
            element: 'weekchart',
            data: response.weekdata,
            xkey: 'date',
            ykeys: ['booking'],
            labels: ['Amount(Rs)'],
            barRatio: 0.4,
            xLabelAngle: 35,
            pointSize: 1,
            barOpacity: 1,
            pointStrokeColors:['#ff6028'],
            behaveLikeLine: true,
            grid: true,
            gridTextColor:'#878787',
            hideHover: 'auto',
            smooth: true,
            barColors: ['#3324f5'],
            resize: true,
            gridTextFamily:"Roboto"
          });  
        }
      });
    }

    if($('#monthchart').length > 0){
      $.ajax({
        url: AppHelper.baseUrl+"api/get_estimates_month_report",
        method: "GET",
        dataType: "json",
        success: function(response) {
          Morris.Bar({
            element: 'monthchart',
            data: response.message.monthdata,
            xkey: 'date',
            ykeys: ['booking'],
            labels: ['Amount(Rs)'],
            barRatio: 0.4,
            xLabelAngle: 35,
            pointSize: 1,
            barOpacity: 1,
            pointStrokeColors:['#ff6028'],
            behaveLikeLine: true,
            grid: true,
            gridTextColor:'#878787',
            hideHover: 'auto',
            smooth: true,
            barColors: ['#3324f5'],
            resize: true,
            gridTextFamily:"Roboto"
          });  
        }
      });
    }
    
    if($('#yearchart').length > 0){
      $.ajax({
        url: AppHelper.baseUrl+"api/get_estimates_year_report",
        method: "GET",
        dataType: "json",
        success: function(response) {
          Morris.Bar({
            element: 'yearchart',
            data: response.message.yeardata,
            xkey: 'date',
            ykeys: ['booking'],
            labels: ['Amount(Rs)'],
            barRatio: 0.4,
            xLabelAngle: 35,
            pointSize: 1,
            barOpacity: 1,
            pointStrokeColors:['#ff6028'],
            behaveLikeLine: true,
            grid: true,
            gridTextColor:'#878787',
            hideHover: 'auto',
            smooth: true,
            barColors: ['#3324f5'],
            resize: true,
            gridTextFamily:"Roboto"
          });  
        }
      });
    }

    if($('#job_weekchart').length > 0){
      $.ajax({
        url: AppHelper.baseUrl+"api/get_job_week_report",
        method: "GET",
        dataType: "json",
        success: function(response) {
          Morris.Bar({
            element: 'job_weekchart',
            data: response.weekdata,
            xkey: 'date',
            ykeys: ['booking'],
            labels: ['Jobs'],
            barRatio: 0.4,
            xLabelAngle: 35,
            pointSize: 1,
            barOpacity: 1,
            pointStrokeColors:['#ff6028'],
            behaveLikeLine: true,
            grid: true,
            gridTextColor:'#878787',
            hideHover: 'auto',
            smooth: true,
            barColors: ['#3324f5'],
            resize: true,
            gridTextFamily:"Roboto"
          });  
        }
      });
    }

    if($('#job_monthchart').length > 0){
      $.ajax({
        url: AppHelper.baseUrl+"api/get_job_month_report",
        method: "GET",
        dataType: "json",
        success: function(response) {
          Morris.Bar({
            element: 'job_monthchart',
            data: response.message.monthdata,
            xkey: 'date',
            ykeys: ['booking'],
            labels: ['Jobs'],
            barRatio: 0.4,
            xLabelAngle: 35,
            pointSize: 1,
            barOpacity: 1,
            pointStrokeColors:['#ff6028'],
            behaveLikeLine: true,
            grid: true,
            gridTextColor:'#878787',
            hideHover: 'auto',
            smooth: true,
            barColors: ['#3324f5'],
            resize: true,
            gridTextFamily:"Roboto"
          });  
        }
      });
    }
    
    if($('#job_yearchart').length > 0){
      $.ajax({
        url: AppHelper.baseUrl+"api/get_job_year_report",
        method: "GET",
        dataType: "json",
        success: function(response) {
          Morris.Bar({
            element: 'job_yearchart',
            data: response.message.yeardata,
            xkey: 'date',
            ykeys: ['booking'],
            labels: ['Jobs'],
            barRatio: 0.4,
            xLabelAngle: 35,
            pointSize: 1,
            barOpacity: 1,
            pointStrokeColors:['#ff6028'],
            behaveLikeLine: true,
            grid: true,
            gridTextColor:'#878787',
            hideHover: 'auto',
            smooth: true,
            barColors: ['#3324f5'],
            resize: true,
            gridTextFamily:"Roboto"
          });  
        }
      });
    }


    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var target = $(e.target).attr("href");
      switch (target) {
        case "#week":        
          $(window).trigger('resize');
          break;
        case "#month":         
          $(window).trigger('resize');
          break;
        case "#yearly":         
          $(window).trigger('resize');
          break;
        case "#week1":        
          $(window).trigger('resize');
          break;
        case "#month1":         
          $(window).trigger('resize');
          break;
        case "#yearly1":         
          $(window).trigger('resize');
          break;
      }
    })
});