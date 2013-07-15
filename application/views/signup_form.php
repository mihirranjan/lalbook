<div class='ajaxpopformwrapper'>
<div class="ajaxpopforminner">
<h2>Signup  <a class="button cancel"><span class="inner"><img src="<?php echo image_url();?>close.png" /></span></a></h2>

<fieldset>
<label for="help-us-fulname">Full Name&nbsp;<span class="mandatory_label">*</span>:</label>
<div class="field">
				<input id="fulname" onblur="placeholder='E'"
					onfocus="placeholder=''" placeholder='Full Name' type="text"
					name="fulname" id="help-us-fulname" value="" />
			</div>
</fieldset>
<fieldset>
<label for="help-us-email">Your email address&nbsp;<span class="mandatory_label">*</span>:</label>
<div class="field">
				<input id="email" onblur="placeholder='Email Address'"
					onfocus="placeholder=''" placeholder='Email' type="text"
					name="email" id="help-us-email" value="" />
			</div>
</fieldset>
<fieldset>
<label for="help-us-username">Public Username&nbsp;<span class="mandatory_label">*</span>:</label>
<div class="field">
<input 	id="username" onblur="placeholder='Username'" onfocus="placeholder=''" placeholder='Username' 
		type="text" name="username" id="help-us-username" value="" /></div>
</fieldset>
<fieldset>
<label for="help-us-message">Goals in signing up for LalBook&nbsp;<span class="mandatory_label">*</span>::</label>
<div class="field">
<textarea onblur="placeholder='Goals'" onfocus="placeholder=''" placeholder='Goals' 
	id="message" name="message" cols="10" rows="2"></textarea>
</div>
</fieldset>
<fieldset>
<label for="help-us-password">Password&nbsp;<span class="mandatory_label">*</span>:</label>
<div class="field">
	<input 	onblur="placeholder='Password'" onfocus="placeholder=''" placeholder='Password' 
			type="password" name="password" id="password" value="" /></div>
</fieldset>
<fieldset>
<label for="help-us-cpassword">Confirm Password&nbsp;<span class="mandatory_label">*</span>:</label>
<div class="field">
	<input onblur="placeholder='Confirm Password'" onfocus="placeholder=''" placeholder='Confirm Password' type="password" 
		name="cpassword" id="cpassword"  value="" /></div>
</fieldset>
<fieldset>
<!--    <label for="help-us-email"> </label>-->

<input type="hidden" name="terms" id="example_text" value="<?php echo $terms->conditions;?>" />
<table>
<tr>
	<td class="terms">
		<input type="checkbox" name="terms"  id="help-us-terms" value="1" />
	</td>
	<td>
		Please accept <a href="#" onclick="example_popup()" style="color:#C10001;">Terms of Service*</a>
	</td>
</tr>
</table>
<span id="terms"></span> 
</fieldset>

</div>
<div class="buttons">
<div class="submit-button">
<input type="submit" style="cursor:pointer;" class="button form-submit-button clsBut" name="signup" value="Submit"/>
</div>

</div>
</div>    
<!-- Toggle and show this on success -->
<div style="display: none" id="ajaxpopform-success">
	<div class="inner">
		<h2>Thank You For Signup in Lalbook</h2>
		<h4>Please Check Confirmation Link Sent To Your Email Address To Register In Lalbook</h4>
	</div>
	<div class="buttons">
		<p
			style="left: -120px; position: relative; right: 0; text-align: center;">
			<a class="button cancel" id="cancel"><span class=""> <img
					src="<?php echo image_url();?>closeButton.png" />
			</span> </a>
		</p>
	</div>
</div>