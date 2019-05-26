$(function() {
    $('#calculatorError').hide();
});

$('#drunkRCalculateSubmit').click(function() {
	var volumeValue = $('#volume_value').val(),
		unitMultiplier = $('#volume_unit').val(),
		alcoholPercent = $('#alcohol_percent').val(),
		price = $('#price').val();
	console.log(volumeValue +" "+ unitMultiplier +" "+ alcoholPercent +" "+ price)
	if (volumeValue=="" || unitMultiplier=="" || alcoholPercent=="" || price=="") {
		$('#calculatorErrorText').text("ERROR! Your input shall not be unfilled.");
		$('#calculatorError').show();
		return;
	}
	var drunkRFactor = 1/(Number(volumeValue)*Number(unitMultiplier)* (Number(alcoholPercent)/100)) * price ;
	$('#drunkRCalculatorResult').text(drunkRFactor);
});