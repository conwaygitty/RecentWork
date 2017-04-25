function Tooltip()
{
	this.ajaxurl 	 = "/wp-admin/admin-ajax.php";
	this.data		 = '';
	this.div_info 	 = "#players-tool-tip-info";
	this.datatype	 = 'json';	
	this.action_call = 'article_player_tool_tips';			
};

Tooltip.prototype.attach_tool_tips = function() 
{
	//console.log("json data:"+this.data);
	
	$.each(this.data, function(key,tooltip_value){
    	//console.log("playerID:"+key);
    	var player = $('[data-player="'+ key +'"]');
		
		$.each(player, function(key,value){
	    	//console.log("!player:"+key+"|"+value);
	    	$(this).attr("title", tooltip_value);
	    	$(this).attr("data-toggle", "tooltip");
	    	$(this).attr("data-placement", "auto");
	    	$(this).attr("data-html", "true");
	    	$(this).attr("data-trigger", "hover click focus");
		});	
			   	
	});
};

Tooltip.prototype.attach_team_tool_tips = function() 
{
	//console.log("json data:"+this.data);
	
	$.each(this.data, function(key,tooltip_value){
    	// console.log("TeamID:"+key);
    	var team = $('[data-team="'+ key +'"]');
		
		$.each(team, function(key,value){
	    	//console.log("!team:"+key+"|"+value);
	    	$(this).attr("title", tooltip_value);
	    	$(this).attr("data-toggle", "tooltip");
	    	$(this).attr("data-placement", "auto");
	    	$(this).attr("data-html", "true");
	    	$(this).attr("data-trigger", "hover click focus");
		});	
			   	
	});
};

Tooltip.prototype.get_tooltip = function() 
{
	var loadUrl				= this.ajaxurl;
	var objRequest 			= {};
	var data				= "";

	objRequest.action		= this.action_call;
	objRequest.post_id		= $( this.div_info ).data('post');//'2009926';
	objRequest.theme 		= 'genesis';
	objRequest.league 		= $( this.div_info ).data('league');
	objRequest.json_output  = true;
	
	$.ajax({
	     type:		"GET",
         async:       false, 
         dataType:  this.datatype,	     
	     url:       loadUrl,	     
	     data:      objRequest, 
	     success:function(result)
	     {
	    	 data 		= result;
	    	 this.data 	= result;
	     }, 
	 	 error:function(e)
	 	 {
	 		 //alert('nooo');
			//console.log(e);
	 	 }        
	 });
	 
	this.data 	= data;
	//console.log("afterzz:"+data);
	//console.log("afterzz:"+this.data);
	return data;
};


Tooltip.prototype.get_post_id = function(id) 
{
	var element = $( id ).data('post');
	return element;
};


