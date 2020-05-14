/* Add to favourites */
function addFavourite(blog_id, user_id){
	if (user_id=='') {
		window.location='/sign-in';
	} else{
		$('.AF_Latest_blog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$('.RF_Latest_blog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$.ajax({
			url: 'add-to-favourite',
			method: 'POST',
			data: { blog_id:blog_id, user_id:user_id },
			success:function(response){
				if (response.success==true) {
					$('.AF_Latest_blog_'+blog_id).html('<i class="fas fa-star" onclick="removeFavourite('+blog_id+' ,'+user_id+');"></i>')
					$('.RF_Latest_blog_'+blog_id).html('<i class="fas fa-star" onclick="removeFavourite('+blog_id+' ,'+user_id+');"></i>')
				}
			}
		})
	}
}

/* Remove from favourites */
function removeFavourite(blog_id, user_id){
	if (user_id=='') {
		window.location='/sign-in';
	} else{
		$('.AF_Latest_blog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$('.RF_Latest_blog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$.ajax({
			url: 'remove-favourite',
			method: 'POST',
			data: { blog_id:blog_id, user_id:user_id },
			success:function(response){
				if (response.success==true) {
					$('.AF_Latest_blog_'+blog_id).html('<i class="far fa-star" onclick="addFavourite('+blog_id+' ,'+user_id+');"></i>')
					$('.RF_Latest_blog_'+blog_id).html('<i class="far fa-star" onclick="addFavourite('+blog_id+' ,'+user_id+');"></i>')
				}
			}
		})
	}
}

/* Like Blog */
function likeBlog(blog_id, user_id, status){
	if (user_id=='') {
		window.location='/sign-in';
	} else{
		$('.likeBlog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$('.unlikeBlog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$.ajax({
			url: '/like-blog',
			method: 'POST',
			data: { blog_id:blog_id, user_id:user_id, status:status },
			success:function(response){
				if (response.success==true) {
					$('.likeBlog_'+blog_id).html('<i class="fas fa-thumbs-up" onclick="unLikeBlog('+blog_id+','+user_id+')"></i>')
					$('.unlikeBlog_'+blog_id).html('<i class="fas fa-thumbs-up" onclick="unLikeBlog('+blog_id+','+user_id+')"></i>')
				$('.dislikeBlog_'+blog_id).html('<i class="far fa-thumbs-down" onclick="dislikeBlog('+blog_id+','+user_id+')"></i>')
				$('.undislikeBlog_'+blog_id).html('<i class="far fa-thumbs-down" onclick="dislikeBlog('+blog_id+','+user_id+')"></i>')

					$('.LikeCount_'+blog_id).html(response.likes)
					$('.DislikeCount_'+blog_id).html(response.dislikes)
				}
			}
		})
	}
}

/* Unlike Blog */
function unLikeBlog (blog_id, user_id, status){
	if (user_id=='') {
		window.location='/sign-in';
	} else{
		$('.likeBlog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$('.unlikeBlog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$.ajax({
			url: '/unlike-blog',
			method: 'POST',
			data: { blog_id:blog_id, user_id:user_id, status:status },
			success:function(response){
				$('.likeBlog_'+blog_id).html('<i class="far fa-thumbs-up" onclick="likeBlog('+blog_id+','+user_id+')"></i>')
				$('.unlikeBlog_'+blog_id).html('<i class="far fa-thumbs-up" onclick="likeBlog('+blog_id+','+user_id+')"></i>')
				$('.LikeCount_'+blog_id).html(response.likes)
				$('.DislikeCount_'+blog_id).html(response.dislikes)
			}
		})
	}
}

/* Dislike Blog */
function dislikeBlog(blog_id, user_id){
	if (user_id=='') {
		window.location='/sign-in';
	} else{
		$('.dislikeBlog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$('.undislikeBlog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$.ajax({
			url: 'dislike-blog',
			method: 'POST',
			data: { blog_id:blog_id, user_id:user_id },
			success:function(response){
				$('.likeBlog_'+blog_id).html('<i class="far fa-thumbs-up" onclick="likeBlog('+blog_id+','+user_id+')"></i>')
				$('.unlikeBlog_'+blog_id).html('<i class="far fa-thumbs-up" onclick="likeBlog('+blog_id+','+user_id+')"></i>')
				$('.dislikeBlog_'+blog_id).html('<i class="fas fa-thumbs-down" onclick="unDislikeBlog('+blog_id+','+user_id+')"></i>')
				$('.undislikeBlog_'+blog_id).html('<i class="fas fa-thumbs-down" onclick="unDislikeBlog('+blog_id+','+user_id+')"></i')
				$('.LikeCount_'+blog_id).html(response.likes)
				$('.DislikeCount_'+blog_id).html(response.dislikes)
			}
		})
	}
}

/* Un-dislike Blog */
function unDislikeBlog(blog_id, user_id){
	if (user_id=='') {
		window.location='/sign-in';
	} else{
		$('.dislikeBlog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$('.undislikeBlog_'+blog_id).html('<i class="fas fa-spinner fa-spin"></i>')
		$.ajax({
			url: 'undislike-blog',
			method: 'POST',
			data: { blog_id:blog_id, user_id:user_id },
			success:function(response){
				$('.likeBlog_'+blog_id).html('<i class="far fa-thumbs-up" onclick="likeBlog('+blog_id+','+user_id+')"></i>')
				$('.unlikeBlog_'+blog_id).html('<i class="far fa-thumbs-up" onclick="likeBlog('+blog_id+','+user_id+')"></i>')					
				$('.dislikeBlog_'+blog_id).html('<i class="far fa-thumbs-down" onclick="dislikeBlog('+blog_id+','+user_id+')"></i>')
				$('.undislikeBlog_'+blog_id).html('<i class="far fa-thumbs-down" onclick="dislikeBlog('+blog_id+','+user_id+')"></i>')
				$('.LikeCount_'+blog_id).html(response.likes)
				$('.DislikeCount_'+blog_id).html(response.dislikes)
			}
		})
	}
}