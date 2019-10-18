	$('#select_form').change(function()
	{
		var a = $(this).val(); //This is formid
		console.log(a);
		$.get(
			"get_form_fields", {a},
			function(data){
			console.log(data);
			$('#select_question').empty();
			$('#select_question').append('<option value="">Select a question from the list</option>');
			$.each(data, function(key,value){

				if (value.id != 'legend')
				{
					$( '#select_question' )
					.append( " <option value='" + value.desc + "||_||" + value.id + "'>" + value.desc + " [ " + value.id +" ] </option> " );
				}
		});

			$('#logics').empty();
			$.each(data, function(key,value){
					if (value != 'legend')
					{
						$('#logics')
						.append( " <option value='" + value.desc + "||_||" + value.id + "'>" + value.desc + " [ " + value.id +" ] </option> " );
					}
				});

			$('#logics').change(function(e){
				e.preventDefault();
				var selected = $(this).val().split("||_||");
				console.log(selected);
				$.get(
					"get_form_fields", {a},
					function(data){
						$.each(data, function(key,value){
							let count = value.options.length;
							if ( value.options.length > 0 )
							{
								if (selected[1] == value.id) {
										$('#values').empty();
										for (var i = 0; i < count; i++) {
											$('#values')
											.append("<option value='"+value.options[i]+"'>"+value.options[i]+"</option>");
										}
								}
							}
						});
					});

			});

			});//ajax loop

		$.get("get_form_skip_logics", {a}, function(res){
			$('#add_skip_logics').empty();
			console.log(res);
			$.each(res,function(key,data)
		  {
		  	var dquestion = data.question.split("||_||");
		  	var dskip_columns = data.skip_columns.split("||_||");
		    $('#add_skip_logics')
		    .append(`
				<tr>
					
					<td>`+ dquestion[0] + `</td>
					<td>`+ data.check_value +`</td>
					<td>`+ dskip_columns[0] +`</td>
					<td><a href="remove_skip_logic?id=`+data.id+`"><i class="fa fa-trash" style="color: red"></a></td>
				</tr>
			`);
		  });
		});

		$('#select_question').change(function(){
			$('#que').css('display','block');
			$('.clone_this').css('display','block');
			$('.proceed').css('display','block');
		});

		// $('#add_condition').click(function(){
		// 	$(".some-element")
		// 	.append(
		// 		$('.clone_this').addClass('original')
		// 		.clone().removeClass('original clone_this')
		// 		.addClass('cloned mt-2')
		// 		.append(`<span href="#" class="del_this" style="cursor: pointer;">DEL</span>`)
		// 		);
		// 	//Remove
		// 	$('.del_this').click(function(e){
		// 	$(this).parent('.cloned').empty();
		// 	});
		// });

	});//first input
	var a = $('#edit_skip_logic_id').val();
	
	$('#logics').change(function(e){
				e.preventDefault();
				
				console.log(a);
				var selected = $(this).val().split("||_||");
				console.log(selected);
				$.get(
					"get_form_fields", {a},
					function(data){
						console.log(data);
						$.each(data, function(key,value){
							let count = value.options.length;
							if ( value.options.length > 0 )
							{
								if (selected[1] == value.id) {
										$('#values').empty();
										for (var i = 0; i < count; i++) {
											$('#values')
											.append("<option value='"+value.options[i]+"'>"+value.options[i]+"</option>");
										}
								}
							}
						});
					});

			});
