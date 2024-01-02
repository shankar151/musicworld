<!doctype hmtl>
<html>
<head>
	<!--<style>
		#img-preview {
  display: none; 
  width: 155px;   
  border: 2px dashed #333;  
  margin-bottom: 20px;
}
#img-preview img {  
  width: 100%;
  height: auto; 
  display: block;   
}

[type="file"] {
  height: 0;  
  width: 0;
  overflow: hidden;
}
[type="file"] + label {
  font-family: sans-serif;
  background: #f44336;
  padding: 10px 30px;
  border: 2px solid #f44336;
  border-radius: 3px;
  color: #fff;
  cursor: pointer;
  transition: all 0.2s;
}
[type="file"] + label:hover {
  background-color: #fff;
  color: #f44336;
}
	</style>-->
	
	<style>
		img{
  max-width:180px;
}
input[type=file]{
padding:10px;
background:#2d2d2d;}
	</style>
	
	<script>
		  function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
	</script>
	
	<meta http-equiv="refresh" content="5">
</head>
<body>
<form>
  <!--<div>
    <div id="img-preview"></div>
    <img src="a.jpg" id="img-preview"/><input type="file" id="choose-file" name="choose-file" accept="image/*" />
    <label for="choose-file">Upload file</label>
  </div>
	-->
	<div>
		<input type='file' onchange="readURL(this);" />
		<img id="blah" src="http://placehold.it/180" alt="your image" />
	</div>
</form>
</body>
</html>