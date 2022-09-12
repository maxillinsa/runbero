function Tvar(obj){
	
	return document.getElementById(obj);
}

function clearlistbox(lb) {
                for (var i = lb.options.length - 1; i >= 0; i--) {
                    lb.options[i] = null;
                }
                lb.selectedIndex = -1;
            }

   function getParameterByName(name) {
                 name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
                 var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
                 return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
             }
			 
			 String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};
               function checkEmail(personi) {

                   var email = personi;
                   var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

                   if (!filter.test(email)) {
                       return false;
                   }
               }
			   
			   
			   function Terror(errdetails,diva){
				   
				   Tvar(diva).innerHTML="<div class='alert alert-danger' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>"+errdetails+"</div>"
			   }