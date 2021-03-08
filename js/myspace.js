function openspacetab(evt, sptabname) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(sptabname).style.display = "block";
    evt.currentTarget.className += " active";    
}


function ch_cover(){
    alert("Change Cover");
}
function del_cover(){
    alert("Delete Cover");
}
function ch_dp(){
    alert("Change DP");
}
function del_dp(){
    alert("Delete DP");
}

var esd_modal = document.getElementById("esd");
var esd_close = document.getElementsByClassName("esd_close_icon")[0];
function edit_space_details(){

  esd_modal.style.display = "block";

}

esd_close.onclick = function() {
  esd_modal.style.display = "none";
}

