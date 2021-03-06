<!DOCTYPE html>
<html lang="en">

<head>
    <!--Add all stylesheets and references-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AHCC Boarding Calender</title>
    <link href="https://unpkg.com/tabulator-tables@5.0.7/dist/css/tabulator.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.0.7/dist/js/tabulator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/2.3.0/luxon.min.js" integrity="sha512-2j5fkjQ4q5ceXgfxi+kqrU2Oz234MrpyywZsQz1F5OGnfat7mOhjRr0oz5cpQ+YwwWB+hhDBSyxNGuL/tKWMFw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Set CSS Style For All Components-->
    <style>
    body, h1, h2, h3, h4, h5, h6 {font-family: "Raleway", sans-serif;}
    .tabulator {font-size: 20px; font font-family: "Raleway", sans-serif}
    footer {
      text-align: center;
      font-size: 8px;
      padding:3px;
      background-color: DarkSlateGrey;
      color: white;
    }
    </style>

<body>

    <!--Navbar Header-->
      <div class="w3-top">
        <div class="w3-bar w3-white w3-card" id="myNavbar">
          <a href="#home" class="w3-bar-item w3-button w3-wide" disabled>ANIMAL HEALTH CARE CENTER BOARDING CALENDAR</a>
    <!-- Right-sided navbar links -->
          <div class="w3-right w3-hide-small">
            <button id="add-row" class="w3-bar-item w3-button"><i class="fa fa-plus"></i>  ADD ROW</button>

          </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

          <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
            <i class="fa fa-bars"></i>
          </a>
        </div>
        <p stlye="padding-bottom: 1px;"
    </div>

    <!--Initialize Data Table within HTML-->
    <div id="data-table"></div>

    <script>
    // Initialize Table Data
    var tabledata = [
          {name:"Gertie Carrell", location:"Beach",misc:"DDCx1",bath:0, meds:1, di:"12/05/2021", do:"12/06/2021", brought:"bed, blanket"},
          {name:"Chloe Cost", location:"Space",misc:"DDCx1",bath:0, meds:0, di:"12/06/2021", do:"12/07/2021", brought:"Nothing"},

    ]
    var dateEditor = function(cell, onRendered, success, cancel){
    //cell - the cell component for the editable cell
    //onRendered - function to call when the editor has been rendered
    //success - function to call to pass the successfuly updated value to Tabulator
    //cancel - function to call to abort the edit and return to a normal cell

    //create and style input
    var cellValue = luxon.DateTime.fromFormat(cell.getValue(), "dd/MM/yyyy").toFormat("yyyy-MM-dd"),
    input = document.createElement("input");

    input.setAttribute("type", "date");

    input.style.padding = "4px";
    input.style.width = "100%";
    input.style.boxSizing = "border-box";

    input.value = cellValue;

    onRendered(function(){
        input.focus();
        input.style.height = "100%";
    });

    function onChange(){
        if(input.value != cellValue){
            success(luxon.DateTime.fromFormat(input.value, "yyyy-MM-dd").toFormat("dd/MM/yyyy"));
        }else{
            cancel();
        }
    }

    //submit new value on blur or change
    input.addEventListener("blur", onChange);

    //submit new value on enter
    input.addEventListener("keydown", function(e){
        if(e.keyCode == 13){
            onChange();
        }

        if(e.keyCode == 27){
            cancel();
        }
    });

    return input;
    };



    // Create Table with Components
    var table = new Tabulator("#data-table", {
      ajaxURL:"dogs.php",
      reactiveData:true,
      layout:"fitcolumns",
      height:"1000px",
      responsiveLayout:"hide",
      tooltips:true,
      resizableRows:true,
      selectable:false,


      columns:[
          {title:"Name", field:"name",width:200, editor:true, resizable:false},
          {title:"Location", field:"location",hozAlign:"center", editor:true,resizable:false},
          {title:"Misc", field:"misc",editor:true,resiazble:true},
          {title:"Meds?", field:"meds", width:100, hozAlign:"center", formatter:"tickCross", sorter:"boolean", editor:true,resizable:false},
          {title:"Bath?", field:"bath", width:100, hozAlign:"center", formatter:"tickCross", sorter:"boolean", editor:true,resizable:false},
          {title:"Date In", field:"di",hozAlign:"center", resizable:false, sorter:"date", editor:dateEditor},
          {title:"Date Out", field:"date_out",hozAlign:"center", resizable:false, sorter:"date", editor:dateEditor},
          {title:"Brought", field:"brought",width:200, editor:true,resizable:true},
          {title:"Delete",formatter:"buttonCross", width:100, hozAlign:"center",resizable:false, cellClick:function(e, cell){
            cell.getRow().delete();
          }},
        ],



    })


    // Get Add Button Working
    document.getElementById("add-row").addEventListener("click", function(){
      table.addRow({},true);
    })

    </script>

    <footer>
      <p>PRODUCED BY:  LOGAN PIKE</p>


    </footer>

</body>

</html>
