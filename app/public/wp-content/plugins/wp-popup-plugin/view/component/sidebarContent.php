<div id="overall" class="content-section input-group" data-group="group1">
	<div>
		<h3>Color</h3>
		<input type="color" id="favcolor1" name="group1[color]" />
	</div>
	<div class="range-group">
		<h3>Opacity</h3>
		<input type="range" name="group1[opacity]" class="range-input" id="volumeRange1" min="0" max="100" value="50">
		<div class="input-container">
			<input type="number" class="number-input" id="volumeNumber1" min="0" max="100" value="50">
			<span class="percentage">%</span>
		</div>
	</div>
</div>

<div id="title" class="content-section input-group" data-group="group2">
	<div>
		<h3>Color</h3>
		<input type="color" id="favcolor2" name="group2[color]" />
	</div>
	<div class="range-group">
		<h3>Font Size</h3>
		<input type="range" class="range-input" id="volumeRange2" min="0" max="100" value="50" name="group2[fontSize]">
		<div class="input-container">
			<input type="number" class="number-input" id="volumeNumber2" min="0" max="100" value="50">
			<span class="percentage">%</span>
		</div>
	</div>
	<div class="range-group">
		<h3>Line Height</h3>
		<input type="range" name="group2[lineHeight]" class="range-input" id="volumeRange3" min="0" max="100" value="50">
		<div class="input-container">
			<input type="number" class="number-input" id="volumeNumber3" min="0" max="100" value="50">
			<span class="percentage">%</span>
		</div>
	</div>

</div>

<div id="container" class="content-section input-group" data-group="group3">
	<div class="range-group">
		<h3>Padding</h3>
		<input type="range" class="range-input" name="group3[padding]" id="volumeRange4" min="0" max="100" value="10">
		<div class="input-container">
			<input type="number" class="number-input" id="volumeNumber4" min="0" max="100" value="10">
			<span class="percentage">%</span>
		</div>
	</div>
	<div class="range-group">
		<h3>Border Radius</h3>
		<input type="range" name="group3[borderRadius]" id="volumeRange5" class="range-input" min="0" max="100" value="0">
		<div class="input-container">
			<input type="number" class="number-input" id="volumeNumber5" min="0" max="100" value="0">
			<span class="percentage">%</span>
		</div>
	</div>
	<div>
		<h3>Background Image</h3>
		<div class="image-upload">
			<button id="selectImage" type="button">Pilih Gambar</button>
			<input type="hidden" id="fileInput" name="img">
			<img id="previewImage" src="" style="max-width: 200px; display: none;">
		</div>
	</div>
</div>

<div id="content" class="content-section input-group" data-group="group4">
	<div>
		<h3>Color</h3>
		<input type="color" id="favcolor3" name="group4[color]" />
	</div>
	<div class="range-group">
		<h3>Font Size</h3>
		<input type="range" name="group4[fontSize]" id="volumeRange6" class="range-input" min="0" max="100" value="0">
		<div class="input-container">
			<input type="number" class="number-input" id="volumeNumber6" min="0" max="100" value="0">
			<span class="percentage">%</span>
		</div>
	</div>

</div>
<div id="button" class="content-section input-group" data-group="group5">
	<div>
		<h3>Button</h3>
		<input type="hidden" name="button" value="0">
		<input type="checkbox" name="button" value="1"> True / False
	</div>
	<div class="range-group">
		<h3>Padding</h3>
		<input type="range" name="buttonstyle[padding]" id="volumeRange6" class="range-input" min="0" max="100" value="0">
		<div class="input-container">
			<input type="number" class="number-input" id="volumeNumber6" min="0" max="100" value="0">
			<span class="percentage">%</span>
		</div>
	</div>
	<div class="range-group">
		<h3>Text Size</h3>
		<input type="range" name="buttonstyle[fontSize]" id="volumeRange6" class="range-input" min="0" max="100" value="0">
		<div class="input-container">
			<input type="number" class="number-input" id="volumeNumber6" min="0" max="100" value="0">
			<span class="percentage">%</span>
		</div>
	</div>
</div>
