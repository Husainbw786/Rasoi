$(function() {
	var random=0
	function stop(){
		$('.container  #progress_bar').css('display','none')
	}
	jQuery(document).ready(function($) {
		$('.container  #progress_bar').css('display','block')
		setTimeout(stop,1500);
		console.log('in main function');
		similar_recipe();		    
    })

	async function similar_recipe(){
		if($('#id_input').val().trim()!=''){
			var request = {
				'type'			:	'new_page',
				'category'		:	'recipes',
				'sub_category'	:	'similar',
				'rand'			:	random++,
				'id'			:	$('#id_input').val()
			};
			var val = await call_ajax(request)
			val = JSON.parse(val)
			if(val!=null){			
				console.log(val.baseUri)
				var cardsImg   = $('.card-cascade .card-img-top')
				var cardsTitle = $('.card-cascade .card-title')
				var cardsInput = $('.card-cascade input')
				for(var i=0; i<val.length; i++){
					$(cardsTitle[i]).attr('title',val.title)
					$(cardsImg[i]).attr('src','https://spoonacular.com/recipeImages/'+val[i].id+'-636x393.jpg')	
					$(cardsTitle[i]).text(val[i].title)
					$(cardsInput[i]).val(val[i].id)
					console.log('value insertion: '+i)
					$(cardsImg[i]).parent().parent().parent().css('display', 'block')
				}
			}else {
				$('.card_main_animation').remove('.msg')
				$('.card_main_animation').append('<p class="msg">No match Found<p>')
			}
			console.log('------------------------------------------------')
		//	console.log(val)
			console.log('------------------------------------------------')	
		}
	}

	$('.data_card').click(async function(){
		$('.card_main_animation #progress_bar').css('display','block')
		console.log($($(this).find('input:hidden')).val())
		var request = {
			'type'			:	'new_page',
			'category'		:	'recipes',
			'sub_category'	:	'information',
			'rand'			:	random++,
			'id'			:	$($(this).find('input:hidden')).val(),
			'query'			: 	{
				'includeNutrition'	:	'true'
			}
		};
		var msg = await call_ajax(request)
		$('.card_main_animation  #progress_bar').css('display','none')
		// console.log(msg)
		window.open('detail_of_recipe.php', '_blank')
	})

	function call_ajax(request){
		if(random==20){
			random=0
		}
		return $.ajax({
			url: '../../Controller/api_controller.php',
			type: 'POST',
			data: request
		})
		.done(function(val) {
		
			console.log('valueee got');
			console.log('--------------------------------');
		//	console.log(val);	
			console.log('--------------------------------');
		})
		.fail(function() {
		
			console.log("error");
		})
	} 


})