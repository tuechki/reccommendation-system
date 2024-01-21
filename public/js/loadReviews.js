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

    dependenciesLink.addEventListener("click", async function () {
        event.preventDefault();
        this.classList.add("activeNavLink");
        shortLink.classList.remove("activeNavLink");
        adminLink.classList.remove("activeNavLink");
        detailedLink.classList.remove("activeNavLink");

   
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("disciplineCV").innerHTML = this.responseText;
                let annotation = document.getElementById('grayContainer');
                annotation.remove();
                console.log(this.responseText);
            }
        };
        xmlhttp.open("GET", "../detailedWithDependencies/" + disciplineId, true);
        xmlhttp.send();

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        await sleep(100);

        var disciplinesChartContainer = document.getElementById("dependencyChartContainer");
        disciplinesChartContainer.style.height = 600 + "px";

        // Set styles for the container
        disciplinesChartContainer.style.display = 'flex';
        disciplinesChartContainer.style.justifyContent = 'center';
        disciplinesChartContainer.style.alignItems = 'center';
        disciplinesChartContainer.style.height = '50vh'; // Optional: Set a specific height for the container

        // Set styles for the canvas

        var canvas = document.createElement("canvas");
        canvas.id = "dependencyChart";
        canvas.width = 400;
        canvas.height = 400;

        disciplinesChartContainer.appendChild(canvas);

        var dependenciesChartDataJson = document.getElementById("dependenciesChartData");
        console.log(dependenciesChartDataJson.value);
        var chartData = JSON.parse(dependenciesChartDataJson.value);

        var labels = chartData.labels;
        var data = chartData.data;
        var backgroundColor = chartData.backgroundColor;

        var ctx = document.getElementById("dependencyChart").getContext("2d");
        var chart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: backgroundColor
                }]
            }
        });
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