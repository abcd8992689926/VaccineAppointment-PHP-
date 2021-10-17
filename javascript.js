function next(obj,target2)
  {
     var target =document.getElementById(target2);
       if( obj.value.length ==obj.getAttribute('maxlength'))
           {
               target.focus();
           }
       return;
  }