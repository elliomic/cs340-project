<?php include "_header.php"; ?>

<h2 class="x-display2">PEBCAK Services</h2>
<p class="x-heading2">Enter your address to see available plans.</p>

<section class="x-localization x-ui-theme--light" data-preloader="{&quot;type&quot;:&quot;global&quot;, &quot;message&quot;:&quot;Checking your address...&quot;}">
  <form action="index.php" method="post" data-form-dealfinder-localization="">
	<fieldset>
	  <legend class="x--vh" aria-hidden="true">Tell us where you'd like PEBCAK service</legend>
	  
	  <div class="x-flex-row center-xs middle-xs">
		
		<div class="x-flex__col-xs-12 x-flex__col-md-6">
		  <div class="x-flex__content">
			<div class="x-field--text" data-preloader-suppress="" data-suggestions-multi="{&quot;requiredIds&quot;:[&quot;Address_UnitNumber&quot;], &quot;url&quot;:&quot;search_results.php&quot;}">
			  <label class="x-field__label x-heading5 x-field__label--floating-label" for="Address_StreetAddress">Street Address</label>
			  <input autocomplete="off" class="x-field__input" data-validate="" data-validate-message="A valid Street Address is required" data-validate-pattern="^\s*(?:[^%\s]+\s+[^%\s]+){1,}(?:[^%]*)$" data-validate-required="True" id="Address_StreetAddress" name="Address.StreetAddress" placeholder="Street Address" type="text" value="">
			</div>
		  </div>
		</div>
		<div class="x-flex__col-xs-4 x-flex__col-md-3">
		  <div class="x-flex__content">
			<div class="x-field--text">
			  <label class="x-field__label x-heading5 x-field__label--floating-label" for="Address_UnitNumber">Unit</label>
			  <input class="x-field__input" data-validate="" data-validate-message="Looks like your building has multiple units. Please enter your apartment number." id="Address_UnitNumber" name="Address.UnitNumber" placeholder="Unit" type="text" value="">
			</div>
		  </div>
		</div>
		<div class="x-flex__col-xs-8 x-flex__col-md-3">
		  <div class="x-flex__content">
			<div class="x-field--text">
			  <label class="x-field__label x-heading5 x-field__label--floating-label" for="Address_ZipCode">Zip Code</label>
			  <input class="x-field__input" data-validate="" data-validate-message="Please enter 5-digit ZIP Code" data-validate-pattern="^(?:[1-9]|0(?!0{4}))\d{4}(?:[-\s]\d{4})?$" data-validate-required="True" id="Address_ZipCode" maxlength="5" name="Address.ZipCode" placeholder="ZIP Code" type="text" value="">
			  
			</div>
		  </div>
		</div>
		<section aria-hidden="true" class="x-flex__col-xs-12 x-flex-row flush top-xs end-xs x-error-summary" data-error-summary="">
		  <div class="x-flex__col-xs-1">
			<svg focusable="false" aria-hidden="true" class="x-icon x-icon--error-small"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="images/global-sprite.svg#icon-exclamation"></use></svg>
		  </div>
		  <div class="x-flex__col-xs-11">
			<ol id="error-summary" data-error-summary-container="" class="x-error-summary__errors"></ol>
		  </div>
		</section>
		
		<div class="x-flex-row x-content center-xs">
		  <div class="x-flex__content">
			<button type="submit" class="x-button--solid"><span>View plans</span></button>
		  </div>
		</div>
	  </div>
	</fieldset>
  </form>
</section>
		  
<?php include "_footer.php"; ?>
