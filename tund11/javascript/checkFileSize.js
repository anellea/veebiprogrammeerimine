window.onload = function(){
	document.getElementById("submit").disabled = true;
	document.getElementById("fileToUpload").addEventListener("change", checkSize);
}

function checkSize(){
	var fileToUpload = document.getElementById("fileToUpload").files[0];
	if(fileToUpload.size <= 2097152){
		document.getElementById("submit").disabled = false;
		document.getElementById("fileSizeError").innerHTML = "";
	}else{
		document.getElementById("submit").disabled = ture;
		document.getElementById("fileSizeError").innerHTML = "Valisid liiga suure faili, vali palun pilt max. mahuga 2Mb;
}