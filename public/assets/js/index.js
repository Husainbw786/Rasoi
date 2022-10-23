/*
	registration form 
 */
function getValue(value){
	value=value.trim()
	if(value.length!=0){
		value = value[0].toUpperCase() + value.substring(1).toLowerCase(); 
		value =  value.replace(/[^A-Z]+/ig, "");
	}
	return value;	
}

/*
	Jquery Function start here
 */
$(function () {
	var controller_address ='../Controller/database_controller.php'
	var flag = {
				f_name:false,
				email: false,
				pswrd_strng:false,
				pswrd_mth:false,
				email_exist_chk:false}
	var login_flag ={
			email_chck: false,
			password:false,
			email_auth:false
	}
	var random =1;
	/*
		Start when  Dom load Ready function start here
	 */	
	jQuery(document).ready(function($) {
		$('.animation  #progress_bar').css('display','block')
		images_load()
		recipe_for_user_cards()
		random_fact()
		radndom_jokes();
		cards_load();
		diet_cards()	
		cuisine_cards()	
		menu_item_types_cards('appetizer')
		occasional_cards()
		$('.container  #progress_bar').css('display','none')
	})

	/* scroll auto close */
    var scroll_flag = false;
	$('nav .nav-item').click(function(){
        console.log('inside link funtion');   
    	if(scroll_flag){
        	
        	$('nav .navbar-toggler').click();
        	scroll_flag=false;
        	console.log('inside link funtion if');
    	}
	})
    	
	$('nav .navbar-toggler').click(function(){
		scroll_flag=true;
    	console.log('inside navbtn clicked');
	})
	/* scroll auto close */

	/*
		Start when Dom load Ready function start here
 	*/

	 /*
	 Random Fact when it start!
	  */
	async function random_fact(){
		var request = {

			'type': 'just_data',
			'category': 'misc',
			'rand':random++,
			'sub_category':'fact'
		};

		console.log('-----------------Rabdom fact----------------------------------')
		console.log('before')
		var val = await call_ajax(request);
		val = JSON.parse(val)
		$('.streak .random_quates').html('<strong>'+val.text+'</strong>')
		console.log(val)	 	
		console.log('after')	 	
		console.log('-----------------Rabdom fact----------------------------------')
	}

	async function radndom_jokes(){
		var request = {

			'type': 'just_data',
			'category': 'misc',
			'rand':random++,
			'sub_category':'jokes'
		};

		console.log('-----------------Rabdom fact----------------------------------')
		console.log('before')
		var val = await call_ajax(request);
		val = JSON.parse(val)
		$('.streak .random_jokes').html('<strong>'+val.text+'</strong>')
		console.log(val)	 	
		console.log('after')	 	
		console.log('-----------------Rabdom fact----------------------------------')
	}

	/*
		Detail page
	*/
	//main function
	async function detail_page(input){
		$('.animation  #progress_bar').css('display','block')
		console.log(input)
		var request = {
			'type'			:	'new_page',
			'category'		:	'recipes',
			'sub_category'	:	'information',
			'rand'			:	random++,
			'id'			:	input,
				'query'		: 	{
				'includeNutrition'	:	'true'
			}
		};
		var msg = await call_ajax(request)
		$('.animation  #progress_bar').css('display','none')
		// console.log(msg)
		window.open('resources/detail_of_recipe.php', '_blank')
	} 

	//recipe search cards
	$('.data_card').click(function(){
		console.log($($(this).find('input:hidden')).val())
		detail_page($($(this).find('input:hidden')).val())	
	})

	//image modal detail page
	$('#modal_info .modal-footer button.source_url').click(function(){
		detail_page($(this).val())	
	})

	//detail page for ocassional event
	$('#special .card').click(function(){
		detail_page($($(this).find('input:hidden')).val())	
	})

	//detail page for Random stuff for user
	$('#recipe_for_user figure').click(function(){
		detail_page($($(this).find('input:hidden')).val())	
	})

	//detail page for cuisine
	$('#cuisine_selector .card').click(function(){
		detail_page($($(this).find('input:hidden')).val())	
	})

	//detail page for menu_types
	$('#menu_types .card').click(function(){
		detail_page($($(this).find('input:hidden')).val())	
	})

	/**
	 * [cards_load description] It will fectch the value from api and put in cards...
	 * @return {[type]} [description]
	 */
	async function cards_load(value){
		console.log('on start cards')

		var request = {

			'type': 'cards',
			'category': 'recipes',
			'sub_category':'random',
			'query': {
				'number':10
			}
		};
		console.log('before')
		var val = await call_ajax(request);
		console.log('after')

		$('#cards_views').append(val);
	}

	// cusine event
	//for cusine event
	var cuisine_flag_value=0 
	var cuisine_api_result=''
	console.log('---------outside function---------------');
	async function cuisine_cards(){
		console.log(cuisine_flag_value);
		$('.animation  #progress_bar').css('display','block')
		var img = $('#cuisine_selector .cuisine .card .view img')
		var title = $('#cuisine_selector .cuisine .card .card-body .card-title')
		var id = $('#cuisine_selector .cuisine .card .card-body input')
		if(cuisine_flag_value==0 || cuisine_flag_value==30 || cuisine_api_result==''){
			cuisine_flag_value=0;
			cuisine_api_result = await cuisine_event()
			for(var i=0;i<3 && i<cuisine_api_result.length;i++){
				$(img[i]).attr('src','https://spoonacular.com/recipeImages/'+cuisine_api_result[cuisine_flag_value].id+'-556x370.jpg')
				$(title[i]).attr('title',cuisine_api_result[cuisine_flag_value].title)
				$(title[i]).text(cuisine_api_result[cuisine_flag_value].title)
				$(id[i]).val(cuisine_api_result[cuisine_flag_value].id)
				cuisine_flag_value++
			}
		}else{
			for (var i = 0; i<3 && i<cuisine_api_result.length-cuisine_flag_value; i++) {
				$(img[i]).attr('src','https://spoonacular.com/recipeImages/'+cuisine_api_result[cuisine_flag_value].id+'-556x370.jpg')
				$(title[i]).attr('title',cuisine_api_result[cuisine_flag_value].title)
				$(title[i]).text(cuisine_api_result[cuisine_flag_value].title)
				$(id[i]).val(cuisine_api_result[cuisine_flag_value].id)
				cuisine_flag_value++	
			}
		}
		console.log('---------befor if---------------');
		console.log(cuisine_flag_value);
		$('.animation  #progress_bar').css('display','none')
		if(cuisine_api_result.length<=cuisine_flag_value){
			cuisine_api_result=''
			cuisine_flag_value=0
		}
		console.log('---------after if---------------');
		console.log(cuisine_flag_value);
	}

	//for main function
	async function cuisine_event(){
		console.log('on start images')
		var request = {
			'type': 'id_title',
			'category': 'recipes',
			'sub_category':'search',
			'rand':random++,
			'query': {
				'cuisine':$('#cuisine_selector .cuisine .custom-select').val(),
				'number':30
			}
		}
		console.log('before')
		var val = JSON.parse(await call_ajax(request));
		return val;
	}

	$('#cuisine_selector .cuisine .custom-select').change(function(){
		cuisine_flag_value=0 
		cuisine_api_result=''
		cuisine_cards()
	})
	//refresh
	$('#cuisine_selector .cuisine .refresh').click(function(){
		cuisine_cards()
	})

	// recipe_for_userevent
	//for random recipe  event
	var recipe_for_user_flag_value=0 
	var recipe_for_user_api_result=''
	console.log('---------outside function---------------');
	async function recipe_for_user_cards(){
		console.log(recipe_for_user_flag_value)
		$('.animation  #progress_bar').css('display','block')
		var img = $('#recipe_for_user  figure img')
		var id = $('#recipe_for_user  figure input')
		if(recipe_for_user_flag_value==0 || recipe_for_user_flag_value==30 || recipe_for_user_api_result==''){
			recipe_for_user_flag_value=0;
			recipe_for_user_api_result = await recipe_for_user_event()
			for(var i=0;i<6 && i<recipe_for_user_api_result.length;i++){
				$(img[i]).attr('src','https://spoonacular.com/recipeImages/'+recipe_for_user_api_result[recipe_for_user_flag_value].id+'-556x370.jpg')
				$(img[i]).attr('title',recipe_for_user_api_result[recipe_for_user_flag_value].title)
				$(id[i]).val(recipe_for_user_api_result[recipe_for_user_flag_value].id)
				recipe_for_user_flag_value++
			}
		}else{
			for (var i=0; i<6 && i<recipe_for_user_api_result.length-recipe_for_user_flag_value; i++) {
				$(img[i]).attr('src','https://spoonacular.com/recipeImages/'+recipe_for_user_api_result[recipe_for_user_flag_value].id+'-556x370.jpg')
				$(img[i]).attr('title',recipe_for_user_api_result[recipe_for_user_flag_value].title)
				$(id[i]).val(recipe_for_user_api_result[recipe_for_user_flag_value].id)
				recipe_for_user_flag_value++	
			}
		}
		console.log('---------befor if---------------');
		console.log(recipe_for_user_flag_value);
		$('.animation  #progress_bar').css('display','none')
		if(recipe_for_user_api_result.length<=recipe_for_user_flag_value){
			recipe_for_user_api_result=''
			recipe_for_user_flag_value=0
		}
		console.log('---------after if---------------');
		console.log(recipe_for_user_flag_value);
	}
	//for main function
	async function recipe_for_user_event(){
		console.log('on start images')
		var request = {
			'type': 'modal',
			'category': 'recipes',
			'sub_category':'random',
			'rand':random++,
			'query': {
				'number':30,
			}
		}
		console.log('before')
		var val = JSON.parse(await call_ajax(request));
		return val;
	}
	//refresh
	$('#recipe_for_user .refresh').click(function(){
		recipe_for_user_cards()
	})

	// Menu-items
	//for types breakfast lunch and dinner
	var menu_item_types_flag_value=0 
	var menu_item_types_api_result=''
	console.log('---------outside function---------------');
	async function menu_item_types_cards(type=''){
		console.log(menu_item_types_flag_value);
		$('.animation  #progress_bar').css('display','block')
		var img = $('#menu_types  .card .view img')
		var title = $('#menu_types  .card .card-body .card-title')
		var id = $('#menu_types  .card .card-body input')
		if(menu_item_types_flag_value==0 || menu_item_types_flag_value==30 || menu_item_types_api_result==''){
			menu_item_types_flag_value=0;
			menu_item_types_api_result = await menu_item_types_event(type)
			for(var i=0;i<3 && i<menu_item_types_api_result.length;i++){
				$(img[i]).attr('src','https://spoonacular.com/recipeImages/'+menu_item_types_api_result[menu_item_types_flag_value].id+'-556x370.jpg')
				$(title[i]).attr('title',menu_item_types_api_result[menu_item_types_flag_value].title)
				$(title[i]).text(menu_item_types_api_result[menu_item_types_flag_value].title)
				$(id[i]).val(menu_item_types_api_result[menu_item_types_flag_value].id)
				menu_item_types_flag_value++
			}
		}else{
			for (var i = 0; i<3 && i<menu_item_types_api_result.length-menu_item_types_flag_value; i++) {
				$(img[i]).attr('src','https://spoonacular.com/recipeImages/'+menu_item_types_api_result[menu_item_types_flag_value].id+'-556x370.jpg')
				$(title[i]).attr('title',menu_item_types_api_result[menu_item_types_flag_value].title)
				$(title[i]).text(menu_item_types_api_result[menu_item_types_flag_value].title)
				$(id[i]).val(menu_item_types_api_result[menu_item_types_flag_value].id)
				menu_item_types_flag_value++	
			}
		}
		console.log('---------befor if---------------');
		console.log(menu_item_types_flag_value);
		$('.animation  #progress_bar').css('display','none')
		if(menu_item_types_api_result.length<=menu_item_types_flag_value){
			menu_item_types_api_result=''
			menu_item_types_flag_value=0
		}
		console.log('---------after if---------------');
		console.log(menu_item_types_flag_value);
	}

	//for main function
	async function menu_item_types_event(type){
		console.log('on start images')
		var request = {
			'type': 'id_title',
			'category': 'recipes',
			'sub_category':'search',
			'rand':random++,
			'query': {
				'type':type,
				'number':30
			}
		}
		console.log('before')
		var val = JSON.parse(await call_ajax(request));
		return val;
	}

	$('#menu_types .button button').click(function(){
		menu_item_types_flag_value=0 
		menu_item_types_api_result=''
		menu_item_types_cards($(this).val())
	})
	//refresh
	$('#menu_types .refresh').click(function(){
		menu_item_types_cards()
	})

	// diet event
	//for die event
	var diet_flag_value=0 
	var diet_api_result=''
	console.log('---------outside function---------------');
	async function diet_cards(){
		console.log(diet_flag_value);
		$('.animation  #progress_bar').css('display','block')
		var img = $('#cuisine_selector .diet .card .view img')
		var title = $('#cuisine_selector .diet .card .card-body .card-title')
		var id = $('#cuisine_selector .diet .card .card-body input')
		if(diet_flag_value==0 || diet_flag_value==30 || diet_api_result==''){
			diet_flag_value=0;
			diet_api_result = await diet_event()
			for(var i=0;i<3 && i<diet_api_result.length;i++){
				$(img[i]).attr('src','https://spoonacular.com/recipeImages/'+diet_api_result[diet_flag_value].id+'-556x370.jpg')
				$(title[i]).attr('title',diet_api_result[diet_flag_value].title)
				$(title[i]).text(diet_api_result[diet_flag_value].title)
				$(id[i]).val(diet_api_result[diet_flag_value].id)
				diet_flag_value++
			}
		}else{
			for (var i = 0; i<3 && i<diet_api_result.length-diet_flag_value; i++) {
				$(img[i]).attr('src','https://spoonacular.com/recipeImages/'+diet_api_result[diet_flag_value].id+'-556x370.jpg')
				$(title[i]).attr('title',diet_api_result[diet_flag_value].title)
				$(title[i]).text(diet_api_result[diet_flag_value].title)
				$(id[i]).val(diet_api_result[diet_flag_value].id)
				diet_flag_value++	
			}
		}
		console.log('---------befor if---------------');
		console.log(diet_flag_value);
		$('.animation  #progress_bar').css('display','none')
		if(diet_api_result.length<=diet_flag_value){
			diet_api_result=''
			diet_flag_value=0
		}
		console.log('---------after if---------------');
		console.log(diet_flag_value);
	}

	//for main function
	async function diet_event(){
		console.log('on start images')
		var request = {
			'type': 'id_title',
			'category': 'recipes',
			'sub_category':'search',
			'rand':random++,
			'query': {
				'diet':$('#cuisine_selector .diet .custom-select').val(),
				'number':30
			}
		}
		console.log('before')
		var val = JSON.parse(await call_ajax(request));
		return val;
	}

	$('#cuisine_selector .diet .custom-select').change(function(){
		diet_flag_value=0 
		diet_api_result=''
		diet_cards()
	})
	//refresh
	$('#cuisine_selector .diet .refresh').click(function(){
		diet_cards()
	})


	//for occasional event
	var occasional_event_flag_value=0; 
	var occasional_api_result=''
	console.log('---------outside function---------------');
	async function occasional_cards(){
		console.log(occasional_event_flag_value);
		$('.animation  #progress_bar').css('display','block')
		var img = $('#special .card .view img')
		var title = $('#special .card .card-body .card-title')
		var id = $('#special .card .card-body input')
		if(occasional_event_flag_value==0 || occasional_event_flag_value==30 || occasional_api_result==''){
			occasional_event_flag_value=0;
			occasional_api_result = await ocassional_event()
			for(var i=0;i<3 && i<occasional_api_result.length;i++){
				$(img[i]).attr('src','https://spoonacular.com/recipeImages/'+occasional_api_result[occasional_event_flag_value].id+'-556x370.jpg')
				$(title[i]).attr('title',occasional_api_result[occasional_event_flag_value].title)
				$(title[i]).text(occasional_api_result[occasional_event_flag_value].title)
				$(id[i]).val(occasional_api_result[occasional_event_flag_value].id)
				occasional_event_flag_value++
			}
		}else{
			for (var i = 0; i<3 && i<occasional_api_result.length-occasional_event_flag_value; i++) {
				$(img[i]).attr('src','https://spoonacular.com/recipeImages/'+occasional_api_result[occasional_event_flag_value].id+'-556x370.jpg')
				$(title[i]).attr('title',occasional_api_result[occasional_event_flag_value].title)
				$(title[i]).text(occasional_api_result[occasional_event_flag_value].title)
				$(id[i]).val(occasional_api_result[occasional_event_flag_value].id)
				occasional_event_flag_value++	
			}
		}
		console.log('---------befor if---------------');
		console.log(occasional_event_flag_value);
		$('.animation  #progress_bar').css('display','none')
		if(occasional_api_result.length<=occasional_event_flag_value){
			occasional_api_result=''
			occasional_event_flag_value=0
		}
		console.log('---------after if---------------');
		console.log(occasional_event_flag_value);
	}
	//for main function
	async function ocassional_event(){
		console.log('on start images')
		var request = {
			'type': 'id_title',
			'category': 'recipes',
			'sub_category':'search',
			'rand':random++,
			'query': {
				'cuisine':'indian,Chinese',
				'excludeIngredients':'pork',
				'number':30
			}
		}
		console.log('before')
		var val = JSON.parse(await call_ajax(request));
		return val;
	}
	//refresh
	$('#special .refresh').click(function(){
		occasional_cards()
	})

	async function images_load(){
		console.log('on start images')
		var request = {

			'type': 'modal',
			'category': 'recipes',
			'sub_category':'random',
			'rand':random++,
			'query': {
				'number':18,
				'tags':'dessert'
			}
		};
		console.log('before')
		var val = JSON.parse(await call_ajax(request));
		console.log('after')
		console.log('--------------------got Value from api---------------------')
		var figure =$('.fig_modal')
		for (var i = val.length - 1; i >= 0; i--) {

			$(figure[i].children[0]).val(val[i].title)
			$(figure[i].children[1]).val(val[i].summary)
			$(figure[i].children[2]).val(val[i].id)
			$(figure[i].children[3]).val(val[i].source_url)
			$(figure[i].children[4]).val(val[i].img_url)
			$(figure[i].children[5]).attr('src', val[i].img_url)
		}
	}

	function call_ajax(request, url='../Controller/api_controller.php'){
		if(random==20){
			random=0
		}
		return $.ajax({
			// url: '/api_call',									//Shubham 
			url: url,				//Murtaza
			type: 'POST',
			data: request
		
		})
		.done(function(val) {
		
			console.log('--------------------------------');
			console.log('valueee got');
			console.log(val);	
			console.log('--------------------------------');
		})
		.fail(function() {
		
			console.log("error");
		})
	}

	/*
		Modal
	 */
	$('.fig_modal').click(function(){
		console.log()	
		$('.modal-footer .source_url').css('display','inline-block')
		$('.modal-footer .close').css('display','none')
		$('.modal-footer .no_thanks').css('display','inline-block')
		$('.video-container').css('display','none')
		$('.modal_img_contianer').css('display','block')
		var val =$(this).find('input')
		var associative_array_figure = new Object();
		for(var i =0; i<val.length;i++){
			console.log(val[i].name);
			associative_array_figure[val[i].name] = val[i].value;
		}
		$('.modal img.fig').attr('src','https://spoonacular.com/recipeImages/'+associative_array_figure['id']+'-556x370.jpg')
		$('.modal p.heading.lead').html('<b>'+ associative_array_figure['title'] +'<b>')
		$('.modal p.summary').html(associative_array_figure['summary'])
		$('.modal button.source_url').val(associative_array_figure['id'])
		// $('.modal a.source_url').attr('href',associative_array_figure['source_url'])
	})

	$('.video_card').click(function(){
		$('.modal-footer .source_url').css('display','none')
		$('.modal-footer .close').css('display','inline-block')
		$('.modal-footer .no_thanks').css('display','none')
		$('.video-container').css('display','block')
		$('.modal_img_contianer').css('display','none')
		console.log()	
		var title =$(this).find('.card-title')
		var youtube_id =$(this).find('input')
		$('.modal p.heading.lead').html('<b>'+ $(title).text()+'<b>')
		$('.video-container iframe').attr('src','https://www.youtube.com/embed/'+$(youtube_id).val())
	})

	$('.login_modal').click(function(){	
		//Header
		$('#ModalForm .modal-title').html('<strong>Sign in</strong>');			
		//body
		$('#ModalForm .modal-body .register').css('display','none')
		$('#ModalForm .modal-body .profile').css('display','none')
		$('#ModalForm .modal-body .login_form').css('display','block')
		$('#ModalForm').removeClass('right')
		$('#ModalForm .modal-dialog').css('margin-right','auto')
		//footer
	 	$('#ModalForm .login_registration_footer p').text('')
	})

	$('.sign_up_modal').click(function(){		
		//Header
		$('#ModalForm .modal-title').html('<strong>Sign up</strong>')
		//body
		$('#ModalForm .modal-body .login_form').css('display','none')
		$('#ModalForm .modal-body .profile').css('display','none')
		$('#ModalForm .modal-body .register').css('display','block')
		$('#ModalForm').removeClass('right')
		$('#ModalForm .modal-dialog').css('margin-right','auto')
		//footer
	 	$('#ModalForm .login_registration_footer p').text('')
	})

	$('#user_name').click(function(){		
		//Header
		$('#ModalForm .modal-title').html('<strong>User Detail</strong>')
		//body
		$('#ModalForm .modal-body .login_form').css('display','none')
		$('#ModalForm .modal-body .login_form').css('display','none')
		$('#ModalForm .modal-body .register').css('display','none')
		$('#ModalForm .modal-body .profile').css('display','block')
		$('#ModalForm').addClass('right')
		$('#ModalForm .modal-dialog').css('margin-right','0px')
		//footer
	 	$('#ModalForm .login_registration_footer p').text('')
	})

	/*
	Chatbot
	 */
	$('.chatbot').click(function() {
		var str = $('.chatbot-card').css('display');
		console.log('inside chatbot click');
		if(str=='none'){
			$('.chatbot-card').css('display','inline-grid')
		}
		else {
			$('.chatbot-card').css('display','none')	
		}
	})

	$('.close_button').click(function() {
		console.log('inside chatbot click');
		$('.chatbot-card').css('display','none')	
	})

	async function chatbot_return(msg){
		console.log('on inside chartbot')
		var dte;
		var txt = msg.replace(/ /g, "+");
		var request = {

			'type': 'chatbot',
			'category': 'misc',
			'sub_category':'chatbot',
			'rand':random++,
			'query': {
				'text': txt
			}
		};
		console.log('before')
		dte = String(new Date()).substring(0,24);
		var tagGet = '<div class="d-flex justify-content-end"><div class="msg_cotainer_send ">'+msg+'</div><div class="img_cont_msg"><img src="../public/assets/images/useravatar.png" class="rounded-circle user_img_msg"></div></div><div class="d-flex justify-content-end mb-4"><p class="f_size text-white">'+dte+'</p></div>';
		$('.chatbot-card-body.msg_card_body').append(tagGet);
		var val = await call_ajax(request);
		
		$('.chatbot-card-body.msg_card_body').append(val);

		console.log('after')
	}

	$('#send_btn').click(function() {
		var msg = $('.type_msg').val();
		console.log(msg)
		$('.type_msg').val('');
		msg =msg.trim();
		if(msg!=""){
			chatbot_return(msg);
		}	
	})

	$('.chatbot-card .type_msg').keyup(function(event){
		if(event.key == 'Enter'){
			var msg = $('.type_msg').val()
			console.log(msg)
			$('.type_msg').val('')
			msg =msg.trim()
			if(msg!=""){
				chatbot_return(msg)
			}
		}
	})

	/*
	Sign in and register
	 */
	async function registration(request){
		$('.animation  #progress_bar').css('display','block')
		var result=	JSON.parse(await call_ajax(request,controller_address))
		$('.animation  #progress_bar').css('display','none')
		if(result){
			alert('Registration SuccessFull')
			$(".register #first_name").val('')
			$(".register #last_name").val('')
			$(".register #email").val('')
			$(".register #password").val('')
			$(".register #password_chk").val('')
			$("#modal_close").click();
		}else{
			alert('Registration is not SuccessFull')
		}
		// console.log(result)
	}

 	$('.register #register').click(function(event){
	 	event.preventDefault() 	
	 	var chk = true
	 	$.each(flag, function(index, val) {
	 		if (val) {
	 			console.info('true index :'+index);
	 			return
	 		}else {
	 			chk =false
	 			console.info('false index :'+index);
				$(".login_registration_footer p").text("Enter required detail");
	 			return false;
	 		}
		});
		if(chk){			
			var request ={
				'type':'insert and update',
				'data':{
					'first_name'	:$('.register #first_name').val(),
					'last_name'		:$('.register #last_name').val(),
					'email'			:$('.register #email').val().toLowerCase(),
					'password'		:$('.register #password').val(),
					'mobile_number'	:$('.register #mobile_number').val(),
					'gender'		:$('.register .custom-radio:checked').val()
				}
			}
			registration(request)
		}
 	})

	 /*
	 registration functions
  */
 	$(".register .email #otp").keyup(async function (){
 		if($(".register .email #otp").val().length==10){
 			// console.log($(".register .email #otp").val());
 			$(".register .email #otp").addClass('disabled')
			var request={
				'type':'otp_match',
				'data':{
					'otp': $(".register .email #otp").val()
				}
			}
 			var result = await JSON.parse(await call_ajax(request,controller_address)) 
 			if(result){
				$(".register .email p").text("Email verified");
	 			$(".register .email #otp").val("")
	 			$(".register .email #otp").css('display','none')
	 			flag['email_otp']=true
 			}else{
				$(".register .email p").text("enter otp is in correct");
	 			$(".register .email #otp").val("")
	 			flag['email_otp']=false
 			}
 			$(".register .email #otp").removeClass('disabled')
 		}
 	})

  	$(".register #first_name").keyup(function (){
		console.log("inside name");
		var value = $(".register #first_name").val();
		value = getValue(value);
		console.warn(value);
		if(value!=''){
			$(".register .f-name p").text("");
			flag['f_name']=true

		}else {
			$(".register .f-name p").text("required");
			flag['f_name']=false
		}
		$(".register #first_name").val(value);	
	});
	
	//this is for last name 
	$(".register #last_name").keyup(function (){
		console.log("inside last name");
		var value = $(".register #last_name").val();
		value = getValue(value);
		$(".register #last_name").val(value);
	});

	$('.register #email').blur(async function() {
		console.log('inside on blur');
		var name =$('.register #first_name').val()
		var email=$('.register #email').val().toLowerCase()
		if(flag['email']){
			var request={
				'type':'select',
				'data':{
					'email':email,
					'verify':'email',
					'select':[
							'email'
							]
					}
				}
			var result = await JSON.parse(await call_ajax(request,controller_address)) 
			if(result){
				// console.log('email existed'+result);
				flag['email_exist_chk']=false
				$(".register .email p").text("Email existed");
			}else{
				flag['email_exist_chk']=true
				$(".register .email p").text("");
				}	
			}
	});

	// regex for email check 
	function email_regex_check(email){
		console.log('inside regex check');
		if((/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))){
			return true
		}
		return false
	}

	$(".register #email").keyup(function(){
		console.log("inside mobile number")	
		if(email_regex_check($(".register #email").val())){
			$(".register .email p").text("");
			flag['email']=true;
			$(".register .email .otp").css('display','none')
		}
		else{
			$(".register .email p").text("Enter a valid email");
			flag['email']=false
			$(".register .email .otp").css('display','none')
		}
	});	

	//password strength check
	function password_auth_chk(password){
		if(password.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/)){
			return true
		}
		return false
	}

	$(".register #password").keyup(function(){
		console.log("inside password");		
		if(password_auth_chk($(".register #password").val())){
			$(".register .password1 p").text("");
			flag['pswrd_strng']=true
		}else{
			$(".register .password1 p").text("At least 8 characters and 1 digit and 1 capital character and 1 special character");
			flag['pswrd_strng']=false
		}
	});

	//password match
	$(".register #password_chk").keyup(function(){
		console.log("inside password");
		var password1 =  $(".register #password").val();
		var password2 =  $(".register #password_chk").val();
		if(password1==password2){
			$(".register .password2 p").text("");
			flag['pswrd_mth']=true;
		}
		else{
			$(".register .password2 p").text("password does match");
			flag['pswrd_mth']=false;
		}
	});

	$('.login_form #email').blur(async function(){
		var email = $('.login_form #email').val().toLowerCase()
		if(login_flag['email_chck']){
			console.log('inside blur')
			var request={
				'type':'select',
				'data':{
					'email':email,
					'verify':'email',
					'select':[
							'email'
							]
					}
				}
			var result = await JSON.parse(await call_ajax(request,controller_address)) 
			// console.log(result);
			if(result){
				$('.login_form .email p').text('')
				login_flag['email_auth']=true
			}
			else{
				login_flag['email_auth']=false
				$('.login_form .email p').text('Email not found please enter correct email')
			}
		}
	})

	$('.login_form #password').keyup(function(){
		console.log('inside email password');
		if(password_auth_chk($(".login_form #password").val())){
			$(".login_form .password p").text("");
			login_flag['password']=true
		}else{
			$(".login_form .password p").text("Invalid password");
			login_flag['password']=false
		}
	})

	// email chck
	$('.login_form #email').keyup(function(){
		console.log('inside email login');
		console.log($(".login_form #email").val());
		if(email_regex_check($(".login_form #email").val())){
			$('.login_form .email p').text('')
			login_flag['email_chck']=true		
		}else{
			$('.login_form .email p').text('Invalid Email')
			login_flag['email_chck']=false		

		}
	});

	//submit login
	async function login_chk(request){
		$('.animation  #progress_bar').css('display','block')	
		var result = JSON.parse(await call_ajax(request,controller_address));
		// console.log(result);
		if(result){
			alert('login successfull')
			location.reload();
			$('.login_form #email').val('')	
			$('.login_form #password').val('')
			$("#modal_close").click()

		}else{
			$('.login_form #password').val('')
			alert('invalid password')

		}
		$('.animation  #progress_bar').css('display','none')
	}	

	$('.login_form #login_submit').click(function(event) {
		event.preventDefault()
		var chk = true
	 	$.each(login_flag, function(index, val) {
	 		if (val) {
	 			console.info('true index :'+index);
	 			return
	 		}else {
	 			chk =false
	 			alert('please enter Valid credentials')
	 			console.info('false index :'+index);
	 			return false;
	 		}
		});
		if(chk){			
			var request ={
				'type':'login_chk',
				'data':{
					'email'			:$('.login_form #email').val().toLowerCase(),
					'password'		:$('.login_form #password').val(),
				}
			}
			console.log('convert to local');
			console.log($('.login_form #email').val().toLowerCase());
			login_chk(request)
		}
	});

	/*
	search box
	 */
	
	//show all items after click
	function show_all_item(){
		$('#home').css('display','block')
		$('.all_div_to_hide').css('display','block')
		$('footer').css('display','block')
		$('.main-search .search-input').val('');
		$('.search_background_div').css('padding-top', '30px');
		$('.search_background_div').css('padding-bottom', '30px');
	}

	//hide search items
	function hide_search_bar_items(){
		$('.main-search .search-input').val('');
		$('.data_card').css('display', 'none')
		$('.video_card').css('display','none')
		$('.search_background_div').css('position','inherit')
		$('.video_search').css('display','none');
		$('.for_ingredient_tag .chip').remove()
		$('h6.recipe').css('display','none')
		$('.used_ingredient').css('display','none')
		$('.missed_ingredient').css('display','none')
		$('.search_tag').css('display','none')
		$('.main-search .search-icon').css('display','block')
		$('.main-search .search-input').css('border-radius','0px')
	}
	// home-link makes everything normal
	$('nav #home-link').click(function (){
		show_all_item()
		hide_search_bar_items()
		window.location.href = '#home'
	})
	// about-link 
	$('nav #about-link').click(function (){
		show_all_item()
		hide_search_bar_items()
		window.location.href = '#about'
	})

	$('nav #cuisine-link').click(function (){
		show_all_item()
		hide_search_bar_items()
		window.location.href = '#cuisine_selector'
	})

	$('nav #special-link').click(function (){
		show_all_item()
		hide_search_bar_items()
		window.location.href = '#recipe_for_user'
	})

	//show search display
	function show_search_display(){
		$('#home').css('display','none')
		$('.all_div_to_hide').css('display','none')
		$('footer').css('display','none')
		$('.search_background_div').css('padding-top', '100px');
		$('.search_background_div').css('padding-bottom', '150px');
	} 

	// search-item {}
	$('nav #search-link').click(function (){
		show_search_display()
		hide_search_bar_items()
	})


	var recipe_global_val=''
	var ofset_global_val=0
	function tag_maker(img, value){
		if(img==0){
			return '<div class="chip"><span class="ingredient">'+value+'</span><i class="close fas fa-times" onclick="detail_of_item(this)"></i></div>';
		}else {
			return '<div class="chip"><img src="'+img+'" alt="Ingredient"><span class="ingredient">'+value+'</span><i class="close fas fa-times" onclick="detail_of_item(this)"></i></div>';
		}
	}

	$('.main-search .suggession_bar_item').click(function() {
		var chip =$('.for_ingredient_tag .chip span.ingredient')
		recipe_global_val=''
		for(var i = 0; i<chip.length; i++){
			recipe_global_val+= chip[i].innerHTML+',+'
		}
		recipe_global_val+=$(this).children('span').text()
		console.info('--------------------------------------------');
		console.info(recipe_global_val);
		search_recipe_or_ingredient(0,recipe_global_val)
		var ingredient_name = $(this).children('span').text()
		var image_url = $(this).children('img').attr('src')
		$('.suggession_bar').css('display','none');
		console.log(ingredient_name)
		var chip = tag_maker(image_url,ingredient_name)
		$('.margin_padding_background').css('display','block')
		$('.for_ingredient_tag').append(chip)
		$('.search-input').val('');
	});

	$('.main-search .dropdown .dropdown-item').click(function() {		
		// $('.search_background_div').css('margin-bottom', '50px');
		ofset_val=0
		hide_search_bar_items()
		console.log('main function');
		console.log($(this).text());
		console.log('--------------inside dropdown------------');
		show_search_display()
		$('.main-search #dropdownMenu').html('<strong>'+$(this).text()+'</strong>')
		if($(this).text()=='Advance Search'){
			$('.search_tag').css('display','block')
			$('.search_background_div').css('margin-bottom', '0px');
			$('.search_background_div').css('padding-bottom', '20px');
		}else if($(this).text()=='Ingredient'){
			$('.main-search .search-icon').css('display','none')
			$('.main-search .search-input').css('border-radius','0px 10px 10px 0px')
		}else if($(this).text()=='Video Search'){
			$('.video_search').css('display','block');
		}
	});

	$('.card_main .refresh').click(function(){
		ofset_global_val+=18
		console.info(ofset_global_val)
		search_recipe_or_ingredient(ofset_global_val,recipe_global_val)
	})

	async function search_recipe_or_ingredient(ofset_val, recipe_val){
		$('.card_main .refresh').css('display','block')
		$('.animation  #progress_bar').css('display','block')
		$('.data_card img').css('display','block')
		$('.used_ingredient .chip').remove()
		$('.missed_ingredient .chip').remove()
		$('h6.recipe').css('display','none')
		recipe_val = recipe_val.replace(/\s/g,'+')
		recipe_global_val=recipe_val
		var value=$('.main-search #dropdownMenu').text()
		if (value=='Recipe'){
			console.log('before if')
			if(!(recipe_val.trim()=='') &&  !(/[^a-zA-Z0-9\-\/]/.test(recipe_val.trim()))){
			
				console.log('Inside recipe or ingredient function Inside IF')
				var request = {

					'type': 'just_data',
					'category': 'recipes',
					'sub_category':'search',
					'rand':random++,
					'query': {
						'query': recipe_val,
						'offset': ofset_val,
						'number': 18,	
					}
				};
				console.log('------------------------------------------------')
				console.log('before')
				var varaiable = await call_ajax(request);
				var val = JSON.parse(varaiable);
				if(val!=null){			
					console.log(val.baseUri)
					var imageUrl   =val.baseUri
					var cardsImg   = $('.data_card .card-cascade .card-img-top')
					var cardsTitle = $('.data_card .card-cascade .card-title')
					var cardsInput = $('.data_card .card-cascade input')
					var cardsPrep  =	$('.data_card .card-cascade span.prep') 
					var cardsServ  =	$('.data_card .card-cascade span.serv')
					for(var i=0; i<val.results.length; i++){
						$(cardsTitle[i]).attr('title',val.results[i].title)
						$(cardsImg[i]).attr('src',imageUrl+val.results[i].image)	
						$(cardsTitle[i]).text(val.results[i].title)
						$(cardsInput[i]).val(val.results[i].id)
						$(cardsPrep[i]).text(val.results[i].readyInMinutes)
						$(cardsServ[i]).text(val.results[i].servings)
						$(cardsServ[i]).parent().css('display', 'block');
						$(cardsPrep[i]).parent().css('display', 'block');
						console.log('value insertion: '+i)
						$(cardsImg[i]).parent().parent().parent().css('display', 'block')
					}
				}
				
				console.log('------------------------------------------------')
				// console.log(val)
				console.log('------------------------------------------------')
				console.log('after')
			}
			else {
				alert('Please Enter valid recipe name')
			}
		}else if (value=='Ingredient') {
			console.log('Inside Ingredient function Inside IF')
			var request = {
				'type': 'just_data',
				'category': 'recipes',
				'sub_category':'ingredients',
				'rand':random++,
				'query': {
					'ingredients': recipe_val,
					'offset': ofset_val,
					'number': 18	
				}
			}
			console.log('------------------------------------------------')
			console.log('before')
			var varaiable = await call_ajax(request)
			var val = JSON.parse(varaiable)
			// $('.card.card-cascade').parent().removeClass('col-md-4')
			// $('.card.card-cascade').parent().addClass('col-md-6')
			if(val!=null){	
				var cardsImg   = $('.data_card .card-cascade .card-img-top')
				var cardsTitle = $('.data_card .card-cascade .card-title')
				var cardsInput = $('.data_card .card-cascade input')
				var missedIngredientsDiv = $('.data_card .card-cascade .missed_ingredient')
				var usedIngredientsDiv = $('.data_card .card-cascade .used_ingredient')
				$('.used_ingredient .chip').remove()
				$('.missed_ingredient .chip').remove()
				for(var i=0; i<val.length; i++){
					$(cardsTitle[i]).attr('title',val[i].title)
					$(cardsImg[i]).attr('src',val[i].image)	
					$(cardsTitle[i]).text(val[i].title)
					$(cardsInput[i]).val(val[i].id)
					$(cardsImg[i]).parent().parent().parent().css('display', 'block')	
					var flag=0
					for(var j=0;j<val[i].missedIngredients.length;j++){
						var missDiv = '<div class="chip"><input type="hidden" name="id" value="'+val[i].missedIngredients[j].id+'"><img src="'+val[i].missedIngredients[j].image+'" alt="Ingredient"><span>'+val[i].missedIngredients[j].name+'</span></div>'
						$(missedIngredientsDiv[i]).append(missDiv)
						flag=1;
					}
					if(flag){
						$(missedIngredientsDiv[i]).css('display','block')
					}
					flag=0

					for(var j=0;j<val[i].usedIngredients.length;j++){
						var missDiv = '<div class="chip"><input type="hidden" name="id" value="'+val[i].usedIngredients[j].id+'"><img src="'+val[i].usedIngredients[j].image+'" alt="Ingredient"><span>'+val[i].usedIngredients[j].name+'</span></div>'
						$(usedIngredientsDiv[i]).append(missDiv)
						flag=1
					}
					if(flag){
						$(usedIngredientsDiv[i]).css('display','block')
					}

					console.log('value insertion: '+i)
				}
			}
			console.info(val)
		}else if (value=='Advance Search'){
			var cuisine            =	$('.search_tag .cuisine').children('.chip')
			var diet               =	$('.search_tag .diet').children('select').val()
			var intolerance        =	$('.search_tag .intolerance').children('.chip')
			var type               =	$('.search_tag .type').children('select').val()
			var include_ingredient =	$('.search_tag .include_ingredient').children('.chip')
			var exclude_ingredient =	$('.search_tag .exclude_ingredient').children('.chip')
			var slider_input_value =	$('.search_tag .custom-range')
			var nutrition_input    =	$('.search_tag .nutrition_value')
			var nutri_val_arr      =	{}

			var str=''
			if(recipe_val!=''){
				nutri_val_arr['query']=recipe_val
			}
			if(cuisine.length){
				for (var i = cuisine.length - 1; i >= 0; i--) {
					str+=	$(cuisine[i]).text()+','
				}
				console.info(str);
				str=str.substring(0,str.length-1)
				console.info(str);
				nutri_val_arr['cuisine']=str
				console.warn(str);
				str=''
			}
			if(intolerance.length){
				for (var i = intolerance.length - 1; i >= 0; i--) {
					str+=	$(intolerance[i]).text()+','
				}	
				str=str.substring(0,str.length-1)
				nutri_val_arr['intolerances']=str
				console.warn(str);
				str=''
			}
			if(include_ingredient.length){
				for (var i = include_ingredient.length - 1; i >= 0; i--) {
					str+=	$(include_ingredient[i]).text()+','
				}	
				str=str.substring(0,str.length-1)
				nutri_val_arr['includeIngredients']=str
				console.warn(str);
				str=''
			}
			if(exclude_ingredient.length){
				for (var i = exclude_ingredient.length - 1; i >= 0; i--) {
					str+=	$(exclude_ingredient[i]).text()+','
				}	
				str=str.substring(0,str.length-1)
				nutri_val_arr['excludeIngredients']=str
				console.warn(str);
			}
			if(type!='all'){	
				nutri_val_arr['type']=type
			}
			if(diet!='all'){	
				nutri_val_arr['diet']=diet
			} 	
			for (var i = nutrition_input.length - 1; i >= 0; i--) {
				if($(slider_input_value[i]).val() == 0 || 
					(($(nutrition_input[i]).val()=='minCarbs' || 
						$(nutrition_input[i]).val()=='minProtein') && 
							$(slider_input_value[i]).val()==10) ||
					(($(nutrition_input[i]).val()=='minCalories') && 
							$(slider_input_value[i]).val()==50) ||
					(($(nutrition_input[i]).val()=='minFat') && 
							$(slider_input_value[i]).val()==1)){
					continue;
				}
				else {
					nutri_val_arr[$(nutrition_input[i]).val()]=$(slider_input_value[i]).val()
					}
			}
			nutri_val_arr['number'] = 18
			nutri_val_arr['offset'] = 18
			// console.info(nutri_val_arr);
			var request = {
					'type': 'just_data',
					'category': 'recipes',
					'sub_category':'complex',
					'rand':random++,
					'query': nutri_val_arr
				};
			var val = await call_ajax(request)
			val = JSON.parse(val);
			console.info('-----------------------------------');
			// console.info(val);
			console.info('-----------------------------------');
			if(val!=null){	
				var cardsImg   = $('.data_card .card-cascade .card-img-top')
				var cardsTitle = $('.data_card .card-cascade .card-title')
				var cardsInput = $('.data_card .card-cascade input')
				for(var i=0; i<val.results.length; i++){
					$(cardsTitle[i]).attr('title',val.results[i].title)
					$(cardsImg[i]).attr('src',val.results[i].image)	
					$(cardsTitle[i]).text(val.results[i].title)
					$(cardsInput[i]).val(val.results[i].id)
					$(cardsImg[i]).parent().parent().parent().css('display', 'block')
				}
			}	
		}else if (value=='Video Search'){
			console.log('before if')
			$('.card_main .refresh').css('display','none')
			console.log('Inside recipe or ingredient  Video function function Inside IF')
			var cuisine            =	$('.video_search .cuisine').children('.chip')
			var diet               =	$('.video_search .diet').children('select').val()
			var type               =	$('.video_search .type').children('select').val()
			var include_ingredient =	$('.video_search .include_ingredient').children('.chip')
			var exclude_ingredient =	$('.video_search .exclude_ingredient').children('.chip')
			var nutri_val_arr      =	{}

			var str=''
			if(recipe_val!=''){
				nutri_val_arr['query']=recipe_val
			}
			if(cuisine.length){
				for (var i = cuisine.length - 1; i >= 0; i--) {
					str+=	$(cuisine[i]).text()+','
				}
				console.info(str);
				str=str.substring(0,str.length-1)
				console.info(str);
				nutri_val_arr['cuisine']=str
				console.warn(str);
				str=''
			}
			if(include_ingredient.length){
				for (var i = include_ingredient.length - 1; i >= 0; i--) {
					str+=	$(include_ingredient[i]).text()+','
				}	
				str=str.substring(0,str.length-1)
				nutri_val_arr['includeIngredients']=str
				console.warn(str);
				str=''
			}
			if(exclude_ingredient.length){
				for (var i = exclude_ingredient.length - 1; i >= 0; i--) {
					str+=	$(exclude_ingredient[i]).text()+','
				}	
				str=str.substring(0,str.length-1)
				nutri_val_arr['excludeIngredients']=str
				console.warn(str);
			}
			if(type!='all'){	
				nutri_val_arr['type']=type
			}
			if(diet!='all'){	
				nutri_val_arr['diet']=diet
			} 	
			nutri_val_arr['number']=18
			nutri_val_arr['offset']=18
			var request = {
				'type': 'just_data',
				'category': 'misc',
				'sub_category':'video',
				'rand':random++,
				'query': nutri_val_arr
			};
			console.log('------------------------------------------------')
			console.log('before')
			var varaiable = await call_ajax(request);
			var val = JSON.parse(varaiable);
			console.log('video search');
			if(val!=null){	
				var cardsImg   = $('.video_card .card-cascade .card-img-top')
				var cardsTitle = $('.video_card .card-cascade .card-title')
				var cardsInput = $('.video_card .card-cascade input')
				for(var i=0; i<val.videos.length; i++){
					$(cardsTitle[i]).attr('title',val.videos[i].title)
					$(cardsImg[i]).attr('src',val.videos[i].thumbnail)	
					$(cardsTitle[i]).text(val.videos[i].shortTitle)
					$(cardsInput[i]).val(val.videos[i].youTubeId)
					$(cardsImg[i]).parent().parent().parent().css('display', 'block')
				}
			}
			$('.video_card_main').css('display','flex')
			$([document.documentElement, document.body]).animate({
			scrollTop: $('.video_card_main').offset().top }, 3000);
		}
		else{
			alert('please select a type of search')
		}
		$('.card_main').css('display','flex')
		$('.animation  #progress_bar').css('display','none')
		if(value!='Video Search'){
			$([document.documentElement, document.body]).animate({
				scrollTop: $('.data_card').offset().top
			}, 3000);
		}
	}

	async function auto_search(search_box){
 		console.log('auto_search');
 		var request = {

					'type': 'just_data',
					'category': 'ingredient',
					'sub_category':'autocomplete',
					'rand':random++,
					'query': {
						'query': search_box,
						'number': 5,	
					}
				};
		console.log('before');
		console.log('---------------------------------------------');
		var val = await call_ajax(request)
		var val = JSON.parse(val)
		if(val!=null){
			var search_bar_item = $('.main-search .suggession_bar_item')
			$('.main-search .suggession_bar').css('display','block')
			for(var i=0;i<val.length;i++){
				$(search_bar_item[i]).children('span').html(val[i].name)
				$(search_bar_item[i]).children('img').attr('src', 'https://spoonacular.com/cdn/ingredients_100x100/'+val[i].image)
				$(search_bar_item[i]).css('display','block')
			}
		}
		// console.log(val);
		console.log('---------------------------------------------');
		console.log('after');
 	}

	$('.main-search .search-icon').click(function(){		
		console.info('searched icon pressed');
		console.info($('.main-search #dropdownMenu').text());
		ofset_global_val=0
 		if($('.main-search #dropdownMenu').text() == 'Recipe'){
			search_recipe_or_ingredient(0,$('.search-input').val().trim())
		}else if ($('.main-search #dropdownMenu').text() == 'Advance Search'){
			search_recipe_or_ingredient(0,$('.search-input').val().trim())
		}else if ($('.main-search #dropdownMenu').text() == 'Video Search'){
			search_recipe_or_ingredient(0,$('.search-input').val().trim())
		}	
	})

	$('.main-search .search-input').keyup(function(event) {
		console.info('Inside key up Enter pressed'+$('.main-search #dropdownMenu').text())
		if(event.key == 'Enter') {
			ofset_global_val=0
		}
		if(event.key == 'Enter' && $('.main-search #dropdownMenu').text() == 'Recipe'){
			console.info('Enter pressed');
			$('.search_result_card_div').css('display', 'flex')
			search_recipe_or_ingredient(0,$('.search-input').val().trim());
			// $('.search_background_div').css('margin-bottom', '0px');
			// $('.search_background_div').css('margin-top', '0px');
			// $('.search_background_div').css('padding-top', '10px');
			// $('.search_background_div').css('padding-bottom', '10px');
		}else if ($('.main-search #dropdownMenu').text() == 'Ingredient'){
			var search_box=$('.search-input').val().trim();
			if(search_box.length%2 == 1){
				auto_search(search_box);
			}
			else if(search_box.length==0){
				$('.main-search .suggession_bar').css('display','none')
			}
		}else if (event.key == 'Enter' && $('.main-search #dropdownMenu').text() == 'Advance Search'){
			var search_box=$('.search-input').val().trim();
				search_recipe_or_ingredient(0,search_box);
		}else if (event.key == 'Enter' && $('.main-search #dropdownMenu').text() == 'Video Search'){
			var search_box=$('.search-input').val().trim();
				search_recipe_or_ingredient(0,search_box);
		}
	})

	/*
	ingredient search buttons
	 */
	// Slider advance Search
	$('.custom-range#customRange11').change(function(){
		console.info('slider');
		console.info($(this).val());
	    $(this).parent().parent().children('span').html($(this).val())
	})

	async function auto_search_Ingredient(search_box){
 		console.log('auto_search Ingredient');
 		var request = {

					'type': 'just_data',
					'category': 'ingredient',
					'sub_category':'autocomplete',
					'rand':random++,
					'query': {
						'query': search_box,
						'number': 5,	
					}
				};
		console.log('before');
		console.log('---------------------------------------------');
		var val = await call_ajax(request)
		var val = JSON.parse(val)
		if(val!=null){
			var class_name = get_class_name()
			var search_bar_item = $(class_name+' .Ingredient-search .suggession_bar_item')
			$(class_name+' .Ingredient-search .suggession_bar').css('display','block')
			for(var i=0;i<val.length;i++){
				$(search_bar_item[i]).children('span').html(val[i].name)
				$(search_bar_item[i]).children('img').attr('src', 'https://spoonacular.com/cdn/ingredients_100x100/'+val[i].image)
				$(search_bar_item[i]).css('display','block')
			}
		}
		// console.log(val);
		console.log('---------------------------------------------');
		console.log('after');
 	}

	$('.tag_maker').change(function (){
	 	console.info('------------------------');
	 	console.info($(this).val());
	 	console.info();
	 	if($(this).val()!='none' && $(this).val()!='all'){
		 	$(this).parent().append(tag_maker(0,$(this).val()))
	 	}
	})

	$('.Ingredient-search .suggession_bar_item').click(function() {
		var class_name = get_class_name()
		console.info('--------------------------------------------');
		var ingredient_name = $(this).children('span').text()
		var image_url = $(this).children('img').attr('src')
		$(class_name+' .Ingredient-search .suggession_bar').css('display','none');
		console.log(ingredient_name)
		var chip = tag_maker(image_url,ingredient_name)
		if($(class_name+' .Ingredient-search .search-toggle').text()=='Include Ingredient'){
			$(class_name+' .include_ingredient').append(chip)
		}else {
			$(class_name+' .exclude_ingredient').append(chip)
		}
		$(class_name+' .Ingredient-search .Ingredient-input').val('')
	});	
	
	$('.Ingredient-search .dropdown .dropdown-item').click(function() {
		var class_name = get_class_name()
		$(class_name+' .Ingredient-search .search-input').val('');
		console.log($(this).text());
		$(class_name+' .Ingredient-search #dropdownMenu').html('<strong>'+$(this).text()+'</strong>')
	});

	function get_class_name(){
		var class_name;
		if ($('.main-search #dropdownMenu').text() == 'Advance Search') {
			class_name = '.search_tag'
		}else if ($('.main-search #dropdownMenu').text() == 'Video Search') {
			class_name = '.video_search'
		}
		return class_name;
	}

	$('.Ingredient-search .Ingredient-input').keyup(function(event) {

		console.info('key pressed');
		var class_name = get_class_name()
		console.info($(class_name+' .Ingredient-input').val());
		if (($(class_name+' .Ingredient-search #dropdownMenu').text() == 'Include Ingredient') ||
				($(class_name+' .Ingredient-search #dropdownMenu').text() == 'Exclude Ingredient')){
			var search_box=$(class_name+' .Ingredient-input').val().trim();
			if(search_box.length%2 == 1){
				auto_search_Ingredient(search_box);
			}
			else if(search_box.length==0){
				$(class_name+' .Ingredient-search .suggession_bar').css('display','none')
			}
		}
			//else if end 
	})

	$('.main-search .search-input').focus(function(){
		ofset_val=0
		// hide_search_bar_items()
		show_search_display()
		console.log('main function');
	})
})
/*
	Jquery Function end here
 */

/*
 Javascript Function 
 */
/*
	Remove chip small tags remover
 */
function detail_of_item(ele){
	console.info(ele);
	console.info();
	
	$(ele).parent().remove()
}

	// $('.search-input').blur(function(){
	// 	if($('.search-input').val().trim() == '' && $('.main-search #dropdownMenu').text()!=''){

	// 		$('.search_background_div').css('margin-bottom', '0px');
	// 		$('.search_background_div').css('margin-top', '50px');
	// 		$('.search_background_div').css('padding-top', '50px');
	// 		$('.search_background_div').css('padding-bottom', '50px');
	// 		$('.margin_padding_background').css('display','')
	// 		$('header').css('display','')
	// 		$('.all_div_to_hide').css('display','')
	// 		$('footer').css('display','')
	// 		console.log('other function');
	// 	}
	// })
	// 	// regex for number check 
	// $(".register #mobile_number").keyup(function(){
	// 	console.log("inside mobile number");
	// 	var validate_num =  /^\+?([6-9]{1,5})\)?[-. ]?([0-9]{5})[-. ]?([0-9]{4})$/;
	// 	var num = $(".register #mobile_number").val();
	// 	if(num.match(validate_num)){
	// 		$(".register .mobile_number p").text("");
	// 		flag['mbl']=true
	// 	}
	// 	else{
	// 		$(".register .mobile_number p").text("Enter a valid mobile number");
	// 		flag['mbl']=false
	// 	}
	// });