<div class="card-datatable table-responsive">


    <div class="col-md-12 text-left">
        <label class="us_sty" > Title </label> <br>
        {{$service->title}} 
    </div>  
    
    <div class="col-md-12">   <hr></div>  
        
        <div class="col-md-12 text-left">
               <label class="us_sty" > Sub Title </label> <br>
               {{$service->sub_title}}
        </div> 
        
        <div class="col-md-12"> <hr></div>   
         
        <div class="col-md-12 text-left">
             <label class="us_sty" > Duration </label> <br>
             {{$service->duration}}  
        </div> 
        
        <div class="col-md-12"> <hr></div>   
        
        <div class="col-md-12 text-left">
            <label class="us_sty" > Price </label>  <br>
            {{$service->price}} 
        </div>
                
            <div class="col-md-12"> <hr></div> 
      
            <div class="col-md-12 text-left note-editor">
                
                 <label class="us_sty" > Description </label>
                 {!!$service->description!!}
        </div>   
</div>

