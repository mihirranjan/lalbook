<!-- BID FORM -->
<form method="post"  id="bidform" class="ui-widget-content bidform " style="display:none;" >  
	<div class='bidformwrapper'>
		<div class="ajaxpopforminner">
		<h2>Place Your Bid  <a class="button cancel"><span class="inner"><img src="<?php echo image_url();?>close.png" /></span></a></h2>
		<input type="hidden" id="bidid" name="hidden_bidid"/>
		<input type="hidden" id="bidjob" name="hidden_userid"/>
		<input type="hidden" id="usrmailid" name="hidden_mail"/>
		<input type="hidden" id="usercr" name="hidden_credit" />
		<input type="hidden" id="jobnames" name="hidden_jobname" />
		<input type="hidden" id="bideremail" name="hidden_bideremail" />
		<input type="hidden" id="biddernamee" name="hidder_bidername" />
		<input type="hidden" id="jobamt" name="hidden_jobamount" />  

		<fieldset>
		  <label for="help-us-email">Quote Your Price(All price in Rs.)*:</label>
		  <div class="field"><input type="text" name="bidamount" id="help-us-bidamount" value="" /></div>
		</fieldset>
		 <fieldset>
		  <label for="help-us-email">Enter End-Date*:</label>
		  <div class="field"><input type="text" name="deliverdate" id="help-us-deliverdate" class="popupDatepicker"  value=""  /></div>
		</fieldset>
		<!-- <fieldset>
		  <label for="help-us-email">Hours*:</label>
		  <div class="field"><input type="text" name="delivery" id="help-us-delivery" value="" /></div>
		</fieldset>-->
		<fieldset>
		  <label for="help-us-email">Message to the buyer(Optional):</label>
		  <div class="field"><textarea  name="desc" id="help-us-desc" cols="10" rows="10"></textarea></div>
		</fieldset>
		 <!-- <fieldset>
		<!--<label for="help-us-email">--><!--we will send your contact details along with your quoted price to this buyer..</label>
		 </fieldset>-->

		</div>
		<div class="buttons">
		<div class="submit-bid" style="text-align: center;width: 77px;margin: 0 auto;"><input type="submit" class="button form-submit-bid clsBut" name="Complete This Bid" value="send"/><!--<span class="inner">Send</span>--></div>
		<p style="clear: both; font-weight: bold; padding: 10px 0px; text-align: center; margin: 0px 50px;">*1 credit point will be deducted From your bidding credit</p>

		</div>
	</div>    
	<!-- Toggle and show this on success -->
	<div style="display:none" id="bidform-success">
		<div class="">
			<h2>Thank you For Your Bid</h2>
			<h4>we will send  your quoted price</h4>
		</div>
		<div class="buttons">
			<a class="button cancel"><span class=""><img src="<?php echo image_url();?>closeButton.png" /></span></a>
		</div>
	</div>
</form>


<form method="post"  id="msgform" class="ui-widget-content msgform" style="display:none;" action="">  
	<div class='msgformwrapper'>
		<div class="ajaxpopforminner">
		<h2>Send Your Message  <a class="button canceld"><span class="inner"><img src="<?php echo image_url();?>close.png" /></span></a></h2>
		<input type="hidden" id="toid" name="hidden_toid"/>
		<input type="hidden" id="fromid" name="hidden_fromid"/>
		<input type="hidden" id="jobidss" name="hidden_jobid"/>
		<input type="hidden" id="tomail" name="hidden_tomail" />
		<input type="hidden" id="biddermailid" name="hidden_bidermail" />

		<fieldset>
		<label for="help-us-email">Message to the buyer:</label>
		<div class="field"><textarea  name="desc" id="help-us-desc" cols="10" rows="10"></textarea></div>
		</fieldset>
		<!-- <fieldset>
		<!--<label for="help-us-email">--><!--we will send your contact details along with your quoted price to this buyer..</label>
		</fieldset>-->

		</div>
		<div class="buttons">
		<div class="submit-msg" style="text-align: center;width: 77px;margin: 0 auto;"><input type="submit" class="button form-submit-msg clsBut" name="Complete This Bid" value="send"/><!--<span class="inner">Send</span>--></div>


		</div>
	</div>    
	<!-- Toggle and show this on success -->
	<div style="display:none" id="msgform-success">
		<div class="">
		<h2>Thank you For Your Message</h2>
		<h4>we will send  your Message to this user..</h4>
		</div>
		<div class="buttons">
		<a class="button canceld"><span class=""><img src="<?php echo image_url();?>closeButton.png" /></span></a>
		</div>
	</div>
</form>

 
<form method="post"  id="amountedit" class="ui-widget-content amountedit" style="display:none;" action="">  

	<div class='amtformwrapper'>
		<div class="ajaxpopforminner">
		<h2>Award An Amount:  <a class="button closebutn"><span class="inner"><img src="<?php echo image_url();?>close.png" /></span></a></h2>
		<input type="hidden"  id="bidsid" name="hidden_bidamnt" />

		<fieldset>
		<label for="help-us-email">Awarded Amount:</label>
		<div class="field"><input type="text" name="editdamount" id="help-us-editdamount" value="" class="amttoaward"/></div>
		</fieldset>
		<!-- <fieldset>
		<!--<label for="help-us-email">--><!--we will send your contact details along with your quoted price to this buyer..</label>
		</fieldset>-->

		</div>
		<div class="buttons">
		<div class="submit-amt" style="text-align: center;width: 77px;margin: 0 auto;"><input type="submit"   id="tomsg" class="button form-submit-amt clsBut" name="Complete This Bid" value="send"/><!--<span class="inner">Send</span>--></div>


		</div>
	</div>    
	<!-- Toggle and show this on success -->
	<div style="display:none" id="amtform-success">
		<div class="">
		<h2>Your Amount Is Changed</h2>
		<h4>we will send the Details to this user..</h4>
		</div>
		<div class="buttons">
		<a class="button closebutn"><span class=""><img src="<?php echo image_url();?>closeButton.png" /></span></a>
		</div>
	</div>
</form>


<form method="post"  id="tobiddmsgform" class="ui-widget-content tobiddmsgform" style="display:none;" action="">  

	<div class='tomsgformwrapper'>
	<div class="ajaxpopforminner">
	<h2>Send Your Message  <a class="button canceldd"><span class="inner"><img src="<?php echo image_url();?>close.png" /></span></a></h2>
	<input type="hidden" id="touid" name="hidden_touid"/>
	<input type="hidden" id="fromuid" name="hidden_fromuid"/>
	<input type="hidden" id="ujobidss" name="hidden_ujobid"/>
	<input type="hidden" id="toemail" name="hidden_toemail" />
	<input type="hidden" id="bidderumailid" name="hidden_biderumail" />

	<fieldset>
	  <label for="help-us-email">Message to the BidUser:</label>
	  <div class="field"><textarea  name="descrpt" id="help-us-descrpt" cols="10" rows="3"></textarea></div>
	</fieldset>
	 <!-- <fieldset>
	<!--<label for="help-us-email">--><!--we will send your contact details along with your quoted price to this buyer..</label>
	 </fieldset>-->

	</div>
	<div class="buttons">
	<div class="submit-tomsg" style="text-align: center;width: 77px;margin: 0 auto;"><input type="submit"   id="tomsg" class="button form-submit-tomsg clsBut" name="Complete This Bid" value="send"/><!--<span class="inner">Send</span>--></div>


	</div>
	</div>    
	<!-- Toggle and show this on success -->
	<div style="display:none" id="tomsgform-success">
	<div class="">
	<h2>Thank you For Your Message</h2>
	<h4>we will send your Message  to this user..</h4>
	</div>
	<div class="buttons">
	<a class="button canceldd"><span class=""><img src="<?php echo image_url();?>closeButton.png" /></span></a>
	</div>
	</div>
</form>

 
<form method="post"  id="nologin" class="ui-widget-content nobidform bidform" style="display:none" action="">  
	
	<!--<div id="nologin" style="display:none" class="nobidform">-->
	<div class='bidformwrapper'>
	<div class="ajaxpopforminner" style=" background: none repeat scroll 0 0 #fff !important; min-height: 100px; text-align: center;padding:10px;line-height:30px;">
	<h3> <a class="button close"><span class="inner" style="padding:0 0 5px !important;"><img src="http://demo.maventricks.com/lalbook/application/css/images/close_but.png" /></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please<br /> Login To Place<br /> Your Bid </h3>
	</div> 
	</div>
</form>



