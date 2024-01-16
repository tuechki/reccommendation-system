
function showResult() {
    let field = document.getElementById("field");
    let searchInput = document.getElementById("searchInput");
    
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("livesearch").innerHTML=this.responseText;
        console.log(this.responseText);
        document.getElementById("livesearch").style.border="1px solid #A5ACB2";
      }
    }
    xmlhttp.open("GET","../search/?field="+ field + "$searchInput=" + searchInput,true);
    xmlhttp.send();
  }