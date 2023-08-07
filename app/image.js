class Image{
	constructor(){
		this.avatar = '';
	}

	upload(){
		this.avatar = document.querySelector('#avatar').files[0];
		let formData = new FormData();
		formData.append('avatar', this.avatar);

		let data = formData;
		let xhr = new XMLHttpRequest();
		xhr.open('POST', './upload_image');
		xhr.send(data);
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				if(r == 0){
					utils.showToast('Error al cargar imagen','error');
				} else if(r == 1){
					utils.showToast('Foto guardada exitosamente', 'success');
					setTimeout(() => {
						window.location.reload();
					}, 3000);
				} else if (r == 2){
					utils.showToast('Error al guardar la imagen','error');
				} else if(r == 3){
					utils.showToast('La foto ya existe','danger');
				}else if(r == 4){
					utils.showToast('La imagen excede el tamaño permitido','danger');
				}
			}
		}
		
	}

	upload_image64(){
		this.avatar = document.querySelector('#preview').toDataURL("image/png", 0.4);
		let formData = new FormData();
		formData.append('avatar', this.avatar);

		let data = formData;
		let xhr = new XMLHttpRequest();
		xhr.open('POST', './upload_image64');
		xhr.send(data);
		xhr.onreadystatechange = function(){
			if (xhr.readyState == 4 && xhr.status == 200) {
				let r = xhr.responseText;
				console.log(r);
				if(r == 0){
					utils.showToast('Error al cargar imagen','error');
				} else if(r == 1){
					utils.showToast('Foto guardada exitosamente', 'success');
					setTimeout(() => {
						window.location.reload();
					}, 3000);
				} 
			}
		}
		
	}
}