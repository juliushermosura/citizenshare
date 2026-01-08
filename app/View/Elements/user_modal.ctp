		<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
			<ul class="cd-switcher">
				<li><a href="#0" class="selected">Sign In</a></li>
				<li><a href="#0" class="">Start Your Own School</a></li>
			</ul>

			<div id="cd-login" class="is-selected"> <!-- log in form -->
				<form class="cd-form" method="post" action="<?php echo SITE_URL ?>" accept-charset="utf-8">
          <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
					<div class="center"><a href="#"><img src="/img/facebook_login.png" border="0" /></a></div>
					
					<p class="separator center">OR</p>
					
					<p class="fieldset">
						<input class="full-width has-padding has-border" id="signup-email" type="email" placeholder="E-mail" name="data[User][email]">
						<span class="cd-error-message">Error message here!</span>
					</p>
					
					<p class="fieldset">
						<input class="full-width has-padding has-border" id="signin-password" type="password" placeholder="Password" name="data[User][password]">
						<span class="cd-error-message">Enter password</span>
					</p>

					<p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>

					<p class="fieldset">
						By signing in, you agree to our <a class="orange" href="#">Community Guidelines</a>, <a class="orange" href="#">Terms of Use</a>, and <a class="orange" href="#">Privacy Policy</a>
					</p>

					<p class="fieldset">
						<input class="full-width" type="submit" value="Login">
					</p>
					<p class="fieldset">
						<input type="checkbox" id="remember-me" checked="">
						<label for="remember-me">Keep me signed in until I sign out.</label>
					</p>

					<p class="cd-form-bottom-message">Need an account? <span class="cd-switcher2"><a href="#0">Sign Up</a></span></p>

				</form>
				
				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-login -->

			<div id="cd-signup" class=""> <!-- sign up form -->
				<form class="cd-form">
					<div class="center"><a href="#"><img src="/img/signup_facebook.png" border="0" /></a></div>
					<p class="separator center">OR</p>

					<div class="fieldset">
						<div class="samerow">
							<input class="full-width has-padding has-border" id="signup-firstname" type="text" placeholder="First Name">
							<span class="cd-error-message">Error message here!</span>
						</div>
						<div class="samerow marginleft10">
							<input class="full-width has-padding has-border" id="signup-lastname" type="text" placeholder="Last Name">
							<span class="cd-error-message">Error message here!</span>
						</div>
					</div>

					<p class="fieldset">
						<input class="full-width has-padding has-border" id="signup-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding has-border" id="signup-password" type="text" placeholder="Password">
						<a href="#0" class="hide-password">Hide</a>
						<span class="cd-error-message">Error message here!</span>
					</p>
					
					<p class="fieldset">
						By signing up, you agree to our <a class="orange" href="#">Community Guidelines</a>, <a class="orange" href="#">Terms of Use</a>, and <a class="orange" href="#">Privacy Policy</a>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Create account">
					</p>
				</form>

				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-signup -->

			<div id="cd-signup2" class=""> <!-- sign up form -->
				<form class="cd-form">
					<div class="center"><a href="#"><img src="/img/signup_facebook.png" border="0" /></a></div>
					<p class="separator center">OR</p>

					<div class="fieldset">
						<div class="samerow">
							<input class="full-width has-padding has-border" id="signup-firstname" type="text" placeholder="First Name">
							<span class="cd-error-message">Error message here!</span>
						</div>
						<div class="samerow marginleft10">
							<input class="full-width has-padding has-border" id="signup-lastname" type="text" placeholder="Last Name">
							<span class="cd-error-message">Error message here!</span>
						</div>
					</div>

					<p class="fieldset">
						<input class="full-width has-padding has-border" id="signup-email2" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding has-border" id="signup-password2" type="text" placeholder="Password">
						<a href="#0" class="hide-password">Hide</a>
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding has-border" id="signup-paypal" type="text" placeholder="Your PayPal Email Address">
						<span class="cd-error-message">Error message here!</span>
						<em>Payments for your sales will be sent to this PayPal account. Open a PayPal Business or Premier account at <a href="http://www.paypal.com" target="_blank">PayPal.com</a>.</em>
					</p>

					<p class="fieldset">
						By signing up, you agree to our <a class="orange" href="#">Community Guidelines</a>, <a class="orange" href="#">Terms of Use</a>, and <a class="orange" href="#">Privacy Policy</a>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Create account">
					</p>
				</form>

				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-signup2 -->
			
			<div id="cd-reset-password"> <!-- reset password form -->
				<p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

				<form class="cd-form">
					<p class="fieldset">
						<label class="cd-email" for="reset-email">E-mail</label>
						<input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Reset password">
					</p>
				</form>

				<p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
			</div> <!-- cd-reset-password -->
			<a href="#0" class="cd-close-form">Close</a>
		</div> <!-- cd-user-modal-container -->
