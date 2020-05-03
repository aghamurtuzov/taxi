$(function() {

    function show_clock(){
        var timeNow = new Date();
        var hours   = timeNow.getHours();
        var minutes = timeNow.getMinutes();
        var timeString = "" + ((hours > 12) ? hours - 12 : hours);
        timeString  += ((minutes < 10) ? ":0" : ":") + minutes;
        return timeString;
    }

    function show_date()
    {
        var timeNow = new Date();
        var day     = timeNow.getDate();
        var weekday = timeNow.getDay();
        var month   = timeNow.getMonth();
        var year    = timeNow.getFullYear();

        var dateString = "";
        
        dateString  += days[weekday]+",";
        dateString  += " "+ day;
        dateString  += " "+months[month];
        dateString  += " "+year;
        return dateString
    }

    $( document ).ready(function() {
        $('.clock').html(show_clock());
        $('.date').html(show_date());
    });

    window.setInterval(function(){
        $('.clock').html(show_clock());
        $('.date').html(show_date());
    }, 1000);

});