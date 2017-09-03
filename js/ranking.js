$(document).ready(function() {
    $('#example').DataTable( {
        "language": {
            "url": "js/spanishRanking.json"
        },
        "order": [[ 3, "desc" ]]
        
   
    } );
} );