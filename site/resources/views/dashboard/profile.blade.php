@extends('layouts.dashboard')

@section('dashboard-content')

	<div class="main-body-container">
		<div class="profile-view card grid-bx">
			<div class="cover-image">
				<div class="edit-btn"><i class="fa icons fa-pencil"></i> </div>
				<div class="profile-name">Priya Roy <span class="pull-right"><i class="fa fa-user"></i> User Interface Designer</span></div>
			</div>
			<div class="profile-image">
				<img src="{{ url('images/karlene-quigley-large.jpg') }}" height="118" width="118"  style=" border-radius:50%;">
			</div>
			<div class="profile-details row">
					<div class="col-xs-2 wrapper-cols status-wrapper">
						<div class="dropdown profile-status">
                            <button class="btn btn-default dropdown-toggle status" type="button" data-toggle="dropdown"><i class="fa online fa-check-circle"></i> ONLINE <i class="fa drop-down fa-chevron-down"></i></button>
                            <ul class="dropdown-menu status-dropdown pull-right">
                                <li><a class="status-type type-online" href="#"><i class="fa online fa-check-circle"></i> ONLINE</a></li>
                                <li><a class="status-type type-away" href="#"><i class="fa fa-clock-o"></i> AWAY</a></li>
                                <li><a class="status-type type-dnd" href="#"><i class="fa fa-minus-circle"></i> DO NOT DISTURB</a></li>
                                <li><a class="status-type type-offline" href="#"><i class="fa fa-circle-o"></i> OFFLINE</a></li>
                            </ul>
                        </div>
						<div class="border-line"></div>
                    </div>
					<div class="col-xs-4 wrapper-cols details-wrapper m-t-sm">
	                    <div class="phone-mail-wrapper">    
	                        <span class="phone-details">
	                        	<i class="fa icons phone-icon fa-phone"></i>
	                        	<label for="phone-icon">+91 9039667558</label>
	                        </span>
	                        <span class="mail-details pull-right">
	                        	<i class="fa icons mail-icon fa-envelope"></i>
	                        	<label for="mail-icon">akshay@sahusoft.com</label>
	                        </span>
						</div>
						<div class="location-birthday-wrapper">
							<span class="location-details">
								<i class="fa icons location-icon fa-map-marker"></i>
	                        	<label for="location-icon">Jayanagar, Bangalore</label>
	                        </span>
							<span class="birthday-details pull-right">
								<i class="fa icons birthday-icon fa-gift"></i>
	                        	<label for="birthday-icon">06 March, 1994</label>
	                        </span>
						</div>
						<div class="border-line"></div>
					</div>
					<div class="col-xs-4 wrapper-cols friends-wrapper">
						<div class="friend-title">Friends</div>
						<div class="friend-images">
							<img class="image-1" src="{{ url('images/1.png') }}"  style=" border-radius:50%;">
							<img class="image-2" src="{{ url('images/2.png') }}"  style=" border-radius:50%;">
							<img class="image-3" src="{{ url('images/3.png') }}"  style=" border-radius:50%;">
							<img class="image-4" src="{{ url('images/1.png') }}"  style=" border-radius:50%;">
							<img class="image-5" src="{{ url('images/2.png') }}"  style=" border-radius:50%;">
							<img class="image-6" src="{{ url('images/3.png') }}"  style=" border-radius:50%;">
						</div>
						<div class="friends-count">50 +</div>
						<div class="border-line"></div>
					</div>
					<div class="col-xs-2 wrapper-cols edit-wrapper">
						<div class="btn btn-primary edit-btn"><i class="fa fa-pencil-square-o"></i> EDIT PROFILE</div>
					</div>
				
			</div>

		</div>
		<div class="row row-1">
            <div class="col-md-8 left-wrapper">
          		<div class="comment-input-wrapper card grid-bx card card-default card grid-bx">
          			<div class="comment-input-body card-block">
          				<textarea class="comment-input" placeholder="What's going on?"></textarea>
          			</div>
          			<div class="card-footer comment-input-footer clearfix">
          				<i class="fa icons fa-smile-o"></i>
          				<i class="fa icons fa-picture-o"></i>
          				<button class="btn btn-primary post-btn pull-right">POST</button>
          			</div>
          		</div>
          		<div class="comment-wrapper card card-default card grid-bx">
          			<div class="comment-body card-block">
          				<div class="comment-header clearfix">
          					<div class="comment-profile">
          						<div class="profile-image">
									<img src="{{ url('images/2.png') }}"  style=" border-radius:50%;">
								</div>
								<div class="profile-name">Obidullah Plabon
									<div class="active-time">5 min ago</div>
								</div>
          					</div>
          					<div class="right-btns pull-right">
          						<i class="fa icons fa-comment"></i><label for="fa-comment">3</label>
          						<i class="fa icons fa-heart"></i><label for="fa-heart">7</label>
		          				<div class="border-line"></div>
		          				<i class="fa icons fa-trash"></i>
          					</div>
          				</div>
						<div class="comment-title">
          					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.
          					<div class="border-line"></div>
          				</div>
          			</div>
					<div class="other-comment-body comment-body">
          				<div class="other-comment-header comment-header clearfix">
          					<div class="other-comment-profile comment-profile">
          						<div class="profile-image">
									<img src="{{ url('images/1.png') }}"  style=" border-radius:50%;">
								</div>
								<div class="profile-name">Ahosanuddin Noman
								</div>
          					</div>
          					<div class="right-btns pull-right">
								<div class="active-time">5 min ago</div>
          					</div>
          				</div>
						<div class="other-comment-title comment-title">
          					Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet.
          					<div class="border-line"></div>
          				</div>
          			</div>
					<div class="other-comment-body comment-body">
          				<div class="other-comment-header comment-header clearfix">
          					<div class="other-comment-profile comment-profile">
          						<div class="profile-image">
									<img src="{{ url('images/3.png') }}"  style=" border-radius:50%;">
								</div>
								<div class="profile-name">Alberuni Azad
								</div>
          					</div>
          					<div class="right-btns pull-right">
								<div class="active-time">4 min ago</div>
          					</div>
          				</div>
						<div class="other-comment-title comment-title">
          					Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero.
          					<div class="border-line"></div>
          				</div>
          			</div>
          			<div class="other-comment-input">
          				<textarea class="comment-input-box" placeholder="Write a Comment and Press Enter"></textarea>
          			</div>
          		</div>
				<div class="comment-wrapper card card-default card grid-bx">
          			<div class="comment-body card-block">
          				<div class="comment-header clearfix">
          					<div class="comment-profile">
          						<div class="profile-image">
									<img src="{{ url('images/2.png') }}"  style=" border-radius:50%;">
								</div>
								<div class="profile-name">Obidullah Plabon
									<div class="active-time">5 min ago</div>
								</div>
          					</div>
          					<div class="right-btns pull-right">
          						<i class="fa icons fa-comment"></i><label for="fa-comment">3</label>
          						<i class="fa icons fa-heart"></i><label for="fa-heart">7</label>
		          				<div class="border-line"></div>
		          				<i class="fa icons fa-trash"></i>
          					</div>
          				</div>
						<div class="comment-title">
          					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.
          					<div class="image-container">
								<img src="{{ url('images/wallpaper1.jpg') }}" >
          					</div>
          					<div class="border-line"></div>
          				</div>
          			</div>
					<div class="other-comment-body comment-body">
          				<div class="other-comment-header comment-header clearfix">
          					<div class="other-comment-profile comment-profile">
          						<div class="profile-image">
									<img src="{{ url('images/3.png') }}"  style=" border-radius:50%;">
								</div>
								<div class="profile-name">Alberuni Azad
								</div>
          					</div>
          					<div class="right-btns pull-right">
								<div class="active-time">4 min ago</div>
          					</div>
          				</div>
						<div class="other-comment-title comment-title">
							Fusce iaculis mollis tortor, dignissim venenatis ligula sagittis non. Duis non accumsan est, consectetur tincidunt ipsum. Aenean porttitor congue mattis. <br>

	      					Aliquam porta rhoncus leo, non porta nulla luctus ac. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae<br>

							Vivamus convallis consectetur sem in cursus. Sed sapien arcu, laoreet vitae rutrum ac, placerat :) :P
	      					<div class="border-line"></div>
          				</div>
          			</div>
          			<div class="other-comment-input">
          				<textarea class="comment-input-box" placeholder="Write a Comment and Press Enter"></textarea>
          			</div>
          		</div>
          	</div>
    
            <div class="col-md-4 right-wrapper">
            	<div class="chat-wrapper card grid-bx card card-default">
                    <div class="card-header chat-header">
                        <h4 class="card-title header-title">Chat</h4>
                        <div class="header-icons pull-right">
							<ul class="nav nav-pills icons-group" role="tablist">
								<li class="icon-wrapper nav-item">
									<a class="nav-link active" data-toggle="tab" href="#chat" role="tab">
										<i class="fa fa-comments-o"></i>
									</a>
								</li>
								<li class="icon-wrapper nav-item">
									<a class="nav-link" data-toggle="tab" href="#profile	" role="tab">
										<i class="fa fa-users"></i>
									</a>
								</li>
							</ul>
                        </div>
                    </div>
                    <div class="tab-content card-block chat-body">
                        <div class="tab-pane active" id="chat">
                        	<div class="chat-profile">
	      						<div class="profile-image">
	      							<div class="online-symbol"></div>
									<img src="{{ url('images/2.png') }}"  style=" border-radius:50%;">
								</div>
								<div class="profile-name">Muhsin
									<div class="profile-post">Designer</div>
								</div>
	      					</div>
							<div class="chat-input-wrapper input-group">
	      						<input type="text" class="chat-input-box input-lg form-control" height="25px" placeholder="Write Message...">
	      						<i class="fa icons fa-paper-plane input-group-addon"></i>
	      					</div>
							<div class="self-msg-wrapper msg-wrapper">
	      						<div class="self-msg">For, grass firmament. Good have. Fowl were land land heaven open that let days fill void. Very lesser own wherein their.</div>
	      						<div class="msg-time">12:00 AM</div>
	      					</div>
							<div class="other-msg-wrapper msg-wrapper">
	      						<div class="other-msg">Likeness second, whales. In darkness it wherein place. Were great sea be form Gathering tree grass form every.</div>
	      						<div class="msg-time">11:54 PM</div>
	      					</div>
							<div class="self-msg-wrapper msg-wrapper">
	      						<div class="self-msg">Saying bring herb that were which have doesn't over divide spirit bearing. Bring. Seasons moving doesn't god.</div>
	      						<div class="msg-time">11:52 PM</div>
	      					</div>
							<div class="other-msg-wrapper msg-wrapper">
	      						<div class="other-msg">Grass his was behold they're fly sixth so appear yielding. male creeping green.</div>
	      						<div class="msg-time">11:50 PM</div>
	      					</div>
                        </div>
						<div class="tab-pane" id="profile">
							<div class="chat-input-wrapper input-group">
	      						<input type="text" class="chat-input-box input-lg form-control" placeholder="Search User to Chat With...">
	      						<i class="fa icons fa-search input-group-addon"></i>
	      					</div>
                        	<div class="chat-profile">
	      						<div class="profile-image">
	      							<div class="online-symbol"></div>
									<img src="{{ url('images/1.png') }}"  style=" border-radius:50%;">
								</div>
								<div class="profile-name">Muhsin 
									<div class="profile-post">Designer</div>
								</div>
	      					</div>
							<div class="chat-profile">
	      						<div class="profile-image">
	      							<div class="online-symbol"></div>
									<img src="{{ url('images/2.png') }}"  style=" border-radius:50%;">
								</div>
								<div class="profile-name">Mrigank Mridul 
									<div class="profile-post">Senior Developer</div>
								</div>
	      					</div>
							<div class="chat-profile">
	      						<div class="profile-image">
	      							<div class="online-symbol"></div>
									<img src="{{ url('images/1.png') }}"  style=" border-radius:50%;">
								</div>
								<div class="profile-name">Sankhadeep Roy 
									<div class="profile-post">Senior Developer</div>
								</div>
	      					</div>
							<div class="chat-profile">
	      						<div class="profile-image">
	      							<div class="online-symbol"></div>
									<img src="{{ url('images/1.png') }}"  style=" border-radius:50%;">
								</div>
								<div class="profile-name">Akshay Jain 
									<div class="profile-post">Software Engineer</div>
								</div>
	      					</div>
							<div class="chat-profile">
	      						<div class="profile-image">
	      							<div class="online-symbol"></div>
									<img src="{{ url('images/2.png') }}"  style=" border-radius:50%;">
								</div>
								<div class="profile-name">Aditya Thakur 
									<div class="profile-post">Software Engineer</div>
								</div>
	      					</div>							
                        </div>												
                    </div>
                </div>
				<div class="activity-wrapper card grid-bx card card-default">
                    <div class="card-header activity-header">
                        <h3 class="card-title header-title">RECENT ACTIVITY</h3>
                    </div>
                    <div class="card-block activity-body">
                    	<ul>
                    		<li class="comment-title"><i class="fa icons fa-upload"></i>Uploaded <span class="highlight-part">Dashboard.psd</span></li>
                    		<li class="comment-title"><i class="fa icons fa-user-plus"></i>Became friends with <span  class="highlight-part">Porimol Chandra Roy</span></li>
                    		<li class="comment-title"><i class="fa icons fa-trophy"></i>Unlocked an Achievement : <span  class="highlight-part">Best Employee of The Month!</span></li>
                    		<li class="comment-title"><i class="fa icons fa-comment"></i>Commented on Obidullah Plabon's <span  class="highlight-part">Post.</span></li>
                    		<li class="comment-title"><i class="fa icons fa-pencil"></i> <span class="highlight-part">Wrote</span> on Arefien Shamsul's Wall.</li>
                    		<li class="comment-title"><i class="fa icons fa-thumbs-up"></i>Liked Alberuni Azad's <span  class="highlight-part">Photo</span></li>
                    		<li class="comment-title"><i class="fa icons fa-user-plus"></i>Became friends with <span  class="highlight-part">Ahosanuddin Noman</span></li>
                    		<li class="comment-title"><i class="fa icons fa-upload"></i>Uploaded <span  class="highlight-part">Profile.psd</span></li>
                    	</ul>
                    </div>
                </div>
            </div>
        </div>
	</div>

@endsection