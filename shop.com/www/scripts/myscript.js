window.onload = (function () {

	$(".userData").click(function(){
		runPage('userData.html','#info');
		setDataActivePage('1');
				
		$("#info").hide();
		$("#info2").hide();
		$("#info").show();
		
		console.log("Opening page named \"userData\"");
	});
	
	$(".account").click(function(){
		runPage('account.html','#info');
		setDataActivePage('2');
				
		$("#info").hide();
		$("#info2").hide();
		$("#info").show();
		
		console.log("Opening page named \"account\"");
	});
	
	$(".cart").click(function(){
		runPage('cart.html','#info');
		setDataActivePage('3');
				
		$("#info").hide();
		$("#info2").hide();
		$("#info").show();
		
		console.log("Opening page named \"cart\"");
	});
	
	$(".order").click(function(){
		runPage('order.html','#info');
		setDataActivePage('4');
				
		$("#info").hide();
		$("#info2").hide();
		$("#info").show();
		
		console.log("Opening page named \"order\"");
	});
	
	$(".productsGroup").click(function(){
		runPage('productsGroup.html','#info');
		setDataActivePage('5');
				
		$("#info").hide();
		$("#info2").hide();
		$("#info").show();
		
		console.log("Opening page named \"productsGroup\"");
	});
	
	$(".product").click(function(){
		runPage('product.html','#info');
		setDataActivePage('6');
				
		$("#info").hide();
		$("#info2").hide();
		$("#info").show();
		
		console.log("Opening page named \"product\"");
	});

	$(".discount").click(function(){
		runPage('discount.html','#info');
		setDataActivePage('7');
				
		$("#info").hide();
		$("#info2").hide();
		$("#info").show();
		
		console.log("Opening page named \"discount\"");
	});
	
	$(".storage").click(function(){
		runPage('storage.html','#info');
		setDataActivePage('8');
				
		$("#info").hide();
		$("#info2").hide();
		$("#info").show();
		
		console.log("Opening page named \"storage\"");
	});
	
	$(".orderForStorage").click(function(){
		runPage('orderForStorage.html','#info');
		setDataActivePage('9');
				
		$("#info").hide();
		$("#info2").hide();
		$("#info").show();
		
		console.log("Opening page named \"orderForStorage\"");
	});
	
	$(".allOrders").click(function(){
		runPage('allOrders.html','#info');
		setDataActivePage('10');
				
		$("#info").hide();
		$("#info2").hide();
		$("#info").show();
		
		console.log("Opening page named \"allOrders\"");
	});
	
	var currentPage=getDataActivePage();
	
	if(currentPage==1) runPage('userData.html','#info');
	if(currentPage==2) runPage('account.html','#info');
	if(currentPage==3) runPage('cart.html','#info');
	if(currentPage==4) runPage('order.html','#info');
	if(currentPage==5) runPage('productsGroup.html','#info');
	if(currentPage==6) runPage('product.html','#info');
	if(currentPage==7) runPage('discount.html','#info');
	if(currentPage==8) runPage('storage.html','#info');
	if(currentPage==9) runPage('orderForStorage.html','#info');
	if(currentPage==10) runPage('allOrders.html','#info');
	
	console.log('Page loaded or reloaded');
});

var getDataActivePage = function (){
	var ob = {'id':'inquiry'};
	var res="0";
	$.ajax({
		type:'POST',
		url:'scripts/getActivePage.php',
		dataType:'json',
		async: false,
		data:"param="+JSON.stringify(ob),
		success:function(html) {				
			res=html;
		}
	});
	return res;	
}

function runPage(file,feld) {
	$.get(file, function (data) { $(feld).html(data); });
}

function setDataActivePage(pageId){
	var ob = {'id':pageId};
	$.ajax({
		type:'POST',
		url:'scripts/setActivePage.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log('Set active key for current page');
		}
	});
}

$("#BtnAdd").click(function(){
	$('#formFind').hide("slow");
	$('#formAdd').slideToggle("slow");
	
	if(getDataActivePage()==7) runPage('scripts/clientsDiscountType.html','#typeDiscount');
	
	console.log("Opening the slider to add record");
});
 
$("#BtnSearch").click(function(){
	$('#formAdd').hide("slow");
	$('#formFind').slideToggle("slow");
	
	console.log("Opening the slider to find record");
});
///////////////////////////////////////////////////////////////////////////////////

//userData
$('.tableShow').click(function(){
	var id = $(this).data('id');
	var ob = {'id':id}
 
	$.ajax({
		type:'POST',
		url:'scripts/outputUserData.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {

			var res = html.split('|');
			//Страница "Показать запись"
			var htmlContent ="<h1>Информация о клиенте</h1><input type=\"hidden\" id=\"pers_id\"  value=\"".concat(res[5]).concat("\"><body><table class='table4' border=0 width=40% cellspacing = 0 align=center><tr><td class='table4td'><p>Пользователь: ").concat("<b>").concat(res[0]).concat("</b></td></tr><tr><td class='table4td'>").concat("</b></p><p><i>Контактные данные</i></p></td></tr><tr><td class='table4td'>").concat("<p>Номер телефона: ").concat(res[1]).concat("</p><p>E-mail: ").concat(res[2]).concat("</p><p>Адрес: ").concat(res[3]).concat("</p><p>Номер банковской карты: ").concat(res[4]).concat("</td></tr></table></body>");
			htmlContent=htmlContent.concat("<Br><div class='links'><ul><li><a class='tableEdit' href=\"#\">Редактировать</a></li><li><a class='tableDel' href=\"#\">Удалить</a></li><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
						
			$('#info2').html(htmlContent);
			initClickEdit();
			initClickDelete();
			
			$("#info").hide();
			$("#info2").show();
		}
	});
	
	console.log("Opening page named \"showRecord\"");
});

function initClickEdit() {
	$('.tableEdit').click(function(){

		var id = $(this).data('id');
		if(id == null) {
			id = $('#pers_id').val();
		}
		var ob = {'id':id}
	 
		$.ajax({
			type:'POST',
			url:'scripts/outputUserData.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				var res = html.split('|');
				//Страница редактировать
				var htmlContent="<h1>Изменение информации о клиенте</h1><form id=\"user_edit\" action=\"scripts/updateUserData.php\" method=\"post\" name=\"forma\"><fieldset><input type=\"hidden\" name=\"id\"  value=\"".concat(res[5]).concat("\"><label id=\"label\" for=\"fio\">ФИО: </label><input id=\"text_edit\" type=\"text\" name=\"fio\" size=\"34\" oninput=\"validateFIO(this)\" placeholder=\"").concat(res[0]).concat("\"><br/><label id=\"label\" for=\"phone_number\">Телефон: </label><input id=\"text_edit\" type=\"text\" name=\"phone_number\" size=\"31\" oninput=\"validatePhone(this)\" placeholder=\"").concat(res[1]).concat("\"> <br/><label id=\"label\" for=\"mail_address\">E-mail: </label><input id=\"text_edit\" type=\"text\" name=\"mail_address\" size=\"33\" oninput=\"validateMail(this)\" placeholder=\"").concat(res[2]).concat("\"> <br/><label id=\"label\" for=\"address\">Адрес: </label><input id=\"text_edit\" type=\"text\" name=\"address\" size=\"33\" oninput=\"validateAddress(this)\" placeholder=\"").concat(res[3]).concat("\"> <br/><label id=\"label\" for=\"card_number\">Номер банковской карты: </label><input id=\"text_edit\" type=\"text\" name=\"card_number\" size=\"14\" oninput=\"validateCartNumber(this)\" placeholder=\"").concat(res[4]).concat("\"> <br/></fieldset><fieldset><input id=\"submit\" type=\"submit\" value=\"Изменить данные\"></fieldset></form>");
				htmlContent=htmlContent.concat("<div class='link1'><ul><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
				$('#info2').html(htmlContent);
	   
				$("#info").hide();
				$("#info2").hide();
				$("#info2").show();
			}
		});
		console.log("Opening page named \"editRecord\"");
	});
}
initClickEdit();

function initClickDelete() {
	$('.tableDel').click(function(){

		var isTableShow='false';
	
		var id = $(this).data('id');
		if(id == null) {
			id = $('#pers_id').val();
			isTableShow='true';
		}
		var ob = {'id':id};

		//Посылаем запрос к account
		$.ajax({
			type:'POST',
			url:'scripts/dataCheck.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log((html=="true")? "Record have few linked accounts": "Can deleting this record");
				if(html=="true" && isTableShow=="false") {
					document.getElementById('deleteUserId').value = ob.id;
					$('.popupQuestionToDeleting').css('display', 'block');
				}
				else {
					$.ajax({
						type:'POST',
						url:'scripts/delete.php',
						dataType:'json',
						data:"param="+JSON.stringify(ob),
						success:function(html) {
							console.log("Record deleted from table \"user_data\"");
							runPage('userData.html','#info');
							
							$("#info").hide();
							$("#info2").hide();
							$("#info").show();
						}
					});
				}
			}
		});
		console.log("Opening page named \"deleteRecord\"");
	});
}
initClickDelete();

$("#deleteCancel").click(function(){
	$('.popupQuestionToDeleting').css('display', 'none');
});

$("#deleteYes").click(function(){
	var data = {'id':document.getElementById('deleteUserId').value,'answer':'yes'};
	delRecords(data);
});

$("#deleteNo").click(function(){
	var data = {'id':document.getElementById('deleteUserId').value,'answer':'no'};
	delRecords(data);
});

function delRecords(data) {
	var ob = {'id':data.id};
	
	if(data.answer!='yes' && data.answer!='no') $('.popupQuestionToDeleting').css('display', 'none');
	else if(data.answer=='yes') {
		//Удалить запись из "Аккаунт"
		$.ajax({
			type:'POST',
			url:'scripts/deleteLinkedAccount.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log("Linked records deleted from table \"account\"");
			}
		});
	}

	$.ajax({
		type:'POST',
		url:'scripts/deleteDiscount.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log("Record deleted from table \"discount\"");
			
			runPage('discount.html','#info');
			
			$("#info").hide();
			$("#info2").hide();
			$("#info").show();
			
			$('.popupQuestionToDeleting').css('display', 'none');
		}
	});
}

function searchUserData(){	
	var fio = document.forms["searchUser"].elements["fioSearch"].value;
	var phone_number = document.forms["searchUser"].elements["phoneNumberSearch"].value;
	var mail_address = document.forms["searchUser"].elements["mailSearch"].value;
	var address = document.forms["searchUser"].elements["addressSearch"].value;
	var card_number = document.forms["searchUser"].elements["cardNumberSearch"].value;
	
	var searchData = {'fio':fio,'phone_number':phone_number,'mail_address':mail_address,'address':address,'card_number':card_number};

	$.ajax({
		type:'POST',
		url:'scripts/searchUserData.php',
		dataType:'json',
		data:"searchData="+JSON.stringify(searchData),
		success:function(html) {
			var res = html.split('*');
			
			var htmlContent="";
			if((res.length-1)!=0) htmlContent="<h1>Результат поиска</h1><body><style type=\"text/css\"> .table5 {margin-right: 40px;\n margin-top: -5px;\n margin-bottom: 10px;\n border: 1px solid black;} </style><table class='table5' border=0 width=75% cellspacing = 0 align=right><tr><th class='table_font'>ФИО</th><th class='table_font'>Номер телефона</th><th class='table_font'>E-mail</th><th class='table_font'>Адрес</th><th class='table_font'>Номер банковской карты</th></tr>";
			else htmlContent="<p>. ______________________________________________________________________________________________________.</p><p>______________________ К сожалению не одной записи по данному запросу не было найдено. ______________________</p></Br>";
			
			for (var i=0;i<res.length-1;i++){
				var record = res[i].split('|');
				htmlContent=htmlContent.concat("<tr><td class='table3td'>").concat(record[1]).concat("</td><td class='table3td'>").concat(record[2]).concat("</td><td class='table3td'>").concat(record[3]).concat("</td><td class='table3td'>").concat(record[4]).concat("</td><td class='table3td'>").concat(record[5]).concat("</td></tr>");
			}
			if((res.length-1)!=0)htmlContent=htmlContent.concat("</table>");
			htmlContent=htmlContent.concat("<style type=\"text/css\"> .link2 {float:right;\n margin-right: 310px;\n margin-bottom: 8px;\n box-shadow: 0px 1px 1px rgba(50,50,50, .4);\n width: 198px;\n height: 20px;\n background: rgba(240,240,240, .5);} .link2 >a { display: block;\n float: left;\n padding: 1px 27px;\n border-right: 1px solid rgba(0,0,0, .2);\n border-left: 1px solid rgba(0,0,0, .2);} </style><div class='link2'><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></div>");
			
			$('#info2').html(htmlContent);
			//initClickEdit();
			//initClickDelete();
			
			$("#info").hide();
			$("#info2").hide();
			$("#info2").show();
		}
	});
	console.log("Opening page named \"searchUserData\"");
}

//discount
$('#discountType').change(function(){
     var current=$('#discountType option:selected').val();

	 if(current==1)runPage('scripts/clientsDiscountType.html','#typeDiscount');
	 if(current==2)runPage('scripts/cartsDiscountType.html','#typeDiscount');
	 if(current==3)runPage('scripts/productsDiscountType.html','#typeDiscount');
	 	 
	 console.log("Change discount property (id)");
});

// Нужно доработать!
$('.discountShow').click(function(){
	var id = $(this).data('id');
	var ob = {'id':id};
 
	$.ajax({
		type:'POST',
		url:'scripts/outputDiscount.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log(html);
			var res = html.split('|');
			//Страница "Показать запись"
			var type='';
			if(res[4]==1) type='Скидка для пользователя';
			else if(res[4]==2) type='Скидка на заказ';
			else if(res[4]==3) type='Скидка на товар';
			
			var obj = {'type':res[4],'id':res[5]}

			$.ajax({
				type:'POST',
				url:'scripts/getDiscountObject.php',
				dataType:'json',
				data:"data="+JSON.stringify(obj),
				success:function(data) {
					console.log(data);
					
					var htmlContent ="<h1>Информация о скидке</h1><input type=\"hidden\" id=\"pers_id\"  value=\"".concat(res[0]).concat("\"><body><table class='table4' border=0 width=40% cellspacing = 0 align=center><tr><td class='table4td'><p>Название: ").concat("<b>").concat(res[1]).concat("</b></td></tr><tr><td class='table4td'>").concat("<p>Тип: \"").concat(type).concat("\"</p>").concat("<p>Назначение: ").concat((res[4]==2)?("Корзина №".concat(data)):data).concat("</p>").concat("<p>Размер: ").concat(res[2]).concat("%</p>").concat("<p>Описание: \"").concat(res[3]).concat("\"</td></tr></table></body>");
					htmlContent=htmlContent.concat("<div class='link1'><ul><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
					//htmlContent=htmlContent.concat("<Br><div class='links'><ul><li><a class='tableEdit' href=\"#\">Редактировать</a></li><li><a class='tableDel' href=\"#\">Удалить</a></li><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");					
					$('#info2').html(htmlContent);
				}
			});
			
			$("#info").hide();
			$("#info2").show();
		}
	});
	
	console.log("Opening page named \"showRecord\"");
});

function delRecordsDiscount(data) {
	var ob = {'id':data.id};
	console.log(data.answer);
	
	if(data.answer!='yes' && data.answer!='no') $('.popupQuestionToDeleting').css('display', 'none');
	else if(data.answer=='yes') {
		//Удалить запись из "Аккаунт"
		$.ajax({
			type:'POST',
			url:'scripts/deleteLinkedRecords.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log("Linked records deleted from table \"discountRecord\"");
			}
		});
	}

	$.ajax({
		type:'POST',
		url:'scripts/deleteDiscount.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log("Record deleted from table \"discount\"");
			
			runPage('discount.html','#info');
			
			$("#info").hide();
			$("#info2").hide();
			$("#info").show();
			
			$('.popupQuestionToDeleting').css('display', 'none');
		}
	});
}

$("#deleteDiscountYes").click(function(){
	var data = {'id':document.getElementById('deleteDiscountId').value,'answer':'yes'};
	delRecordsDiscount(data);
});

$("#deleteDiscountNo").click(function(){
	var data = {'id':document.getElementById('deleteDiscountId').value,'answer':'no'};
	delRecordsDiscount(data);
});


function initClickDeleteDiscount() {
	$('.discountDelete').click(function(){
	
		var isTableShow='false';
	
		var id = $(this).data('id');
		if(id == null) {
			id = $('#pers_id').val();
			isTableShow='true';
		}
		var ob = {'id':id};

		//Посылаем запрос к подчиненным записям
		$.ajax({
			type:'POST',
			url:'scripts/dataCheckDiscount.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log((html=="true")? "Record have few linked": "Can deleting this record");
				if(html=="true" && isTableShow=="false") {
					document.getElementById('deleteDiscountId').value = ob.id;
					$('.popupQuestionToDeleting').css('display', 'block');
				}
				else {
					$.ajax({
						type:'POST',
						url:'scripts/deleteDiscount.php',
						dataType:'json',
						data:"param="+JSON.stringify(ob),
						success:function(html) {
							console.log("Record deleted from table \"discount\"");
							runPage('discount.html','#info');
							
							$("#info").hide();
							$("#info2").hide();
							$("#info").show();
						}
					});
				}
				console.log(((html=="true")?"true":"false"));
			}
		});
		console.log("Opening page named \"deleteRecord\"");
	});
}
initClickDeleteDiscount();

function initClickEditDiscount() {
	$('.discountEdit').click(function(){

		var id = $(this).data('id');
		if(id == null) {
			id = $('#pers_id').val();
		}		
		
		var ob = {'id':id}
		var htmlContent="";
	 
		$.ajax({
			type:'POST',
			url:'scripts/outputDiscount.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
			console.log(html);
				var res = html.split('|');
				
				//Страница редактировать
				htmlContent="<h1>Изменение информации о скидках</h1><form id=\"user_edit\" action=\"scripts/updateDiscount.php\" method=\"post\" name=\"forma\"><fieldset><input type=\"hidden\" name=\"id\"  value=\"".concat(res[0]).concat("\"><label id=\"label\" for=\"discountName\">Название: </label><input id=\"text_edit\" type=\"text\" name=\"discountName\" size=\"30\" oninput=\"validateDiscountName(this)\" placeholder=\"").concat(res[1]).concat("\"><br/><label id=\"label\" for=\"discountValue\">Размер скидки: </label><input id=\"text_edit\" type=\"text\" name=\"discountValue\" size=\"26\" oninput=\"validateDiscountValue(this)\" placeholder=\"").concat(res[2]).concat("\"> <br/><label id=\"label\" for=\"discountType\">Тип скидки: </label><select  id=\"discountType\" name=\"discountType\">");

				if(res[4]=="1") {
					htmlContent = htmlContent.concat("<option value=\"1\">Скидки для клиентов</option></select>");
				}
				else if(res[4]=="2") {
					htmlContent = htmlContent.concat("<option value=\"2\">Скидки на заказы</option></select>");
				}
				else if(res[4]=="3") {
					htmlContent = htmlContent.concat("<option value=\"3\">Скидки на товары</option></select>");
				}
				
				if(res[4]=="1") {
					$.ajax({
						type:'POST',
						url:'scripts/getLinkedToDiscountAccount.php',
						dataType:'json',
						data:"data="+JSON.stringify(ob),
						success:function(data) {
							console.log(data);
							
							var resData = data.split('|');
							var accountName = resData[1].split('*');
							var acccountId = resData[2].split('*');

							htmlContent=htmlContent.concat("<Br><label id=\"label\" for=\"discountObject\">Назначение: </label>");
							htmlContent=htmlContent.concat("<select  id=\"discountObject\" name=\"discountObject\">");
							
							for(var i=0;i<resData[0];i++) {
								if(acccountId[i]==resData[3]) htmlContent=htmlContent.concat("<option selected value=\"").concat(acccountId[i]).concat("\">").concat(accountName[i]).concat("</option>");
								else htmlContent=htmlContent.concat("<option value=\"").concat(acccountId[i]).concat("\">").concat(accountName[i]).concat("</option>");
							}
							htmlContent=htmlContent.concat("</select>");
							
							htmlContent=htmlContent.concat("<Br> <label id=\"label\" for=\"description\">Описание: </label><input id=\"text_edit\" type=\"text\" name=\"description\" size=\"30\"  oninput=\"validateDiscountName(this)\" placeholder=\"").concat(res[3]).concat("\"><br/></fieldset><fieldset><input id=\"submit\" type=\"submit\" value=\"Изменить данные\"></fieldset></form>");
							htmlContent=htmlContent.concat("<div class='link1'><ul><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
							
							$('#info2').html(htmlContent);
						}
					});
				}
				if(res[4]=="2") {
					$.ajax({
						type:'POST',
						url:'scripts/getLinkedToDiscountOrder.php',
						dataType:'json',
						data:"data="+JSON.stringify(ob),
						success:function(data) {
							console.log(data);

							var resData = data.split('|');

							htmlContent=htmlContent.concat("<Br><label id=\"label\" for=\"discountObject\">Назначение: </label>");
							htmlContent=htmlContent.concat("<select  id=\"discountObject\" name=\"discountObject\">");
							
							for(var i=1;i<=resData[0];i++) {
								if(resData[resData[0]+1]==i) htmlContent=htmlContent.concat("<option value=\"").concat(i).concat("\">Корзина №").concat(resData[i]).concat("</option>");
							}
							htmlContent=htmlContent.concat("</select>");
							
							htmlContent=htmlContent.concat("<Br> <label id=\"label\" for=\"description\">Описание: </label><input id=\"text_edit\" type=\"text\" name=\"description\" size=\"30\"  oninput=\"validateDiscountName(this)\" placeholder=\"").concat(res[3]).concat("\"><br/></fieldset><fieldset><input id=\"submit\" type=\"submit\" value=\"Изменить данные\"></fieldset></form>");
							htmlContent=htmlContent.concat("<div class='link1'><ul><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
							
							$('#info2').html(htmlContent);
						}
					});
				}
				if(res[4]=="3") {
					$.ajax({
						type:'POST',
						url:'scripts/getLinkedToDiscountProduct.php',
						dataType:'json',
						data:"data="+JSON.stringify(ob),
						success:function(data) {
							console.log(data);

							var resData = data.split('|');
							var productName = resData[1].split('*');
							var productId = resData[2].split('*');

							htmlContent=htmlContent.concat("<Br><label id=\"label\" for=\"discountObject\">Назначение: </label>");
							htmlContent=htmlContent.concat("<select  id=\"discountObject\" name=\"discountObject\">");
							
							for(var i=0;i<resData[0];i++) {
								if(productId[i]==resData[3]) htmlContent=htmlContent.concat("<option selected value=\"").concat(productId[i]).concat("\">").concat(productName[i]).concat("</option>");
								else htmlContent=htmlContent.concat("<option value=\"").concat(productId[i]).concat("\">").concat(productName[i]).concat("</option>");
							}
							htmlContent=htmlContent.concat("</select>");
							
							htmlContent=htmlContent.concat("<Br> <label id=\"label\" for=\"description\">Описание: </label><input id=\"text_edit\" type=\"text\" name=\"description\" size=\"30\"  oninput=\"validateDiscountName(this)\" placeholder=\"").concat(res[3]).concat("\"><br/></fieldset><fieldset><input id=\"submit\" type=\"submit\" value=\"Изменить данные\"></fieldset></form>");
							htmlContent=htmlContent.concat("<div class='link1'><ul><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
							
							$('#info2').html(htmlContent);
						}
					});
				}
			}
		});
		
		$("#info").hide();
		$("#info2").hide();
		$("#info2").show();
		
		console.log("Opening page named \"editRecord\"");
	});
}
initClickEditDiscount();

//account
$('.accountShow').click(function(){
	var id = $(this).data('id');
	id = id.slice(1,(id.length-1));
	var dataId = id.split('|');
	
	var ob = {'accountId':dataId[0],'userId':dataId[1],'cartId':dataId[2],'discountId':dataId[3]};
	//console.log(ob.cartId);
	$.ajax({
		type:'POST',
		url:'scripts/outputAccount.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log(html);

			var res = html.split('|');
			var order = res[5].split(', ');

			//Страница показать запись
			var htmlContent ="<h1>Учётная запись пользователя</h1><input type=\"hidden\" id=\"account_id\"  value=\"".concat(res[2]).concat("\"><input type=\"hidden\" id=\"user_id\"  value=\"").concat(res[0]).concat("\"><input type=\"hidden\" id=\"cart_id\"  value=\"").concat(res[6]).concat("\"><input type=\"hidden\" id=\"discount_id\"  value=\"").concat(res[7]).concat("\"><body><table class='table4' border=0 width=40% cellspacing = 0 align=center><tr><td class='table4td'><p>Пользователь: <b>").concat((res[1])? res[1] : 'Отсутствует').concat("</b></td></tr><tr><td class='table4td'></b></p><p><i>Учётная запись</i></p></td></tr><tr><td class='table4td'><p>Логин: ").concat(res[3]).concat("</p><p>Пароль: ").concat(res[4]).concat("</p><p>Список заказов: <select>");
			for(i=0;i<order.length;i++) {
				htmlContent=htmlContent.concat("<option>").concat(((order[i])? "Заказ №" : "")).concat(((order[i])? order[i] : 'Отсутствует')).concat("</option>");
			}
			htmlContent=htmlContent.concat("</select></p><p>Скидка: ").concat(((res[8])? "\"" : "")).concat(((res[8])? res[8] : 'Отсутствует')).concat(((res[8])? "\"" : "")).concat("</p><p>Корзина: Корзина №").concat(res[6]).concat("</p>").concat("</td></tr></table></body>");
			htmlContent=htmlContent.concat("<Br><div class='links'><ul><li><a class='accountEdit' href=\"#\">Редактировать</a></li><li><a class='accountDelete' href=\"#\">Удалить</a></li><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
		
			$('#info2').html(htmlContent);
			initClickEditAccount();
			initClickDeleteAccount();
			
			$("#info").hide();
			$("#info2").show();
		}
	});
	console.log("Opening page named \"showRecord\"");
});

function initClickEditAccount() {
	$('.accountEdit').click(function(){

		var id = $(this).data('id');
		if(id == null) {
			var accountId = $('#account_id').val();
			var userId = $('#user_id').val();
			var discountId = $('#discount_id').val();
			var ob = {'accountId':accountId,'userId':userId,'discountId':discountId};
		}
		else {
			id = id.slice(1,(id.length-1));
			var dataId = id.split('|');
			//var ob = {'accountId':dataId[0],'userId':dataId[1]};
			var ob = {'accountId':dataId[0],'userId':dataId[1],'cartId':dataId[2],'discountId':dataId[3]};
		}
		console.log(ob.discountId);
 
		$.ajax({
			type:'POST',
			url:'scripts/outputAccount.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				var res = html.split('|');
				var order = res[5].split(', ');
				var htmlContent="<h1>Изменениеe учётной записи пользователя</h1><form id=\"user_edit\" action=\"scripts/updateAccount.php\" method=\"post\" name=\"forma\"><fieldset><input type=\"hidden\" name=\"id\"  value=\"".concat(res[2]).concat("\"><label id=\"label\" for=\"user\">Пользователь: </label><input id=\"text_edit\" type=\"text\" name=\"user\" size=\"26\" readonly value=\"").concat((res[1])? res[1]:'Отсутствует').concat("\"><br/><label id=\"label\" for=\"login\">Логин: </label><input id=\"text_edit\" type=\"text\" name=\"login\" size=\"33\" oninput=\"validateLogin(this)\" placeholder=\"").concat(res[3]).concat("\"> <br/><label id=\"label\" for=\"password\">Пароль: </label><input id=\"text_edit\" type=\"text\" name=\"password\" size=\"32\" oninput=\"validatePassword(this)\" placeholder=\"").concat(res[4]).concat("\"> <br/>");
				htmlContent=htmlContent.concat("<p id=\"label\">Список заказов: <select>");
				for(i=0;i<order.length;i++) {
					htmlContent=htmlContent.concat("<option>").concat(((order[i])? "Заказ №" : "")).concat(((order[i])? order[i] : 'Отсутствует')).concat("</option>");
				}
				htmlContent=htmlContent.concat("</select></p><label id=\"label\" for=\"discount\">Скидка: </label><input id=\"text_edit\" type=\"text\" name=\"discount\" size=\"32\" readonly value=\"").concat(((res[8])? res[8]:'Отсутствует')).concat("\"> <br/><label id=\"label\" for=\"cart\">Корзина: </label><input id=\"text_edit\" type=\"text\" name=\"card_number\" size=\"31\" readonly value=\"Корзина №").concat(res[6]).concat("\"> <br/></fieldset><fieldset><input id=\"submit\" type=\"submit\" value=\"Изменить данные\"></fieldset></form>");
				htmlContent=htmlContent.concat("<div class='link1'><ul><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
				$('#info2').html(htmlContent);
	   
				$("#info").hide();
				$("#info2").hide();
				$("#info2").show();
			}
		});
		console.log("Opening page named \"editRecord\"");
	});
}
initClickEditAccount();

function initClickDeleteAccount() {
	$('.accountDelete').click(function(){

		var id = $(this).data('id');
		if(id == null) {
			id = $('#account_id').val();
			var cartId = $('#cart_id').val();
			var ob = {'accountId':id,'cartId':cartId};
		}
		else {
			id = id.slice(1,(id.length-1));
			var dataId = id.split('|');
			//var ob = {'accountId':dataId[0],'userId':dataId[1]};
			var ob = {'accountId':dataId[0],'userId':dataId[1],'cartId':dataId[2],'discountId':dataId[3]};
		}
 
		$.ajax({
			type:'POST',
			url:'scripts/deleteAccount.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log("Record deleted from table \"account\"");
				runPage('account.html','#info');
				
				$("#info").hide();
				$("#info2").hide();
				$("#info").show();
			}
		});
		console.log("Opening page named \"deleteRecord\"");
	});
}
initClickDeleteAccount();

//product
$('.productShow').click(function(){
	var id = $(this).data('id');
	id = id.slice(1,(id.length-1));
	var dataId = id.split('|');
	
	var ob = {'productId':dataId[0],'productsGroupId':dataId[1],'discountId':dataId[2]};
 
	$.ajax({
		type:'POST',
		url:'scripts/outputProduct.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log(html);
			var res = html.split('|');
			//Страница "Показать запись"
			var htmlContent ="<h1>Информация о товаре</h1><input type=\"hidden\" id=\"product_id\"  value=\"".concat(res[0]).concat("\"><input type=\"hidden\" id=\"products_group_id\"  value=\"").concat(res[5]).concat("\"><input type=\"hidden\" id=\"discount_id\"  value=\"").concat(res[7]).concat("\"><body><table class='table4' border=0 width=40% cellspacing = 0 align=center><tr><td class='table4td'><p>Название: ").concat("<b>").concat(res[1]).concat("</b></td></tr><tr><td class='table4td'>").concat("<p>Группа: ").concat((res[6])? res[6]:'Отсутствует').concat("</p>").concat("<p>Цена: ").concat(res[2]).concat(" руб.</p>").concat("<p>Количество: ").concat(res[3]).concat(" шт.</p>").concat("<p>Описание: \"").concat(res[4]).concat("\"</p>").concat("<p>Скидка: ").concat((res[8]) ? res[8] : 'Отсутствует').concat("</p>").concat("</td></tr></table></body>");;
			htmlContent=htmlContent.concat("<Br><div class='links'><ul><li><a class='productEdit' href=\"#\">Редактировать</a></li><li><a class='productDelete' href=\"#\">Удалить</a></li><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");

			$('#info2').html(htmlContent);
			initClickEditProduct();
			initClickDeleteProduct();
			
			$("#info").hide();
			$("#info2").show();
		}
	});
	
	console.log("Opening page named \"showRecord\"");
});

function initClickEditProduct() {
	$('.productEdit').click(function(){

		var id = $(this).data('id');
		if(id == null) {
			var productId = $('#product_id').val();
			var productsGroupId = $('#products_group_id').val();
			var discountId = $('#discount_id').val();
			var ob = {'productId':productId,'productsGroupId':productsGroupId,'discountId':discountId};
		}
		else {
			id = id.slice(1,(id.length-1));
			var dataId = id.split('|');
			var ob = {'productId':dataId[0],'productsGroupId':dataId[1],'discountId':dataId[2]};
		}
		console.log(ob.discountId);
 
		$.ajax({
			type:'POST',
			url:'scripts/outputEditProduct.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
			console.log(html);
				var res = html.split('|');
				var productGroupName = res[7].split('*');
				var productGroupId = res[8].split('*');

				var htmlContent="<h1>Изменениеe данных товара</h1><form id=\"user_edit\" action=\"scripts/updateProduct.php\" method=\"post\" name=\"forma\"><fieldset><input type=\"hidden\" name=\"id\"  value=\"".concat(res[0]).concat("\"><label id=\"label\" for=\"product\">Название: </label><input id=\"text_edit\" type=\"text\" name=\"product\" size=\"30\" placeholder=\"").concat(res[1]).concat("\"><br/><label id=\"label\" for=\"products_group\">Группа: </label><select name=\"products_group\">");
				for(i=0;i<productGroupName.length;i++)
				htmlContent=htmlContent.concat("<option value=\"").concat(productGroupId[i]).concat("\">").concat(((productGroupName[i])? productGroupName[i] : 'Отсутствует')).concat("</option>");
				htmlContent=htmlContent.concat("</select></br><label id=\"label\" for=\"price\">Цена: </label><input id=\"text_edit\" type=\"text\" name=\"price\" size=\"34\" placeholder=\"").concat(res[2]).concat(" руб.\"><br/><label id=\"label\" for=\"count\">Количество: </label><input id=\"text_edit\" type=\"text\" name=\"count\" size=\"27\" placeholder=\"").concat(res[3]).concat(" шт.\"><br/><label id=\"label\" for=\"description\">Описание: </label><input id=\"text_edit\" type=\"text\" name=\"description\" size=\"29\" placeholder=\"").concat(res[4]).concat("\"><br/><label id=\"label\" for=\"discount\">Скидка: </label><input id=\"text_edit\" type=\"text\" name=\"discount\" size=\"31\" readonly value=\"").concat((res[6])? res[6] : 'Отсутствует').concat("\"><br/></fieldset><fieldset><input id=\"submit\" type=\"submit\" value=\"Изменить данные\"></fieldset></form>");
				htmlContent=htmlContent.concat("<div class='link1'><ul><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
				
				$('#info2').html(htmlContent);
	   
				$("#info").hide();
				$("#info2").hide();
				$("#info2").show();
			}
		});
		console.log("Opening page named \"editRecord\"");
	});
}
initClickEditProduct();

/////////////////////
function initClickDeleteProduct() {
	$('.productDelete').click(function(){

		var id = $(this).data('id');
		if(id == null) {
			var productId = $('#product_id').val();
			var productsGroupId = $('#products_group_id').val();
			var discountId = $('#discount_id').val();
			var ob = {'productId':productId,'productsGroupId':productsGroupId,'discountId':discountId};
		}
		else {
			id = id.slice(1,(id.length-1));
			var dataId = id.split('|');
			var ob = {'productId':dataId[0],'productsGroupId':dataId[1],'discountId':dataId[2]};
		}
		console.log(ob.discountId);
 
		$.ajax({
			type:'POST',
			url:'scripts/deleteProduct.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log("Record deleted from table \"product\"");
				runPage('product.html','#info');
				
				$("#info").hide();
				$("#info2").hide();
				$("#info").show();
			}
		});
		console.log("Opening page named \"deleteRecord\"");
	});
}
initClickDeleteProduct();

//----------------------------------- Валидаторы ----------------------------------------//
//userData
function validateCartNumber(input) {
	if ((input.value.match(/^[0-9]{9}$/))) input.setCustomValidity("");   
	else input.setCustomValidity("Максимально допустимое значение для ввода насчитывает девять символов");	
}

function validatePhone(input) {
	if (input.value.length <= 16) input.setCustomValidity("");   
	else input.setCustomValidity("Максимально допустимое значение для ввода насчитывает шестнадцать символов");	
	
	if (input.value.match(/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/)) input.setCustomValidity("");
	else input.setCustomValidity("Были введены недопустимые символы");
}

function validateMail(input) {
	if (input.value.length <= 20) input.setCustomValidity("");   
	else input.setCustomValidity("Максимально допустимое значение для ввода насчитывает двадцать символов");	
	
	if (input.value.match(/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/)) input.setCustomValidity("");
	else input.setCustomValidity("Были введены недопустимые символы");
}

function validateFIO(input) {
	if (input.value.length <= 100) input.setCustomValidity("");   
	else input.setCustomValidity("Максимально допустимое значение для ввода насчитывает сто символов");	
	
	if (input.value.match(/^(([А-ЯЁ][а-яё]+)|([A-Z][a-z]+)) (([А-ЯЁ][а-яё]+)|([A-Z][a-z]+)) (([А-ЯЁ][а-яё]+)|([A-Z][a-z]+))$/)) input.setCustomValidity("");
	else input.setCustomValidity("Были введены недопустимые символы");
}

function validateAddress(input) {
	if (input.value.length <= 50) input.setCustomValidity("");   
	else input.setCustomValidity("Максимально допустимое значение для ввода насчитывает пятьдесят символов");	
}

//discount
function validateDiscountName(input) {
	if (input.value.length <= 20) input.setCustomValidity("");   
	else input.setCustomValidity("Максимально допустимое значение для ввода насчитывает двадцать символов");
}

function validateDiscountValue(input) {
	if ((input.value.match(/^([0-9])|([0-9]{2})$/))) input.setCustomValidity("");   
	else input.setCustomValidity("Значение должно соответствовать процентному диапозону");	
}

function validateDescription(input) {
	if (input.value.length <= 200) input.setCustomValidity("");   
	else input.setCustomValidity("Максимально допустимое значение для ввода насчитывает двести символов");
}

//account
function validateLogin(input) {
	if (input.value.length <= 20) input.setCustomValidity("");   
	else input.setCustomValidity("Максимально допустимое значение для ввода насчитывает двадцать символов");	
}

function validatePassword(input) {
	if (input.value.length >= 4 && input.value.length <= 20) input.setCustomValidity("");   
	else input.setCustomValidity("Оптимальный пароль должен содержать от четырех до двадцати символов");	
}
////////////////////////////////////////////

//productGroup
$('#array_products_id').change(function(){
     var current=$('#array_products_id option:selected').val();
	 
	 var objSel = document.getElementById("array_products_count");
	 objSel.selectedIndex = current;
	 
	 console.log("Change product property (id)");
});

$('#array_products_count').change(function(){
     var current=$('#array_products_count option:selected').val();
	 
	 var objSel = document.getElementById("array_products_id");
	 objSel.selectedIndex = current;
	 
	 console.log("Change product property (count)");
});

//storage
$('.storageShow').click(function(){
	var id = $(this).data('id');
	var ob = {'id':id}
	
	$.ajax({
		type:'POST',
		url:'scripts/outputStorage.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log(html);
			var res = html.split('|');
			var productName = res[2].split('*');
			var productCount = res[3].split(', ');
			//Страница "Показать запись"
			var htmlContent ="<h1>Информация о складе</h1><input type=\"hidden\" id=\"pers_id\"  value=\"".concat(res[0]).concat("\"><body><table class='table4' border=0 width=40% cellspacing = 0 align=center><tr><td class='table4td'><p>Название: ").concat("<b>").concat(res[1]).concat("</b></td></tr><tr><td class='table4td'><p>Список товаров: <select id=\"array_products_id\">");
			for(i=0;i<productName.length;i++)
				htmlContent=htmlContent.concat("<option>").concat(i+1).concat(". ").concat(((productName[i])? productName[i] : 'Отсутствует')).concat("</option>");
			htmlContent=htmlContent.concat("</select></p><p>Количество товаров: <select id=\"array_products_count\">");
			
			for(i=0;i<productCount.length;i++)
				htmlContent=htmlContent.concat("<option>").concat(i+1).concat(". ").concat(((productCount[i])? productCount[i] : '0')).concat(" шт.</option>");
			htmlContent=htmlContent.concat("</td></tr></table>");
			htmlContent=htmlContent.concat("<Br><div class='links'><ul><li><a class='storageEdit' href=\"#\">Редактировать</a></li><li><a class='storageDelete' href=\"#\">Удалить</a></li><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
			
			$('#info2').html(htmlContent);
			initClickEditStorage();
			initClickDeleteStorage();
			
			$("#info").hide();
			$("#info2").show();
		}
	});	
	console.log("Opening page named \"showRecord\"");
});

function initClickEditStorage() {
	$('.storageEdit').click(function(){

		var id = $(this).data('id');
		if(id == null) {
			id = $('#pers_id').val();
		}
		var ob = {'id':id};
	 
		$.ajax({
			type:'POST',
			url:'scripts/outputEditStorage.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log(html);
				var res = html.split('|');
				var productName = res[2].split('*');
				var productId = res[3].split('*');
				var productActiveId = res[4].split('*');

				//Страница редактировать
				var htmlContent="<h1>Изменение информации о складе</h1><form id=\"user_edit\" action=\"scripts/updateStorage.php\" method=\"post\" name=\"forma\"><fieldset><input type=\"hidden\" name=\"id\"  value=\"".concat(res[0]).concat("\"><label id=\"label\" for=\"storage\">Название: </label><input id=\"text_edit\" type=\"text\" name=\"storage\" size=\"30\" placeholder=\"").concat(res[1]).concat("\"><br/><label id=\"label\" for=\"array_products_id\">Список товаров: </label><br/><select class='multipleSelect' multiple name=\"products[]\" id=\"array_products_id\">");
				//for(i=0;i<productName.length;i++)
				//htmlContent=htmlContent.concat("<option value=\"").concat(productId[i]).concat("\">").concat(((productName[i])? productName[i] : 'Отсутствует')).concat("</option>");
				////////
				var activeFlag=false;
				for(i=0;i<productName.length;i++) {
					for(j=0;j<productActiveId.length;j++)
						if(productId[i]==productActiveId[j]) {
							htmlContent=htmlContent.concat("<option selected value=\"").concat(productId[i]).concat("\">").concat(((productName[i])? productName[i] : 'Отсутствует')).concat("</option>");
							activeFlag=true;
						}
					if(activeFlag==false) htmlContent=htmlContent.concat("<option value=\"").concat(productId[i]).concat("\">").concat(((productName[i])? productName[i] : 'Отсутствует')).concat("</option>");
					activeFlag=false;
				}
				/////////
				htmlContent=htmlContent.concat("</select></br><label id=\"label\" for=\"array_products_count\">Количество товаров: </label><input id=\"text_edit\" type=\"text\" name=\"array_products_count\" size=\"14\" placeholder=\"").concat(res[4]).concat("\"> <br/></fieldset><fieldset><input id=\"submit\" type=\"submit\" value=\"Изменить данные\"></fieldset></form>");
				htmlContent=htmlContent.concat("<div class='link1'><ul><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
			
				$('#info2').html(htmlContent);
	   
				$("#info").hide();
				$("#info2").hide();
				$("#info2").show();
			}
		});
		console.log("Opening page named \"editRecord\"");
	});
}
initClickEditStorage();

function initClickDeleteStorage() {
	$('.storageDelete').click(function(){

		var isTableShow='false';
	
		var id = $(this).data('id');
		if(id == null) {
			id = $('#pers_id').val();
			isTableShow='true';
		}
		var ob = {'id':id};

		//Посылаем запрос к account
		$.ajax({
			type:'POST',
			url:'scripts/dataCheckStorage.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log((html=="true")? "Record have few linked storage": "Can deleting this record");
				if(html=="true" && isTableShow=="false") {
					document.getElementById('deleteStorageId').value = ob.id;
					$('.popupQuestionToDeleting').css('display', 'block');
				}
				else {
					$.ajax({
						type:'POST',
						url:'scripts/deleteStorage.php',
						dataType:'json',
						data:"param="+JSON.stringify(ob),
						success:function(html) {
							console.log("Record deleted from table \"storage\"");
							runPage('storage.html','#info');
							
							$("#info").hide();
							$("#info2").hide();
							$("#info").show();
						}
					});
				}
			}
		});
		console.log("Opening page named \"deleteRecord\"");
	});
}
initClickDeleteStorage();

$("#deleteCancelStorage").click(function(){
	$('.popupQuestionToDeleting').css('display', 'none');
});

$("#deleteYesStorage").click(function(){
	var data = {'id':document.getElementById('deleteStorageId').value,'answer':'yes'};
	delRecordsStorage(data);
});

$("#deleteNoStorage").click(function(){
	var data = {'id':document.getElementById('deleteStorageId').value,'answer':'no'};
	delRecordsStorage(data);
});

function delRecordsStorage(data) {
	var ob = {'id':data.id};
	
	if(data.answer!='yes' && data.answer!='no') $('.popupQuestionToDeleting').css('display', 'none');
	else if(data.answer=='yes') {
		//Удалить запись из "Аккаунт"
		$.ajax({
			type:'POST',
			url:'scripts/deleteLinkedStorage.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log(html);
				console.log("Linked records deleted from table \"products_group\"");
			}
		});
	}

	$.ajax({
		type:'POST',
		url:'scripts/deleteStorage.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log("Record deleted from table \"storage\"");
			
			runPage('storage.html','#info');
			
			$("#info").hide();
			$("#info2").hide();
			$("#info").show();
			
			$('.popupQuestionToDeleting').css('display', 'none');
		}
	});
}

//productGroup
$('.productsGroupShow').click(function(){
	var id = $(this).data('id');
	var ob = {'id':id}
	console.log(ob.id);
	$.ajax({
		type:'POST',
		url:'scripts/outputProductsGroup.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log(html);
			var res = html.split('|');
			var productName = res[2].split('*');
			var productCount = res[3].split(', ');
			//Страница "Показать запись"
			var htmlContent ="<h1>Информация о группе товаров</h1><input type=\"hidden\" id=\"pers_id\"  value=\"".concat(res[0]).concat("\"><body><table class='table4' border=0 width=40% cellspacing = 0 align=center><tr><td class='table4td'><p>Название: ").concat("<b>").concat(res[1]).concat("</b></td></tr><tr><td class='table4td'><p>Список товаров: <select id=\"array_products_id\">");
			for(i=0;i<productName.length;i++)
				htmlContent=htmlContent.concat("<option>").concat(i+1).concat(". ").concat(((productName[i])? productName[i] : 'Отсутствует')).concat("</option>");
			htmlContent=htmlContent.concat("</select></p><p>Количество товаров: <select id=\"array_products_count\">");
			
			for(i=0;i<productCount.length;i++)
				htmlContent=htmlContent.concat("<option>").concat(i+1).concat(". ").concat(((productCount[i])? productCount[i] : '0')).concat(" шт.</option>");
			htmlContent=htmlContent.concat("</select><p>Склад: ").concat(res[4]).concat("</p></td></tr></table>");
			htmlContent=htmlContent.concat("<Br><div class='links'><ul><li><a class='productsGroupEdit' href=\"#\">Редактировать</a></li><li><a class='productsGroupDelete' href=\"#\">Удалить</a></li><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
			
			$('#info2').html(htmlContent);
			initClickEditProductsGroup();
			initClickDeleteProductsGroup();
			
			$("#info").hide();
			$("#info2").show();
		}
	});	
	console.log("Opening page named \"showRecord\"");
});

//////////////////////////////
function initClickEditProductsGroup() {
	$('.productsGroupEdit').click(function(){

		var id = $(this).data('id');
		if(id == null) {
			id = $('#pers_id').val();
		}
		var ob = {'id':id};
	 
		$.ajax({
			type:'POST',
			url:'scripts/outputEditProductsGroup.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
			console.log(html);
			
				var res = html.split('|');
				var productName = res[2].split('*');
				var productId = res[3].split('*');
				var productActiveId = res[4].split('*');
				var storageName = res[7].split('*');
				var storageId = res[6].split('*');
				

				//Страница редактировать
				var htmlContent="<h1>Изменение информации о складе</h1><form id=\"user_edit\" action=\"scripts/updateProductsGroup.php\" method=\"post\" name=\"forma\"><fieldset><input type=\"hidden\" name=\"id\"  value=\"".concat(res[0]).concat("\"><label id=\"label\" for=\"productsGroupName\">Название: </label><input id=\"text_edit\" type=\"text\" name=\"productsGroupName\" size=\"30\" placeholder=\"").concat(res[1]).concat("\"><br/><label id=\"label\" for=\"array_products_id\">Список товаров: </label><br/><select class='multipleSelect' multiple name=\"productsGroup[]\" id=\"array_products_id\">");
				var activeFlag=false;
				for(i=0;i<productName.length;i++) {
					for(j=0;j<productActiveId.length;j++)
						if(productId[i]==productActiveId[j]) {
							htmlContent=htmlContent.concat("<option selected value=\"").concat(productId[i]).concat("\">").concat(((productName[i])? productName[i] : 'Отсутствует')).concat("</option>");
							activeFlag=true;
						}
					if(activeFlag==false) htmlContent=htmlContent.concat("<option value=\"").concat(productId[i]).concat("\">").concat(((productName[i])? productName[i] : 'Отсутствует')).concat("</option>");
					activeFlag=false;
				}
				htmlContent=htmlContent.concat("</select></br><label id=\"label\" for=\"array_products_count\">Количество товаров: </label><input id=\"text_edit\" type=\"text\" name=\"array_products_count\" size=\"14\" placeholder=\"").concat(res[5]).concat("\">");
				htmlContent=htmlContent.concat("<label id=\"label\" for=\"storageToProductsGroup\">Склад: </label><select name=\"storageToProductsGroup\">");
				for(i=0;i<storageName.length;i++) {
					if(storageId[i]==res[8]) htmlContent=htmlContent.concat("<option selected value=\"").concat(storageId[i]).concat("\">").concat(((storageName[i])? storageName[i] : 'Отсутствует')).concat("</option>");
					else htmlContent=htmlContent.concat("<option value=\"").concat(storageId[i]).concat("\">").concat(((storageName[i])? storageName[i] : 'Отсутствует')).concat("</option>");
				}
				htmlContent=htmlContent.concat("</select> <br/></fieldset><fieldset><input id=\"submit\" type=\"submit\" value=\"Изменить данные\"></fieldset></form>");
				htmlContent=htmlContent.concat("<div class='link1'><ul><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li>ul></div>");

				$('#info2').html(htmlContent);
	   
				$("#info").hide();
				$("#info2").hide();
				$("#info2").show();
			}
		});
		console.log("Opening page named \"editRecord\"");
	});
}
initClickEditProductsGroup();

function initClickDeleteProductsGroup() {
	$('.productsGroupDelete').click(function(){

		var isTableShow='false';
	
		var id = $(this).data('id');
		if(id == null) {
			id = $('#pers_id').val();
			isTableShow='true';
		}
		var ob = {'id':id};

		//Посылаем запрос к account
		$.ajax({
			type:'POST',
			url:'scripts/dataCheckProductsGroup.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log((html=="true")? "Record have few linked products": "Can deleting this record");
				if(html=="true" && isTableShow=="false") {
					document.getElementById('deleteProductsGroupId').value = ob.id;
					$('.popupQuestionToDeleting').css('display', 'block');
				}
				else {
					$.ajax({
						type:'POST',
						url:'scripts/deleteProductsGroup.php',
						dataType:'json',
						data:"param="+JSON.stringify(ob),
						success:function(html) {
							console.log("Record deleted from table \"products_group\"");
							runPage('productsGroup.html','#info');
							
							$("#info").hide();
							$("#info2").hide();
							$("#info").show();
						}
					});
				}
			}
		});
		console.log("Opening page named \"deleteRecord\"");
	});
}
initClickDeleteProductsGroup();

$("#deleteCancel").click(function(){
	$('.popupQuestionToDeleting').css('display', 'none');
});

$("#deleteProductsGroupYes").click(function(){
	var data = {'id':document.getElementById('deleteProductsGroupId').value,'answer':'yes'};
	delRecordsProductsGroup(data);
});

$("#deleteProductsGroupNo").click(function(){
	var data = {'id':document.getElementById('deleteProductsGroupId').value,'answer':'no'};
	delRecordsProductsGroup(data);
});

function delRecordsProductsGroup(data) {
	var ob = {'id':data.id};
	
	if(data.answer!='yes' && data.answer!='no') $('.popupQuestionToDeleting').css('display', 'none');
	else if(data.answer=='yes') {
		//Удалить запись из "Аккаунт"
		$.ajax({
			type:'POST',
			url:'scripts/deleteLinkedProduct.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log(html);
				console.log("Linked records deleted from table \"products_group\"");
			}
		});
	}

	$.ajax({
		type:'POST',
		url:'scripts/deleteProductsGroup.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log("Record deleted from table \"products_group\"");
			
			runPage('productsGroup.html','#info');
			
			$("#info").hide();
			$("#info2").hide();
			$("#info").show();
			
			$('.popupQuestionToDeleting').css('display', 'none');
		}
	});
}

////////////
$('.cartShow').click(function(){
	var id = $(this).data('id');
	var ob = {'id':id}
	
	$.ajax({
		type:'POST',
		url:'scripts/outputCart.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log(html);
			var res = html.split('|');
			var productName = res[1].split('*');
			var productCount = res[2].split(', ');
			//Страница "Показать запись"
			var htmlContent ="<h1>Информация о складе</h1><input type=\"hidden\" id=\"pers_id\"  value=\"".concat(res[0]).concat("\"><body><table class='table4' border=0 width=40% cellspacing = 0 align=center><tr><td class='table4td'><p>Название: ").concat("<b>").concat("Корзина №").concat(res[0]).concat("</b></td></tr><tr><td class='table4td'><p>Список товаров: <select id=\"array_products_id\">");
			for(i=0;i<productName.length;i++)
				htmlContent=htmlContent.concat("<option>").concat(i+1).concat(". ").concat(((productName[i])? productName[i] : 'Отсутствует')).concat("</option>");
			htmlContent=htmlContent.concat("</select></p><p>Количество товаров: <select id=\"array_products_count\">");
			
			for(i=0;i<productCount.length;i++)
				htmlContent=htmlContent.concat("<option>").concat(i+1).concat(". ").concat(((productCount[i])? productCount[i] : '0')).concat(" шт.</option>");
			htmlContent=htmlContent.concat("</td></tr></table>");
			htmlContent=htmlContent.concat("<div class='link1'><ul><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
			
			$('#info2').html(htmlContent);
			initClickEditStorage();
			initClickDeleteStorage();
			
			$("#info").hide();
			$("#info2").show();
		}
	});	
	console.log("Opening page named \"showRecord\"");
});

//order
$('.orderShow').click(function(){
	var id = $(this).data('id');
	var ob = {'id':id}
 
	$.ajax({
		type:'POST',
		url:'scripts/outputOrder.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log(html);
			var res = html.split('|');
			//Страница "Показать запись"
			var htmlContent ="<h1>Информация о заказе</h1><input type=\"hidden\" id=\"pers_id\"  value=\"".concat(res[0]).concat("\"><body><table class='table4' border=0 width=40% cellspacing = 0 align=center><tr><td class='table4td'><p>Название: ").concat("<b>").concat('Заказ № ').concat(res[0]).concat("</b></td></tr><tr><td class='table4td'>").concat("<p>Корзина: Корзина № ").concat(res[1]).concat("</p><p>Клиент: ").concat(res[2]).concat("</p><p>Скидка: ").concat(res[3]).concat(" (").concat(res[4]).concat("%)</p><p>Стоимость: ").concat(res[5]).concat(" руб.</p><p>Сумма к оплате: ").concat(res[6]).concat(" руб.</p></td></tr></table></body>");
			htmlContent=htmlContent.concat("<Br><div class='links3'><ul><li><a class='orderDelete' href=\"#\">Удалить</a></li><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
						
			$('#info2').html(htmlContent);
			
			initClickDeleteOrder();
			
			$("#info").hide();
			$("#info2").show();
		}
	});
	
	console.log("Opening page named \"showRecord\"");
});
//////////////////////////////////////////////
function initClickDeleteOrder() {
	$('.orderDelete').click(function(){

		var isTableShow='false';
	
		var id = $(this).data('id');
		if(id == null) {
			id = $('#pers_id').val();
			isTableShow='true';
		}
		var ob = {'id':id};

		//Посылаем запрос к account
		$.ajax({
			type:'POST',
			url:'scripts/dataCheckOrder.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log((html=="true")? "Record have few linked cart": "Can deleting this record");
				if(html=="true" && isTableShow=="false") {
					document.getElementById('deleteOrderId').value = ob.id;
					$('.popupQuestionToDeleting').css('display', 'block');
				}
				else {
					$.ajax({
						type:'POST',
						url:'scripts/deleteOrder.php',
						dataType:'json',
						data:"param="+JSON.stringify(ob),
						success:function(html) {
							console.log("Record deleted from table \"order\"");
							runPage('order.html','#info');
							
							$("#info").hide();
							$("#info2").hide();
							$("#info").show();
						}
					});
				}
			}
		});
		console.log("Opening page named \"deleteRecord\"");
	});
}
initClickDeleteOrder();

$("#deleteCancel").click(function(){
	$('.popupQuestionToDeleting').css('display', 'none');
});

$("#deleteOrderYes").click(function(){
	var data = {'id':document.getElementById('deleteOrderId').value,'answer':'yes'};
	delRecordsOrder(data);
});

$("#deleteOrderNo").click(function(){
	var data = {'id':document.getElementById('deleteOrderId').value,'answer':'no'};
	delRecordsOrder(data);
});

function delRecordsOrder(data) {
	var ob = {'id':data.id};
	
	if(data.answer!='yes' && data.answer!='no') $('.popupQuestionToDeleting').css('display', 'none');
	else if(data.answer=='yes') {
		//Удалить запись из "Аккаунт"
		$.ajax({
			type:'POST',
			url:'scripts/deleteLinkedOrder.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log(html);
				console.log("Linked records deleted from table \"order\"");
			}
		});
	}

	$.ajax({
		type:'POST',
		url:'scripts/deleteOrder.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log("Record deleted from table \"order\"");
			
			runPage('order.html','#info');
			
			$("#info").hide();
			$("#info2").hide();
			$("#info").show();
			
			$('.popupQuestionToDeleting').css('display', 'none');
		}
	});
}

////////////////////

$('.orderForStorageShow').click(function(){
	var id = $(this).data('id');
	var ob = {'id':id}
	
	$.ajax({
		type:'POST',
		url:'scripts/orderForStorageShow.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			console.log(html);
			var res = html.split('|');
			var productName = res[2].split('*');
			var productCount = res[3].split(', ');
			//Страница "Показать запись"
			var htmlContent ="<h1>Информация о заказе для склада</h1><input type=\"hidden\" id=\"pers_id\"  value=\"".concat(res[0]).concat("\"><body><table class='table4' border=0 width=40% cellspacing = 0 align=center><tr><td class='table4td'><p>Название: ").concat("<b>").concat(res[1]).concat("</b></td></tr><tr><td class='table4td'><p>Список товаров: <select id=\"array_products_id\">");
			for(i=0;i<productName.length;i++)
				htmlContent=htmlContent.concat("<option>").concat(i+1).concat(". ").concat(((productName[i])? productName[i] : 'Отсутствует')).concat("</option>");
			htmlContent=htmlContent.concat("</select></p><p>Количество товаров: <select id=\"array_products_count\">");
			
			for(i=0;i<productCount.length;i++)
				htmlContent=htmlContent.concat("<option>").concat(i+1).concat(". ").concat(((productCount[i])? productCount[i] : '0')).concat(" шт.</option>");
			htmlContent=htmlContent.concat("</select><p>Дата заказа: ").concat(res[4]).concat("</p><p>Заказчик/Ответственный: ").concat(res[5]).concat("</p></td></tr></table>");
			htmlContent=htmlContent.concat("<Br><div class='links'><ul><li><a class='OrderForStorageEdit' href=\"#\">Редактировать</a></li><li><a class='orderForStorageDelete' href=\"#\">Удалить</a></li><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
			
			$('#info2').html(htmlContent);
			
			initClickEditOrderForStorage();
			initClickDeleteOrderForStorage();
			
			$("#info").hide();
			$("#info2").show();
		}
	});	
	console.log("Opening page named \"showRecord\"");
});

function initClickEditOrderForStorage() {
	$('.OrderForStorageEdit').click(function(){

		var id = $(this).data('id');
		if(id == null) {
			id = $('#pers_id').val();
		}
		var ob = {'id':id};
	 
		$.ajax({
			type:'POST',
			url:'scripts/outputEditOrderForStorage.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
			console.log(html);
				var res = html.split('|');
				var storageName = res[2].split('*');
				var storageId = res[1].split('*');
				var productName = res[4].split('*');
				var productId = res[5].split('*');
				var productActiveId = res[6].split('*');
				console.log(productActiveId[1]);
				
				//Страница редактировать
				var htmlContent="<h1>Изменение информации о заказе для склада</h1><form id=\"user_edit\" action=\"scripts/updateOrderForStorage.php\" method=\"post\" name=\"forma\"><fieldset><input type=\"hidden\" name=\"id\"  value=\"".concat(res[0]).concat("\"><label id=\"label\" for=\"orderForStorageName\">Склад: </label><select name=\"orderForStorageName\">");
				for(i=0;i<storageName.length;i++) {
					if(storageId[i]==res[3]) htmlContent=htmlContent.concat("<option selected value=\"").concat(storageId[i]).concat("\">").concat(((storageName[i])? storageName[i] : 'Отсутствует')).concat("</option>");
					else htmlContent=htmlContent.concat("<option value=\"").concat(storageId[i]).concat("\">").concat(((storageName[i])? storageName[i] : 'Отсутствует')).concat("</option>");
				}
				htmlContent=htmlContent.concat("</select><br/><label id=\"label\" for=\"array_products_id\">Список товаров: </label><br/><select class='multipleSelect' multiple name=\"products[]\" id=\"array_products_id\">");
				var activeFlag=false;
				for(i=0;i<productName.length;i++) {
					for(j=0;j<productActiveId.length;j++)
						if(productId[i]==productActiveId[j]) {
							htmlContent=htmlContent.concat("<option selected value=\"").concat(productId[i]).concat("\">").concat(((productName[i])? productName[i] : 'Отсутствует')).concat("</option>");
							activeFlag=true;
						}
					if(activeFlag==false) htmlContent=htmlContent.concat("<option value=\"").concat(productId[i]).concat("\">").concat(((productName[i])? productName[i] : 'Отсутствует')).concat("</option>");
					activeFlag=false;
				}
				htmlContent=htmlContent.concat("</select></br><label id=\"label\" for=\"array_products_count\">Количество товаров: </label><input id=\"text_edit\" type=\"text\" name=\"array_products_count\" size=\"19\" placeholder=\"").concat(res[7]).concat("\"></br><label id=\"label\" for=\"orderDate\">Дата заказа: </label><input id=\"text_edit\" type=\"text\" name=\"orderDate\" size=\"27\" placeholder=\"").concat(res[8]).concat("\"></br><label id=\"label\" for=\"agent\">Заказчик/Ответственный: </label><input id=\"text_edit\" type=\"text\" name=\"agent\" size=\"14\" placeholder=\"").concat(res[9]).concat("\"><br/></fieldset><fieldset><input id=\"submit\" type=\"submit\" value=\"Изменить данные\"></fieldset></form>");
				htmlContent=htmlContent.concat("<div class='link1'><ul><li><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></li></ul></div>");
				
				$('#info2').html(htmlContent);
	   
				$("#info").hide();
				$("#info2").hide();
				$("#info2").show();
			}
		});
		console.log("Opening page named \"editRecord\"");
	});
}
initClickEditOrderForStorage();

function initClickDeleteOrderForStorage() {
	$('.orderForStorageDelete').click(function(){

		var id = $(this).data('id');
		if(id == null) {
			id = $('#pers_id').val();
		}
		var ob = {'id':id};
 
		$.ajax({
			type:'POST',
			url:'scripts/deleteOrderForStorage.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log("Record deleted from table \"orderForStorage\"");
				runPage('orderForStorage.html','#info');
				
				$("#info").hide();
				$("#info2").hide();
				$("#info").show();
			}
		});
		console.log("Opening page named \"deleteRecord\"");
	});
}
initClickDeleteOrderForStorage();

function searchAccount(){	
	var fio = document.forms["searchAccount"].elements["fioSearch"].value;
	var login = document.forms["searchAccount"].elements["loginSearch"].value;
	var order_list = document.forms["searchAccount"].elements["orderListSearch"].value;
	var discount = document.forms["searchAccount"].elements["discountSearch"].value;
	var cart = document.forms["searchAccount"].elements["cartSearch"].value;
	
	if(order_list.indexOf("Заказ № ")!=(-1)) {
		order_list = order_list.replace("Заказ № ", '');
	}
	if(order_list.indexOf("Заказ №")!=(-1)) {
		order_list = order_list.replace("Заказ №", '');
	}
	
	if(cart.indexOf("Корзина № ")!=(-1)) {
		cart = cart.replace("Корзина № ", '');
	}
	if(cart.indexOf("Корзина №")!=(-1)) {
		cart = cart.replace("Корзина №", '');
	}
	
	var searchData = {'fio':fio,'login':login,'order_list':order_list,'discount':discount,'cart':cart};
	$.ajax({
		type:'POST',
		url:'scripts/searchAccount.php',
		dataType:'json',
		data:"searchData="+JSON.stringify(searchData),
		success:function(html) {
			console.log(html);
			if(html!="") var res = html.split('*');
			
			var htmlContent="";
			if(html!="") htmlContent="<h1>Результат поиска</h1><body><style type=\"text/css\"> .table5 {margin-right: 40px;\n margin-top: -5px;\n margin-bottom: 10px;\n border: 1px solid black;} </style><table class='table5' border=0 width=75% cellspacing = 0 align=right><tr><th class='table_font'>Пользователь</th><th class='table_font'>Логин</th><th class='table_font'>Пароль</th><th class='table_font'>Список заказов</th><th class='table_font'>Скидка для пользователя</th><th class='table_font'>Корзина</th></tr>";
			else htmlContent="<p>. ______________________________________________________________________________________________________.</p><p>______________________ К сожалению не одной записи по данному запросу не было найдено. ______________________</p></Br>";
			if(html!="") {
				for (var i=0;i<res.length;i++){
					var record = res[i].split('|');
					htmlContent=htmlContent.concat("<tr><td class='table3td'>").concat(record[1]).concat("</td><td class='table3td'>").concat(record[2]).concat("</td><td class='table3td'>");
					
					for(var j=0;j<record[3].length;j++)
						htmlContent=htmlContent.concat("*");
						
					htmlContent=htmlContent.concat("</td><td class='table3td'><select>");
					var order = record[4].split(', ');
					
					for(var j=0;j<order.length;j++)
						htmlContent=htmlContent.concat("<option>Заказ № ").concat(order[j]).concat("</option>");
							
					htmlContent=htmlContent.concat("</td><td class='table3td'>").concat(record[5]).concat("</td><td class='table3td'>Корзина № ").concat(record[6]).concat("</td></tr>");
				}
			}
			if(html!="")htmlContent=htmlContent.concat("</table>");
			htmlContent=htmlContent.concat("<style type=\"text/css\"> .link2 {float:right;\n margin-right: 310px;\n margin-bottom: 8px;\n box-shadow: 0px 1px 1px rgba(50,50,50, .4);\n width: 198px;\n height: 20px;\n background: rgba(240,240,240, .5);} .link2 >a { display: block;\n float: left;\n padding: 1px 27px;\n border-right: 1px solid rgba(0,0,0, .2);\n border-left: 1px solid rgba(0,0,0, .2);} </style><div class='link2'><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></div>");
			
			$('#info2').html(htmlContent);
			
			$("#info").hide();
			$("#info2").hide();
			$("#info2").show();
		}
	});
	console.log("Opening page named \"searchAccount\"");
}

///////////////
function searchCart(){	
	var cart_id = document.forms["searchCart"].elements["cartIdSearch"].value;
	var products_list = document.forms["searchCart"].elements["productsListSearch"].value;
		
	if(cart_id.indexOf("Корзина № ")!=(-1)) {
		cart_id = cart_id.replace("Корзина № ", '');
	}
	if(cart_id.indexOf("Корзина №")!=(-1)) {
		cart_id = cart_id.replace("Корзина №", '');
	}
	
	var searchData = {'cart_id':cart_id,'products_list':products_list};

	$.ajax({
		type:'POST',
		url:'scripts/searchCart.php',
		dataType:'json',
		data:"searchData="+JSON.stringify(searchData),
		success:function(html) {
			console.log(html);
			var res = html.split('<>');
			
			var htmlContent="";
			if(html!="") htmlContent="<h1>Результат поиска</h1><body><style type=\"text/css\"> .table5 {margin-right: 40px;\n margin-top: -5px;\n margin-bottom: 10px;\n border: 1px solid black;} </style><table class='table5' border=0 width=75% cellspacing = 0 align=right><tr><th class='table_font'>Корзина</th><th class='table_font'>Список товаров в корзине</th><th class='table_font'>Количество товаров в корзине</th></tr>";
			else htmlContent="<p>. ______________________________________________________________________________________________________.</p><p>______________________ К сожалению не одной записи по данному запросу не было найдено. ______________________</p></Br>";
			if(html!=""){
				for (var i=0;i<res.length;i++){
					var record = res[i].split('|');
					htmlContent=htmlContent.concat("<tr><td class='table3td'> Корзина № ").concat(record[0]).concat("</td>");
					
					htmlContent=htmlContent.concat("<td class='table3td'><select>");					
					var product = record[1].split('*');
					for(var j=0;j<product.length;j++)
						htmlContent=htmlContent.concat("<option>").concat(product[j]).concat("</option>");

					htmlContent=htmlContent.concat("</seletc></td><td class='table3td'><select>");					
					var productCount = record[2].split(', ');
					for(var j=0;j<productCount.length;j++)
						htmlContent=htmlContent.concat("<option>").concat(productCount[j]).concat(" шт.</option>");
				}
				htmlContent=htmlContent.concat("</seletc></td></tr></table>");
			}
			htmlContent=htmlContent.concat("<style type=\"text/css\"> .link2 {float:right;\n margin-right: 310px;\n margin-bottom: 8px;\n box-shadow: 0px 1px 1px rgba(50,50,50, .4);\n width: 198px;\n height: 20px;\n background: rgba(240,240,240, .5);} .link2 >a { display: block;\n float: left;\n padding: 1px 27px;\n border-right: 1px solid rgba(0,0,0, .2);\n border-left: 1px solid rgba(0,0,0, .2);} </style><div class='link2'><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></div>");
			
			$('#info2').html(htmlContent);
			
			$("#info").hide();
			$("#info2").hide();
			$("#info2").show();
		}
	});
	console.log("Opening page named \"searchCart\"");
}

////////////////////////////////////////
function searchOrder(){	
	var order_id = document.forms["searchOrder"].elements["orderSearch"].value;
	var cart_id = document.forms["searchOrder"].elements["cartSearch"].value;
	var account = document.forms["searchOrder"].elements["accountSearch"].value;
	var discount = document.forms["searchOrder"].elements["discountSearch"].value;
	var price = document.forms["searchOrder"].elements["priceSearch"].value;
	var total_price = document.forms["searchOrder"].elements["totalPriceSearch"].value;
		
	if(cart_id.indexOf("Корзина № ")!=(-1)) {
		cart_id = cart_id.replace("Корзина № ", '');
	}
	if(cart_id.indexOf("Корзина №")!=(-1)) {
		cart_id = cart_id.replace("Корзина №", '');
	}
	
	if(order_id.indexOf("Заказ № ")!=(-1)) {
		order_id = order_id.replace("Заказ № ", '');
	}
	if(order_id.indexOf("Заказ №")!=(-1)) {
		order_id = order_id.replace("Заказ №", '');
	}
	
	var searchData = {'cart_id':cart_id,'order_id':order_id, 'account':account, 'discount':discount, 'price':price, 'total_price':total_price};

	$.ajax({
		type:'POST',
		url:'scripts/searchOrder.php',
		dataType:'json',
		data:"searchData="+JSON.stringify(searchData),
		success:function(html) {
			console.log(html);
			var res = html.split('*');
			
			var htmlContent="";
			if(html!="") {
				htmlContent="<h1>Результат поиска</h1><body><style type=\"text/css\"> .table5 {margin-right: 40px;\n margin-top: -5px;\n margin-bottom: 10px;\n border: 1px solid black;} </style><table class='table5' border=0 width=75% cellspacing = 0 align=right><tr><th class='table_font'>Заказ</th><th class='table_font'>Корзина</th><th class='table_font'>Клиент</th><th class='table_font'>Скидка</th><th class='table_font'>Стоимость<br>(без учёта скидки)</th><th class='table_font'>Стоимость<br>(с учётом скидки)</th></tr><tr>";
				
			}
			else htmlContent="<p>. ______________________________________________________________________________________________________.</p><p>______________________ К сожалению не одной записи по данному запросу не было найдено. ______________________</p></Br>";
			for(var i=0;i<res.length;i++) {
				var data = res[i].split('|');
				htmlContent=htmlContent.concat("<th class='table3td'>Заказ № ").concat(data[0]).concat("</th>").concat("<th class='table3td'>Корзина № ").concat(data[1]).concat("</th>").concat("<th class='table3td'>").concat(data[2]).concat("</th>").concat("<th class='table3td'>").concat(data[3]).concat("</th>").concat("<th class='table3td'>").concat(data[4]).concat(" руб.</th>").concat("<th class='table3td'>").concat(data[5]).concat(" руб.</th></tr>");
				
			}
			
			htmlContent=htmlContent.concat("</table>");
			htmlContent=htmlContent.concat("<style type=\"text/css\"> .link2 {float:right;\n margin-right: 310px;\n margin-bottom: 8px;\n box-shadow: 0px 1px 1px rgba(50,50,50, .4);\n width: 198px;\n height: 20px;\n background: rgba(240,240,240, .5);} .link2 >a { display: block;\n float: left;\n padding: 1px 27px;\n border-right: 1px solid rgba(0,0,0, .2);\n border-left: 1px solid rgba(0,0,0, .2);} </style><div class='link2'><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></div>");
			
			$('#info2').html(htmlContent);
			
			$("#info").hide();
			$("#info2").hide();
			$("#info2").show();
		}
	});
	console.log("Opening page named \"searchOrder\"");
}

////////////////////////////////////////
function searchProductsGroup(){	
	var products_group = document.forms["searchProductsGroup"].elements["productsGroupSearch"].value;
	var products_list = document.forms["searchProductsGroup"].elements["productsListSearch"].value;
	var storage = document.forms["searchProductsGroup"].elements["storageSearch"].value;
	
	var searchData = {'products_group':products_group,'products_list':products_list, 'storage':storage};

	$.ajax({
		type:'POST',
		url:'scripts/searchProductsGroup.php',
		dataType:'json',
		data:"searchData="+JSON.stringify(searchData),
		success:function(html) {
			console.log(html);
			var res = html.split('<>');
			
			var htmlContent="";
			if(html!="") htmlContent="<h1>Результат поиска</h1><body><style type=\"text/css\"> .table5 {margin-right: 40px;\n margin-top: -5px;\n margin-bottom: 10px;\n border: 1px solid black;} </style><table class='table5' border=0 width=75% cellspacing = 0 align=right><tr><th class='table_font'>Группа товаров</th><th class='table_font'>Список товаров</th><th class='table_font'>Список количества товаров</th><th class='table_font'>Склад</th></th></tr><tr>";
			else htmlContent="<p>. ______________________________________________________________________________________________________.</p><p>______________________ К сожалению не одной записи по данному запросу не было найдено. ______________________</p></Br>";
			if(html!="") {
				for(var i=0;i<res.length;i++) {
					var data = res[i].split('|');
					htmlContent=htmlContent.concat("<th class='table3td'>").concat(data[0]).concat("</th>").concat("<th class='table3td'><select>");//.concat(data[1]).concat("</th>").concat("<th class='table3td'>").concat(data[2]).concat("</th>").concat("<th class='table3td'>").concat(data[3]).concat("</th>").concat("<th class='table3td'>").concat(data[4]).concat(" руб.</th>").concat("<th class='table3td'>").concat(data[5]).concat(" руб.</th></tr>");
					
					var product = data[1].split('|');
					for(var j=0;j<product.length;j++) {
						htmlContent=htmlContent.concat("<option>").concat(product[j]).concat("</option>");
					}
					htmlContent=htmlContent.concat("</select></th><th class='table3td'><select>");
					
					var product_count = data[2].split(', ');
					for(var j=0;j<product_count.length;j++) {
						htmlContent=htmlContent.concat("<option>").concat(product_count[j]).concat(" шт.</option>");
					}
					htmlContent=htmlContent.concat("</select></th><th class='table3td'>").concat((data[3])?data[3]:'Отсутствует').concat("</th></tr>");
				}
			}
			
			htmlContent=htmlContent.concat("</table>");
			htmlContent=htmlContent.concat("<style type=\"text/css\"> .link2 {float:right;\n margin-right: 310px;\n margin-bottom: 8px;\n box-shadow: 0px 1px 1px rgba(50,50,50, .4);\n width: 198px;\n height: 20px;\n background: rgba(240,240,240, .5);} .link2 >a { display: block;\n float: left;\n padding: 1px 27px;\n border-right: 1px solid rgba(0,0,0, .2);\n border-left: 1px solid rgba(0,0,0, .2);} </style><div class='link2'><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></div>");
			
			$('#info2').html(htmlContent);
			
			$("#info").hide();
			$("#info2").hide();
			$("#info2").show();
		}
	});
	console.log("Opening page named \"searchProductsGroup\"");
}
////////////////////////////////////////
function searchStorage(){	
	var storage = document.forms["searchStorage"].elements["storageSearch"].value;
	var products_list = document.forms["searchStorage"].elements["productsListSearch"].value;
	
	var searchData = {'storage':storage,'products_list':products_list};

	$.ajax({
		type:'POST',
		url:'scripts/searchStorage.php',
		dataType:'json',
		data:"searchData="+JSON.stringify(searchData),
		success:function(html) {
			console.log(html);
			var res = html.split('<>');
			
			var htmlContent="";
			if(html!="") htmlContent="<h1>Результат поиска</h1><body><style type=\"text/css\"> .table5 {margin-right: 40px;\n margin-top: -5px;\n margin-bottom: 10px;\n border: 1px solid black;} </style><table class='table5' border=0 width=75% cellspacing = 0 align=right><tr><th class='table_font'>Скидка</th><th class='table_font'>Список товаров</th><th class='table_font'>Список количества товаров</th></tr><tr>";
			else htmlContent="<p>. ______________________________________________________________________________________________________.</p><p>______________________ К сожалению не одной записи по данному запросу не было найдено. ______________________</p></Br>";
			if(html!="") {
				for(var i=0;i<res.length;i++) {
					var data = res[i].split('|');
					htmlContent=htmlContent.concat("<th class='table3td'>").concat(data[0]).concat("</th>").concat("<th class='table3td'><select>");//.concat(data[1]).concat("</th>").concat("<th class='table3td'>").concat(data[2]).concat("</th>").concat("<th class='table3td'>").concat(data[3]).concat("</th>").concat("<th class='table3td'>").concat(data[4]).concat(" руб.</th>").concat("<th class='table3td'>").concat(data[5]).concat(" руб.</th></tr>");
					
					var product = data[1].split('|');
					for(var j=0;j<product.length;j++) {
						htmlContent=htmlContent.concat("<option>").concat(product[j]).concat("</option>");
					}
					htmlContent=htmlContent.concat("</select></th><th class='table3td'><select>");
					
					var product_count = data[2].split(', ');
					for(var j=0;j<product_count.length;j++) {
						htmlContent=htmlContent.concat("<option>").concat(product_count[j]).concat(" шт.</option>");
					}
				}
			}
			
			htmlContent=htmlContent.concat("</tr></table>");
			htmlContent=htmlContent.concat("<style type=\"text/css\"> .link2 {float:right;\n margin-right: 310px;\n margin-bottom: 8px;\n box-shadow: 0px 1px 1px rgba(50,50,50, .4);\n width: 198px;\n height: 20px;\n background: rgba(240,240,240, .5);} .link2 >a { display: block;\n float: left;\n padding: 1px 27px;\n border-right: 1px solid rgba(0,0,0, .2);\n border-left: 1px solid rgba(0,0,0, .2);} </style><div class='link2'><a href=\"javascript:window.location.reload()\">Вернуться к таблице</a></div>");
			
			$('#info2').html(htmlContent);
			
			$("#info").hide();
			$("#info2").hide();
			$("#info2").show();
		}
	});
	console.log("Opening page named \"searchStorage\"");
}

/*$(".submitAutorisation").click(function(){

	Autorisation();
});


	
	
function Autorisation(){
	var login = document.getElementById('loginToAutorisation').value;
	var password = document.getElementById('passwordToAutorisation').value;

	//$('.popupQuestionToDeleting').css('display', 'none');
	console.log("login: ".concat(login).concat("; password: ").concat(password));
	
	var id=0;
	var ob = {'id':id};

	$.ajax({
		type:'POST',
		url:'scripts/Autorisation.php',
		dataType:'json',
		async: false,
		data:"param="+JSON.stringify(ob),
		success:function(html) {				
			console.log(html);
		}
	});
}
Autorisation();*/

	$('.submitAutorisation').click(function(){
	
		var login = document.getElementById('loginToAutorisation').value;
		var password = document.getElementById('passwordToAutorisation').value;
	
		console.log("login: ".concat(login).concat("; password: ").concat(password));
		var ob ={'login':login, 'password':password};
	 
		$.ajax({
			type:'POST',
			url:'scripts/Autorisation.php',
			dataType:'json',
			data:"param="+JSON.stringify(ob),
			success:function(html) {
				console.log(html);
				if(html==1) $('.popupAutorisation').css('display', 'none');
				else $('.popupAutorisation').css('display', 'block');
			}
		});
		console.log("Opening page named \"editRecord\"");
	});
	
function dataCheckAutorisation(){
	var ob = {'id':'inquiry'};
	$.ajax({
		type:'POST',
		url:'scripts/dataCheckAutorisation.php',
		dataType:'json',
		data:"param="+JSON.stringify(ob),
		success:function(html) {
			if(html=='true') $('.popupAutorisation').css('display', 'none');
				else $('.popupAutorisation').css('display', 'block');
		}
	});
}
//dataCheckAutorisation();