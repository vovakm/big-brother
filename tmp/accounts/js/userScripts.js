$(function() {
    changeWidth(980);

    $('#buttons input').click(function(){
        changeWidth($(this).val());
    });

    function changeWidth(menuWidth){
        var menuItems = $('#menu li').size();
        var itemWidth = (menuWidth/menuItems)-2;

        $('#menu').css({'width': menuWidth +'px'});
        $('#menu a').css({'width': itemWidth +'px'});
    }
});

var d=document
var NN=d.layers?true:(window.opera&&!d.createComment)?true:false
function showTime(){
	var tmN=new Date();
	var dH=''+tmN.getHours();dH=dH.length<2?'0'+dH:dH;
	var dM=''+tmN.getMinutes();dM=dM.length<2?'0'+dM:dM;
	var tmp=dH+':'+dM;
	d.getElementById('myClock').innerHTML=tmp;
	var t=setTimeout('showTime()',1000);
}

$(document).ready(function(){ 
$('.splLink').click(function(){ 
$(this).parent().children('div.splCont').toggle('normal');
 return false;
 });
 });