 let disciplineId = document.getElementById("disciplineId").innerHTML;

 let shortLink = document.getElementById("short");
 let detailedLink = document.getElementById("detailed");
 let adminLink = document.getElementById("admin");
 let dependenciesLink = document.getElementById("dependencies");


 shortLink.addEventListener("click", function(){
     event.preventDefault();
     this.classList.add("activeNavLink");
     detailedLink.classList.remove("activeNavLink");
     adminLink.classList.remove("activeNavLink");
     dependenciesLink.classList.remove("activeNavLink");


     var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("disciplineCV").innerHTML = this.responseText;
        console.log(this.responseText);
      }
    };
    xmlhttp.open("GET","../short/" + disciplineId,true);
    xmlhttp.send();
    });

    dependenciesLink.addEventListener("click", function(){
        event.preventDefault();
        this.classList.add("activeNavLink");
        shortLink.classList.remove("activeNavLink");
        adminLink.classList.remove("activeNavLink");
        detailedLink.classList.remove("activeNavLink");

   
        var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
           document.getElementById("disciplineCV").innerHTML = this.responseText;
           let annotation = document.getElementById('grayContainer');
           annotation.remove();
           console.log(this.responseText);
         }
       };
       xmlhttp.open("GET","../detailedWithDependencies/" + disciplineId ,true);
       xmlhttp.send();
       });

       detailedLink.addEventListener("click", function(){
        event.preventDefault();
        this.classList.add("activeNavLink");
        shortLink.classList.remove("activeNavLink");
        adminLink.classList.remove("activeNavLink");
        dependenciesLink.classList.remove("activeNavLink");

   
        var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
           document.getElementById("disciplineCV").innerHTML = this.responseText;
           console.log(this.responseText);
         }
       };
       xmlhttp.open("GET","../detailed/" + disciplineId ,true);
       xmlhttp.send();
       });

       adminLink.addEventListener("click", function(){
        event.preventDefault();
        this.classList.add("activeNavLink");
        detailedLink.classList.remove("activeNavLink");
        shortLink.classList.remove("activeNavLink");
        dependenciesLink.classList.remove("activeNavLink");
   
        var xmlhttp = new XMLHttpRequest();
       xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
           document.getElementById("disciplineCV").innerHTML = this.responseText;
           console.log(this.responseText);
         }
       };
       xmlhttp.open("GET","../admin/" + disciplineId,true);
       xmlhttp.send();
       });

/* Theme experimenting */
let changeThemeBtn = document.getElementById("theme");

changeThemeBtn.addEventListener("click", function(){
  

});