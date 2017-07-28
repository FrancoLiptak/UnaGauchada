function ordenar(arrayJS, criterio){
    if (criterio == 'ascendente'){
        return arrayJS.sort(function (a, b) {
            return (a.reputacion - b.reputacion)
        })
    }else{
        return arrayJS.sort(function (a, b){
                return (b.reputacion - a.reputacion)
            })
    }
}

function showResults(arrayJS, criterio){
    arrayJS = ordenar(arrayJS, criterio);
    for(var i=0;i<arrayJS.length;i++){
        document.write("<tr>");
        document.write("<td align='center'>");
        document.write("<p id='n"+i+"'>"+arrayJS[i]["nombre"]+"</p>");
        document.write("</td>");
        document.write("<td align='center'>");
        document.write("<p id='a"+i+"'>"+arrayJS[i]["apellido"]+"</p>");
        document.write("</td>");
        document.write("<td align='center'>");
        document.write("<p id='r"+i+"'>"+arrayJS[i]["reputacion"]+"</p>");
        document.write("</td>");
        document.write("<td align='center'>");
        document.write("<p id='l"+i+"'>"+arrayJS[i]["logro"]+"</p>");
        document.write("</td>");
        document.write("</tr>");
    }
}

function showResults2(arrayJS, criterio){
    arrayJS = ordenar(arrayJS, criterio);
    for(var i=0;i<arrayJS.length;i++){
        document.getElementById("n"+i).innerHTML = arrayJS[i]["nombre"];
        document.getElementById("a"+i).innerHTML = arrayJS[i]["apellido"];
        document.getElementById("r"+i).innerHTML = arrayJS[i]["reputacion"];
        document.getElementById("l"+i).innerHTML = arrayJS[i]["logro"];
    }
}
