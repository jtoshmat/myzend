/* Add here all your JS customizations */
var TOSH = {
    is_numeric : function(num){
        return typeof num === 'number' && isFinite(num);
    },
    //*******************************************************************//
    is_email : function(email){
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{1,1})+$/;
        //var regex = /^([a-zA-Z0-9+-_.){1+}\@([a-zA-Z0-9.-_){1+}(.){1}(a-zA-Z){2+} /; acceptible 5/22
        return regex.test(email);
    },
    //*******************************************************************//
    //get querystring by passing the querystring name for example, www.toshmatov.us?employee_id=2232323.
    querystring : function (sVar){
        return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(sVar).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
    },

    is_data_valid :  function(){
        var input = $("#myinput").val();
        var a = input || 'empty'; //if input is null or empty or undefined, it will be empty
        $("#mydisplay").text(a);
    },

    replace_char : function(){
        var input = $("#myinput").val();
        var a = input.replace(/@/g, '*'); // replace @ with *
        var b = input.replace(/\s/g, '-'); //replace space with - and etc
        $("#mydisplay").text(a);
    },

}

$(document).ready(function(){

});