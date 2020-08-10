@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Material Dashboard')])

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet"> 
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> 

<div class="team">
    <div class="container">
                
        <div class="row">
            <div class="col-lg-12 col-lg-offset-3 text-center">  
                <h2><span class="ion-minus"></span>Nuestro equipo<span class="ion-minus"></span></h2>
            </div> 
        </div>
    		    		
    	<div class="row text-center" id="collaborators">
    			
    		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    				   
    				   	<img class="img-rounded" alt="team-photo" src="https://res.cloudinary.com/mateo-loaiza-rios/image/upload/v1597094865/first_image.jpg" width="60%"  height="48.5%"> 
    				   	
    				   	<div class="team-member">
                        
    				   	<h4>Mateo Loaiza Rios</h4>
    				   	
    				   	<p>Ingeniero de sistemas y telecomunicaciones</p>
                        
    				   	</div>
    				   	
    				   	<p class="social">
                            <a href="https://www.linkedin.com/in/mateo-loaiza-rios/" target="_blank"><span class="fa fa-linkedin-square"></span></a>
    				   		<a href="https://github.com/loaizamateo" target="_blank"><span class="fa fa-github-square"></span></a>
    				   		<a href="https://twitter.com/loaizamateo" target="_blank"><span class="fa fa-twitter-square"></span></a>
    				   		<a href="mailto:mateoloaiza1227@gmail.com" target="_blank"><span class="fa fa-google-plus-square"></span></a>
    				   	</p>
    						    					    				
    		 </div> <!--col-lg-4 -->
    				
    		 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    				   
    				   	<img class="img-rounded" alt="team-photo" src="https://media-exp1.licdn.com/dms/image/C4E03AQH06VSv_MRaUg/profile-displayphoto-shrink_200_200/0?e=1602720000&v=beta&t=nPXIOft4hW2fn7pXWqlIjg9WdXG3TjHW8hV_y3T99EI" width="60%">
    				   	
    				   	<div class="team-member">
                        
    				   	<h4>Wilfredo Holguin Arbeláez</h4>
    				   	
                           <p>Ingeniero de sistemas y telecomunicaciones</p>
                        
    				   	</div>
    				   	
    				   	<p class="social">
                            <a href="https://www.linkedin.com/in/wilfredo-holgu%C3%ADn-arbel%C3%A1ez-396771173/" target="_blank"><span class="fa fa-linkedin-square"></span></a>
    				   		<a href="https://github.com/wilfredoha"><span class="fa fa-github-square" target="_blank"></span></a>
    				   		<a href="mailto:wilfredoholguin76@gmail.com"><span class="fa fa-google-plus-square" target="_blank"></span></a>
    				   	</p>
    						    					    				
    		 </div> <!--col-lg-4 -->
                   
    	</div>  <!-- row text-center -->
    			
    </div>    
</div>
@endsection