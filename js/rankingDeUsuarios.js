function ordenar(arrayJS, criterio){
    if (criterio == 'ascendente'){
        return arrayJS.sort(function (a, b) {
            return (a.reputacion - b.reputacion)
        })
    }else{
        return arrayJS.sort(function (a, b){
                return (b.value - a.value)
            })
    }
}

function showResults(arrayJS, criterio){
    arrayJS = ordenar(arrayJS, criterio);
    for(var i=0;i<arrayJS.length;i++){
        document.write("<tr>");
        document.write("<td align='center'>");
        document.write(arrayJS[i]["nombre"]);
        document.write("</td>");
        document.write("<td align='center'>");
        document.write(arrayJS[i]["apellido"]);
        document.write("</td>");
        document.write("<td align='center'>");
        document.write(arrayJS[i]["reputacion"]);
        document.write("</td>");
        document.write("<td align='center'>");
        document.write(arrayJS[i]["logro"]);
        document.write("</td>");
        document.write("</tr>");
    }
}