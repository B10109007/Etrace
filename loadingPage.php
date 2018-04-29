<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/chi.css">
        <title></title>      
        <style>.vertical-alignment-helper {
                display:table;
                height: 100%;
                width: 100%;
                pointer-events:none; /* This makes sure that we can still click outside of the modal to close it */
            }
            .vertical-align-center {
                /* To center vertically */
                display: table-cell;
                vertical-align: middle;
                pointer-events:none;
            }
            .modal-content {
                /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
                width:inherit;
                height:inherit;
                /* To center horizontally */
                margin: 0 auto;
                pointer-events: all;
            }</style>
    </head>
    <body>
        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" 
   data-keyboard="false" >
            <div class="vertical-alignment-helper">
                <div class="modal-dialog vertical-align-center">
                    <div class="modal-content" style="width: 150px">               
                        <div class="modal-body" style="text-align:center;"><h4 id="text"><i class="fa fa-spinner fa-spin"></i> 請稍後</h4></div>                
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $("#myModal").modal();
        </script>
    </body>

</html>
