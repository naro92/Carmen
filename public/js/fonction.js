var famille = document.getElementsByClassName("famille");
var check=document.getElementById("cookie").value;
var checked=document.getElementById("checkbox");
var famille = document.getElementsByClassName("famille");
console.log(check);
    if(check=="true"){
        famille[0].style.display = "block";
    }else{
        famille[0].style.display = "none";
    }

