<template>
	<div class="contact">
		<form @submit.prevent="saveQuestion">
			<div class="form-group">
				<label class="control-label">Địa chỉ Email của bạn</label>
				<input type="text" v-model.trim="contact.email" class="form-control" placeholder="VD: Vinavi.adm@gmail.com" @keydown="error.email = null">
				<span v-if="error.email" class="error">{{ error.email }}</span>
			</div>
			<div class="form-group">
				<label class="control-label">Tiêu đề</label>
				<input type="text" v-model.trim="contact.title" class="form-control" placeholder="VD: Tôi cần tư vấn thêm!" @keydown="error.title = null">
				<span v-if="error.title" class="error">{{ error.title }}</span>
			</div>
			<div class="form-group">
				<label class="control-label">Nội dung</label>
				<textarea v-model.trim="contact.content" class="form-control" rows="10" cols="30" @keydown="error.content = null"></textarea>
				<span v-if="error.content" class="error">{{ error.content }}</span>
			</div>
			<div class="form-group">
				<label for="issue">Vui lòng chọn vấn đề cần hỗ trợ</label>
				<select v-model="contact.issue" class="form-control">
					<option disabled value="">Chọn vấn đề cần hỗ trợ</option>
					<option>Đơn hàng</option>
					<option>Tài khoản</option>
					<option>Khiếu nại</option>
					<option>Hỗ trợ kỹ thuật</option>
				</select>
			</div>
			<div class="form-group">
				<label for="file" class="add-file">
					<span class="file-name">
						<span class="color_orange">Thêm ảnh</span>
						<span class="color_none">hoặc thả ảnh ở đây</span>
					</span>
					<input type="file" id="file" name="file" @change="fileChanged" accept=".png,.jpeg,.jpg">
				</label>
				<div class="add-file-image" style="text-align: center">
					<img id="avatar" class="thumbnail" src="">
				</div>
				<span v-if="error.file" class="error">{{ error.file }}</span>
			</div>

			<div class="form-group">
				<vue-recaptcha
					:sitekey="capchaSitekey" 
					@verify="(value) => recaptcha = value"
					@expired="() => recaptcha = null"
				></vue-recaptcha>
				<span v-if="error.captcha" class="error">{{ error.captcha }}</span>
			</div>

			<div class="question text-center">
				<button type="submit" class="btn btn-primary bg-orange border-coler-orange">Gửi câu hỏi</button>
			</div>
		</form>
	</div>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';

export default {
    name: "contact",
	components: {
		'vue-recaptcha': VueRecaptcha
	},
    data() {
    	return {
    		contact: {
    			email: '',
	    		title: '',
	    		content: '',
	    		issue: '',
	    		file: '',
    		},
    		error: {
    			email:'',
    			title: '',
	    		content: '',
	    		file: '',
	    		captcha:'',
    		},
    		recaptcha: null,
    	}
    },
    props: {
        capchaSitekey: {
            type: String,
            required: true,
        },
    },
    mounted() {
		$('#file').change(function(e) {
			if (this.files.length > 0){
				var filename = this.files[0].name;
				$('.color_orange').text(filename);
				$('.color_none').text('thay đổi');	
			}		  
		});

		$('#avatar').hide();
    },
    methods: {
    	saveQuestion(){
			let scop = this;

			scop.error = {};
    		if(!scop.recaptcha) {
    			scop.error.captcha = "Vui lòng xác nhận Captcha.";

				return;
    		}

    		const config = {
		        headers: { 'content-type': 'multipart/form-data' }
			}	
    		let formData = new FormData();
      		formData.append('file', this.contact.file);
      		formData.append('email', this.contact.email);
      		formData.append('title', this.contact.title);
      		formData.append('content', this.contact.content);
      		formData.append('issue', this.contact.issue);
      		formData.append('file', this.contact.file);
			formData.append('capcha', this.recaptcha);
			
 			scop.$loading(true);
    		axios.post('contacts/store', formData, config)
              .then(response=>{
              	let data = response.data;
              	if(data.status == 200){
              		$('#file').val('');
              		scop.contact = {
              			email:'',
              			title:'',
              			content:'',
              			issue:'',
              			file:'',
              		}
	                $('#avatar').attr('src', "");
	                $('#avatar').attr('style', "display:none");
	                $('.color_orange').text('Thêm ảnh');
					$('.color_none').text('hoặc thả ảnh ở đây');
					
					$('#popup_alert .title').html('Gửi câu hỏi thành công'); 
					$('#popup_alert .message').html('');
					$('#popup_alert').modal('show');
              	} else if(data.status == 403){
                	this.error.captcha = data.message;
                } else {
					scop.error = {};
					
                	if(data.data.email){
						this.error.email =data.data.email[0];
					}
					if(data.data.title){
						this.error.title =data.data.title[0];
					}
					if(data.data.content){
						this.error.content =data.data.content[0];
					}
					if(data.data.file){
						this.error.file =data.data.file[0];
					}
                }

 				this.$loading(false);
              }).catch(function (error) {
				Swal.fire({
					title: "",
					text: error,
					type: "error"
				});
				this.$loading(false);
			});
    	},
    	fileChanged(event){
    		var numFiles = event.target.files.length;
    		if(numFiles>0){
              	this.contact.file = event.target.files[0];

              	var fileReader = new FileReader();
				fileReader.readAsDataURL(event.target.files[0]);
				fileReader.onload = (event) => {
					$('#avatar').attr('src',event.target.result);
					$('#avatar').show();
				};
    		} else {
    			this.contact.file = '';
    			$('#avatar').attr('src', "");
	            $('#avatar').hide();
    			$('.color_orange').text('Thêm ảnh');
                $('.color_none').text('hoặc thả ảnh ở đây');
    		}
    	},
    }
};
</script>

<style scoped lang="scss">
.contact{
	input,
	textarea,
	select {
		&:focus{
			border: 1px solid #f57c00;
		}
	}
	.control-label::after{
		content:"*";
		color:red;
		margin-left:4px;
	}
	.add-file{
		color: #8c8c8c;
	    position: relative;
	    display: block;
	    border: dashed 1px #d9d9d9;
		cursor: pointer;
		padding: 30px 0;
		.file-name{
			background: #fff;
		    display: block;
		    text-align: center;
		    padding: 12px;
		    cursor: pointer;
			.color_orange{
				color: #f57c00!important;
			}
		}
		input{
		    position: absolute;
		    opacity: 0;
		    top: 0;
		    left: 0;
		    width: 100%;
		    height: 100%;
		    cursor: pointer;
		}
		&:hover{
			border: dashed 1px #f57c00;
		}
	}
	.add-file-image{
		img {
			height: 200px;
			width: auto;
			max-width: 100%;
			object-fit: contain;
		}
	}
}
</style>