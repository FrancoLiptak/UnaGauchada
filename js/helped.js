$(document).ready(function(){ 
   $('#body').show();
   $('#all').show('slow');
   $('#buttonAll').on('click',function(){
        $('#accepted').hide();
        $('#pending').hide();
        $('#rejected').hide();
        $('#calificated').hide();
        $('#all').show('slow');
   });
   $('#buttonAccepted').on('click',function(){
        $('#all').hide();
        $('#pending').hide();
        $('#rejected').hide();
        $('#calificated').hide();
        $('#accepted').show('slow');
   });
   $('#buttonPending').on('click',function(){
        $('#all').hide();
        $('#accepted').hide();
        $('#rejected').hide();
        $('#calificated').hide();
        $('#pending').show('slow');
   });
   $('#buttonRejected').on('click',function(){
        $('#all').hide();
        $('#pending').hide();
        $('#accepted').hide();
        $('#calificated').hide();
        $('#rejected').show('slow');
   });
   $('#buttonCalificated').on('click',function(){
        $('#all').hide();
        $('#pending').hide();
        $('#accepted').hide();
        $('#rejected').hide();
        $('#calificated').show('slow');
   });
});