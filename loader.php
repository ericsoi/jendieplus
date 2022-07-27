<div class="wo_about_wrapper_parent">
	<div class="wo_about_wrapper">
		<div class="hero hero-overlay" style="background-color: #d84c47;">
			<div class="container">
				<h1 class="text-center">{{LANG upload_new_video}}</h1>
			</div>
		</div>
		<svg id="wave" viewBox="0 0 100 15"><path fill="#d84c47" opacity="0.5" d="M0 30 V15 Q30 3 60 15 V30z"></path><path fill="#d84c47" d="M0 30 V12 Q30 17 55 12 T100 11 V30z"></path></svg>
	</div>
</div>
<div class="col-md-2"></div>
<div class="col-md-8 pt_page_margin">
	<div class="content pt_shadow">
		<div class="col-md-12 pt_upload_vdo">
			<?php if ($pt->user->admin == 1) { ?>
				<div class="alert alert-warning">
					<h4>Just admins can see this message</h4>
					<p>Note: Your server max upload size is: <?php echo ini_get('upload_max_filesize')?>, means you can't upload files that are larger than: <?php echo ini_get('upload_max_filesize')?><br><br> If you want to increase the limit or If you can't upload large files, go to Admin Settings > Settings > Site Settings > Max upload size and increase the value, if you still can't upload large files, please contact your host provider and let them increase the upload limit and max_execution_time.</p>
				</div>
			<?php } ?>
			<div class="upload upload-video" data-block="video-drop-zone">
				<div>
					<svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" class="feather feather-upload"><path d="M14,13V17H10V13H7L12,8L17,13M19.35,10.03C18.67,6.59 15.64,4 12,4C9.11,4 6.6,5.64 5.35,8.03C2.34,8.36 0,10.9 0,14A6,6 0 0,0 6,20H19A5,5 0 0,0 24,15C24,12.36 21.95,10.22 19.35,10.03Z" /></svg>
					<h4>{{LANG darg_drop_video}}</h4>
					<p>{{LANG or}} {{LANG click_2choose_file}}</p>
					<button class="btn btn-main">{{LANG upload}}</button>
				</div>
			</div>
			<div class="progress hidden">
				<span class="percent">0%</span>
				<div class="progress_bar_parent">
					<div class="bar upload-progress-bar progress-bar active"></div>
				</div>
				<div class="clear"></div>
				<div class="text-center pt_prcs_vdo"></div>
			</div>

<style>
.form-group1.hidden {
  visibility:hidden;
}
.form-group1.hidden {  /*this is being used, it overrides the previous rule*/
  position:absolute;
  left:-999em;
}
p {margin:0}
</style>

			<form action="" method="POST" id="upload-video" style="visibility: hidden;">
				<input type="file" name="video" accept="video/*" class="upload-video-file">
			</form>
			<div class="fluid upload-ffmpeg-mode hidden" id="upload-form">
				<div class="col-md-12">
					<form action="" class="form-horizontal setting-panel pt_forms" method="POST">
						<div class="form-group">
							<label class="col-md-12" for="title">{{LANG video_title}}</label>
							<div class="col-md-12">
								<input id="title" name="title" type="text" placeholder="" class="form-control input-md">
								<span class="help-block">{{LANG video_title_help}}</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="description">{{LANG video_description}}</label>
							<div class="col-md-12">
								<textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-12" for="category_id">{{LANG category}}</label>
							<div class="col-md-12">
								<select name="category_id" id="category_id" class="form-control">
									<?php foreach($pt->categories as $key => $category) {?>
									<option value="<?php echo $key?>"><?php echo $category?></option>
									<?php } ?>
								</select>
							</div>
						</div>
                  <!--<div class="form-group1">--><div class="form-group1 hidden">
                     <!--<label class="col-md-12" for="privacy">{{LANG privacy}}</label>-->
                     <!--<div class="col-md-12">-->
                        <select name="privacy" id="privacy" class="form-control">
                              <option hidden value="0">public</option>
						      <option hidden value="1">private</option>
    						  <option selected value="2"></option>
                               <!--<option value="2">{{LANG unlisted}}</option>-->
                        </select>
                     <!--</div>-->
                  </div>
                  <div class="form-group1 hidden">
                        <!--<label class="col-md-12" for="age_restriction">{{LANG age_restriction}}</label>-->
                        <!--<div class="col-md-12">-->
                           <select name="age_restriction" id="age_restriction" class="form-control">
                              <option selected value="1">{{LANG all_ages}}</option>
                              <option hidden value="2"></option>
                           </select>
                        <!--</div>-->
                     </div>
						<div class="form-group">
							<label class="col-md-12" for="tags">{{LANG tags}}</label>
							<div class="col-md-12">
								<input id="mySingleFieldTags" name="tags" type="text" placeholder="" class="form-control input-md">
								<span class="help-block">{{LANG tags_help}}</span>
							</div>
						</div>

						<div class="form-group hidden" id="video-thumnails">
							<label class="col-md-12" for="thumbnail">{{LANG thumbnail}}</label>
							<div class="col-md-12">
								<div class="fluid">
									<div class="carousel slide" id="choose-thumnail-cr" data-interval="false" style="cursor: pointer">
										<div class="carousel-inner">
											<div class="item active"></div>
										</div>
										<div class="fluid choose-thumnail-control">
											<span class="pull-left">{{LANG video_thumbs}}</span>
											<span class="pull-right">
												<a class="btn btn-default" href="#choose-thumnail-cr" data-slide="prev">
													<i class="fa fa-caret-left"></i>
												</a>
												<a class="btn btn-default" href="#choose-thumnail-cr"  data-slide="next">
													<i class="fa fa-caret-right"></i>
												</a>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="last-sett-btn modal-footer" style="margin: 0px -40px -10px -40px;">
							<button type="submit" id="submit-btn" class="btn btn-main setting-panel-mdbtn" disabled><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check-circle'><path d='M22 11.08V12a10 10 0 1 1-5.93-9.14'></path><polyline points='22 4 12 14.01 9 11.01'></polyline></svg> {{LANG publish}}</button>
						</div>
						<input type="hidden" name="video-location" id="video-location" value="">
						<input type="hidden" name="video-thumnail" id="video-thumnail" value="">

					</form>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<form action="" id="thumbnail-form" method="POST">
   <input id="thumbnail" name="thumbnail" type="file" style="visibility: hidden;" accept="image/*">
   <div class="loading-spinner"></div>
</form>
<div class="col-md-2"></div>

<style>
.loading-spinner {
  -webkit-animation-play-state: running;
          animation-play-state: running;
  opacity: 1;
  position: relative;
  height: 100vh;
}
@-webkit-keyframes spinner {
  0% {
    -webkit-transform: translate3d(-50%, -50%, 0) rotate(0deg);
            transform: translate3d(-50%, -50%, 0) rotate(0deg);
  }
  100% {
    -webkit-transform: translate3d(-50%, -50%, 0) rotate(360deg);
            transform: translate3d(-50%, -50%, 0) rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: translate3d(-50%, -50%, 0) rotate(0deg);
            transform: translate3d(-50%, -50%, 0) rotate(0deg);
  }
  100% {
    -webkit-transform: translate3d(-50%, -50%, 0) rotate(360deg);
            transform: translate3d(-50%, -50%, 0) rotate(360deg);
  }
}
.loading-spinner.-paused {
  -webkit-animation-play-state: paused;
          animation-play-state: paused;
  opacity: 0.2;
  transition: opacity linear 0.1s;
}
.loading-spinner::before {
  -webkit-animation: 1.5s linear infinite spinner;
          animation: 1.5s linear infinite spinner;
  -webkit-animation-play-state: inherit;
          animation-play-state: inherit;
  border: solid 3px #dedede;
  border-bottom-color: #EF6565;
  border-radius: 50%;
  content: "";
  height: 40px;
  left: 50%;
  opacity: inherit;
  position: absolute;
  top: 50%;
  -webkit-transform: translate3d(-50%, -50%, 0);
          transform: translate3d(-50%, -50%, 0);
  width: 40px;
  will-change: transform;
}
</style>



<script>
var video_thumb = Array();
$(document).on('click', '.carousel-inner', function(event) {

   $('#thumbnail').trigger('click');
});
$('#thumbnail').change(function(event) {
   $.ajax({
        type: 'POST',
        url: "{{LINK aj/upload-thumbnail}}?hash=" + $('.main_session').val() ,
        data: new FormData($("#thumbnail-form")[0]),
        processData: false,
        contentType: false,
        success: function(data) {
            $('.carousel-inner').append('<div class="item"><img src="' + data.thumbnail + '"></div>');
            video_thumb.push(data.thumbnail);
            $('#video-thumnail').val(data.thumbnail);
            $(".carousel-inner").find('.item').removeClass('active');
            $(".carousel-inner").find('.item:last').addClass('active');
        }
    });
});
$(function () {

   var video_drop_block = $("[data-block='video-drop-zone']");

   if (typeof(window.FileReader)){
      video_drop_block[0].ondragover = function() {
         video_drop_block.addClass('hover');
         return false;
      };

      video_drop_block[0].ondragleave = function() {
         video_drop_block.removeClass('hover');
         return false;
      };

      video_drop_block[0].ondrop = function(event) {
         event.preventDefault();
         video_drop_block.removeClass('hover');
         var file = event.dataTransfer.files;
         $('#upload-video').find('input').prop('files', file);
      };
   }

	$("#mySingleFieldTags").tagit({
      allowSpaces: true
   });
	var bar         = $('.bar');
   var percent     = $('.percent');
   var prcsvdo		= $('.pt_prcs_vdo');
   var is_uploaded = false;


	$('#upload-video').submit(function(event) {
      var file_size = $(".upload-video-file").prop('files')[0].size;
      if (file_size > "{{CONFIG max_upload}}") {
         swal({
            title: '{{LANG error}}',
            text:  "{{LANG file_is_too_big}} <?php echo pt_size_format($pt->config->max_upload); ?>",
            type: 'error',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK',
            buttonsStyling: true,
            confirmButtonClass: 'btn btn-success',
         }).then(function(){
            swal.close();
            $('.upload-video-file').val('');
         },
         function() {
            swal.close();
            $('.upload-video-file').val('');
         });
         return false;
      }
      else{
         var filename = $('.upload').val().split('\\').pop();
         $('#title').val(filename);
         $('#upload-form').removeClass('hidden');
         $('.upload').addClass('hidden');
      }
   });

   $('#choose-thumnail-cr').bind('slid.bs.carousel', function (e) {
      console.log(video_thumb);
      var vsthumb = video_thumb[$(this).find('.active').index()];
      console.log(vsthumb);
      $("#video-thumnail").val(vsthumb);
   });

   $('#upload-video').ajaxForm({
      url: '{{LINK aj/upload-video-ffmpeg}}?hash=' + $('.main_session').val(),
      dataType:'json',
      beforeSend: function() {
         $('.progress').removeClass('hidden');
         var percentVal = '0%';
         bar.width(percentVal);
         percent.html(percentVal);
      },
      uploadProgress: function(event, position, total, percentComplete) {
         if(percentComplete > 50) {
            percent.addClass('white');
         }
         var percentVal = percentComplete + '%';
         bar.width(percentVal);
         percent.html(percentVal);

         if (percentComplete == 100) {
            prcsvdo.html('<svg width="30" height="10" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="#000"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite" /><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite" /></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite" /><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite" /></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite" /><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite" /></circle></svg> {{LANG processing_video}}');
            $('.progress').find('.bar').removeClass('upload-progress-bar');
         }
      },
      success: function(data) {
	    	percentVal = '0%';
	    	bar.width(percentVal);
         $('.progress').addClass('hidden');

         if (data.status == 200) {
         	$('#video-location').val(data.file_path);
         	Snackbar.show({text: '<i class="fa fa-check"></i> ' + data.file_name + ' {{LANG successfully_uploaded}}'});
         	$('#submit-btn').attr('disabled', false);
         	$('.upload-video-file').val('');
			   $('#title').val(data.file_name);
            $("#video-thumnails").removeClass('hidden');

            var i       = 0;
            var url     = '{img}';
            video_thumb = data.images;

            $('.carousel-inner').html('');
            $.each(video_thumb, function( index, value ) {
                $('.carousel-inner').append('<div class="item"><img src="' + value + '"></div>');
                i++;
            });
            $(".carousel-inner").find('.item:first-child').addClass('active');
            $("#video-thumnail").val(video_thumb[0]);
            $('.carousel').carousel({
              interval: false
            });


            // $("#video-thumnails").find('.item').each(function(index, el) {
            //    if (i == 0) {
            //       $("#video-thumnail").val(data.images[i]);
            //    }

            //    $(el).html($("<img>",{
            //       src:url.replace('{img}',data.images[i])
            //    }));

            // });
         }
         else if(data.status == 401){
            swal({
               title: '{{LANG oops}}!',
               text: "{{LANG upload_limit_reached}}!",
               type: 'info',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: '{{LANG upgrade_now}}',
               cancelButtonText: '{{LANG cancel}}',
               confirmButtonClass: 'btn btn-success margin-right',
               cancelButtonClass: 'btn',
               buttonsStyling: false
            }).then(function(){
               window.location.href = '{{LINK go_pro}}';
            },
            function() {
               window.location.href = '{{LINK }}';
            });
         }
         else if(data.status == 402){
            swal({
               title: '{{LANG error}}',
               text: data.message,
               type: 'error',
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'OK',
               buttonsStyling: true,
               confirmButtonClass: 'btn btn-success',
            }).then(function(){
               swal.close();
               $('.upload-video-file').val('');
            },
            function() {
               swal.close();
               $('.upload-video-file').val('');
            });
         }
         else {
         	Snackbar.show({showAction: false,backgroundColor: '#e22e40',text: '<div>'+ data.error +'</div>'});
         }
	    }
	});

	$('#upload-form form').ajaxForm({
      url: '{{LINK aj/ffmpeg-submit}}?hash=' + $('.main_session').val(),
      beforeSend: function() {
         $('#submit-btn').attr('disabled', true);
         $('#submit-btn').val("{{LANG please_wait}}");
      },
      success: function(data) {
	    	if (data.status == 200) {
	    		window.location.href = data.link;
	    	}
         else if(data.status == 402){
            swal({
               title: '{{LANG error}}',
               text: data.message,
               type: 'error',
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'OK',
               buttonsStyling: true,
               confirmButtonClass: 'btn btn-success',
            }).then(function(){

                window.location.href = '{{LINK upload-video}}';
            },
            function() {
               window.location.href = '{{LINK }}';
            });
         }
         else {
	    		$('#submit-btn').attr('disabled', false);
	    	    $('#submit-btn').val('{{LANG publish}}');
	    		Snackbar.show({text: '<div>'+ data.message +'</div>'});
	    	}
      }
	});

	$('.upload-video-file').on('change', function() {
   	$('#upload-video').submit();
	});
});

function PT_OpenUploadForm() {
	$('#upload-video').find('input').trigger('click');
}

jQuery(function($) {
   $(document).ready(function() {
      $( '.upload' ).on('click', function(e) {
         $( '.upload-video-file' ).trigger("click");
      });
   });
});
</script>
<style>.upload-s3-progressing{background: #4c9dd3;}</style>

<script>
//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js
</script>