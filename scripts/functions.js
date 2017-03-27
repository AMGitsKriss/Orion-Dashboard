function deleteEntry(name, id){
	if(window.confirm("Are you sure you want to delete this entry?")){
		var form = document.createElement("form");
		form.setAttribute("method", "post");
		form.setAttribute("action", "");
		var hiddenField = document.createElement("input");
		hiddenField.setAttribute("type", "hidden");
		hiddenField.setAttribute("name", name);
		hiddenField.setAttribute("value", id);
		form.appendChild(hiddenField);
		document.body.appendChild(form);
		form.submit();
	}
}
