function ajax( a )
{

    var XHR = new XMLHttpRequest(  );
    
    if ( a.element )
    {

        var element = document.getElementById( a.element );
        if ( a.load == true ) element.innerHTML = '<img src=\'http://' + window.location.hostname + '/images/ajax/load.gif\' alt=\'\'/>';
    
    }
    
    XHR.onreadystatechange = function(  )
    {
        if ( XHR.readyState == 4 )
        {
            if ( XHR.status == 200 )
            {
                if ( a.element && a.response == true ) element.innerHTML = XHR.responseText;
            }
        }
    }


    if ( a.method == 'POST' )
    {
      
        XHR.open( 'POST', 'http://' + window.location.hostname + '/' + a.url, true  );
        XHR.setRequestHeader( 'content-type', 'application/x-www-form-urlencoded' );    
  
    }
    else
    {

        XHR.open( 'GET', 'http://' + window.location.hostname + '/' + a.url + ( a.vars ? '?' + a.vars : '' ), true );
  
    }

    XHR.send( a.vars ? a.vars : null );

}