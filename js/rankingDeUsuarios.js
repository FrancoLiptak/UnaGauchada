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
                                    alert("hola");
    arrayJS = ordenar(arrayJS, criterio);
    for(var i=0;i<arrayJS.length;i++){
        alert("n"+i);
        document.getElementById("n"+i).innerHTML = arrayJS[i]["nombre"];
        document.getElementById("a"+i).innerHTML = arrayJS[i]["apellido"];
        document.getElementById("r"+i).innerHTML = arrayJS[i]["reputacion"];
        document.getElementById("l"+i).innerHTML = arrayJS[i]["logro"];
    }
}

